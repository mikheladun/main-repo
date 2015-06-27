#!/bin/bash
# ===========================================================================
#
# ETL - Data Import (loadStPreReadings)
#
# ===========================================================================
#$ export PATH="/Applications/Postgres.app/Contents/MacOS/bin:$PATH"
#$ . ~/.profile
#$ echo $SHELL
#$ chmod 750 *.sh

#---------------------------------------
# ** EDIT VALUES BELOW ** 
#---------------------------------------
DB_DW_USR=wdr15_dw_dev_owner
DB_DW_PWD=wdr15_dw_dev_owner
DB_HOST=127.0.0.1
DB_PORT=1521
DB_SID=ORCL
#---------------------------------------
# ** EDIT VALUES ABOVE **
#---------------------------------------

FILE_LOG="${IQ_ETL_HOME}/iq_etl.log"
FILE_CTL="${IQ_ETL_HOME}/iq_etl.ctl"
FILE_CSV="${IQ_ETL_HOME}/iq_etl.csv"
FILE_SQL="${IQ_ETL_HOME}/iq_etl.sql"

export LD_LIBRARY_PATH=$ORCL_BIN
export DYLD_LIBRARY_PATH=$ORCL_BIN
# r+w+x on install dir
chmod -R 0777 "${IQ_ETL_HOME}"
# delete old log files
find "${IQ_ETL_HOME}/../" -name "\*.log" -type f -exec rm {} \;

ORCL_LSNR="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$DB_HOST)(PORT=$DB_PORT)))(CONNECT_DATA=(SERVER=DEDICATED)(SID=$DB_SID)))"
ORCL_LSNR2="\(DESCRIPTION\=\(ADDRESS_LIST\=\(ADDRESS\=\(PROTOCOL\=TCP\)\(HOST\=$DB_HOST\)\(PORT\=$DB_PORT\)\)\)\(CONNECT_DATA\=\(SERVER\=DEDICATED\)\(SID\=$DB_SID\)\)\)"
START=$(date)

#--------------------------------------
# update st_pre_readings
#--------------------------------------
echo exit | "$ORCL_BIN"/sqlplus -L $DB_DW_USR/$DB_DW_PWD@$ORCL_LSNR @"$FILE_SQL" >> "$FILE_LOG"

#echo "ORCL_BIN=${ORCL_BIN},IQ_ETL_HOME=${IQ_ETL_HOME},IQ_DATA_DIR=${IQ_DATA_DIR}" >> "$FILE_LOG"

find "${IQ_DATA_DIR}" -name "*.csv" -maxdepth 1 -type f | head -1 | while read csv
do
  cp "${csv}" "$FILE_CSV"
  echo exit | "$ORCL_BIN"/sqlldr $DB_DW_USR/$DB_DW_PWD@$ORCL_LSNR2 -control="$FILE_CTL" -bad="${csv}.bad" -log="${csv}.log" -rows=500000 >> "$FILE_LOG"
  cat /dev/null > "$FILE_CSV"
  echo "${csv} :: $(date)" >> "$FILE_LOG"
done

exit 0;
