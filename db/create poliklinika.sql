-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema poliklinika
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema poliklinika
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `poliklinika` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_latvian_ci ;
USE `poliklinika` ;

-- -----------------------------------------------------
-- Table `poliklinika`.`adrese`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`adrese` (
  `adrese_id` INT NOT NULL AUTO_INCREMENT,
  `valsts` VARCHAR(45) NOT NULL,
  `regions` VARCHAR(90) NOT NULL,
  `pilseta` VARCHAR(45) NULL,
  `iela` VARCHAR(45) NULL,
  `maja` VARCHAR(50) NOT NULL,
  `pasta_indekss` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`adrese_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`darbinieki`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`darbinieki` (
  `darbinieks_id` INT NOT NULL AUTO_INCREMENT,
  `vards` VARCHAR(45) NOT NULL,
  `uzvards` VARCHAR(45) NOT NULL,
  `tips` ENUM('Vadītājs', 'Administrators', 'Speciālists', 'Māsa', 'Apkopējs') NOT NULL,
  `personas_kods` VARCHAR(12) NOT NULL,
  `talrunis` VARCHAR(12) NOT NULL,
  `liguma_nr` VARCHAR(10) NULL,
  `id_adrese` INT NOT NULL,
  PRIMARY KEY (`darbinieks_id`),
  CONSTRAINT `fk_darbinieki_adrese1`
    FOREIGN KEY (`id_adrese`)
    REFERENCES `poliklinika`.`adrese` (`adrese_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`lietotaji`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`lietotaji` (
  `lietotajs_id` INT NOT NULL AUTO_INCREMENT,
  `lietotajvards` VARCHAR(45) NOT NULL,
  `parole` VARCHAR(60) NOT NULL,
  `epasts` VARCHAR(255) NOT NULL,
  `id_darbinieks` INT NOT NULL,
  `adminpiekluve` ENUM('yes', 'no'),
  PRIMARY KEY (`lietotajs_id`, `id_darbinieks`),
  CONSTRAINT `fk_lietotaji_darbinieki1`
    FOREIGN KEY (`id_darbinieks`)
    REFERENCES `poliklinika`.`darbinieki` (`darbinieks_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`pacienti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`pacienti` (
  `pacients_id` INT NOT NULL AUTO_INCREMENT,
  `vards` VARCHAR(45) NOT NULL,
  `uzvards` VARCHAR(45) NOT NULL,
  `personas_kods` VARCHAR(12) NULL,
  `dzim_datums` DATE NOT NULL,
  `talrunis` VARCHAR(12) NULL,
  `epasts` VARCHAR(255) NULL,
  `nacionalitate` VARCHAR(45) NOT NULL,
  `gimenes_arsts` INT,
  `id_adrese` INT NOT NULL,
  PRIMARY KEY (`pacients_id`),
  CONSTRAINT `fk_pacienti_darbinieki1`
    FOREIGN KEY (`gimenes_arsts`)
    REFERENCES `poliklinika`.`darbinieki` (`darbinieks_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pacienti_adrese1`
    FOREIGN KEY (`id_adrese`)
    REFERENCES `poliklinika`.`adrese` (`adrese_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`kabinets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`kabinets` (
  `kabinets_id` VARCHAR(5) NOT NULL,
  `stavs` INT NOT NULL,
  PRIMARY KEY (`kabinets_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`pakalpojums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`pakalpojums` (
  `pakalpojums_id` INT NOT NULL AUTO_INCREMENT,
  `nosaukums` VARCHAR(45) NOT NULL,
  `apraksts` TEXT NULL,
  `cena` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`pakalpojums_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`vizite`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`vizite` (
  `vizite_id` INT NOT NULL AUTO_INCREMENT,
  `id_pacients` INT NOT NULL,
  `id_arsts` INT NOT NULL,
  `laiks` DATETIME NOT NULL,
  `id_pakalpojums` INT NOT NULL,
  `gim_arsta_nosutijums` TINYINT NULL,
  `valsts_apmaksats` TINYINT NOT NULL,
  `apdrosinasana` TINYINT NULL,
  `id_kabinets` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`vizite_id`, `id_pacients`, `id_arsts`),
  CONSTRAINT `fk_vizite_pacienti1`
    FOREIGN KEY (`id_pacients`)
    REFERENCES `poliklinika`.`pacienti` (`pacients_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_vizite_darbinieki1`
    FOREIGN KEY (`id_arsts`)
    REFERENCES `poliklinika`.`darbinieki` (`darbinieks_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_vizite_pakalpojums1`
    FOREIGN KEY (`id_pakalpojums`)
    REFERENCES `poliklinika`.`pakalpojums` (`pakalpojums_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_vizite_kabinets1`
    FOREIGN KEY (`id_kabinets`)
    REFERENCES `poliklinika`.`kabinets` (`kabinets_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`diagnoze`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`diagnoze` (
  `diagnozes_kods` VARCHAR(5) NOT NULL,
  `nosaukums` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`diagnozes_kods`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`pacienta_diagnoze`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`pacienta_diagnoze` (
`pacienta_diagnoze_id` INT NOT NULL AUTO_INCREMENT,
  `id_pacients` INT NOT NULL,
  `id_diagnoze` VARCHAR(5) NOT NULL,
  `statuss` ENUM('Izmeklēšanā', 'Aktīvs', 'Izārstēts') NOT NULL DEFAULT 'Izmeklēšanā',
  PRIMARY KEY (`pacienta_diagnoze_id`, `id_pacients`, `id_diagnoze`),
  CONSTRAINT `fk_pacienti_has_diagnoze_pacienti1`
    FOREIGN KEY (`id_pacients`)
    REFERENCES `poliklinika`.`pacienti` (`pacients_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pacienti_has_diagnoze_diagnoze1`
    FOREIGN KEY (`id_diagnoze`)
    REFERENCES `poliklinika`.`diagnoze` (`diagnozes_kods`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`specialitate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`specialitate` (
  `specialitate_id` INT NOT NULL AUTO_INCREMENT,
  `nosaukums` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`specialitate_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `poliklinika`.`darbinieka_specialitate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `poliklinika`.`darbinieka_specialitate` (
`darbinieka_specialitate_id` INT NOT NULL AUTO_INCREMENT,
  `id_darbinieks` INT NOT NULL,
  `id_specialitate` INT NOT NULL,
  PRIMARY KEY (`darbinieka_specialitate_id`, `id_darbinieks`, `id_specialitate`),
  CONSTRAINT `fk_darbinieki_has_specialitate_darbinieki1`
    FOREIGN KEY (`id_darbinieks`)
    REFERENCES `poliklinika`.`darbinieki` (`darbinieks_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_darbinieki_has_specialitate_specialitate1`
    FOREIGN KEY (`id_specialitate`)
    REFERENCES `poliklinika`.`specialitate` (`specialitate_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
