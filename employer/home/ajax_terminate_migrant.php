<?php

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";



$migrant_user_id = trim(sql_real_escape_string($_POST['migrant_user_id']));
$job_detail_id = trim(sql_real_escape_string($_POST['job_detail_id']));



$query = "update migrant_job_details set isEmployed = 0 where user_id_migrant_type = '$migrant_user_id' and id='$job_detail_id'";

$result = sql_query($query,$connect);

if (sql_error($result)) {
	echo "1";
}



?>