<?
error_reporting(error_reporting() & ~E_DEPRECATED);
if (eregi("db_mysql.php",$_SERVER[PHP_SELF])) 
{
    Header("Location:index.php");
    die();
}

class ResultSet 
{
	var $result;
	var $total_rows;
	var $fetched_rows;

	function set_result( $res ) 
	{
		$this->result = $res;
	}

	function get_result() 
	{
		return $this->result;
	}

	function set_total_rows( $rows ) 
	{
		$this->total_rows = $rows;
	}

	function get_total_rows() 
	{
		return $this->total_rows;
	}

	function set_fetched_rows( $rows ) 
	{
		$this->fetched_rows = $rows;
	}

	function get_fetched_rows() 
	{
		return $this->fetched_rows;
	}

	function increment_fetched_rows() 
	{
		$this->fetched_rows = $this->fetched_rows + 1;
	}
}


global $strQuery;


function sql_connect($host, $user, $password, $db)
{
	global $l_error;
   	$dbi=@mysql_connect($host, $user, $password,false,65536); // 65536 is used for store procedur. We had a problem at first getting mssql results  text field to return anything more than 4096 bytes. 
	if(!$dbi) die($l_error['dbConf']);
      if (!mysql_select_db($db)) 
	{
	    mysql_query("CREATE DATABASE $db");
	    mysql_select_db($db);
	}
      return $dbi;
}

function sql_logout($id)
{
       $dbi=@mysql_close($id);
       return $dbi;
}

function sql_query($query,$id,$printError = false)
{
	global $strQuery;
	$strQuery = $query;
    	$res=@mysql_query($query, $id);
    	if(!$res && $printError)
    		print sql_error();
    	return $res;
}

function sql_num_rows($res)
{
	$rows=mysql_num_rows($res);
    return $rows;
}

function sql_num_fields($res)
{
	$rows=mysql_num_fields($res);
      return $rows;
}


function sql_result($res, $nr=0, $nf=0)
{
	$row = mysql_result($res, $nr, $nf);
	return $row;
}

function sql_fetch_row($res, $nr=0)
{
  	$row = mysql_fetch_row($res);
   	return $row;

}


function sql_fetch_array($res, $nr=0)
{
  	$row = array();
     	$row = mysql_fetch_array($res);
     	return $row;
}

function sql_fetch_object($res, $nr=0)
{
     	$row = mysql_fetch_object($res);
	if($row) return $row;
	else return false;
}

function sql_free_result($res) 
{
     	$row = mysql_free_result($res);
      return $row;
}

function sql_error() 
{
			global $strQuery;
			$err = mysql_error();
			if($err)
      	return 'Mysql error: '.$err.'.<br />Query: '.$strQuery;
}
function sql_error_report($errno) {
	
	if( $errno == '1062')
		return "is already exist";

    else if ( $errno == '1451')
        return "has Dependencies, can't delete";
    
}
function sql_insert_id( $link_identifier ) 
{
      return mysql_insert_id($link_identifier);
}
function sql_real_escape_string($string) {

	return mysql_real_escape_string($string);
}
?>
