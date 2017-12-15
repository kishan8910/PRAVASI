-- may 27, 2017

-- CREATE TABLE `admin` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(50) NOT NULL,
--   `email` varchar(50) NOT NULL,
--   `mobile` varchar(50) NOT NULL,
--   `password` varchar(50) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `aadhar_no` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `home_phone` bigint(20) NOT NULL,
  `migrantImage` varchar(100) NOT NULL,
  `emergency_mobile` bigint(20) NOT NULL,
  `emergency_email` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aadhar_no` (`aadhar_no`)
) ENGINE=InnoDB;


-- CREATE TABLE `dance_type` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `type_name` varchar(50) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB;


-- CREATE TABLE `studio` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(50) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB;


CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


-- CREATE TABLE `level` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `level_name` varchar(50) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB;


-- CREATE TABLE `studio_relation` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `studio_id` int(11) NOT NULL,
--   `dance_type_id` int(11) NOT NULL,
--   `location_id` int(11) NOT NULL,
--   `level_id` int(11) NOT NULL,
--   `time_from` time NOT NULL,
--   `time_to` time NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB; 


-- CREATE TABLE `student_studio_relation` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `student_id` int(11) NOT NULL,
--   `studio_relation_id` int(11) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB;


-- ALTER TABLE student_studio_relation ADD CONSTRAINT uniq_key UNIQUE (student_id,studio_relation_id);


-- CREATE TABLE `student_leave` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `student_id` INT NULL,
--   `date_from` DATE NULL,
--   `date_to` DATE NULL,
--   PRIMARY KEY (`id`),
--   INDEX `foreign_student_idx` (`student_id` ASC),
--   CONSTRAINT `foreign_student`
--     FOREIGN KEY (`student_id`)
--     REFERENCES `student` (`id`)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION) ENGINE=InnoDB;


-- ALTER TABLE `student_leave` 
-- ADD COLUMN `matter` VARCHAR(45) NULL AFTER `date_to`;

CREATE TABLE `forgot_password` (
  `forgetID` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `aadhar_no` varchar(100) NOT NULL,
  `random_number` varchar(50) NOT NULL,
  PRIMARY KEY (`forgetID`)
) ENGINE=InnoDB;


-- CREATE TABLE `student_fee_details` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `year` int(11) DEFAULT NULL,
--   `month` varchar(20) DEFAULT NULL,
--   `student_id` int(11) DEFAULT NULL,
--   `no_of_weeks` int(11) DEFAULT NULL,
--   `comment` varchar(150) DEFAULT NULL,
--   `studio_relation_id` int(11) DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `id_UNIQUE` (`id`),
--   KEY `fk_student_fee_details_1_idx` (`student_id`),
--   KEY `fk_student_fee_details_2_idx` (`studio_relation_id`),
--   CONSTRAINT `fk_student_fee_details_2` FOREIGN KEY (`studio_relation_id`) REFERENCES `studio_relation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
--   CONSTRAINT `fk_student_fee_details_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
-- ) ENGINE=InnoDB;




CREATE TABLE `notification_history` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `changed_field` VARCHAR(45) NULL,
  `changed_field_value` VARCHAR(150) NULL,
  PRIMARY KEY (`id`));


ALTER TABLE `notification_history` 
ADD COLUMN `user_field` VARCHAR(45) NULL AFTER `changed_field_value`;


ALTER TABLE `user` 
ADD COLUMN `enrolment_date` DATE NOT NULL AFTER `userType`;7


ALTER TABLE `user` 
CHANGE COLUMN `migrantImage` `userImage` VARCHAR(100) NOT NULL ;


ALTER TABLE `user` 
ADD COLUMN `location_id` INT(11) NOT NULL AFTER `enrolment_date`;


ALTER TABLE `user` 
CHANGE COLUMN `enrolment_date` `enrolment_date` TIMESTAMP NOT NULL ;



CREATE TABLE `migrant_job_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id_migrant_type` INT NOT NULL,
  `user_id_employer_type` INT NOT NULL,
  `terminationReq` INT NULL DEFAULT '0',
  `joinReq` INT NULL DEFAULT '0',
  `isEmployed` INT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));












