<?php

if( $_SERVER['REQUEST_METHOD'] == "POST") {

	// $email = trim(sql_real_escape_string($_POST['email']));
  $aadhar_no = trim(sql_real_escape_string($_POST['aadhar_no']));
	$password = trim(sql_real_escape_string($_POST['password']));
	$sql = "select id,email,password,first_name,aadhar_no,userType,empl_tx_address from user where aadhar_no = '$aadhar_no' and password = '".md5($password)."'";	
	$result = sql_query($sql, $connect);
	if(sql_num_rows($result)) {
		
		$row = sql_fetch_array($result);
		$_SESSION['user_id'] = $row[0];
		// $_SESSION['user_email'] = $row[1];
		$_SESSION['user_first_name'] = $row[3];
    $_SESSION['user_aadhar_no'] = $row[4];
    $_SESSION['user_password'] = $row[1];
    $_SESSION['contract_address'] = $row[6];

		// $_SESSION['adminPasswdSess'] = $row[2];

    if ($row[5] == 'migrant') {
        echo " <script type=\"text/javascript\">
      window.location.href=\"../../pravasi/migrant/migrant.php?u=home&b=migrant_home\";
        </script>";  
    }
    elseif($row[5] == 'employer')
    {
      echo " <script type=\"text/javascript\">
      window.location.href=\"../../pravasi/employer/employer.php?u=home&b=employer_home\";
        </script>";
    }
    elseif ($row[5] == 'gov') {
      echo " <script type=\"text/javascript\">
      window.location.href=\"../../pravasi/gov/gov.php?u=home&b=gov_home\";
        </script>";
    }

		
		
	}
	else {
	
		$login_flag = true;
	}
}
if ($_GET[act] == logout ) {
	unset($_SESSION['user_id']);

	unset($_SESSION['user_first_name']);
	unset($_SESSION['user_aadhar_no']);
  unset($_SESSION['user_password']);
  unset($_SESSION['contract_address']);
	session_unset();
	session_destroy();?>
	<script type="text/javascript">
        window.location.href="index.php";
        </script>
<?php } ?>

<div style="font-color:47494A; height:20%; margin:0 auto; text-align:center; display:block;font-size: 16px;color:orangered;">
<?php
	if( $login_flag == true) 
	{		
		echo "<b>Login Failed!. Try again</b>";
	}
	else
	{
		echo "&nbsp;";
	}
?>
</div>


    <script type="text/javascript">

    	$(document).ready(function(){
    		$("#btn_login").click(function(){
	    		$("#form_login").submit();
	    	});
    	});

    </script>
    
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col s3"></div>
        <div class="col s6">
          <div class="card grey lighten-3 z-depth-5" style="padding: 15px;">
            <div class="card-content black-text">
              <span class="card-title center">PRAVASI - USER LOGIN</span>
            </div>
            <form class="" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='number' name='aadhar_no' id='aadhar_no' />
                <label for='email'>Enter your aadhar number</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' />
                <label for='password'>Enter your password</label>
              </div>
              
            </div>

            <div class="card-action">
            	
               <button type='submit' name='btn_login' class='btn waves-effect teal lighten-1'>Login</button>
               <a href="register_details.php"><button class='btn waves-effect teal lighten-1' type="button">Register</button></a>

            </div>
            <div class="card-action">

              <!--  <a href="forgot_password.php"><button class='btn waves-effect teal lighten-1' type="button" >Forgot Password</button></a> -->
            
            </div>
           
          </form>
            
          </div>
        </div>
        <div class="col s3"></div>
      </div>
</div>

</body>

    
</html>





