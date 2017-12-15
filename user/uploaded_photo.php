<script type='text/javascript' src='../libcommon/javascripts/jquery/jquery-1.7.1.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {    
    function removePhoto(url,imgurl)
    {           
        var dataString = "imgurl="+imgurl;
        // alert(dataString);
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
});
</script>

<?php

// include "../../libcommon/conf.php";
// include "../../libcommon/classes/db_mysql.php";
include "../libcommon/functions.php";
// include "../../libcommon/db_inc.php";

$fileName = $_FILES['doc']['name'];
$image_path = "../usersphoto";

$format = getFormat($fileName);
$ext = pathinfo($fileName, PATHINFO_EXTENSION);
$allowed =  array('gif','png' ,'jpg', 'pdf');
$anrand = get_rand_id(10); //alphanumeric values

if(in_array($ext,$allowed))
{
	$myimage = "$image_path/".$anrand.".".$format;
	if (move_uploaded_file($_FILES['doc']['tmp_name'], $myimage)) 
	{
	  //echo "success";
	} 
	else 
	{
	  echo "Upload failed!";
	}
}
else
{
	echo "Incorrect format!";
}

/*$thumb=new Imagick($myimage);

list($newX,$newY)=scaleImage(
        $thumb->getImageWidth(),
        $thumb->getImageHeight(),
        100, 133);

$thumb->thumbnailImage($newX,$newY);

$thumb->writeImage($myimage);
*/	
echo "<img src=\"$myimage\" style=\"width:75px; height:80px; float:left;margin-left:51px;padding:10px;\" />
		<input name=\"photoimage\" type=\"hidden\" value=\"$myimage\" />			
		<input type=\"button\" class=\"btn\" value=\"Remove\" style=\"margin:40px 0 0 30px;\" onclick=\"removePhoto('removephotoimage.php','$myimage')\" />";

function scaleImage($x,$y,$cx,$cy) 
{
    //Set the default NEW values to be the old, in case it doesnt even need scaling
    list($nx,$ny)=array($x,$y);
   
    //If image is generally smaller, don't even bother
    if ($x>=$cx || $y>=$cx) 
    {           
        //Work out ratios
        if ($x>0) $rx=$cx/$x;
        if ($y>0) $ry=$cy/$y;
             
        //Use the lowest ratio, to ensure we don't go over the wanted image size
        if ($rx>$ry) 
        {
            $r=$ry;
        } 
        else 
        {
            $r=$rx;
        }
       
        //Calculate the new size based on the chosen ratio
        $nx=intval($x*$r);
        $ny=intval($y*$r);
    }   
   
    //Return the results
    return array($nx,$ny);
}

function getFormat ($filename) 
{
	return strtolower(substr(strrchr($filename, '.'), 1));
}

?>
