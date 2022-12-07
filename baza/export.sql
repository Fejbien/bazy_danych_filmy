-- MySQL Script generated by MySQL Workbench
-- Wed Dec  7 11:23:22 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema movies
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema movies
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `movies` DEFAULT CHARACTER SET utf8 ;
USE `movies` ;

-- -----------------------------------------------------
-- Table `movies`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movies`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `is_admin` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `movies`.`generes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movies`.`generes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `genere` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `movies`.`movies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movies`.`movies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `year` VARCHAR(45) NULL,
  `length` INT NULL,
  `genere_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `admin_id` INT NULL,
  `renter_id` INT NULL,
  PRIMARY KEY (`id`, `genere_id`, `user_id`),
  INDEX `fk_movies_users_idx` (`user_id` ASC),
  INDEX `fk_movies_generes1_idx` (`genere_id` ASC),
  INDEX `fk_movies_users1_idx` (`admin_id` ASC),
  INDEX `fk_movies_users2_idx` (`renter_id` ASC),
  CONSTRAINT `fk_movies_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `movies`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movies_generes1`
    FOREIGN KEY (`genere_id`)
    REFERENCES `movies`.`generes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movies_users1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `movies`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movies_users2`
    FOREIGN KEY (`renter_id`)
    REFERENCES `movies`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
