<?

	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		$first_name 		= trim(sql_real_escape_string($_POST['first_name']));
		$middle_name 		= trim(sql_real_escape_string($_POST['middle_name']));
		$family_name 		= trim(sql_real_escape_string($_POST['family_name']));
		$enrolment_date 	= trim(sql_real_escape_string($_POST['enrolment_date']));
		$dob				= trim(sql_real_escape_string($_POST['dob']));

		$email 				= trim(sql_real_escape_string($_POST['email']));
		// $password 			= trim(sql_real_escape_string($_POST['password']));
		// $cnfm_password 		= trim(sql_real_escape_string($_POST['cnfm_password']));
		$mobile 			= trim(sql_real_escape_string($_POST['mobile']));
		$home_phone 		= trim(sql_real_escape_string($_POST['home_phone']));
		$myimage 			= trim(sql_real_escape_string($_POST['photoimage']));
		$parent1_relation 	= trim(sql_real_escape_string($_POST['parent1_relation']));
		$parent1_email 		= trim(sql_real_escape_string($_POST['parent1_email']));
		$parent1_mobile 	= trim(sql_real_escape_string($_POST['parent1_mobile']));
		$parent2_relation 	= trim(sql_real_escape_string($_POST['parent2_relation']));
		$parent2_email 		= trim(sql_real_escape_string($_POST['parent2_email']));
		$parent2_mobile 	= trim(sql_real_escape_string($_POST['parent2_mobile']));
		$emergency_mobile 	= trim(sql_real_escape_string($_POST['emergency_mobile']));
		$emergency_email	= trim(sql_real_escape_string($_POST['emergency_email']));
		$back_pain 			= trim(sql_real_escape_string($_POST['back_pain']));
		$allergies 			= trim(sql_real_escape_string($_POST['allergies']));

		$address_street_no 	    = trim(sql_real_escape_string($_POST['address_street_no']));
		$address_street_name 	= trim(sql_real_escape_string($_POST['address_street_name']));
		$address_postcode 		= trim(sql_real_escape_string($_POST['address_postcode']));
		$address_suburb 		= trim(sql_real_escape_string($_POST['address_suburb']));
		$address_state 			= trim(sql_real_escape_string($_POST['address_state']));
		$parent1_name 			= trim(sql_real_escape_string($_POST['parent1_name']));
		$parent2_name 			= trim(sql_real_escape_string($_POST['parent2_name']));
		$emergency_contact_name = trim(sql_real_escape_string($_POST['emergency_contact_name']));
		$other_medical_pbm 		= trim(sql_real_escape_string($_POST['other_medical_pbm']));


		
		$query = "update student set first_name = '$first_name',middle_name='$middle_name',family_name='$family_name',enrolment_date=STR_TO_DATE('$enrolment_date', '%d-%m-%Y'),dob=STR_TO_DATE('$dob', '%d-%m-%Y'),email='$email',mobile='$mobile',home_phone='$home_phone',studentImage='$myimage',parent1_relation='$parent1_relation',parent1_email='$parent1_email',parent1_mobile='$parent1_mobile',parent2_relation='$parent2_relation',parent2_email='$parent2_email',parent2_mobile='$parent2_mobile',emergency_mobile='$emergency_mobile',emergency_email='$emergency_email',back_pain='$back_pain',allergies='$allergies',address_street_no='$address_street_no',address_street_name='$address_street_name',address_suburb='$address_suburb',address_state='$address_state',address_postcode='$address_postcode',parent1_name='$parent1_name',parent2_name='$parent2_name',emergency_contact_name='$emergency_contact_name',other_medical_pbm='$other_medical_pbm' where id = '$_GET[id]'";

		$result = sql_query($query,$connect);

		if (sql_error($result)) 
		{
			if(trim(mysql_error()) != '') 
				$input_errors[] =  "Failed to save user: ".$first_name." ".sql_error_report(trim(mysql_errno()));
		}

		if( $input_errors) 
		{
			input_error_reporting($input_errors);
			// echo "<div><b>".$query."</b></div>";
			include_once 'enter_details.php';

		}
		else
		{
			echo "<script>
				window.location.href='?u=home&b=sp'
			</script>";
			// header("Location: ?u=home&b=sp"); 
			// exit();
		}
	}

?>