/**
 * $Id: spiEclipseCodeTemplates.xml 4779 2009-12-11 16:43:35Z hongz $
 *
 * The following code is the property of The SPi Group.
 * Any attempt to redistribute the contents of this file, in whole or in part,
 * is strictly prohibited.
 *
 * Copyright (c) 2012 The SPi Group. All Rights Reserved.
 *
 * http://www.thespigroup.com
 */

package com.spi.wdr.jobs.etl;

import java.util.Arrays;
import java.util.HashMap;
import java.util.Map;

import javax.sql.DataSource;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.batch.core.resource.ListPreparedStatementSetter;
import org.springframework.batch.item.ExecutionContext;
import org.springframework.batch.item.ItemStreamException;
import org.springframework.batch.item.database.ExtendedConnectionDataSourceProxy;
import org.springframework.batch.item.database.JdbcCursorItemReader;
import org.springframework.jdbc.core.namedparam.MapSqlParameterSource;
import org.springframework.jdbc.core.namedparam.NamedParameterUtils;
import org.springframework.jdbc.core.namedparam.ParsedSql;
import org.springframework.jdbc.core.namedparam.SqlParameterSource;


/**
 * <code>ParameterizedJdbcCursorItemReader</code> This class retrieves records from the DB. If there are minValue and maxValue in the SQL this will
 * convert the SQL to a non-named parameter SQL so that is is usable.
 * 
 * @author ryanb
 * @version $Revision: 4779 $
 * 
 * @param <T> staging item to be retrieved from DB
 */

public class ParameterizedJdbcCursorItemReader<T> extends JdbcCursorItemReader < T >
{
    protected final Log logger = LogFactory.getLog( getClass() );

    protected static final String MIN_VALUE_KEY = "minValue";
    protected static final String MAX_VALUE_KEY = "maxValue";
    
    private Map < String, Object > parameterMap = new HashMap < String, Object >();

    /**
     * 
     * @param dataSource
     */
	@Override
	public void setDataSource(DataSource dataSource) {
		if(!(dataSource instanceof ExtendedConnectionDataSourceProxy)) {
			dataSource = new ExtendedConnectionDataSourceProxy(dataSource);
		}
		super.setDataSource(dataSource);
	}

	@Override
	public boolean isUseSharedExtendedConnection() {
		return true;
	}

	/**
	 * 
	 * @param useSharedExtendedConnection
	 */
	@Override
	public void setUseSharedExtendedConnection(boolean useSharedExtendedConnection) {
		useSharedExtendedConnection = true;
		super.setUseSharedExtendedConnection(useSharedExtendedConnection);
	}

	/**
     * This method retrieves the min value and the max value from the execution context. If the values are not null, then it add those values to the parameter map.
     * 
     * If the map is not empty then the parameters will be substituted into SQL
     * 
     * @param executionContext - current execution context
     */
    public void setNamedParameterStatementSetter( ExecutionContext executionContext )
    {
        final Object minValue = executionContext.get( MIN_VALUE_KEY );
        final Object maxValue = executionContext.get( MAX_VALUE_KEY );

        logger.debug( "minValue:" + minValue + ", maxValue: " + maxValue );

        if ( minValue != null && maxValue != null )
        {
            parameterMap.put( MIN_VALUE_KEY, minValue );
            parameterMap.put( MAX_VALUE_KEY, maxValue );
        }
        
        if ( !parameterMap.isEmpty() )
        {
            ParsedSql parsedSql = NamedParameterUtils.parseSqlStatement( getSql() );
            SqlParameterSource paramSource = new MapSqlParameterSource( parameterMap );
            
            // create SQL with ?'s           
            String sql = NamedParameterUtils.substituteNamedParameters( parsedSql, paramSource );
            ListPreparedStatementSetter listPreparedStatementSetter = new ListPreparedStatementSetter();
            listPreparedStatementSetter.setParameters( Arrays.asList( NamedParameterUtils.buildValueArray( parsedSql, paramSource, null ) ) );

            setSql( sql );
            setPreparedStatementSetter( listPreparedStatementSetter );
        }
    }

    /**
     * @return the parameterMap
     */
    public Map < String, Object > getParameterMap()
    {
        return parameterMap;
    }

    /**
     * @param parameterMap the parameterMap to set
     */
    public void setParameterMap( Map < String, Object > parameterMap )
    {
        this.parameterMap = parameterMap;
    }

    /* (non-Javadoc)
     * @see org.springframework.batch.item.support.AbstractItemCountingItemStreamItemReader#open(org.springframework.batch.item.ExecutionContext)
     */
    @Override
    public void open( ExecutionContext executionContext ) throws ItemStreamException
    {
        setNamedParameterStatementSetter( executionContext );
        super.open( executionContext );
    }
}