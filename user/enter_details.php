<script type="text/javascript" src="../libcommon/calendar/ui/ui.core.js"></script>
<script type="text/javascript" src="../libcommon/calendar/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="../libcommon/javascripts/ajaxupload.js"></script>
<script type="text/javascript" src="../index.js" ></script>

<link href="../libcommon/calendar/themes/all.css" rel="stylesheet" type="text/css" />
<script src="../libcommon/javascripts/jquery.validate.js"></script>
<style type="text/css">
	
	td {font-weight: bold;}

</style>
<script>
	





$(document).ready(function() {



	var a ='';


		Materialize.updateTextFields();
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    // yearRange: '1980:2013',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false,
    format: 'dd-mm-yy' // Close upon selecting a date,
  });

	$("#edit_details").validate({
		rules : {
			password : {
				required : true,
				minlength : 6
			},
			cnfm_password : {
				required : true,
				minlength : 6,
				equalTo : "#password"
			},
			mobile : {
				required : true,
				minlength : 10
			}

		}
  		
 		// $("#edit_details").submit();
 	});

	// $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});		


    var button = $('#upload_image'), interval;
	var fileUpload = new AjaxUpload(button,
	{
        action: 'uploaded_photo.php', 						
        name: 'doc',
        onSubmit : function(file, ext)
        {						
            if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
            {
                // extension is not allowed
                alert('Error: invalid file extension');
                // cancel upload
                return false;
            }	
            
            button.text('Uploading');
            this.disable();
            interval = window.setInterval(function()
	        {
	            var text = button.text();
	            if (text.length < 13)
    	        {
	                button.text(text + '.');					
	            } 
	            else 
	            {
	                button.text('Uploading');				
	            }
	        }, 200);
        },
        onComplete: function(file, response)
        {
	        button.html("<p style=color:#F00; font-size:12px;>Successfully Uploaded</p>");							
	        window.clearInterval(interval);											
	        this.enable();				
	        $('#imgshow').html(response);						
        }
    });
    
});	
function removePhoto(url,imgurl)
	{			
		var dataString = "imgurl="+imgurl;
		//alert(dataString);
		$.ajax({
	        type: "GET",
	        url: url,
	        data: dataString,
	        success: function(response)
	        {
	            $('#imgshow').html(response);
	        }
	    });
	    return false;			
	}





	function getEmployeesHired(myaccount, startBlockNumber, endBlockNumber) {



// 		toAscii = function(hex) {
//     var str = '',
//         i = 0,
//         l = hex.length;
//     if (hex.substring(0, 2) === '0x') {
//         i = 2;
//     }
//     for (; i < l; i+=2) {
//         var code = parseInt(hex.substr(i, 2), 16);
//         if (code === 0) continue; // this is added
//         str += String.fromCharCode(code);
//     }
//     return str;
// };

		// const abiDecoder = require('abi-decoder');
  if (endBlockNumber == null) {
    endBlockNumber = web3.eth.blockNumber;
    console.log("Using endBlockNumber: " + endBlockNumber);
  }
  if (startBlockNumber == null) {
    startBlockNumber = endBlockNumber - 1000;
    console.log("Using startBlockNumber: " + startBlockNumber);
  }
  console.log("Searching for transactions to/from account \"" + myaccount + "\" within blocks "  + startBlockNumber + " and " + endBlockNumber);

  for (var i = startBlockNumber; i <= endBlockNumber; i++) {
    
    var block = web3.eth.getBlock(i, true);
    if (block != null && block.transactions != null) {
      block.transactions.forEach( function(e) {
        if (myaccount == "*" || myaccount == e.from || myaccount == e.to) {

            if (e.input.indexOf("7295e067") == 2)  //hire function called
             {
             	  var functionHash = e.input.substring(2,10);
                var employerAadhaarFromBlock = e.input;
                var employeeAadhaarFromBlock = toAscii(e.input.substring(74));
              
                var table = "<table class=\" \" ><tr>  <th> Transation hash </th> <td>" + e.hash + " </td>  </tr> " +
                            "<tr>  <th> From Address </th> <td>"    + e.from + " </td>  </tr> " +
                            "<tr>  <th> To Address   </th> <td>"    + e.to   + " </td>  </tr> " +
                            "<tr>  <th> Employer Aadhaar </th> <td>"    + employerAadhaarFromBlock.toString() + " </td>  </tr> " +
                            "<tr>  <th> Employee Aadhaar </th> <td>"    + employeeAadhaarFromBlock + " </td>  </tr> " +
                            "<tr>  <th> input        </th> <td>"    + e.input + " </td>  </tr> " +
                            "<tr>  <th> Timestamp    </th> <td>"    + block.timestamp + " " + new Date(block.timestamp * 1000).toGMTString() + " </td>  </tr> " +
                            "<tr>  <th> Value        </th> <td>"    + e.value + " </td>  </tr>  </table>" ;

                $(table).appendTo('body');

             }
        }
      })
    }
  }
}








	function callContract(){
		
		var next_id = <?php 
    	    					$query = "select count(*) from user";
       							$result = sql_query($query,$connect);
       							$row = sql_fetch_array($result);
        						echo $row[0];
        					?>	
       
        
		var new_empl_address = web3.eth.accounts[next_id];
		var aadhar_no = $("#aadhar_no").val();
					// alert(new_empl_address);

		$("#empl_address").val(new_empl_address);
		


 			web3.eth.defaultAccount = new_empl_address;



 			var txHash = contractInstance.initEmployeeAddress(aadhar_no, new_empl_address,{gas: 1000000}); //

 			try {
				  var txR = web3.eth.getTransactionReceipt(txHash);
				  if (txR.blockNumber == undefined)
				    throw "transaction receipt not found";

				  $("#edit_details").submit();
				}
				catch(e) {
				  console.log("invalid tx receipt: " + e);
				}





				
	}



</script>


<input type="hidden" name="empl_address" id="empl_address" value="" />

<div class="container">
<div class="row">
<div class="col s10 offset-s2">
			<blockquote>
      			<h5>User Information</h5>
    		</blockquote>
			<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">account_circle</i>
		          <input type='text' size='40' placeholder="first name" id="first_name" name='first_name' value='<?=$first_name?>' style="width:250px" minlength="2" required>
		          <label for="icon_prefix">First Name</label>
          	</div>

          	<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">account_circle</i>
		         <input type='text' size='40' id="middle_name" placeholder="middle name" name='middle_name' value='<?=$middle_name?>' style="width:250px">
		          <label for="icon_prefix">Middle Name</label>
          	</div>

          	<!-- <div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">account_circle</i>
		          <input type='text' size='40' name='family_name' placeholder="family name" value='<?=$family_name?>' style="width:250px">
		          <label for="icon_prefix">Family Name</label>
          	</div>
 -->
          	
          		
		  		<?php/*
					if ($enrolment_date) 
					{

						// echo date("d-m-Y", strtotime($enrolment_date));
						echo '<i class="material-icons prefix">date_range</i>';
						echo '<input type="text"  size="40" name="enrolment_date" placeholder="enrolment date" value="'.date("d-m-Y", strtotime($enrolment_date)).'" style="width:250px" readonly="true" >';
						echo '<label for="icon_prefix">Enrolment Date</label>';
					}
					else
					{
						echo '<i class="material-icons prefix">date_range</i>';
						echo '<input type="text" class="datepicker" size="40" name="enrolment_date" placeholder="enrolment date" value="" style="width:250px" required>';

						echo '<label for="icon_prefix">Enrolment Date</label>';
					}*/
				?>

		  		
		         
		         
         
          	<?
				if ($dob) {
					$dateofbirth = date("d-m-Y", strtotime($dob));
				}
				else
				{
					$dateofbirth = "";	
				}
				
			?>
          	<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">date_range</i>
		          <input required type='text' size='40' class="datepicker" name='dob' placeholder="date of birth" value='<?=$dateofbirth?>' style="width:250px">
		          <label for="icon_prefix">Date of birth</label>
          	</div>




    <div class="input-field col s5">
  		<i class="material-icons prefix">email</i>
          <input type='email' required size='40' name='email' placeholder="email" value='<?=$email?>' style="width:250px">
          <label for="icon_prefix">Email</label>
     </div>

     <?
		if (!$update_flag) 
		{
		?>
		<div class="input-field col s5">
  		<i class="material-icons prefix">security</i>
		<input type='password' data-rule-minlength="6" id="password" required size='40' name='password' placeholder="password" value='' style="width:250px">
		<label for="icon_prefix">Password</label>
     	</div>		

		<div class="input-field col s5">
		<i class="material-icons prefix">security</i>
		<input type='password' id="cnfm_password" data-rule-minlength="6" required size='40' name='cnfm_password' placeholder="confirm password" value='' style="width:250px">
		<label for="icon_prefix">Confirm Password</label>
     	</div>
		<?}
		else
		{?>


		<input type='hidden' data-rule-minlength="6" id="password" required size='40' name='password' placeholder="password" value='<?=$password?>' style="width:250px">

		<input type='hidden' id="cnfm_password" data-rule-minlength="6" required size='40' name='cnfm_password' placeholder="confirm password" value='<?=$cnfm_password?>' style="width:250px">

		<?
		}
		?>

    <div class="input-field col s5">
      <i class="material-icons prefix">visibility</i>
          <input type='text' size='40' name='aadhar_no' id='aadhar_no' placeholder="aadhar number" value='<?=$aadhar_no?>'>
          <label for="icon_prefix">Aadhar Number</label>
     </div>


		<div class="input-field col s5">
  		<i class="material-icons prefix">phone_android</i>
          <input type='text' size='40' name='mobile' placeholder="mobile number" value='<?=$mobile?>'>
          <label for="icon_prefix">Mobile</label>
     </div>


     <div class="input-field col s5">
  		<i class="material-icons prefix">phone</i>
          <input type='text' size='40' name='home_phone' placeholder="home phone" value='<?=$home_phone?>' style="width:250px">
          <label for="icon_prefix">Home Phone</label>
     </div>
          <div class="input-field col s10">
     	<?php		
function defaultimage()
{
	echo "	
		<div id=\"imgshow\">
		<img src=\"../libcommon/images/missing.png\" style=\"width:75px; height:80px; float:left;margin-left:51px;padding:10px;\" class='materialboxed' width='87' /> 
		<div id=\"upload_image\">
		<input name=\"upload_image\" class=\"btn\" style=\"margin:40px 0 0 30px;\" type=\"button\" value=\"Upload Image\"  />
		</div>
		<input name=\"photoimage\" type=\"hidden\" value=\"\" />
		<span id=\"file\"></span>
		</div>";
}				
if( $_GET[action] == "frm_input" || $_GET[action] == "input")
{
	defaultimage();
}
else 
{
	// echo $myimage;
	if($myimage == NULL)
	{
		defaultimage();
	}
	else 
	{
		if(file_exists("".$myimage.""))
		{
			echo "<div id=\"imgshow\">
				<img src=".$myimage." style=\"width:75px; height:80px; float:left;margin-left:51px;padding:10px;\"/>
				<input name=\"photoimage\" type=\"hidden\" value=".$myimage." />
				<input type=\"button\" class=\"btn\" value=\"Remove\" style=\"margin:40px 0 0 30px;\" onClick=\"removePhoto('removephotoimage.php','".$myimage."')\" />
				</div>";
			// echo "<div id=\"imgshow\">
			// 	<img src=".$myimage." class='materialboxed' width='65' />
			// 	<input name=\"photoimage\" type=\"hidden\" value=".$myimage."  />
			// 	<input type=\"button\" class=\"btn\" value=\"Remove\" onClick=\"removePhoto('removephotoimage.php','".$myimage."')\" />
			// 	</div>";
		}
		else 
		{
			defaultimage();
		}
	}
}
?>
  
</div>



   
<div class="input-field col s10">
      <i class="material-icons prefix">home</i>
          <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="address" name="address" class="materialize-textarea"></textarea>
          <label for="address">Address</label>
        </div>
      </div>
    </form>
  </div>
         
    </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">phone_android</i>
          <input type='text' size='40' name='emergency_mobile' placeholder="emergency mobile" value='<?=$emergency_mobile?>' style="width:250px" required>
          <label for="icon_prefix">Mobile No</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">email</i>
          <input type='email' size='40' name='emergency_email' placeholder="emergency email" value='<?=$emergency_email?>' style="width:250px" required>
          <label for="icon_prefix">Email</label>
     </div>



<div class="input-field col s5 validation">
    <i class="material-icons prefix">dvr</i>


    
            <select id='userType' class='validate input-field col s12' name="userType">
                <option value=''>Select</option>
                <option value='migrant'>Migrant</option>
                <option value='employer'>Employer</option>
                <option value='gov'>Government Official</option>
            </select>
        
        
    

    <label for="icon_prefix">Select user type</label>
</div>



<div class="input-field col s5 validation">
    <i class="material-icons prefix">add_location</i>


   <?php
        $query = "select * from location";
        $result = sql_query($query,$connect);
        if (sql_num_rows($result)) {
            echo "<select class='input-field col s12' id='location' style='width:264px;' name='location'>
                <option disabled selected value=''>Select</option>";
            while ($row = sql_fetch_array($result)) {
                echo "<option ".$location_select[$row[id]]." value='$row[id]'>".$row['location_name']."</option>";
            }
            echo "</select>";
        }
        else
        {
             echo "<select class='input-field col s12' id='location' style='width:264px;' name='location'>
                <option disabled selected value=''>Select</option>";
           
            echo "</select>";
        }
    ?>
    

    <label for="icon_prefix">Select Location</label>
</div>

    
          <div class="input-field col s12">
           <div class="input-field col s6">
           		<!-- <input type="button" onclick="getEmployeesHired('0x0874e94858e3781b0a4e8e780548e24e7639d453',0,1000);" name="submit-btn" value="Save and Submit" class='btn'></input> -->
              <input type="button" onclick="callContract();" name="submit-btn" value="Save and Submit" class='btn'></input>
           </div>
          	<?
          		if (!$_SESSION['user_id']) {
          			
          	?>
          	<div class="input-field col s6">
          		<a href="../user/index.php"><input type="button" name="submit-btn" value="Cancel" class='btn'></input></a> 		
          	</div>
          	<?
          	}
          	?>
	
          	</div>




</div>
</div>
</div>


<script type="text/javascript">
    

    $(document).ready(function() 
    {
            Materialize.updateTextFields();
            $('select').material_select();


      $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function(){} //Function for after opening timepicker
      });
            
            
    });

</script>
