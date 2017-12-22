<?
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_first_name']) || !isset($_SESSION['user_password']) || !isset($_SESSION['user_aadhar_no'])) {?>
	<script type="text/javascript">
		window.location.href="../user/index.php";
	</script>
<?	

	}

?>
