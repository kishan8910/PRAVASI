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
	 
 


		function showEmployerTransactions(user_id,myaccount,aadhar_no, startBlockNumber, endBlockNumber) {


  if (endBlockNumber == null) {
    endBlockNumber = web3.eth.blockNumber;
    console.log("Using endBlockNumber: " + endBlockNumber);
  }
  if (startBlockNumber == null) {
    startBlockNumber = endBlockNumber - 1000;
    console.log("Using startBlockNumber: " + startBlockNumber);
  }
  console.log("Searching for transactions to/from account \"" + myaccount + "\" within blocks "  + startBlockNumber + " and " + endBlockNumber);
  // var count = 0;
  for (var i = startBlockNumber; i <= endBlockNumber; i++) {
    
    var block = web3.eth.getBlock(i, true);
    if (block != null && block.transactions != null) {
      block.transactions.forEach( function(e) {
        if (myaccount == "*" || myaccount == e.from || myaccount == e.to) {

            if (e.input.indexOf("3bed352d") == 2 || e.input.indexOf("9c6914fb") == 2)  //hire || fire function called
             {


             	  var functionHash = e.input.substring(2,10);
                var employerAadhaarFromBlock = e.input.substring(10,74);
                var employeeAadhaarFromBlock = e.input.substring(74);
                var transactionType = null;


                if(functionHash ==  "3bed352d")
                {
                  transactionType = "Hiring Transaction";
                }
                else
                {
                  transactionType = "Firing Transaction";
                }                

                var table = "<table class=\"responsive-table bordered\" ><tr><th colspan='2' style='text-align:center;'>"+transactionType+"</th></tr><tr>  <th> Transation hash </th> <td>" + e.hash + " </td>  </tr> " +
                            "<tr>  <th> From Address </th> <td>"    + e.from + " </td>  </tr> " +
                            "<tr>  <th> To Address   </th> <td>"    + e.to   + " </td>  </tr> " +
                            "<tr>  <th> Employer Aadhaar </th> <td>"    + employerAadhaarFromBlock + " </td>  </tr> " +
                            "<tr>  <th> Employee Aadhaar </th> <td>"    + employeeAadhaarFromBlock + " </td>  </tr> " +
                            "<tr>  <th> input        </th> <td>"    + e.input + " </td>  </tr> " +
                            "<tr>  <th> Timestamp    </th> <td>"    + block.timestamp + " " + new Date(block.timestamp * 1000).toGMTString() + " </td>  </tr> " +
                            "<tr>  <th> Value        </th> <td>"    + e.value + " </td>  </tr>  </table>" ;

                $("#txn_details").append(table);

             }

        }
      })
    }
  }


}



function searchEmployer(url)
{
	var employerAadhaarNo = $("#employerAadhaarNo").val();
	var dataString = "employerAadhaarNo="+employerAadhaarNo;
		// alert(dataString);
	$.ajax({
        type: "POST",
        url: url,
        data: dataString,
        success: function(response)
        {
            $('#details').html(response);
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
                <h5>Enter Employer Aadhar For Transaction History</h5>
            </blockquote>

<div class="input-field col s5 validation">
    <i class="material-icons prefix">drag_handle</i>
     <input id='employerAadhaarNo' type='text' size='30' class="required regx_general" style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();">
    <label for="icon_prefix">Aadhar No</label>
</div>



<div class="input-field col s10">
     <input name="upload" type="submit" class="btn" id="upload" value="Submit"  onclick="searchEmployer('home/ajax_show_employer.php');" >
</div>


</div>
</div>
</div>



<div id="details" class="details">

    <div id="loader" style="width:100px;height:50px;margin-left:450px;margin-top:25px;float:left;display:none;"><img src="../libcommon/images/ajax_load.gif" /></div>

</div>

<div id="pagination" style="text-align:right;"></div>







