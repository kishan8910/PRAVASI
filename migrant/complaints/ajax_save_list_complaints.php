<?

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";


$categoryId = trim(sql_real_escape_string($_POST["category"]));
$description = trim(sql_real_escape_string($_POST["description"]));
$user_id = $_SESSION['user_id'];

$action = trim(sql_real_escape_string($_POST["action"]));



if ($action == "save") {
	$query = "INSERT INTO tbl_complaint (complaint_category_id,description,user_id,post_date) VALUES ('$categoryId','$description','$user_id',utc_timestamp())";
	sql_query($query,$connect);	
}
// elseif ($action == "list") {
		$sql = "SELECT t1.*,t2.* FROM tbl_complaint t1,complaint_category t2 where t1.complaint_category_id = t2.id order by t1.id desc";
        // echo $sql;
        $result = sql_query($sql, $connect);
        if(sql_num_rows($result))
        {


            echo "<div class='container'><div class='row'><div class='col s12 '><table class='bordered' width='100%'>
				<tr>
                <th>Sl.No</th>
                <th>Category</th>   
                <th>Description</th>
               
                <th>Delete</th>
            </tr>";
            while($row = sql_fetch_array($result))
            {
                $complaint_id = $row[0];
                echo "<tr align=\"center\" class=\"complaint_name_row".$complaint_id."\" id=\"complaint_name_edit".$level_id."\">
                <td>".(++$start)."</td>
                <td>".$row['category_name']."</td>
                <td>".$row['description']."</td>
                
                <td>

                <div class='red lighten-1 btn waves-effect btn-floating z-depth-2' onclick=\"delete_complaint(".$row[0].", 'ajax_delete_complaint.php');\"><i class='small material-icons white-text' >delete</i></div>
                </td>
                 </tr>";
            }
            echo"</table>";
        }
        else
        {
            echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><h4 style=\"text-align:center; margin:5% 5%; color:#F00;\">No Complaints Found</h4></div></div></div>";
        }

	
// }
    sql_logout($connect);



?>