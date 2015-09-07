-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema escuela
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema escuela
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `escuela` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `escuela` ;

-- -----------------------------------------------------
-- Table `escuela`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(45) NOT NULL COMMENT '',
  `tipo` ENUM('Docente', 'Estudiante') NULL COMMENT '',
  `nombres` VARCHAR(45) NULL COMMENT '',
  `apellidos` VARCHAR(45) NULL COMMENT '',
  `documento` VARCHAR(45) NULL COMMENT '',
  `sexo` ENUM('Femenino', 'Masculino') NULL COMMENT '',
  `estado` ENUM('Eliminado', 'Activo') NULL COMMENT '',
  PRIMARY KEY (`idUsuario`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Temas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Temas` (
  `idTema` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `periodo` INT NULL COMMENT '',
  `titulo` VARCHAR(45) NULL COMMENT '',
  `contenido` VARCHAR(45) NULL COMMENT '',
  `usuario` INT NOT NULL COMMENT '',
  `estado` ENUM('Eliminado', 'Activo') NULL COMMENT '',
  `Temascol` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idTema`)  COMMENT '',
  INDEX `fk_Temas_Usuarios_idx` (`usuario` ASC)  COMMENT '',
  CONSTRAINT `fk_Temas_Usuarios`
    FOREIGN KEY (`usuario`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Archivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Archivos` (
  `idArchivo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NULL COMMENT '',
  `tema` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idArchivo`)  COMMENT '',
  INDEX `fk_Archivos_Temas1_idx` (`tema` ASC)  COMMENT '',
  CONSTRAINT `fk_Archivos_Temas1`
    FOREIGN KEY (`tema`)
    REFERENCES `escuela`.`Temas` (`idTema`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Mensajes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Mensajes` (
  `idMensaje` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `emisor` INT NOT NULL COMMENT '',
  `reseptor` INT NOT NULL COMMENT '',
  `fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `estado` ENUM('Eliminado', 'Activo') NULL COMMENT '',
  PRIMARY KEY (`idMensaje`)  COMMENT '',
  INDEX `fk_Mensajes_Usuarios1_idx` (`emisor` ASC)  COMMENT '',
  INDEX `fk_Mensajes_Usuarios2_idx` (`reseptor` ASC)  COMMENT '',
  CONSTRAINT `fk_Mensajes_Usuarios1`
    FOREIGN KEY (`emisor`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Mensajes_Usuarios2`
    FOREIGN KEY (`reseptor`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Respuestas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Respuestas` (
  `idRespuesta` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `periodo` INT NULL COMMENT '',
  `respuesta` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idRespuesta`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Preguntas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Preguntas` (
  `idPregunta` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `periodo` INT NULL COMMENT '',
  `pregunta` VARCHAR(45) NULL COMMENT '',
  `respuesta` INT NOT NULL COMMENT '',
  `usuario` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idPregunta`)  COMMENT '',
  INDEX `fk_Preguntas_Respuestas1_idx` (`respuesta` ASC)  COMMENT '',
  INDEX `fk_Preguntas_Usuarios1_idx` (`usuario` ASC)  COMMENT '',
  CONSTRAINT `fk_Preguntas_Respuestas1`
    FOREIGN KEY (`respuesta`)
    REFERENCES `escuela`.`Respuestas` (`idRespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Preguntas_Usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Calificaciones` (
  `idCalificacion` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `perido` INT NULL COMMENT '',
  `estudiante` INT NOT NULL COMMENT '',
  `calificacion` INT NULL COMMENT '',
  PRIMARY KEY (`idCalificacion`)  COMMENT '',
  INDEX `fk_Calificaciones_Usuarios1_idx` (`estudiante` ASC)  COMMENT '',
  CONSTRAINT `fk_Calificaciones_Usuarios1`
    FOREIGN KEY (`estudiante`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
