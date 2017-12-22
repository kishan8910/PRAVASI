<style type="text/css">
    td {
        font-weight: bold;
    }
</style>
<style type="text/css">
    td {
        font-weight: bold;
    }

    .select-dropdown{
        overflow-y: auto !important;
    }
</style>
<script type="text/javascript" src="../index.js" ></script>
<script type="text/javascript">
function hireEmployee(user_id,contractAddress,employeeAadhar_no)
{


    jConfirm('Are you sure to?', 'Confirmation', function(r) {
    if( r==true)
    {


    var employerAadharNo = <? echo '"'.$_SESSION['user_aadhar_no'].'"';?>;
    var employerContractAddress = <? echo '"'.$_SESSION['contract_address'].'"';?>;
    console.log(employeeAadhar_no);
    console.log(employerAadharNo);
    console.log(employerContractAddress);
    web3.eth.defaultAccount = employerContractAddress;
    var txr = contractInstance.hire(employerAadharNo,employeeAadhar_no);
    
    if (!txr) 
    {
        return false;
    }

    // alert(txr);


    var dataString = "user_id="+user_id;
    $.ajax({
        type: "POST",
        url: "home/ajax_hire_migrant.php",
        data: dataString,
        success: function(response)
        {

            if (response == "1") 
            {
                jAlert("<span style='color:red;'>Error occured.</span>");
            }
            else
            {
                jAlert("<span style='color:blue;'>Success</span>", 'Success', function(r) {
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
 });
}

function searchUser()
{
    var mobile = $("#mobile").val();
    var location_id = $("#location").val();

    var dataS = "mobile="+mobile+"&location_id="+location_id;

    $('#loader').show();
    $.ajax({
            type: "POST",
            url: "home/ajax_search_user.php",
            data: dataS,
            success: function(response)
            {

                $('#loader').hide(); 
                $('#listlevel').html(response);

            }
          });  
            return false; 

}

    
</script>
<?
include "session.php";

?>

<div class="container">
<div class="row">
<div class="col s10 offset-s2">
            <blockquote>
                <h5>Search User</h5>
            </blockquote>

<div class="input-field col s5 validation">
    <i class="material-icons prefix">drag_handle</i>
     <input id='mobile' type='text' size='30' class="required regx_general" style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();">
    <label for="icon_prefix">Mobile No</label>
</div>

<div class="input-field col s5 validation">
    <i class="material-icons prefix">add_location</i>


   <?php
        $query = "select * from location";
        $result = sql_query($query,$connect);
        if (sql_num_rows($result)) {
            echo "<select class='input-field col s12' id='location' style='width:264px;'>
                <option disabled selected value=''>Select</option>";
            while ($row = sql_fetch_array($result)) {
                echo "<option ".$location_select[$row[id]]." value='$row[id]'>".$row['location_name']."</option>";
            }
            echo "</select>";
        }
        
    ?>
    

    <label for="icon_prefix">Select Location</label>
</div>

<div class="input-field col s10">

     <input name="upload" type="submit" class="btn" id="upload" value="Submit"  onclick="searchUser();" >
</div>


</div>
</div>
</div>



<div id="listlevel" class="listlevel">

    <div id="loader" style="width:100px;height:50px;margin-left:450px;margin-top:25px;float:left;display:none;"><img src="../libcommon/images/ajax_load.gif" /></div>

</div>

<div id="pagination" style="text-align:right;"></div>




<script type="text/javascript">
    
    // save_list_studio('ajax_save_list_studio.php', 'liststudio', 0);
    $(document).ready(function() 
    {
            Materialize.updateTextFields();
            $('select').material_select();
      
    });

</script>
