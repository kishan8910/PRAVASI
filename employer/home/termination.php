<script type="text/javascript" src="../index.js" ></script>
<script type="text/javascript">
    
    function terminateEmployee(migrant_user_id,job_detail_id,contractAddress,employeeAadharNo)
    {
        jConfirm('Are you sure to terminate this employee?', 'Confirmation', function(r) {
    if( r==true)
    {


    
    console.log(contractAddress);
    console.log(employerAadharNo);
    var employerAadharNo = <? echo '"'.$_SESSION['user_aadhar_no'].'"';?>;
    var employerContractAddress = <? echo '"'.$_SESSION['contract_address'].'"';?>;
    web3.eth.defaultAccount = employerContractAddress;
    var txr = contractInstance.fire(employeeAadharNo);
    
    if (!txr) 
    {
        return false;
    }

    // alert(txr);


    var dataString = "migrant_user_id="+migrant_user_id+"&job_detail_id="+job_detail_id;
    
    $.ajax({
        type: "POST",
        url: "home/ajax_terminate_migrant.php",
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

</script>

<?php


$query = "select mjt.id as job_detail_id,u.id as user_id,u.first_name,u.email,u.mobile,l.location_name,u.empl_tx_address,u.aadhar_no from user u inner join location l on l.id = u.location_id inner join migrant_job_details mjt on u.id = mjt.user_id_migrant_type where u.userType='migrant' and mjt.user_id_employer_type = '$_SESSION[user_id]' and mjt.isEmployed = 1";

$result = sql_query($query,$connect);

if (sql_num_rows($result)) {
    
    echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><table class='responsive-table bordered'>
                <tr>
                <th>Sl.No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>Mobile</th>
                <th>Hire</th>        
            </tr>";
            $i=0;
    while ($row = sql_fetch_array($result)) {

        $employeeAadharNo = $row['aadhar_no'];

        $contractAddress = $row['empl_tx_address'];
       $job_detail_id = $row['job_detail_id'];

        echo "<tr>
            <td>".++$i."</td>
            <td>".$row['first_name']."</td>
            <td>".$row['email']."</td>
            <td>".$row['location_name']."</td>
            <td>".$row['mobile']."</td>";
           
                echo "<td><input type='button' value='Terminate' class='btn' onclick=\"terminateEmployee(".$row['user_id'].",".$job_detail_id.",'".$contractAddress."','".$employeeAadharNo."');\"></td>
        </tr>";
            
                    
    }
    echo"</table></div></div></div>";
}
else
{
    echo "<div class='container'><div class='row'><div class='col s10 offset-s2'><h4 style=\"text-align:center; margin:5% 5%; color:#F00;\">No Employees Found For Termination</h4></div></div>";
}


?>