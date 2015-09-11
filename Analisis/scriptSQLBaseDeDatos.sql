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
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `tipo` ENUM('Docente', 'Estudiante') NULL,
  `nombres` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  `documento` VARCHAR(45) NULL,
  `sexo` ENUM('Femenino', 'Masculino') NULL,
  `estado` ENUM('Eliminado', 'Activo') NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Temas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Temas` (
  `idTema` INT NOT NULL AUTO_INCREMENT,
  `periodo` INT NULL,
  `titulo` VARCHAR(45) NULL,
  `contenido` VARCHAR(45) NULL,
  `usuario` INT NOT NULL,
  `estado` ENUM('Eliminado', 'Activo') NULL,
  PRIMARY KEY (`idTema`),
  INDEX `fk_Temas_Usuarios_idx` (`usuario` ASC),
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
  `idArchivo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `tema` INT NOT NULL,
  `extencion` VARCHAR(45) NULL,
  PRIMARY KEY (`idArchivo`),
  INDEX `fk_Archivos_Temas1_idx` (`tema` ASC),
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
  `idMensaje` INT NOT NULL AUTO_INCREMENT,
  `emisor` INT NOT NULL,
  `reseptor` INT NOT NULL,
  `fecha` TIMESTAMP NULL default current_timestamp,
  `estado` ENUM('Eliminado', 'Activo') NULL,
  `contenido` TEXT NULL,
  PRIMARY KEY (`idMensaje`),
  INDEX `fk_Mensajes_Usuarios1_idx` (`emisor` ASC),
  INDEX `fk_Mensajes_Usuarios2_idx` (`reseptor` ASC),
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
-- Table `escuela`.`Preguntas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Preguntas` (
  `idPregunta` INT NOT NULL AUTO_INCREMENT,
  `periodo` INT NULL,
  `descripcion` VARCHAR(45) NULL,
  `usuario` INT NOT NULL,
  PRIMARY KEY (`idPregunta`),
  INDEX `fk_Preguntas_Usuarios1_idx` (`usuario` ASC),
  CONSTRAINT `fk_Preguntas_Usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Respuestas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Respuestas` (
  `idRespuesta` INT NOT NULL AUTO_INCREMENT,
  `respuesta` VARCHAR(45) NULL,
  `pregunta` INT NOT NULL,
  `estado` ENUM('correcta', 'incorrecta') NULL,
  PRIMARY KEY (`idRespuesta`),
  INDEX `fk_Respuestas_Preguntas1_idx` (`pregunta` ASC),
  CONSTRAINT `fk_Respuestas_Preguntas1`
    FOREIGN KEY (`pregunta`)
    REFERENCES `escuela`.`Preguntas` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escuela`.`Calificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escuela`.`Calificaciones` (
  `idCalificacion` INT NOT NULL AUTO_INCREMENT,
  `perido` INT NULL,
  `estudiante` INT NOT NULL,
  `calificacion` INT NULL,
  PRIMARY KEY (`idCalificacion`),
  INDEX `fk_Calificaciones_Usuarios1_idx` (`estudiante` ASC),
  CONSTRAINT `fk_Calificaciones_Usuarios1`
    FOREIGN KEY (`estudiante`)
    REFERENCES `escuela`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
