-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema citycykler
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema citycykler
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `citycykler` DEFAULT CHARACTER SET utf8 ;
USE `citycykler` ;

-- -----------------------------------------------------
-- Table `citycykler`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`media` (
  `mediaId` INT(11) NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(128) NOT NULL,
  `mime` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`mediaId`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`categorytype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`categorytype` (
  `categoryTypeId` INT(11) NOT NULL AUTO_INCREMENT,
  `categoryTypeName` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`categoryTypeId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`category` (
  `categoryId` INT(11) NOT NULL AUTO_INCREMENT,
  `categoryName` VARCHAR(15) NOT NULL,
  `categoryImage` INT(11) NOT NULL,
  `categoryType` INT(11) NOT NULL,
  PRIMARY KEY (`categoryId`),
  INDEX `fkCategoryImage_idx` (`categoryImage` ASC),
  INDEX `fkCategoryType_idx` (`categoryType` ASC),
  CONSTRAINT `fkCategoryImage`
    FOREIGN KEY (`categoryImage`)
    REFERENCES `citycykler`.`media` (`mediaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkCategoryType`
    FOREIGN KEY (`categoryType`)
    REFERENCES `citycykler`.`categorytype` (`categoryTypeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`producttype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`producttype` (
  `productTypeId` INT(11) NOT NULL AUTO_INCREMENT,
  `productTypeName` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`productTypeId`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`brands`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`brands` (
  `brandId` INT NOT NULL AUTO_INCREMENT,
  `brandName` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`brandId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citycykler`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`products` (
  `productId` INT(11) NOT NULL AUTO_INCREMENT,
  `productTitle` VARCHAR(25) NOT NULL,
  `productDesc` TEXT NOT NULL,
  `productPrice` DECIMAL(10,2) NOT NULL,
  `fkCategory` INT(11) NOT NULL,
  `fkType` INT(11) NOT NULL,
  `fkImage` INT(11) NOT NULL,
  `productModel` VARCHAR(15) NOT NULL,
  `productBrand` INT NOT NULL,
  PRIMARY KEY (`productId`),
  INDEX `fk_Category_idx` (`fkCategory` ASC),
  INDEX `fk_productType_idx` (`fkType` ASC),
  INDEX `fk_ProductImage_idx` (`fkImage` ASC),
  INDEX `FK_productBrand_idx` (`productBrand` ASC),
  CONSTRAINT `fk_Category`
    FOREIGN KEY (`fkCategory`)
    REFERENCES `citycykler`.`category` (`categoryId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductImage`
    FOREIGN KEY (`fkImage`)
    REFERENCES `citycykler`.`media` (`mediaId`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productType`
    FOREIGN KEY (`fkType`)
    REFERENCES `citycykler`.`producttype` (`productTypeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_productBrand`
    FOREIGN KEY (`productBrand`)
    REFERENCES `citycykler`.`brands` (`brandId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`offers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`offers` (
  `offerId` INT(11) NOT NULL AUTO_INCREMENT,
  `fkProductId` INT(11) NOT NULL,
  `offerPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`offerId`),
  INDEX `fk_prodId_idx` (`fkProductId` ASC),
  CONSTRAINT `fk_prodId`
    FOREIGN KEY (`fkProductId`)
    REFERENCES `citycykler`.`products` (`productId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`pagecontent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`pagecontent` (
  `pageId` INT(11) NOT NULL AUTO_INCREMENT,
  `pageName` VARCHAR(15) NOT NULL,
  `pageText` TEXT NOT NULL,
  PRIMARY KEY (`pageId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`sitesettings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`sitesettings` (
  `siteSettingsId` INT(11) NOT NULL AUTO_INCREMENT,
  `siteTitle` VARCHAR(25) NOT NULL,
  `street` VARCHAR(25) NOT NULL,
  `zipcode` INT(4) NOT NULL,
  `city` VARCHAR(25) NOT NULL,
  `phone` INT(8) NOT NULL,
  `fax` INT(8) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`siteSettingsId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `citycykler`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citycykler`.`users` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(25) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fullname` VARCHAR(45) NOT NULL,
  `userEmail` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
