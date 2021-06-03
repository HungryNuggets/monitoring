-- MySQL Workbench Synchronization
-- Generated: 2021-06-03 11:28
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Audrey

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER SCHEMA `monitoring_hungry_nuggets`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_customer` (
  `id_customer` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_customer` VARCHAR(85) NOT NULL COMMENT 'Nom de l\'entreprise du client',
  `domain_customer` VARCHAR(140) NOT NULL COMMENT 'Nom de domaine du client',
  `hosting_customer` VARCHAR(200) NOT NULL,
  `contact_person_customer` VARCHAR(100) NOT NULL COMMENT 'Nom de la personne de contact',
  `mail_customer` VARCHAR(150) NOT NULL COMMENT 'E-mail de contact',
  `phone_customer` VARCHAR(40) NOT NULL COMMENT 'Numéro de téléphone de contact',
  PRIMARY KEY (`id_customer`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_admin` (
  `id_admin` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname_admin` VARCHAR(50) NOT NULL COMMENT 'Choosen nickname',
  `pwd_admin` VARCHAR(255) NOT NULL COMMENT 'Password',
  `mail_admin` VARCHAR(200) NOT NULL COMMENT 'personnal email address',
  `status_admin` TINYINT(4) NOT NULL COMMENT '1 -> Validated by an admin or 2 -> Not yet validated by an admin ',
  `confirmation_key_admin` VARCHAR(60) NOT NULL COMMENT 'Randomly generated key for validation purpose',
  `validation_status_admin` TINYINT(4) NOT NULL COMMENT '1 -> E-mail verified or 2 -> Not verified',
  PRIMARY KEY (`id_admin`),
  UNIQUE INDEX `nickname_admin_UNIQUE` (`nickname_admin` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_issue` (
  `id_issue` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp_issue` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamps of the issue',
  `desc_issue` VARCHAR(200) NOT NULL COMMENT 'Description of the issue',
  `status_issue` TINYINT(4) NOT NULL COMMENT '1 -> resolved or 2 -> ongoing',
  `admin_id_admin` INT(11) NULL DEFAULT NULL COMMENT 'Id of the admin taking the issue in charge',
  `customer_id_customer` INT(10) UNSIGNED NOT NULL COMMENT 'Customer who\'s domain is linked with the issue',
  PRIMARY KEY (`id_issue`, `customer_id_customer`),
  INDEX `fk_issue_customer_idx` (`customer_id_customer` ASC) VISIBLE,
  CONSTRAINT `fk_issue_customer`
    FOREIGN KEY (`customer_id_customer`)
    REFERENCES `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_customer` (`id_customer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_issue` ;

DROP TABLE IF EXISTS `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_customer` ;

DROP TABLE IF EXISTS `monitoring_hungry_nuggets`.`monitoring_hungry_nuggets_admin` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
