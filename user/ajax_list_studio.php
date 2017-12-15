<?php
session_start();
include "../libcommon/conf.php";
include "../libcommon/classes/db_mysql.php";

include "../libcommon/db_inc.php";
include "../libcommon/functions.php";
// include 'header.php';

$dance_type = substr(trim(sql_real_escape_string($_POST['dance_type'])),1) ;
$location = substr(trim(sql_real_escape_string($_POST['location'])),1);
$level = substr(trim(sql_real_escape_string($_POST['level'])),1);

$dance_type_arr = explode(',', $dance_type);
$location_arr = explode(',', $location);
$level_arr = explode(',', $level);
// print_r($_POST);
if ($location) 
{
	$loc_txt = "location_id in (".$location.") and";
}
if ($dance_type) {
	$txt_dance = "dance_type_id in (".$dance_type.") and ";
}
if ($level) {
	$txt_level = "level_id in (".$level.") and";
}
if ($dance_type || $location || $level) {


	$query = "select t2.id,t1.name,t2.time_from,t2.time_to from studio t1,studio_relation t2  where ".$txt_dance." ".$loc_txt."  ".$txt_level." t2.studio_id = t1.id;";

	$result = sql_query($query,$connect);

	if(sql_num_rows($result)) {
		echo "<div class='container'>
			<div class='row'>
			<div class='col s10 offset-s2'>

				<blockquote>
			      	<h5>Select Studio</h5>
			    </blockquote>";
			    echo "<input type='hidden' value='".$_SESSION[student_id]."' id='student_id' >";
			while ($row = sql_fetch_array($result)) {

				echo "
				
			<div class='col s6'>
			<input type='checkbox' value='$row[id]' id='$row[id]' class='studio_name' >

			<label for='$row[id]'>".$row['name']." ".$row['time_from']." - ".$row['time_to']."</label></div>";
				
			}
			echo "<div class='col s10' style='padding:25px;'><input type='button' value='Save studio' id='save_studio_btn' class='btn' onclick='save_studio(".$_POST['sid'].");'></div>";
		echo "</div></div></div>";
	}
	else
	{
		echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><h5 style='color:red;'>Sorry! No records found.</h5></div></div></div>";
	}
}
else
{
	echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><h5 style='color:red;'>Sorry! No records found.</h5></div></div></div>";
}

?>