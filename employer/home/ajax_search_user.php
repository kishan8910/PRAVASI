<?php

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";


$location_id = trim(sql_real_escape_string($_POST['location_id']));
$aadhar_no	= trim(sql_real_escape_string($_POST['aadhar_no']));

if ($location_id) {
	$txt = 'and l.id=$location_id';
}
if ($aadhar_no) {
	$aadhar_no_join = "and u.aadhar_no = '$aadhar_no'";
}


$query = "select u.first_name,u.email,u.mobile,l.location_name from user u left join location l on l.id = u.location_id where u.userType='migrant' ".$txt." ".$aadhar_no_join;

$result = sql_query($query,$connect);

if (sql_num_rows($result)) {
	
	echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><table class='responsive-table bordered'>
				<tr>
                <th>Sl.No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Mobile</th>
                <th>Location</th>
                <th>Hire</th>
                
            </tr>";
            $i=0;
	while ($row = sql_fetch_array($result) {
		echo "<tr>
			<td>".++$i."</td>
			<td>".$row['first_name']."</td>
			<td>".$row['email']."</td>
			<td>".$row['location_name']."</td>
			<td><input type='button' value='Hire' onclick='hireEmployee(".$row['id'].");'></td>
		</tr>";		
	}
	echo"</table></div></div></div>";
}
else
{
    echo "<h2 style=\"text-align:center; margin:5% 5%; color:#F00;\">No Dance Type Defined</h2>";
}


?>