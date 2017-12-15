<?

include "../libcommon/conf.php";
include "../libcommon/classes/db_mysql.php";
include "../libcommon/functions.php";
include "../libcommon/db_inc.php";

include "header.php";


?>



<script src="../libcommon/javascripts/jquery.badBrowser.js" type="text/javascript"></script>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
<body>
        <div class="flex-center position-ref full-height">
            <div class="content">
               
                <!-- <div class="body"></div>
                 <div class="grad"></div>
                -->
                <br>
                <div class="details">
                    <form action="save_detail.php" method='POST' id="edit_details">
                    <?php 
                    	include "enter_details.php";
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
include "../libcommon/db_close.php";
?>