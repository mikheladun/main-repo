<?php

class Query
{
	var $NUMBER = 0;
	var $STRING = 1;
	var $DATE = 2;
	var $MYSQL = 3;

	var $Statement;
	var $ParamCount;
	var $aParam;
	var $aPattern;
	var $Result;
	var $Stmt;

	function _constructor($Statement, &$Connection)
	{
		$this->Statement = $Statement;
		$this->Connection = &$Connection;
		$this->Init();
	}
	function Query($Statement, &$Connection)
	{
		$this->_constructor($Statement, $Connection);
	}
	function Init()
	{
		$this->count = substr_count($this->Statement,"?");
		$this->aParam = array();
		$this->aPattern = array();
		for($i=0;$i<$this->count;$i++)
		{
			$this->aPattern[$i] = "/\?/";
		}
	}
	function Param($type, $index, $param)
	{
		//echo "$param<br/>";
		if($index > $this->ParamCount || $index < 1)
		{
			switch($type)
			{
				case $this->NUMBER:
					$this->aParam[$index - 1] = $param == 0 || (isset($param) && !empty($param)) ? $param : "NULL";
					break;
				case $this->STRING:
					$this->aParam[$index - 1] = ($param == NULL ? "NULL" : "'" . Utils::FormatStringForDatabaseInput($param)."'");
					break;
				case $this->DATE:
					$this->aParam[$index - 1] = ($param == NULL || $param == 'SYSDATE' ? "NOW()" : "$param");
					break;
				default:
					$this->aParam[$index - 1] = Utils::FormatStringForDatabaseInput($param);
			}
		}
	}
	function Execute()
	{
		$this->Result = mysql_query($this->BuildQuery(), $this->Connection) or $this->DatabaseError($this->Connection);
		$Response->CountRows = NULL;
		if($this->Result)
		{
			$Response->Success = true;
			if(substr(strtolower($this->Result), 0 , 11) == 'resource id')
			{
				$Response->CountRows = mysql_num_rows($this->Result);
				if($Response->CountRows == 1)
				{
					$Response->Object = mysql_fetch_assoc($this->Result);
				}
			}
		}
		else
		{
			$Response->Success = false;
		}

		//echo "Query: ", strtolower($this->Result)," | CountRows: ", $Response->CountRows;
		return $Response;
	}
	function DatabaseError($Connection)
	{
		echo "<span style=\"color:red;\"><small style=\"color:blue;\">SQL[",$this->Stmt,"]</small><br/><small>",mysql_error($Connection),"</small><br/>&nbsp;</span>";
	}
	function LoopResult()
	{
		return mysql_fetch_assoc($this->Result);
	}
	function LastInsertID(&$Resource)
	{
		return mysql_insert_id($Resource);
	}
	function BuildQuery()
	{
		ksort($this->aParam);
		//echo "aParam[",print_r($this->aParam),"]<br/>";
		//echo "aPattern[",print_r($this->aPattern),"]<br/>";
		$this->Stmt = $this->Statement;
		$this->Stmt = preg_replace($this->aPattern, $this->aParam, $this->Stmt, 1);

		return str_replace('\%s','?',$this->Stmt);
	}
}
?>