<?php


$query = "select * from user where id = '$_SESSION[student_id]'";
$result = sql_query($query,$connect);
$update_flag = 1;
while ($row = sql_fetch_array($result)) 
{
	$first_name_exist = $row['first_name'];	
	$middle_name_exist = $row['middle_name'];
	$enrolment_date_exist = $row['enrolment_date'];
	
	$dob_exist = $row['dob'];
	$address = $row['address'];
	$email_exist = $row['email'];
	$password_exist = $row['password'];
	$mobile_exist = $row['mobile'];
	$home_phone_exist = $row['home_phone'];
	$myimage_exist = $row['studentImage'];
	$parent1_relation_exist = $row['parent1_relation'];
	$parent1_email_exist = $row['parent1_email'];
	$parent1_mobile_exist = $row['parent1_mobile'];
	$parent2_relation_exist = $row['parent2_relation'];
	$parent2_email_exist = $row['parent2_email'];
	$parent2_mobile_exist = $row['parent2_mobile'];
	$emergency_mobile_exist = $row['emergency_mobile'];
	$emergency_email_exist = $row['emergency_email'];
	$back_pain_exist = $row['back_pain'];
	$allergies_exist = $row['allergies'];
	$studio_relation_id_exist = $row['studio_relation_id'];

	$address_street_no_exist 	    = $row['address_street_no'];
	$address_street_name_exist 	= $row['address_street_name'];
	$address_postcode_exist 		= $row['address_postcode'];
	$address_suburb_exist		= $row['address_suburb'];
	$address_state_exist			= $row['address_state'];
	$parent1_name_exist 			= $row['parent1_name'];
	$parent2_name_exist 			= $row['parent2_name'];
	$emergency_contact_name_exist = $row['emergency_contact_name'];
	$other_medical_pbm_exist 		= $row['other_medical_pbm'];

}

/*
if ($first_name != $first_name_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','first name','$first_name')";
	sql_query($sqlChanged,$connect);
}

if ($middle_name != $middle_name_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','first name','$first_name')";
	sql_query($sqlChanged,$connect);
}

// if ($enrolment_date != $enrolment_date_exist) {
// 	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','enrolment date','$enrolment_date')";
// 	sql_query($sqlChanged,$connect);
// }

if ($family_name != $family_name_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','family name','$family_name')";
	sql_query($sqlChanged,$connect);
}

$dob_exist = date("d-m-Y", strtotime($dob_exist));

if ($dob != $dob_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','date of birth','$dob')";
	sql_query($sqlChanged,$connect);
}

if ($address != $address_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','address','$address')";
	sql_query($sqlChanged,$connect);
}

if ($mobile != $mobile_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','mobile','$mobile')";
	sql_query($sqlChanged,$connect);
}

if ($home_phone != $home_phone_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','home phone','$home_phone')";
	sql_query($sqlChanged,$connect);
}

if ($parent1_relation != $parent1_relation_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','primary parent relation','$parent1_relation')";
	sql_query($sqlChanged,$connect);
}

if ($parent1_email != $parent1_email_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','primary parent email','$parent1_email')";
	sql_query($sqlChanged,$connect);
}

if ($parent1_mobile != $parent1_mobile_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','primary parent mobile','$parent1_mobile')";
	sql_query($sqlChanged,$connect);
}

if ($parent2_relation != $parent2_relation_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','secondary parent relation','$parent2_relation')";
	sql_query($sqlChanged,$connect);
}

if ($parent2_email != $parent2_email_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','secondary parent email','$parent2_email')";
	sql_query($sqlChanged,$connect);
}

if ($parent2_mobile != $parent2_mobile_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','secondary parent mobile','$parent2_mobile')";
	sql_query($sqlChanged,$connect);
}

if ($emergency_mobile != $emergency_mobile_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','emergency mobile number','$emergency_mobile')";
	sql_query($sqlChanged,$connect);
}


if ($emergency_email != $emergency_email_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','emergency email','$emergency_email')";
	sql_query($sqlChanged,$connect);
}

if ($back_pain != $back_pain_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','back pain','$back_pain')";
	sql_query($sqlChanged,$connect);
}

if ($allergies != $allergies_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','allergies','$allergies')";
	sql_query($sqlChanged,$connect);
}


if ($address_street_no != $address_street_no_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','street number','$address_street_no')";
	sql_query($sqlChanged,$connect);
}
if ($address_street_name != $address_street_name_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','street name','$address_street_name')";
	sql_query($sqlChanged,$connect);
}

if ($address_postcode != $address_postcode_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','postcode','$address_postcode')";
	sql_query($sqlChanged,$connect);
}
if ($address_suburb != $address_suburb_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','suburb','$address_suburb')";
	sql_query($sqlChanged,$connect);
}

if ($address_suburb != $address_suburb_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','suburb','$address_suburb')";
	sql_query($sqlChanged,$connect);
}
if ($address_state != $address_state_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','state','$address_state')";
	sql_query($sqlChanged,$connect);
}
if ($parent1_name_exist != $parent1_name) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','parent','$parent1_name')";
	sql_query($sqlChanged,$connect);
}
if ($emergency_contact_name != $emergency_contact_name_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','emergency contact name','$emergency_contact_name')";
	sql_query($sqlChanged,$connect);
}
if ($other_medical_pbm != $other_medical_pbm_exist) {
	$sqlChanged = "INSERT INTO notification_history (student_id,changed_field,changed_field_value) VALUES ('$_SESSION[student_id]','other medical problem','$other_medical_pbm')";
	sql_query($sqlChanged,$connect);
}
*/

?>