<?php

include "../libcommon/conf.php";
include "../libcommon/classes/db_mysql.php";
include "../libcommon/functions.php";
include "../libcommon/db_inc.php";

include "header.php";
	// print_r($_POST);
	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		$first_name 		= trim(sql_real_escape_string($_POST['first_name']));
		$middle_name 		= trim(sql_real_escape_string($_POST['middle_name']));

		$enrolment_date 	= trim(sql_real_escape_string($_POST['enrolment_date']));
		$dob				= trim(sql_real_escape_string($_POST['dob']));
		
		$email 				= trim(sql_real_escape_string($_POST['email']));
		$password 			= trim(sql_real_escape_string($_POST['password']));
		$cnfm_password 		= trim(sql_real_escape_string($_POST['cnfm_password']));
		$mobile 			= trim(sql_real_escape_string($_POST['mobile']));
		$home_phone 		= trim(sql_real_escape_string($_POST['home_phone']));
		$myimage 			= trim(sql_real_escape_string($_POST['photoimage']));

		$emergency_mobile 	= trim(sql_real_escape_string($_POST['emergency_mobile']));
		$emergency_email	= trim(sql_real_escape_string($_POST['emergency_email']));

		$parent1_name 			= trim(sql_real_escape_string($_POST['parent1_name']));
		$parent2_name 			= trim(sql_real_escape_string($_POST['parent2_name']));
		$emergency_contact_name = trim(sql_real_escape_string($_POST['emergency_contact_name']));

		$address 			= trim(sql_real_escape_string($_POST['address']));
		$userType 			= trim(sql_real_escape_string($_POST['userType']));
		$aadhar_no 			= trim(sql_real_escape_string($_POST['aadhar_no']));

		$location_id			= trim(sql_real_escape_string($_POST['location']));

		$empl_address_tx =  trim(sql_real_escape_string($_POST['empl_address']));


		$passwordmd5 = md5($password);
		// $cnfm_password = md5('$cnfm_password');
		$res = sql_query("LOCK TABLES student WRITE", $connect);
		$query = "insert into user 
		(first_name,
		middle_name,
		enrolment_date,
		dob,
		email,
		password,
		mobile,
		home_phone,
		userImage,
		emergency_mobile,
		emergency_email,
		address,
		userType,
		aadhar_no,
		location_id,
		empl_tx_address)
		values 
		('$first_name',
		'$middle_name',
		utc_timestamp(),
		STR_TO_DATE('$dob', '%d-%m-%Y'),
		'$email',
		'$passwordmd5',
		'$mobile',
		'$home_phone',
		'$myimage',
		'$emergency_mobile',
		'$emergency_email',
		'$address',
		'$userType',
		'$aadhar_no',
		'$location_id',
		'$empl_address_tx')";

		$result = sql_query($query,$connect);

		if (sql_error($res)) 
		{
			if(trim(sql_error()) != '') 
				$input_errors[] =  "Failed to save user: ".$first_name." ".sql_error_report(trim(mysql_errno()));
		}

		if( $input_errors) 
		{
			input_error_reporting($input_errors);
			echo "<form action='save_detail.php' method='POST' id='edit_details'>";
			include_once 'enter_details.php';
			echo "</form>";
		}
		else
		{
			$student_id = sql_query("SELECT LAST_INSERT_ID()", $connect);
	    	$row = sql_fetch_row($student_id);
	    	$id = $row[0];

	    	$res = sql_query("UNLOCK TABLES", $connect);
			if ($id != 0) {
				//header("Location: select_studio.php?id=".$id); 
				echo " <script type=\"text/javascript\">
			window.location.href=\"index.php\";
		    </script>";
				exit();
			}
			else
			{
				echo "<form action='save_detail.php' method='POST' id='edit_details'>";
				include_once 'enter_details.php';	
				echo "</form>";
			}

		}
	}
	


?>