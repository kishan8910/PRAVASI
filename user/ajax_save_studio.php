<?php
session_start();
include "../libcommon/conf.php";
include "../libcommon/classes/sql.cls.php";
include "../libcommon/classes/db_mysql.php";
include "../libcommon/functions.php";
include "../libcommon/db_inc.php";

// include 'header.php';

$studio_name = substr(trim(sql_real_escape_string($_POST['studios'])),1) ;

$student_id = trim(sql_real_escape_string($_POST['sid']));

$studio_arr = explode(',', $studio_name);

$insertStr = "";

foreach ($studio_arr as $studio_relation_id) {
	$insertStr = $insertStr."(".$student_id.",".$studio_relation_id."),";
}

$insertStr = substr($insertStr, 0,-1);

$query_del = "delete from student_studio_relation where student_id='$student_id'";
sql_query($query_del,$connect);

$query = "insert into student_studio_relation (student_id,studio_relation_id) values ".$insertStr;
$r = sql_query($query,$connect);

if (sql_error($r)) {
	echo "1";
}