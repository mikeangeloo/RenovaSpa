create schema spa;
use spa;

CREATE TABLE IF NOT EXISTS `spa`.`opiniones` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(60) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `spa`.`agencias` (
  `id` INT NOT NULL COMMENT '',
  `razon_social` VARCHAR(45) NULL COMMENT '',
  `nombre_comercial` VARCHAR(45) NULL COMMENT '',
  `telefono` VARCHAR(45) NULL COMMENT '',
  `correo_electronico` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `spa`.`paises` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(60) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `spa`.`circustancias_medicas` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `spa`.`terapeutas` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(60) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `spa`.`hoteles` (
  `id` INT NOT NULL COMMENT '',
  `nombre` VARCHAR(45) NULL COMMENT '',
  `ubicacion` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `spa`.`tratamientos` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(60) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `spa`.`idiomas` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `spa`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `pais_id` INT NOT NULL COMMENT '',
  `idioma_id` INT NOT NULL COMMENT '',
  `hotel_id` INT NOT NULL COMMENT '',
  `agencia_id` INT NOT NULL COMMENT '',
  `circustancias_medica_id` INT NOT NULL COMMENT '',
  `fecha_alta` DATE NULL COMMENT '',
  `nombre` VARCHAR(60) NULL COMMENT '',
  `apellidos` VARCHAR(255) NULL COMMENT '',
  `edad` INT NULL COMMENT '',
  `correo_electronico` VARCHAR(255) NULL COMMENT '',
  `habitacion` VARCHAR(50) NULL COMMENT '',
  `firma` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`, `pais_id`, `idioma_id`, `hotel_id`, `agencia_id`, `circustancias_medica_id`)  COMMENT '',
  INDEX `fk_clientes_paises1_idx` (`pais_id` ASC)  COMMENT '',
  INDEX `fk_clientes_idiomas1_idx` (`idioma_id` ASC)  COMMENT '',
  INDEX `fk_clientes_hoteles1_idx` (`hotel_id` ASC)  COMMENT '',
  INDEX `fk_clientes_circustancias_medicas1_idx` (`circustancias_medica_id` ASC)  COMMENT '',
  INDEX `fk_clientes_agencias1_idx` (`agencia_id` ASC)  COMMENT '',
  CONSTRAINT `fk_clientes_paises1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `spa`.`paises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_idiomas1`
    FOREIGN KEY (`idioma_id`)
    REFERENCES `spa`.`idiomas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_hoteles1`
    FOREIGN KEY (`hotel_id`)
    REFERENCES `spa`.`hoteles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_circustancias_medicas1`
    FOREIGN KEY (`circustancias_medica_id`)
    REFERENCES `spa`.`circustancias_medicas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_agencias1`
    FOREIGN KEY (`agencia_id`)
    REFERENCES `spa`.`agencias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;





CREATE TABLE IF NOT EXISTS `spa`.`sesiones` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `opinion_id` INT NOT NULL COMMENT '',
  `cliente_id` INT NOT NULL COMMENT '',
  `terapeuta_id` INT NOT NULL COMMENT '',
  `tratamiento_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `opinion_id`, `cliente_id`, `terapeuta_id`, `tratamiento_id`)  COMMENT '',
  INDEX `fk_sesiones_clientes_idx` (`cliente_id` ASC)  COMMENT '',
  INDEX `fk_sesiones_terapeutas1_idx` (`terapeuta_id` ASC)  COMMENT '',
  INDEX `fk_sesiones_tratamientos1_idx` (`tratamiento_id` ASC)  COMMENT '',
  INDEX `fk_sesiones_calificaciones1_idx` (`opinion_id` ASC)  COMMENT '',
  CONSTRAINT `fk_sesiones_clientes`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `spa`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sesiones_terapeutas1`
    FOREIGN KEY (`terapeuta_id`)
    REFERENCES `spa`.`terapeutas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sesiones_tratamientos1`
    FOREIGN KEY (`tratamiento_id`)
    REFERENCES `spa`.`tratamientos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sesiones_calificaciones1`
    FOREIGN KEY (`opinion_id`)
    REFERENCES `spa`.`opiniones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
