var Migrations = artifacts.require("./Migrations.sol");

module.exports = function(deployer) {
  deployer.deploy(Migrations);
};


var Employee = artifacts.require("./Employee.sol");

module.exports = function(deployer) {
  deployer.deploy(Employee);
};
