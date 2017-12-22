<script type="text/javascript">
	
function delete_complaint(id,url)
{
	var dataString = "complaint_id="+id;


		$.ajax({
		    type: "POST",
		    url: "complaints/"+url,
		    data: dataString,
		    success: function(response)
		    {
		    	if(response == 2)
                {
                 	Materialize.toast('Cannot delete! Error Occured!', 3000, 'rounded');   
                }
                else
                {
					Materialize.toast('Complaint deleted successfully!', 3000, 'rounded');
					create_complaint('ajax_save_list_complaints.php', 'listcomplaints', 'list');
                }
	
		    	
		    }
	  	});  
}

function create_complaint(url,div,action)
{
	var category = $("#category").val();
	var description = $("#description").val();
	var dataString = "category="+category+"&description="+description+"&action="+action;

		$.ajax({
		    type: "POST",
		    url: "complaints/"+url,
		    data: dataString,
		    success: function(response)
		    {
		    	$("#"+div).html(response);
		    	$("#category").val("");
		    	$("#description").val("");
		    }
	  	});  
	    
	
}



</script>

<style type="text/css">
	
	.select-dropdown{
    overflow-y: auto !important;
}
</style>

<div class="container">
<div class="row">
<div class="col s10 offset-s2">
            <blockquote>
                <h5>Post Complaints</h5>
            </blockquote>

<div class="input-field col s10 validation">
    <i class="material-icons prefix">swap_vert</i>


    <?php
        $query = "select * from complaint_category";
        $result = sql_query($query,$connect);
        if (sql_num_rows($result)) {
            echo "<select id='category'>
                <option disabled selected value=''>Select</option>";
            while ($row = sql_fetch_array($result)) {
                echo "<option value='$row[id]'>".$row['category_name']."</option>";
            }
            echo "</select>";
        }

    ?>
    

    <label for="icon_prefix">Select Complaint Category</label>
</div>




<div class="input-field col s10">
      <i class="material-icons prefix">home</i>
          <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="description" name="description" class="materialize-textarea"></textarea>
          <label for="description">Enter description</label>
        </div>
      </div>
    </form>
  </div>

<div class="input-field col s5">

     <input name="upload" type="button" class="btn" id="upload" value="Post Complaint"  onclick="create_complaint('ajax_save_list_complaints.php', 'listcomplaints','save');"  class="btn">
</div>





</div>
</div>
</div>


<div id="listcomplaints" class="listcomplaints">

    <div id="loader" style="width:100px;height:50px;margin-left:450px;margin-top:25px;float:left;display:none;"><img src="../libcommon/images/ajax_load.gif" /></div>

</div>

<div id="pagination" style="text-align:right;"></div>


<script type="text/javascript">
	
 $(document).ready(function() 
    {
            Materialize.updateTextFields();
            $('select').material_select();
            
            
    });



</script>


<script type="text/javascript">
    create_complaint('ajax_save_list_complaints.php', 'listcomplaints', 'list');
</script>

