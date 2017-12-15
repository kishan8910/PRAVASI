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

<script type="text/javascript">

function searchUser()
{
    var aadhar_no = $("#aadhar_no").val();
    var location_id = $("#location_id").val();
    var dataS = "aadhar_no="+aadhar_no+"&location_id="+location_id;
    $('#loader').show();
    $.ajax({
            type: "POST",
            url: "home/ajax_search_user.php",
            data: dataS,
            success: function(response)
            {
                
                $('#loader').hide(); 
                $('#'+div).html(response);

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
     <input id='aadhar_no' type='text' size='30' class="required regx_general" style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();">
    <label for="icon_prefix">Aadhar No</label>
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

     <input name="upload" type="submit" class="btn" id="upload" value="Submit"  onclick="save_list_level('ajax_save_list_level.php', 'listlevel', 1);" >
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
