-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema BD_SIBCATIE
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BD_SIBCATIE
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BD_SIBCATIE` DEFAULT CHARACTER SET utf8 ;
USE `BD_SIBCATIE` ;

-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Forma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Forma` (
  `idForma` INT NOT NULL AUTO_INCREMENT,
  `nombre_forma` VARCHAR(45) NOT NULL,
  `caracteristicas` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idForma`),
  UNIQUE INDEX `idForma_UNIQUE` (`idForma` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`EstadoSalud`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`EstadoSalud` (
  `idEstadoSalud` INT NOT NULL AUTO_INCREMENT,
  `nombre_estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEstadoSalud`),
  UNIQUE INDEX `idEstadoSalud_UNIQUE` (`idEstadoSalud` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Color`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Color` (
  `idColor` INT NOT NULL AUTO_INCREMENT,
  `nombre_color` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idColor`),
  UNIQUE INDEX `idColor_UNIQUE` (`idColor` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`TipoHoja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`TipoHoja` (
  `idTipoHoja` INT NOT NULL AUTO_INCREMENT,
  `nombre_hoja` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoHoja`),
  UNIQUE INDEX `idTipoHoja_UNIQUE` (`idTipoHoja` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`ZonaCardinal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`ZonaCardinal` (
  `idZonaCardinal` INT NOT NULL AUTO_INCREMENT,
  `nombre_cardinal` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idZonaCardinal`),
  UNIQUE INDEX `idZonaCardinal_UNIQUE` (`idZonaCardinal` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Continente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Continente` (
  `idContinente` INT NOT NULL AUTO_INCREMENT,
  `nombre_continente` VARCHAR(45) NOT NULL,
  `ZonaCardinal_idZonaCardinal` INT NOT NULL,
  PRIMARY KEY (`idContinente`),
  INDEX `fk_Continente_ZonaCardinal1_idx` (`ZonaCardinal_idZonaCardinal` ASC),
  UNIQUE INDEX `idContinente_UNIQUE` (`idContinente` ASC),
  CONSTRAINT `fk_Continente_ZonaCardinal1`
    FOREIGN KEY (`ZonaCardinal_idZonaCardinal`)
    REFERENCES `BD_SIBCATIE`.`ZonaCardinal` (`idZonaCardinal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Familia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Familia` (
  `idFamilia` INT NOT NULL AUTO_INCREMENT,
  `nombre_familia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFamilia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`DeterminadaPor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`DeterminadaPor` (
  `idDeterminadaPor` INT NOT NULL AUTO_INCREMENT,
  `nombre_determinada` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idDeterminadaPor`),
  UNIQUE INDEX `idDeterminadaPor_UNIQUE` (`idDeterminadaPor` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Genero` (
  `idGenero` INT NOT NULL AUTO_INCREMENT,
  `nombre_genero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idGenero`),
  UNIQUE INDEX `idGenero_UNIQUE` (`idGenero` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Epiteto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Epiteto` (
  `idEpiteto` INT NOT NULL AUTO_INCREMENT,
  `nombre_epiteto` VARCHAR(45) NOT NULL,
  `referencia` VARCHAR(45) NULL,
  PRIMARY KEY (`idEpiteto`),
  UNIQUE INDEX `idEpiteto_UNIQUE` (`idEpiteto` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Planta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Planta` (
  `idPlanta` INT NOT NULL AUTO_INCREMENT,
  `fecha_ingreso` DATE NOT NULL,
  `fuente_informacion` VARCHAR(45) NULL,
  `autor` VARCHAR(45) NULL,
  `altura` DECIMAL NOT NULL,
  `reproduccion` TINYINT NULL,
  `visible` TINYINT NOT NULL,
  `Forma_idForma` INT NOT NULL,
  `EstadoSalud_idEstadoSalud` INT NULL,
  `Color_idColor` INT NOT NULL,
  `TipoHoja_idTipoHoja` INT NOT NULL,
  `Continente_idContinente` INT NOT NULL,
  `ZonaCardinal_idZonaCardinal` INT NOT NULL,
  `Familia_idFamilia` INT NULL,
  `DeterminadaPor_idDeterminadaPor` INT NULL,
  `Genero_idGenero` INT NULL,
  `Epiteto_idEpiteto` INT NULL,
  PRIMARY KEY (`idPlanta`),
  INDEX `fk_Planta_Forma1_idx` (`Forma_idForma` ASC),
  INDEX `fk_Planta_EstadoSalud1_idx` (`EstadoSalud_idEstadoSalud` ASC),
  INDEX `fk_Planta_Color1_idx` (`Color_idColor` ASC),
  INDEX `fk_Planta_TipoHoja1_idx` (`TipoHoja_idTipoHoja` ASC),
  INDEX `fk_Planta_Continente1_idx` (`Continente_idContinente` ASC),
  INDEX `fk_Planta_ZonaCardinal1_idx` (`ZonaCardinal_idZonaCardinal` ASC),
  INDEX `fk_Planta_Familia1_idx` (`Familia_idFamilia` ASC),
  INDEX `fk_Planta_DeterminadaPor1_idx` (`DeterminadaPor_idDeterminadaPor` ASC),
  INDEX `fk_Planta_Genero1_idx` (`Genero_idGenero` ASC),
  INDEX `fk_Planta_Epiteto1_idx` (`Epiteto_idEpiteto` ASC),
  UNIQUE INDEX `idPlanta_UNIQUE` (`idPlanta` ASC),
  CONSTRAINT `fk_Planta_Forma1`
    FOREIGN KEY (`Forma_idForma`)
    REFERENCES `BD_SIBCATIE`.`Forma` (`idForma`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_EstadoSalud1`
    FOREIGN KEY (`EstadoSalud_idEstadoSalud`)
    REFERENCES `BD_SIBCATIE`.`EstadoSalud` (`idEstadoSalud`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_Color1`
    FOREIGN KEY (`Color_idColor`)
    REFERENCES `BD_SIBCATIE`.`Color` (`idColor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_TipoHoja1`
    FOREIGN KEY (`TipoHoja_idTipoHoja`)
    REFERENCES `BD_SIBCATIE`.`TipoHoja` (`idTipoHoja`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_Continente1`
    FOREIGN KEY (`Continente_idContinente`)
    REFERENCES `BD_SIBCATIE`.`Continente` (`idContinente`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_ZonaCardinal1`
    FOREIGN KEY (`ZonaCardinal_idZonaCardinal`)
    REFERENCES `BD_SIBCATIE`.`ZonaCardinal` (`idZonaCardinal`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_Familia1`
    FOREIGN KEY (`Familia_idFamilia`)
    REFERENCES `BD_SIBCATIE`.`Familia` (`idFamilia`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_DeterminadaPor1`
    FOREIGN KEY (`DeterminadaPor_idDeterminadaPor`)
    REFERENCES `BD_SIBCATIE`.`DeterminadaPor` (`idDeterminadaPor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_Genero1`
    FOREIGN KEY (`Genero_idGenero`)
    REFERENCES `BD_SIBCATIE`.`Genero` (`idGenero`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_Epiteto1`
    FOREIGN KEY (`Epiteto_idEpiteto`)
    REFERENCES `BD_SIBCATIE`.`Epiteto` (`idEpiteto`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Uso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Uso` (
  `idUso` INT NOT NULL AUTO_INCREMENT,
  `nombre_uso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUso`),
  UNIQUE INDEX `idUso_UNIQUE` (`idUso` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`NombreComun`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`NombreComun` (
  `idNombreComun` INT NOT NULL AUTO_INCREMENT,
  `nombre_comun` VARCHAR(45) NOT NULL,
  `lengua` VARCHAR(45) NULL,
  `Planta_idPlanta` INT NOT NULL,
  PRIMARY KEY (`idNombreComun`),
  INDEX `fk_NombreComun_Planta1_idx` (`Planta_idPlanta` ASC),
  UNIQUE INDEX `idNombreComun_UNIQUE` (`idNombreComun` ASC),
  CONSTRAINT `fk_NombreComun_Planta1`
    FOREIGN KEY (`Planta_idPlanta`)
    REFERENCES `BD_SIBCATIE`.`Planta` (`idPlanta`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Foto` (
  `idFoto` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `latitud` DECIMAL NULL,
  `longitud` DECIMAL NULL,
  `Planta_idPlanta` INT NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idFoto`),
  INDEX `fk_Foto_Planta_idx` (`Planta_idPlanta` ASC),
  UNIQUE INDEX `idFoto_UNIQUE` (`idFoto` ASC),
  CONSTRAINT `fk_Foto_Planta`
    FOREIGN KEY (`Planta_idPlanta`)
    REFERENCES `BD_SIBCATIE`.`Planta` (`idPlanta`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Planta_has_Uso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Planta_has_Uso` (
  `Planta_idPlanta` INT NOT NULL AUTO_INCREMENT,
  `Uso_idUso` INT NOT NULL,
  PRIMARY KEY (`Planta_idPlanta`, `Uso_idUso`),
  INDEX `fk_Planta_has_Uso_Planta1_idx` (`Planta_idPlanta` ASC),
  INDEX `fk_Planta_has_Uso_Uso1_idx` (`Uso_idUso` ASC),
  UNIQUE INDEX `Planta_idPlanta_UNIQUE` (`Planta_idPlanta` ASC),
  CONSTRAINT `fk_Planta_has_Uso_Planta1`
    FOREIGN KEY (`Planta_idPlanta`)
    REFERENCES `BD_SIBCATIE`.`Planta` (`idPlanta`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Planta_has_Uso_Uso1`
    FOREIGN KEY (`Uso_idUso`)
    REFERENCES `BD_SIBCATIE`.`Uso` (`idUso`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fecha_registro` DATETIME NOT NULL,
  `activo` TINYINT NOT NULL,
  `rol` TINYINT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Historial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Historial` (
  `idActividad` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `accion` VARCHAR(45) NOT NULL,
  `Planta_idPlanta` INT NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idActividad`),
  INDEX `fk_Historial_Planta1_idx` (`Planta_idPlanta` ASC),
  INDEX `fk_Historial_Usuario1_idx` (`Usuario_idUsuario` ASC),
  UNIQUE INDEX `idActividad_UNIQUE` (`idActividad` ASC),
  CONSTRAINT `fk_Historial_Planta1`
    FOREIGN KEY (`Planta_idPlanta`)
    REFERENCES `BD_SIBCATIE`.`Planta` (`idPlanta`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Historial_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `BD_SIBCATIE`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Consulta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Consulta` (
  `idConsulta` INT NOT NULL AUTO_INCREMENT,
  `consulta` TEXT CHARACTER SET utf8 NULL,
  `fecha_consulta` DATETIME NOT NULL,
  `url_foto` VARCHAR(255) NOT NULL,
  `latitud` DECIMAL NULL,
  `longitud` DECIMAL NULL,
  `Visitante_idVisitante` INT NOT NULL,
  PRIMARY KEY (`idConsulta`),
  INDEX `fk_Consulta_Visitante1_idx` (`Visitante_idVisitante` ASC),
  UNIQUE INDEX `idConsulta_UNIQUE` (`idConsulta` ASC),
  CONSTRAINT `fk_Consulta_Visitante1`
    FOREIGN KEY (`Visitante_idVisitante`)
    REFERENCES `BD_SIBCATIE`.`Visitante` (`idVisitante`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Exportar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Exportar` (
  `Planta_idPlanta` INT NOT NULL AUTO_INCREMENT,
  `Visitante_idVisitante` INT NOT NULL,
  PRIMARY KEY (`Planta_idPlanta`, `Visitante_idVisitante`),
  INDEX `fk_Exportar_Planta1_idx` (`Planta_idPlanta` ASC),
  INDEX `fk_Exportar_Visitante1_idx` (`Visitante_idVisitante` ASC),
  UNIQUE INDEX `Planta_idPlanta_UNIQUE` (`Planta_idPlanta` ASC),
  CONSTRAINT `fk_Exportar_Planta1`
    FOREIGN KEY (`Planta_idPlanta`)
    REFERENCES `BD_SIBCATIE`.`Planta` (`idPlanta`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Exportar_Visitante1`
    FOREIGN KEY (`Visitante_idVisitante`)
    REFERENCES `BD_SIBCATIE`.`Visitante` (`idVisitante`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_SIBCATIE`.`Favorito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_SIBCATIE`.`Favorito` (
  `idFavorito` INT NOT NULL AUTO_INCREMENT,
  `Planta_idPlanta` INT NOT NULL,
  `Visitante_idVisitante` INT NOT NULL,
  PRIMARY KEY (`idFavorito`),
  INDEX `fk_Favorito_Planta1_idx` (`Planta_idPlanta` ASC),
  INDEX `fk_Favorito_Visitante1_idx` (`Visitante_idVisitante` ASC),
  UNIQUE INDEX `idFavorito_UNIQUE` (`idFavorito` ASC),
  CONSTRAINT `fk_Favorito_Planta1`
    FOREIGN KEY (`Planta_idPlanta`)
    REFERENCES `BD_SIBCATIE`.`Planta` (`idPlanta`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Favorito_Visitante1`
    FOREIGN KEY (`Visitante_idVisitante`)
    REFERENCES `BD_SIBCATIE`.`Visitante` (`idVisitante`)     
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
