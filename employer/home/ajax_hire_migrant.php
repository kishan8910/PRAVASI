<?php

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";



$user_id = trim(sql_real_escape_string($_POST['user_id']));

$query = "insert into migrant_job_details (user_id_migrant_type,user_id_employer_type,isEmployed) values ('$user_id','$_SESSION[user_id]',1)";

$result = sql_query($query,$connect);

if (sql_error($result)) {
	echo "1";
}



?>