pragma solidity ^0.4.17;

contract Employee {

    


    address[] public employeeAccounts;

     mapping (address => address) hiring;
    

    function initEmployeeAddress (address employeeAddress) public {
        employeeAccounts.push(employeeAddress) -1;
    }

    function hire(address employerAddress,address employeeAddress) public  {
        hiring[employeeAddress] = employerAddress;
     }
    
    
    function fire(address employeeAddress) public  {
        if(hiring[employeeAddress] == msg.sender)
            hiring[employeeAddress] = 0x0;
    }
    
    function getEmployer(address employeeAddress) constant public returns (address) {
        return (hiring[employeeAddress]);
    }
    
    function getEmployees () constant public returns (address[])
    {
        return employeeAccounts;
    }

}
