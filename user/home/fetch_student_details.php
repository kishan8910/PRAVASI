<?php

$query = "select * from user where id = '$_SESSION[user_id]'";
$result = sql_query($query,$connect);
$update_flag = 1;
while ($row = sql_fetch_array($result)) 
{
	$first_name = $row['first_name'];	
	$middle_name = $row['middle_name'];
	$enrolment_date = $row['enrolment_date'];

	$dob = $row['dob'];
	$address = $row['address'];
	$email = $row['email'];
	$password = $row['password'];
	$mobile = $row['mobile'];
	$home_phone = $row['home_phone'];
	$myimage = $row['studentImage'];

	$emergency_mobile = $row['emergency_mobile'];
	$emergency_email = $row['emergency_email'];

}

?>