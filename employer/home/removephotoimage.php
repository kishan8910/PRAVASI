<script type='text/javascript' src='../libcommon/javascripts/jquery/jquery-1.7.1.min.js'></script>
<script type="text/javascript">	
$(document).ready(function()
{	
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
		//Cover image upload		
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
				button.html("<p style=color:#F00; font-size:12px;>Successfully uploaded</p>");							
				window.clearInterval(interval);											
				this.enable();				
				$('#imgshow').html(response);						
			}
		});
});

</script>

<?php

if( $_SERVER['REQUEST_METHOD'] == "GET")
{
	
	$imgurl = $_GET["imgurl"];	
	//echo 	$imgurl;
	if(is_file ("../$imgurl"))
	{
		unlink("../$imgurl");	
		echo "<img src=\"../libcommon/images/missing.png\" style=\"width:75px; height:100px; float:left;\" /> 
				<div id=\"upload_image\">
				<input name=\"upload_image\" type=\"button\" value=\"Upload Image\" style=\"margin:40px 0 0 30px;\" />
				</div>				
				<span id=\"file\"></span>";
	}
	else 
	{
		echo "<div style=\"color:red;\">There is no image!!</div>";
		echo "<img src=\"../libcommon/images/missing.png\" style=\"width:75px; height:80px; float:left;margin-left:51px;padding:10px;\" /> 
				<div id=\"upload_image\">
				<input name=\"upload_image\" type=\"button\" value=\"Upload Image\" style=\"margin:40px 0 0 30px;\" />
				</div>				
				<span id=\"file\"></span>";
	}
}

?>

		
