<?php

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";


$location_id = trim(sql_real_escape_string($_POST['location_id']));
$mobile	= trim(sql_real_escape_string($_POST['mobile']));

if ($location_id) {
	$txt = "and l.id='$location_id'";
}
if ($mobile) {
	$mobile_str = "and u.mobile = '$mobile'";
}


$query = "select u.id as user_id,u.first_name,u.email,u.mobile,l.location_name,u.empl_tx_address,u.aadhar_no from user u inner join location l on l.id = u.location_id where u.userType='migrant' ".$txt." ".$mobile_str;

$result = sql_query($query,$connect);

if (sql_num_rows($result)) {
	
	echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><table class='responsive-table bordered'>
				<tr>
                <th>Sl.No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Mobile</th>
                <th>Hire</th>        
            </tr>";
            $i=0;
	while ($row = sql_fetch_array($result)) {

		$contractAddress = $row['empl_tx_address'];
		$aadhar_no = $row['aadhar_no'];

		$query = "select id from migrant_job_details where user_id_migrant_type = '$row[user_id]' and isEmployed = 1";
		$resultEmployed = sql_query($query,$connect);

		echo "<tr>
			<td>".++$i."  

			</td>
			<td>".$row['first_name']."</td>
			<td>".$row['email']."</td>
			<td>".$row['location_name']."</td>
			<td>".$row['mobile']."</td>";
			if (sql_num_rows($resultEmployed)) {
				echo "<td>Already Employed</td>";
			}
			else
			{
				echo "<td><input type='button' value='Hire' class='btn' onclick=\"hireEmployee(".$row['user_id'].",'".$contractAddress."','".$aadhar_no."');\"></td>
		</tr>";
			}
					
	}
	echo"</table></div></div></div>";
}
else
{
    echo "<h4 style=\"text-align:center; margin:5% 5%; color:#F00;\">No Search Result Found</h4>";
}


?>