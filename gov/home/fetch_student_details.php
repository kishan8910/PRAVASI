<?php

$query = "select * from student where id = '$student_id'";
$result = sql_query($query,$connect);
$update_flag = 1;
while ($row = sql_fetch_array($result)) 
{
	$first_name = $row['first_name'];	
	$middle_name = $row['middle_name'];
	$enrolment_date = $row['enrolment_date'];
	$family_name = $row['family_name'];
	$dob = $row['dob'];

	$email = $row['email'];
	// $password = $row['password'];
	$mobile = $row['mobile'];
	$home_phone = $row['home_phone'];
	$myimage = $row['studentImage'];
	$parent1_relation = $row['parent1_relation'];
	$parent1_email = $row['parent1_email'];
	$parent1_mobile = $row['parent1_mobile'];
	$parent2_relation = $row['parent2_relation'];
	$parent2_email = $row['parent2_email'];
	$parent2_mobile = $row['parent2_mobile'];
	$emergency_mobile = $row['emergency_mobile'];
	$emergency_email = $row['emergency_email'];
	$back_pain = $row['back_pain'];
	$allergies = $row['allergies'];
	$studio_relation_id = $row['studio_relation_id'];

	$address_street_no 	    = $row['address_street_no'];
	$address_street_name 	= $row['address_street_name'];
	$address_postcode 		= $row['address_postcode'];
	$address_suburb 		= $row['address_suburb'];
	$address_state 			= $row['address_state'];
	$parent1_name 			= $row['parent1_name'];
	$parent2_name 			= $row['parent2_name'];
	$emergency_contact_name = $row['emergency_contact_name'];
	$other_medical_pbm 		= $row['other_medical_pbm'];
	if ($row['skirt'] == 1) {
		$skirt_checked = 'checked';
	}
	if ($row['enrolment'] == 1) {
		$enrolment_checked = 'checked';
	}
	if ($row['jacket'] == 1) {
		$jacket_checked = 'checked';
	}

}

?>