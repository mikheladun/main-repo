
/*
 * Copyright 2006-2013 the original author or authors.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * {@link Tasklet} that executes a system command.
 *
 * The system command is executed asynchronously using injected
 * {@link #setTaskExecutor(TaskExecutor)} - timeout value is required to be set,
 * so that the batch job does not hang forever if the external process hangs.
 *
 * Tasklet periodically checks for termination status (i.e.
 * {@link #setCommand(String)} finished its execution or
 * {@link #setTimeout(long)} expired or job was interrupted). The check interval
 * is given by {@link #setTerminationCheckInterval(long)}.
 *
 * When job interrupt is detected tasklet's execution is terminated immediately
 * by throwing {@link JobInterruptedException}.
 *
 * {@link #setInterruptOnCancel(boolean)} specifies whether the tasklet should
 * attempt to interrupt the thread that executes the system command if it is
 * still running when tasklet exits (abnormally).
 *
 * @author Robert Kasanicky
 * @author Will Schipp
 * 
 * 
 */

package com.spi.wdr.jobs.etl;

import java.io.File;
import java.io.OutputStream;
import java.util.Map;
import java.util.concurrent.Callable;
import java.util.concurrent.FutureTask;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.batch.core.ExitStatus;
import org.springframework.batch.core.JobInterruptedException;
import org.springframework.batch.core.StepContribution;
import org.springframework.batch.core.StepExecution;
import org.springframework.batch.core.listener.StepExecutionListenerSupport;
import org.springframework.batch.core.scope.context.ChunkContext;
import org.springframework.batch.core.step.tasklet.SimpleSystemProcessExitCodeMapper;
import org.springframework.batch.core.step.tasklet.SystemCommandException;
import org.springframework.batch.core.step.tasklet.SystemCommandTasklet;
import org.springframework.batch.core.step.tasklet.SystemProcessExitCodeMapper;
import org.springframework.batch.core.step.tasklet.Tasklet;
import org.springframework.batch.repeat.RepeatStatus;
import org.springframework.beans.factory.InitializingBean;
import org.springframework.core.task.SimpleAsyncTaskExecutor;
import org.springframework.core.task.TaskExecutor;
import org.springframework.util.Assert;

/**
 * The OracleSqlLoaderTasklet class executes a system command asynchronously using injected
 * {@link #setTaskExecutor(TaskExecutor)} - timeout value is required to be set,
 * so that the batch job does not hang forever if the external process hangs.
 *
 * OracleSqlLoaderTasklet periodically checks for termination status (i.e.
 * {@link #setCommand(String)} finished its execution or
 * {@link #setTimeout(long)} expired or job was interrupted). The check interval
 * is given by {@link #setTerminationCheckInterval(long)}.
 *
 * When job interrupt is detected tasklet's execution is terminated immediately
 * by throwing {@link JobInterruptedException}.
 *
 * {@link #setInterruptOnCancel(boolean)} specifies whether the tasklet should
 * attempt to interrupt the thread that executes the system command if it is
 * still running when tasklet exits (abnormally).
 * 
 * @author Mikhel Adun
 *
 */
public class OracleSqlLoaderTasklet extends StepExecutionListenerSupport implements Tasklet, InitializingBean {

	protected static final Log logger = LogFactory.getLog(SystemCommandTasklet.class);

	private String command;

	private String[] environmentParams = null;

	private File workingDirectory = null;

	private SystemProcessExitCodeMapper systemProcessExitCodeMapper = new SimpleSystemProcessExitCodeMapper();

	private long timeout = 0;

	private long checkInterval = 1000;

	private StepExecution execution = null;

	private TaskExecutor taskExecutor = new SimpleAsyncTaskExecutor();

	private boolean interruptOnCancel = false;

	private boolean stopped = false;

	/**
	 * Execute system command and map its exit code to {@link ExitStatus} using
	 * {@link SystemProcessExitCodeMapper}.
	 */
	@Override
	public RepeatStatus execute(StepContribution contribution, ChunkContext chunkContext) throws Exception {

		FutureTask<Integer> systemCommandTask = new FutureTask<Integer>(new Callable<Integer>() {

			@Override
			public Integer call() throws Exception {
				ProcessBuilder pb = new ProcessBuilder(command);
				Map<String,String> env = pb.environment();
				for(String environmentParam : environmentParams) {
					String[] params = environmentParam.split("=");
					env.put(params[0], params[1]);
					
					if("IQ_ETL_HOME".equalsIgnoreCase(params[0])) {
						workingDirectory = new File(params[1]);
					}
				}

				pb.directory(workingDirectory);
				pb.redirectErrorStream(true);

				Process p = pb.start();
				return p.waitFor();
			}

		});

		long t0 = System.currentTimeMillis();

		taskExecutor.execute(systemCommandTask);

		while (true) {
			Thread.sleep(checkInterval);//moved to the end of the logic
			if (systemCommandTask.isDone()) {
				contribution.setExitStatus(systemProcessExitCodeMapper.getExitStatus(systemCommandTask.get()));
				return RepeatStatus.FINISHED;
			}
			else if (System.currentTimeMillis() - t0 > timeout) {
				systemCommandTask.cancel(interruptOnCancel);
				throw new SystemCommandException("Execution of system command did not finish within the timeout");
			}
			else if (execution.isTerminateOnly()) {
				systemCommandTask.cancel(interruptOnCancel);
				throw new JobInterruptedException("Job interrupted while executing system command '" + command + "'");
			}
			else if (stopped) {
				systemCommandTask.cancel(interruptOnCancel);
				contribution.setExitStatus(ExitStatus.STOPPED);
				return RepeatStatus.FINISHED;
			}
		}
	}

	/**
	 * @param command command to be executed in a separate system process
	 */
	public void setCommand(String command) {
		this.command = command;
	}

	/**
	 * @param envp environment parameter values, inherited from parent process
	 * when not set (or set to null).
	 */
	public void setEnvironmentParams(String[] envp) {
		this.environmentParams = envp;
	}

	/**
	 * @param dir working directory of the spawned process, inherited from
	 * parent process when not set (or set to null).
	 */
	public void setWorkingDirectory(String dir) {
		if (dir == null) {
			this.workingDirectory = null;
			return;
		}
		this.workingDirectory = new File(dir);
		Assert.isTrue(workingDirectory.exists(), "working directory must exist");
		Assert.isTrue(workingDirectory.isDirectory(), "working directory value must be a directory");

	}

	@Override
	public void afterPropertiesSet() throws Exception {
		Assert.hasLength(command, "'command' property value is required");
		Assert.notNull(systemProcessExitCodeMapper, "SystemProcessExitCodeMapper must be set");
		Assert.isTrue(timeout > 0, "timeout value must be greater than zero");
		Assert.notNull(taskExecutor, "taskExecutor is required");
	}

	/**
	 * @param systemProcessExitCodeMapper maps system process return value to
	 * <code>ExitStatus</code> returned by Tasklet.
	 * {@link SimpleSystemProcessExitCodeMapper} is used by default.
	 */
	public void setSystemProcessExitCodeMapper(SystemProcessExitCodeMapper systemProcessExitCodeMapper) {
		this.systemProcessExitCodeMapper = systemProcessExitCodeMapper;
	}

	/**
	 * Timeout in milliseconds.
	 * @param timeout upper limit for how long the execution of the external
	 * program is allowed to last.
	 */
	public void setTimeout(long timeout) {
		this.timeout = timeout;
	}

	/**
	 * The time interval how often the tasklet will check for termination
	 * status.
	 *
	 * @param checkInterval time interval in milliseconds (1 second by default).
	 */
	public void setTerminationCheckInterval(long checkInterval) {
		this.checkInterval = checkInterval;
	}

	/**
	 * Get a reference to {@link StepExecution} for interrupt checks during
	 * system command execution.
	 */
	@Override
	public void beforeStep(StepExecution stepExecution) {
		this.execution = stepExecution;
	}

	/**
	 * Sets the task executor that will be used to execute the system command
	 * NB! Avoid using a synchronous task executor
	 */
	public void setTaskExecutor(TaskExecutor taskExecutor) {
		this.taskExecutor = taskExecutor;
	}

	/**
	 * If <code>true</code> tasklet will attempt to interrupt the thread
	 * executing the system command if {@link #setTimeout(long)} has been
	 * exceeded or user interrupts the job. <code>false</code> by default
	 */
	public void setInterruptOnCancel(boolean interruptOnCancel) {
		this.interruptOnCancel = interruptOnCancel;
	}

	/**
	 * Will interrupt the thread executing the system command only if
	 * {@link #setInterruptOnCancel(boolean)} has been set to true.  Otherwise
	 * the underlying command will be allowed to finish before the tasklet
	 * ends.
	 *
	 * @since 3.0
	 * @see StoppableTasklet#stop()
	 */
//	@Override
	public void stop() {
		stopped = true;
	}

}
