<?php
if ($_GET['b'] == "dance_home") {
	include 'dance_home.php';
}

if ($_GET['b'] == "update") {
	include 'update_details.php';
}

if ($_GET['b'] == 'select_studio') {
	include 'select_studio.php';
}

if ($_GET['b'] == 'update_studio') {
	include 'update_studio_details.php';
}

?>