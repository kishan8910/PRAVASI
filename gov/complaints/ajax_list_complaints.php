<?

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";


$categoryId = trim(sql_real_escape_string($_POST["category"]));
$location = trim(sql_real_escape_string($_POST["location"]));
$user_id = $_SESSION['user_id'];

$action = trim(sql_real_escape_string($_POST["action"]));


if ($categoryId) {
    $condition1 = "and t2.id = '$categoryId'";    
}

if ($location) {
    $condition2 = "and t4.id = '$location'";
}


// if ($action == "save") {
// 	$query = "INSERT INTO tbl_complaint (complaint_category_id,description,user_id,post_date) VALUES ('$categoryId','$description','$user_id',utc_timestamp())";
// 	sql_query($query,$connect);	
// }
// elseif ($action == "list") {
		$sql = "SELECT t1.*,t2.*,t3.id,t4.* FROM tbl_complaint t1,complaint_category t2,user t3,location t4 where t1.complaint_category_id = t2.id and t1.user_id = t3.id and t3.location_id = t4.id ".$condition1." ".$condition2;
        // echo $sql;
        $result = sql_query($sql, $connect);
        if(sql_num_rows($result))
        {


            echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><table class='bordered' width='100%'>
				<tr>
                <th>Sl.No</th>
                <th>Category</th>   
                <th>Location</th>
                <th>Description</th>
               
            </tr>";
            while($row = sql_fetch_array($result))
            {
                $complaint_id = $row[0];
                echo "<tr align=\"center\" class=\"complaint_name_row".$complaint_id."\" id=\"complaint_name_edit".$level_id."\">
                <td>".(++$start)."</td>
                <td>".$row['category_name']."</td>
                <td>".$row['location_name']."</td>
                <td>".$row['description']."</td>
                


                 </tr>";
            }
            echo"</table></div></div></div>";
        }
        else
        {
            echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><h4 style=\"text-align:center; margin:5% 5%; color:#F00;\">No Complaints Found</h4></div></div></div>";
        }

	
// }
    sql_logout($connect);



?>