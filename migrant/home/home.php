<?php
if ($_GET['b'] == "migrant_home") {
	
	include 'migrant_home.php';
}

if ($_GET['b'] == 'es') {

	$student_id = $_GET['id'];
	include 'fetch_student_details.php';
	echo '<form action="?u=home&b=update&id='.$student_id.'" method="POST" id="edit_details">';
	include 'enter_details.php';
	echo '</form>';
}

if ($_GET['b'] == 'update') {
	include 'update_details.php';
}



?>