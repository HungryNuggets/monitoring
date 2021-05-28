-- MySQL Workbench Synchronization
-- Generated: 2021-05-19 11:00
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Audrey

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `monitoring_hungry_nuggets`.`issue` 
DROP FOREIGN KEY `fk_issue_customer`;

ALTER TABLE `monitoring_hungry_nuggets`.`customer` 
ADD COLUMN `hosting_customer` VARCHAR(200) NOT NULL AFTER `domain_customer`;

ALTER TABLE `monitoring_hungry_nuggets`.`admin` 
CHANGE COLUMN `status_admin` `status_admin` TINYINT(4) NOT NULL COMMENT '1 -> Validated by an admin or 2 -> Not yet validated by an admin ' ;

ALTER TABLE `monitoring_hungry_nuggets`.`issue` 
CHANGE COLUMN `customer_id_customer` `customer_id_customer` INT(10) UNSIGNED NOT NULL COMMENT 'Customer who\'s domain is linked with the issue' ;

ALTER TABLE `monitoring_hungry_nuggets`.`issue` 
ADD CONSTRAINT `fk_issue_customer`
  FOREIGN KEY (`customer_id_customer`)
  REFERENCES `monitoring_hungry_nuggets`.`customer` (`id_customer`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
