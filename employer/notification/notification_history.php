<div class="container">
<div class="row">
<div class="col s10 offset-s2">
            <blockquote>
                <h5>Notification</h5>
            </blockquote>




<?php 

$sql = "select st.first_name,st.email,nh.changed_field,nh.changed_field_value from student st inner join notification_history nh on st.id = nh.student_id;";
        // echo $sql;
        $result = sql_query($sql, $connect);
        if(sql_num_rows($result))
        {


            echo "<table class='bordered'>
				<tr >
                <th >Sl.No</th>
                <th >Notification Messages</th>   
            </tr>";
            while($row = sql_fetch_array($result))
            {
                $first_name = $row['first_name'];
                $email = $row['email'];
                $changed_field = $row['changed_field'];
                $changed_field_value = $row['changed_field_value'];

                $notification_msg = "$first_name $email changed $changed_field $changed_field_value";

                echo "<tr>
                        <td>
                            ".++$i."
                        </td>
                        <td>
                            ".$notification_msg."
                        </td>
                    </tr>";
            }
            echo "</table>";

        }
        else
        {
            echo "<h5>No notifications found</h5>";
        }


?>

</div>
</div>
</div>