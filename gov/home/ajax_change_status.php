<?

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";


$student_id = trim(sql_real_escape_string($_POST['student_id']));
$status 	= trim(sql_real_escape_string($_POST['status']));

$query = "update student set blocked = '$status' where id = '$student_id'";
$result = sql_query($query,$connect);

if (sql_error($result)) {
	echo "1";
}

?>