<?

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";





$complaint_id = trim(sql_real_escape_string($_POST['complaint_id']));

$sql = "delete from tbl_complaint where id=\"$complaint_id\"";
    $result = sql_query($sql, $connect);
    if(mysql_error())
    {
        echo 2;
    }
    else
    {
        echo 1;
    }       
    
    sql_logout($connect);










?>