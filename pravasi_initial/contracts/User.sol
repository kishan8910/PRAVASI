pragma solidity ^0.4.17;

contract Employee {

     bytes32[] public userAadhaar;

     mapping (address => address) hiring;
     
     mapping (bytes32 => address) userAccounts;
    

    function initEmployeeAddress (bytes32 aadhaarNo, address employeeAddress) public  {
       
       require(userAccounts[aadhaarNo] == 0x0 || aadhaarNo != 0 || employeeAddress != 0x0);
           
        userAadhaar.push(aadhaarNo) ;   
        userAccounts[aadhaarNo] = employeeAddress;
        
    }

    //function hire(address employerAddress,address employeeAddress) public  {
    //    hiring[employeeAddress] = employerAddress;
    // }
    
    function hire(bytes32 employerAadhaar,bytes32 employeeAadhaar) public  {
        require( userAccounts[employerAadhaar] == msg.sender || userAccounts[employeeAadhaar] != 0x0);
           
        hiring[userAccounts[employeeAadhaar]] = userAccounts[employerAadhaar];
     }
    
    function fire(bytes32 employeeAadhaar) public  {
        if(hiring[userAccounts[employeeAadhaar]] == msg.sender)
            hiring[userAccounts[employeeAadhaar]] = 0x0;
    }
    
    function getEmployerAddressByAddress(address employeeAddress) constant public returns (address) {
        return (hiring[employeeAddress]);
    }
    
    function getEmployerAddressByAadhaar(bytes32 employeeAadhaar) constant public returns (address) {
        return (hiring[userAccounts[employeeAadhaar]]);
    }
    
     function getUserAddressFromAadhaar(bytes32 aadhaarNo) constant public returns (address) {
        return (userAccounts[aadhaarNo]);
    }


    // function getUserAccounts () constant public returns (uint72[],address[])
    //  {
    //     address[] users;
    //     for ( uint16 i = 0; i < userAadhaar.length; i++ )
    //       {
    //          users.push(userAccounts[userAadhaar[i]]);
    //       }
        
    //     return (userAadhaar,users);
    //  }

}

