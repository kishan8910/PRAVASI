<script type="text/javascript" src="../libcommon/calendar/ui/ui.core.js"></script>
<script type="text/javascript" src="../libcommon/calendar/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="../libcommon/javascripts/ajaxupload.js"></script>
<link href="../libcommon/calendar/themes/all.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	
	td {font-weight: bold;}

</style>

<script>

function delete_leave(student_leave_id)
{
	$.ajax({
            type: "POST",
            url: "home/ajax_delete_leave.php",
            data: "student_leave_id="+student_leave_id,
            success: function(response)
            {

                if (response.trim() == 1) 
                {
                	jAlert("<span style='color:red;'>Some error occurred.</span>");
                }
                else
                {
                	jAlert('Leave Deleted Successfully', 'Success', function(r) {
                   if(r == true)
                   {
                       window.location.reload();
                   }
                   });
                }
            }
          });  
    return false;
}

function add_leave()
{
	var leave_date_from = $("#leave_date_from").val();
	var leave_date_to = $("#leave_date_to").val();
	var leave_matter = $("#leave_matter").val();

	if (leave_date_from == "" || leave_date_to == "") 
	{

		// jAlert("<span style='color:red;'>Please enter both leave dates.</span>");
		Materialize.toast('Please enter both leave dates!', 4000)

		return false;
		
	}
	else if (leave_matter == "") 
	{
		// jAlert("<span style='color:red;'>Please enter leave matter.</span>");
		Materialize.toast('Please enter leave matter!', 4000)
		return false;
	}
	else
	{
		var dataString = "leave_date_from="+leave_date_from+"&leave_date_to="+leave_date_to+"&leave_matter="+leave_matter+"&student_id="+<?php echo $_GET['id']; ?>;
		$.ajax({
            type: "POST",
            url: "home/ajax_add_leave.php",
            data: dataString,
            success: function(response)
            {

                if (response.trim() == 1) 
                {
                	jAlert("<span style='color:red;'>Some error occurred.</span>");
                }
                else
                {
                	jAlert('Leave Added Successfully', 'Success', function(r) {
                   if(r == true)
                   {
                       window.location.reload();
                   }
                   });
                }
            }
          });  
    	return false;
	}

}

$(document).ready(function() {
	// $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});		

	Materialize.updateTextFields();
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false,
    format: 'dd-mm-yy' // Close upon selecting a date,
  });
        
    var button = $('#upload_image'), interval;
	var fileUpload = new AjaxUpload(button,
	{
        action: 'home/uploaded_photo.php', 						
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
	        url: 'home/'+url,
	        data: dataString,
	        success: function(response)
	        {
	            $('#imgshow').html(response);
	        }
	    });
	    return false;			
	}


  function mark_checklist(checklist_item,id)
  {

    var student_id = $("#student_id").val();
    var checked = "";
    if ($('#'+id).is(':checked')) 
    {
      checked = '1';
    }
    else
    {
      checked = '0';
    }
    var dataString = "checklist_item="+checklist_item+"&checked="+checked+"&student_id="+student_id;
    $.ajax({
          type: "POST",
          url: 'home/ajax_update_checklist_item.php',
          data: dataString,
          success: function(response)
          {

            Materialize.toast('Checklist updated!', 2000)
          }
      });
      return false;
  }

</script>


<input type="hidden" id="student_id" value="<?=$_GET[id]?>">
<div class="container">
<div class="row">
<div class="col s10 offset-s2">
			<blockquote>
      			<h5>Student Information</h5>
    		</blockquote>
			<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">account_circle</i>
		          <input type='text' size='40' class="validate" placeholder="first name" id="first_name" name='first_name' value='<?=$first_name?>'>
		          <label for="icon_prefix">First Name</label>
          	</div>

          	<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">account_circle</i>
		          <input type='text' size='40' class="validate" id="middle_name" placeholder="middle name" name='middle_name' value='<?=$middle_name?>'>
		          <label for="icon_prefix">Middle Name</label>
          	</div>

          	<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">account_circle</i>
		          <input type='text' size='40' class="validate" name='family_name' placeholder="family name" value='<?=$family_name?>'>
		          <label for="icon_prefix">Family Name</label>
          	</div>

          	<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">date_range</i>
		          <input type='text' class="datepicker" size='40' name='enrolment_date' placeholder="enrolment date" value='<?=date("d-m-Y", strtotime($enrolment_date))?>'>
		          <label for="icon_prefix">Enrolment Date</label>
          	</div>

          	<div class="input-field col s5">
		  		
		  		<i class="material-icons prefix">date_range</i>
		          <input type='text' size='40' class="datepicker" name='dob' placeholder="date of birth" value='<?=date("d-m-Y", strtotime($dob))?>' style="width:250px">
		          <label for="icon_prefix">Date of birth</label>
          	</div>


          	<div class="input-field col s10">
          		
          		<div class="card white lighten-3 z-depth-2" style="padding: 10px;">
            <div class="card-content black-text">
              <span class="card-title center">Add Leave</span>
            </div>
           
           

            <div class='row'>
              <div class='input-field col s6'>
               	<i class="material-icons prefix">date_range</i>
               	<input type='text' class='datepicker' size='40' name='leave_date_from' id='leave_date_from' placeholder='from date' value=''>
               <label for="icon_prefix">Leave From Date</label>
              </div>

              <div class='input-field col s6'>
               	<i class="material-icons prefix">date_range</i>
               <input type='text' class='datepicker' size='40' name='leave_date_to' id='leave_date_to' placeholder='to date' value='' >
               <label for="icon_prefix">Leave To Date</label>
              </div>

            </div>

            <div class='row'>
              <div class='input-field col s6'>
               	<i class="material-icons prefix">textsms</i>
               	<textarea placeholder='leave matter' id='leave_matter' class="materialize-textarea" data-length="120" ></textarea>
               	<label for="icon_prefix">Leave Matter</label>
               
              </div>

              <div class='input-field col s6'>
               	<!-- <input type='button' value='Add' onClick='add_leave();' > -->
               	<div  class='btn waves-effect teal lighten-1' onClick='add_leave();' name='btn_login' >Add</div>
             
              </div>
            </div>
            
         
<?
    $query = "select * from student_leave where student_id = '$student_id'";
	$result_leave = sql_query($query,$connect);
  $leave_tot_diff = 0;
	if (sql_num_rows($result_leave)) 
	{
		
				echo "<table class='responsive-table bordered'>
					<tr>
						<th colspan='5'>
						Leaves taken 
						</th>
					</tr>";
					
					while ($row_leave = sql_fetch_array($result_leave)) 
					{
						$student_leave_id = $row_leave['id'];
						echo "
							<tr>
								<td>
									".++$i."
								</td>
								<td>
									".$row_leave['matter']."
								</td>
								<td>
									".date("d-m-Y", strtotime($row_leave['date_from']))."
								</td>
								<td>
									".date("d-m-Y", strtotime($row_leave['date_to']))."
								</td>
								<td>
									<div type='button' class='red lighten-1 btn waves-effect btn z-depth-2' onClick='delete_leave(".$student_leave_id.")' >Delete</div
								</td>
							</tr>
						";
						$fromD = date("d-m-Y", strtotime($row_leave['date_from']));
						$toD = date("d-m-Y", strtotime($row_leave['date_to']));
						$leave_diff = $toD - $fromD;
						$leave_tot_diff = $leave_tot_diff+$leave_diff;
					}

				echo "</table>";
		// 	</td>
		// </tr>";
		}
		?>
			<div class="row">
            	<?
            	


            	$enrol_date=date("d-m-Y", strtotime($enrolment_date));
				$today=date("d-m-Y", strtotime(date('d-m-Y')));
				// $diff = $today - $enrol_date;
		// echo $diff1 = date_diff($today,$enrol_date);
		// $diff_res = $diff - $leave_tot_diff;
			$unixEnrol = strtotime($enrol_date);
			$unixToday = strtotime($today);
			$diff = abs($unixToday - $unixEnrol)/60/60/24;
		?>
		<div class="input-field col s6 ">
		  		Total Days
		  		
         </div>
         <div class="input-field col s6">
		  		<?

		  			if ($leave_tot_diff != 0) {
					$tot_days = $diff - $leave_tot_diff;
					// $tot_days = floor($diff_res / (60 * 60 * 24));
					$years = intval($tot_days / 365);
					$days = $tot_days % 365; 
					echo $years." years ".$days." days";
				}
				else
				{
					$diff_res = $diff;
					// $tot_days = floor($diff_res / (60 * 60 * 24));
          $tot_days = $diff;
					$years = intval($tot_days / 365);
					$days = $tot_days % 365; 
					echo $years." years ".$days." days";
				}

		  		?>
		  		
         </div>

            </div> 
		 </div>

		 

     </div>


     

     <div class="input-field col s10">
     <blockquote>
      	<h6>Address</h6>
    </blockquote>
    </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">home</i>
          <input type="text"  class="input-large mandatory regx_general validate" placeholder="Street No" name='address_street_no' id='address_street_no' value='<?echo $address_street_no?>'>
          <label for="icon_prefix">Street No</label>
     </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">streetview</i>
          <input type="text"  class="input-large mandatory regx_name validate" placeholder="Street Name" name='address_street_name' id='address_street_name' value='<?echo $address_street_name?>'>
          <label for="icon_prefix">Street Name</label>
     </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">streetview</i>
          <input type="text"  class="input-large mandatory regx_place_name validate"  placeholder="Suburb" name='address_suburb' id='address_suburb' value='<?echo $address_suburb?>'>
          <label for="icon_prefix">Suburb</label>
     </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">domain</i>
          <input type="text"  class="input-large mandatory regx_place_name validate"  placeholder="State" name='address_state' id='address_state' value='<?echo $address_state?>'>
          <label for="icon_prefix">State</label>
     </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">drafts</i>
          <input type="text"  class="input-large mandatory regx_name validate"  placeholder="Post Code" name='address_postcode' id='address_postcode' value='<?echo $address_postcode?>'>
          <label for="icon_prefix">Postcode</label>
     </div>


     <div class="input-field col s10">
     <blockquote>
      	<h6>Other</h6>
    </blockquote>
    </div>


    <div class="input-field col s5">
  		<i class="material-icons prefix">email</i>
          <input type='text' size='40' name='email' placeholder="email" value='<?=$email?>'>
          <label for="icon_prefix">Email</label>
     </div>
     <?
		if (!$update_flag) 
		{
	?>
     <div class="input-field col s5">
  		<i class="material-icons prefix">person_pin</i>
          <input type='password' size='40' name='password' placeholder="password" value='<?=$password?>' >
          <label for="icon_prefix">Password</label>
     </div>

     <div class="input-field col s5">
  		<i class="material-icons prefix">person_pin</i>
          <input type='password' size='40' name='cnfm_password' placeholder="confirm password" value='<?=$cnfm_password?>' >
          <label for="icon_prefix">Confirm Password</label>
     </div>

     <?
 		}
     ?>


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
				<img src=".$myimage." class='materialboxed' width='65' />
				<input name=\"photoimage\" type=\"hidden\" value=".$myimage."  />
				<input type=\"button\" class=\"btn\" value=\"Remove\" onClick=\"removePhoto('removephotoimage.php','".$myimage."')\" />
				</div>";
        echo "<input id=\"upload_image\" class=\"btn\" style=\"margin:40px 0 0 30px;display:none;\" type=\"button\" value=\"Upload Image\"  />";
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
     <blockquote>
        <h5>Check list</h5>
    </blockquote>
    </div>

    <div class="col s5">
      <i class="material-icons prefix">check_circle</i>
          <input onclick="mark_checklist('skirt','skirt_check');" <?=$skirt_checked?> type='checkbox' id='skirt_check' >
            <label for='skirt_check' >Skirt</label>
     </div>

     <div class="col s5">
      <i class="material-icons prefix">check_circle</i>
          <input onclick='mark_checklist("enrolment","enrolment_check");' <?=$enrolment_checked?> type='checkbox' id='enrolment_check' >
            <label for='enrolment_check' >Enrolment</label>
     </div>

     <div class="col s5">
      <i class="material-icons prefix">check_circle</i>
          <input onclick='mark_checklist("jacket","jacket_check");' <?=$jacket_checked?> type='checkbox' id='jacket_check' >
            <label for='jacket_check' >Jacket</label>
     </div>



<div class="input-field col s10">
     <blockquote>
      	<h5>Parent/Guardian Information</h5>
    </blockquote>
    </div>

<div class="input-field col s5">
  		<i class="material-icons prefix">supervisor_account</i>
          <input type='text' size='40' name='parent1_relation' placeholder="parent relation" value='<?=$parent1_relation?>'>
          <label for="icon_prefix">Relation</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">account_circle</i>
          <input type='text' size='40' name='parent1_name' placeholder="parent name" value='<?=$parent1_name?>'>
          <label for="icon_prefix">Name</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">email</i>
          <input type='text' size='40' name='parent1_email' placeholder="parent email" value='<?=$parent1_email?>'>
          <label for="icon_prefix">Email/label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">phone_android</i>
          <input type='text' size='40' name='parent1_mobile' placeholder="parent mobile" value='<?=$parent1_mobile?>' >
          <label for="icon_prefix">Mobile</label>
     </div>


     <div class="input-field col s5">
      <i class="material-icons prefix">supervisor_account</i>
          <input type='text' size='40' name='parent2_relation' placeholder="parent relation" value='<?=$parent2_relation?>' style="width:250px" required>
          <label for="icon_prefix">Relation</label>
     </div>
     <div class="input-field col s5">
      <i class="material-icons prefix">account_circle</i>
          <input type='text' size='40' name='parent2_name' placeholder="parent name" value='<?=$parent2_name?>' style="width:250px">
          <label for="icon_prefix">Name</label>
     </div>
     <div class="input-field col s5">
      <i class="material-icons prefix">email</i>
          <input type='email' size='40' name='parent2_email' placeholder="parent email" value='<?=$parent2_email?>' style="width:250px" required>
          <label for="icon_prefix">Email</label>
     </div>
     <div class="input-field col s5">
      <i class="material-icons prefix">phone_android</i>
          <input type='text' size='40' name='parent2_mobile' placeholder="parent mobile" value='<?=$parent2_mobile?>' style="width:250px" required>
          <label for="icon_prefix">Mobile</label>
     </div>

     <div class="input-field col s10">
     <blockquote>
      	<h5>Emergency Contact Details</h5>
    </blockquote>
    </div>

	<div class="input-field col s5">
  		<i class="material-icons prefix">account_circle</i>
          <input type='text' size='40' name='emergency_contact_name' placeholder="emergency contact name" value='<?=$emergency_contact_name?>'>
          <label for="icon_prefix">Emergency Contact Name</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">phone_android</i>
          <input type='text' size='40' name='emergency_mobile' placeholder="emergency mobile" value='<?=$emergency_mobile?>'>
          <label for="icon_prefix">Mobile No</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">email</i>
          <input type='text' size='40' name='emergency_email' placeholder="emergency email" value='<?=$emergency_email?>'>
          <label for="icon_prefix">Email</label>
     </div>


     <div class="input-field col s10">
     <blockquote>
      	<h5>Medical History</h5>
    </blockquote>
    </div>

	<div class="input-field col s5">
  		<i class="material-icons prefix">local_hotel</i>
          <input type='text' size='40' name='back_pain' placeholder="back pains, if any" value='<?=$back_pain?>'>
          <label for="icon_prefix">Back Pain</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">sentiment_dissatisfied</i>
          <input type='text' size='40' name='allergies' placeholder="allergies, if any" value='<?=$allergies?>'>
          <label for="icon_prefix">Allergies</label>
     </div>
     <div class="input-field col s5">
  		<i class="material-icons prefix">local_hospital</i>
          <input type='text' size='40' name='other_medical_pbm' placeholder="other, if any" value='<?=$other_medical_pbm?>'>
          <label for="icon_prefix">Other</label>
     </div>

     <div class="input-field col s10">
     <blockquote>
      	<h5>Studios</h5>
    </blockquote>
    </div>
    <?
			$query = "select stu.name,dt.type_name,le.level_name,loc.location_name,sr.time_from,sr.time_to from studio stu,dance_type dt,location loc,level le,studio_relation sr,student_studio_relation ssr where ssr.student_id = '$student_id' and ssr.studio_relation_id = sr.id and stu.id = sr.studio_id and dt.id=sr.dance_type_id and loc.id = location_id and le.id = sr.level_id;";
			$result = sql_query($query,$connect);
			if (sql_num_rows($result)) {
				while ($row = sql_fetch_array($result)) 
				{?>
				<div class="input-field col s5">
				<div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title"><?=$row['name']?></span>
              	<div>Type : <?=$row['type_name']?></div>
              	<div>Level : <?=$row['level_name']?></div>
              	<div>Location : <?=$row['location_name']?></div>
              	<div>Time from : <?=$row['time_from']?></div>
              	<div>Time to : <?=$row['time_to']?></div>
            </div>
           
          </div>
          </div>
          <?}
      		}
          ?>
          <div class="input-field col s12">
           <div class="input-field col s6">
           		<input type="submit" name="submit-btn" value="Save and Proceed" class='btn'></input>
           </div>
          	
          	<div class="input-field col s6">
          		<a href="?u=home&b=change_studio&id=<?php echo $student_id; ?>"><input type="button" name="submit-btn"  value="Change Studio" class='btn'></input></a>      		
          	</div>
	
          	</div>
</div>
</div>
</div>


</form>

<!-- <footer style="padding: 98px;">
	<hr />
	<p>
		<strong></strong>
		<span style="float: right;font-size: 12px;font-weight: bold; "></span>
	</p>
</footer> -->