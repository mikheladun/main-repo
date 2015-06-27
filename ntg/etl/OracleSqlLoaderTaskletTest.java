package com.spi.wdr.jobs.etl;

import java.util.Date;

import org.junit.Assert;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.batch.core.BatchStatus;
import org.springframework.batch.core.ExitStatus;
import org.springframework.batch.core.JobExecution;
import org.springframework.batch.test.JobLauncherTestUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(locations = { "classpath:/test-context.xml","classpath:/simple-job-launcher-context.xml","classpath:/meterReadingImportJob.xml" })
public class OracleSqlLoaderTaskletTest 
{

	@Autowired
    private JobLauncherTestUtils jobLauncherTestUtils;

	@Test
	public void testJob() {
		try {

			JobExecution jobExecution = jobLauncherTestUtils.launchStep("loadStagingReadingTable");
			Date startTime = jobExecution.getStartTime();
			Date endTime = jobExecution.getEndTime();

			BatchStatus status = jobExecution.getStatus();
			boolean unsuccessful = status.isUnsuccessful();

			ExitStatus exitStatus = jobExecution.getExitStatus();
			Assert.assertEquals(ExitStatus.COMPLETED.getExitCode(), exitStatus.getExitCode());

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
