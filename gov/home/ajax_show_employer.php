<?

session_start();
include "../../libcommon/conf.php";
include "../../libcommon/classes/sql.cls.php";
include "../../libcommon/classes/db_mysql.php";
include "../../libcommon/db_inc.php";
//include "../../session.php";
include "../../libcommon/functions.php";



$employerAadhaarNo 	= trim(sql_real_escape_string($_POST['employerAadhaarNo']));

$query = "select t1.id,t1.first_name,t1.email,t1.aadhar_no,t1.mobile,t2.location_name,t1.empl_tx_address from user t1,location t2 where t1.aadhar_no = '$employerAadhaarNo' and t1.userType = 'employer' and t1.location_id = t2.id";
$result = sql_query($query,$connect);

if (sql_num_rows($result)) {
	echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><table class='responsive-table bordered'>
				<tr>
                <th>Sl.No</th>
                <th>Employer Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Location</th>
                <th>Show Hiring Transactions</th>        
            </tr>";
            $i=0;

      while ($row = sql_fetch_array($result)) {
      	$contractAddress = $row['empl_tx_address'];
		$aadhar_no = $row['aadhar_no'];


		echo "<tr>
			<td>".++$i."  

			</td>
			<td>".$row['first_name']."</td>
			<td>".$row['email']."</td>
			<td>".$row['mobile']."</td>
			<td>".$row['location_name']."</td>";
			echo "<td><input type='button' value='Show' class='btn' onclick=\"showEmployerTransactions(".$row['id'].",'".$contractAddress."','".$aadhar_no."',0,1000);\"></td>
		</tr>";


      }
      echo "<tr><td colspan='6' id='txn_details'>

      </td></tr>";
}
else
{
	 echo "<h4 style=\"text-align:center; margin:5% 5%; color:#F00;\">No Search Result Found</h4>";
}

?>