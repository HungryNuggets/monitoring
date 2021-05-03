-- MySQL Workbench Synchronization
-- Generated: 2021-05-03 13:47
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Audrey :)

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `monitoring_hungry_nuggets`.`issue` 
DROP FOREIGN KEY `fk_issue_customer`;

ALTER TABLE `monitoring_hungry_nuggets`.`issue` 
CHANGE COLUMN `timestamp_issue` `timestamp_issue` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamps of the issue' ,
CHANGE COLUMN `desc_issue` `desc_issue` VARCHAR(200) NOT NULL COMMENT 'Description of the issue' ,
CHANGE COLUMN `admin_id_admin` `admin_id_admin` INT(11) NULL DEFAULT NULL COMMENT 'Id of the admin taking the issue in charge' ;

ALTER TABLE `monitoring_hungry_nuggets`.`issue` 
ADD CONSTRAINT `fk_issue_customer`
  FOREIGN KEY (`customer_id_customer`)
  REFERENCES `monitoring_hungry_nuggets`.`customer` (`id_customer`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
