<?
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_email']) || !isset($_SESSION['user_first_name'] || !isset($_SESSION['user_aadhar_no']) )) { ?>
	<script type="text/javascript">
	window.location.href="index.php";
	</script>
<?	
//$URL = "index.php";
//	print "<meta http-equiv='refresh' content='1;URL=$URL'>";
}
?>
