<!---  in enter_details.php  -->


<input type="hidden" name="empl_address" id="empl_address" value="" />
<script>
	function callContract(){

		var next_id = <?php 
    	    					$query = "select count(*) from user";
       							$result = sql_query($query,$connect);
       							$row = sql_fetch_array($result);
        						echo $row[0];
        					?>	
       
        web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
		
		var new_empl_address = web3.eth.accounts[next_id];
		$("#empl_address").val = new_empl_address ;
		
		if( $("#userType").val != "migrant" )
		{
			$.post("save_detail.php",$("#edit_details").serialize());
		}
		else{		
			
			abi = [];	
			EmployeeContract = web3.eth.contract(abi);
			contractInstance = EmployeeContract.at(web3.eth.accounts[0]);

 			web3.eth.defaultAccount = new_empl_address;

 			var retAddress = contractInstance.Employee( {gas: 1000000}); //calling constructor

 			
 			if(retAddress != NULL)
 			{
 				$.post("save_detail.php",$("#edit_details").serialize());
			}
			else{
				alert("error occured while registering new user in block");
			}
		}
	}	
</script>
 <!---  in register_details.php  

 change 
<form action="save_detail.php" method='POST' id="edit_details">
to
<form onSubmit="callContract()" method='POST' id="edit_details">

in save_details.php save tmpl_address to mysql -->