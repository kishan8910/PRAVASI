<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<!-- <link href="../libcommon/style/admin_style.css" rel="stylesheet" type="text/css" /> -->
<!-- <link href="../libcommon/style/login_style.css" rel="stylesheet" type="text/css" /> -->
<script type='text/javascript' src='../libcommon/javascripts/jquery/jquery-1.7.1.min.js'></script>

<link href="../libcommon/newMenu/MenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../libcommon/newMenu/MenuBar.js"></script>

<script type="text/javascript" language="javascript" src="../libcommon/tooltip/tooltip.js"></script>

<script src="../libcommon/javascripts/jquery.alerts.js" type="text/javascript"></script>
<link href="../libcommon/style/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<!-- materialize -->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="../libcommon/materialize/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

     <!-- Compiled and minified JavaScript -->
        <script src="../libcommon/materialize/js/materialize.js"></script>


<!--
<link href="../libcommon/style/mouseovertabs.css" rel="stylesheet" type="text/css" />
<script src="../libcommon/script/mouseovertabs.js" type="text/javascript"></script>
-->


<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}
	
	
	
	function getSubcategory(strURL) {		
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subcatdiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>


    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>

<body>

<?
if($_SESSION['user_id'] || $_SESSION['user_first_name'] || $_SESSION['user_email'] || $_SESSION['user_aadhar_no'])
{

	echo '
	<nav class="n bi fj">
      <div class="nav-wrapper">
        <a href="startup-horizontal-half.html" class="brand-logo"><i class="icon-diamond white-text"></i></a>
        <ul id="nav-mobile" class="right">
          <li><a style="color: cornsilk; href="#">Welcome '.$_SESSION['aadhar_first_name'].' !</a></li>
          
          <li><a style="color: cornsilk;" href="student.php?u=home&b=dance_home">Home</a></li>
          <li><a style="color: cornsilk;" href=\'index.php?act=logout\'>Logout</a></li>
        </ul>
      </div>
    </nav>';

	//echo "<a href=\"admin.php?menu=profile\">Welcome ".$_SESSION['staffName'].$_SESSION['adminaccount']." !</a>";
	// echo "<a style='color: cornsilk;' href=\"#\">Welcome ".$_SESSION['student_first_name']." !</a>&nbsp; | &nbsp;";
	// // echo "<a style='color: cornsilk;' href='student.php?u=cp&b=cpf'>Reset-password</a>&nbsp; |&nbsp; ";
	// echo "<a style='color: cornsilk;' href='student.php?u=home&b=dance_home'>Home</a>&nbsp; |&nbsp; ";
	// echo "<a style='color: cornsilk;' href=\"index.php?act=logout\">Logout</a> | &nbsp;&nbsp;";
} 	
?>
		
  

