pragma solidity ^0.4.17;

contract Employee {

     uint72[] public userAadhaar;

     mapping (address => address) hiring;
     
     mapping (uint72 => address) userAccounts;
    

    function initEmployeeAddress (uint72 aadhaarNo, address employeeAddress) public  {
       
       require(userAccounts[aadhaarNo] == 0x0 || aadhaarNo != 0 || employeeAddress != 0x0);
           
        userAadhaar.push(aadhaarNo) ;   
        userAccounts[aadhaarNo] = employeeAddress;
        
    }
    
    function hire(uint72 employerAadhaar,uint72 employeeAadhaar) public  {
        require( userAccounts[employerAadhaar] == msg.sender || userAccounts[employeeAadhaar] != 0x0);
           
        hiring[userAccounts[employeeAadhaar]] = userAccounts[employerAadhaar];
     }
    
    function fire(uint72 employeeAadhaar) public  {
        if(hiring[userAccounts[employeeAadhaar]] == msg.sender)
            hiring[userAccounts[employeeAadhaar]] = 0x0;
    }
    
    function getEmployerAddressByAddress(address employeeAddress) constant public returns (address) {
        return (hiring[employeeAddress]);
    }
    
    function getEmployerAddressByAadhaar(uint72 employeeAadhaar) constant public returns (address) {
        return (hiring[userAccounts[employeeAadhaar]]);
    }
    
     function getUserAddressFromAadhaar(uint72 aadhaarNo) constant public returns (address) {
        return (userAccounts[aadhaarNo]);
    }

}

