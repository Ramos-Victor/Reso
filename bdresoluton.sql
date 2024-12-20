-- MySQL Script generated by MySQL Workbench
-- Sun Nov 24 15:59:34 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_resoluton
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_resoluton
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_resoluton` DEFAULT CHARACTER SET utf8 ;
USE `db_resoluton` ;
-- drop database db_resoluton;

-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_cargo_reso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_cargo_reso` (
  `cd_cargo_reso` INT NOT NULL AUTO_INCREMENT,
  `nm_cargo_reso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cd_cargo_reso`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_usuario` (
  `cd_usuario` VARCHAR(10) NOT NULL,
  `nm_usuario` VARCHAR(50) NOT NULL,
  `nm_email` VARCHAR(50) NOT NULL,
  `cd_senha` VARCHAR(255) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `verificado` CHAR(1) NOT NULL DEFAULT '0',
  `dt_exclusao` DATETIME NULL,
  `nr_telefone` VARCHAR(45) NULL,
  `id_cargo_reso` INT NOT NULL DEFAULT 1,
  `url_imagem_perfil` VARCHAR(150) NULL,
  PRIMARY KEY (`cd_usuario`),
  UNIQUE INDEX `nm_usuario_UNIQUE` (`nm_usuario` ASC) ,
  UNIQUE INDEX `nm_email_UNIQUE` (`nm_email` ASC) ,
  INDEX `fk_tb_usuario_tb_cargo_reso1_idx` (`id_cargo_reso` ASC) ,
  CONSTRAINT `fk_tb_usuario_tb_cargo_reso1`
    FOREIGN KEY (`id_cargo_reso`)
    REFERENCES `db_resoluton`.`tb_cargo_reso` (`cd_cargo_reso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

create table tb_recuperacao_senha(
	email varchar(50) NOT NULL,
    token varchar(64) NOT NULL,
    dt_expiracao DATETIME NOT NULL,
    primary key (email),
    unique key token_unique (token)
)ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_unidade` (
  `cd_unidade` INT NOT NULL AUTO_INCREMENT,
  `nm_unidade` VARCHAR(50) NOT NULL,
  `codigo_unidade` VARCHAR(255) NOT NULL,
  `dt_unidade` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `dt_exclusao` DATETIME NULL,
  PRIMARY KEY (`cd_unidade`),
  UNIQUE INDEX `codigo_unidade_UNIQUE` (`codigo_unidade` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_cargo_unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_cargo_unidade` (
  `cd_cargo` INT NOT NULL AUTO_INCREMENT,
  `nm_cargo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cd_cargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_usuario_unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_usuario_unidade` (
  `id_usuario` VARCHAR(10) NOT NULL,
  `id_unidade` INT NOT NULL,
  `dt_entrada` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cargo` INT NOT NULL,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `dt_exclusao` DATETIME NULL,
  PRIMARY KEY (`id_usuario`, `id_unidade`),
  INDEX `fk_tb_usuario_has_tb_unidade_tb_unidade1_idx` (`id_unidade` ASC) ,
  INDEX `fk_tb_usuario_has_tb_unidade_tb_usuario_idx` (`id_usuario` ASC) ,
  INDEX `fk_tb_usuario_unidade_tb_cargo_unidade1_idx` (`id_cargo` ASC) ,
  CONSTRAINT `fk_tb_usuario_has_tb_unidade_tb_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_resoluton`.`tb_usuario` (`cd_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_has_tb_unidade_tb_unidade1`
    FOREIGN KEY (`id_unidade`)
    REFERENCES `db_resoluton`.`tb_unidade` (`cd_unidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_unidade_tb_cargo_unidade1`
    FOREIGN KEY (`id_cargo`)
    REFERENCES `db_resoluton`.`tb_cargo_unidade` (`cd_cargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_st_sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_st_sala` (
  `cd_sala` INT NOT NULL AUTO_INCREMENT,
  `nm_status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cd_sala`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_sala` (
  `cd_sala` INT NOT NULL AUTO_INCREMENT,
  `nm_sala` VARCHAR(45) NOT NULL,
  `ds_sala` VARCHAR(255) NOT NULL,
  `dt_sala` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` VARCHAR(10) NOT NULL,
  `id_unidade` INT NOT NULL,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `dt_exclusao` DATETIME NULL,
  `st_sala` INT NOT NULL,
  PRIMARY KEY (`cd_sala`),
  INDEX `fk_tb_sala_tb_usuario_unidade1_idx` (`id_usuario` ASC, `id_unidade` ASC) ,
  INDEX `fk_tb_sala_tb_st_sala1_idx` (`st_sala` ASC) ,
  CONSTRAINT `fk_tb_sala_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario` , `id_unidade`)
    REFERENCES `db_resoluton`.`tb_usuario_unidade` (`id_usuario` , `id_unidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_sala_tb_st_sala1`
    FOREIGN KEY (`st_sala`)
    REFERENCES `db_resoluton`.`tb_st_sala` (`cd_sala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_equipamento_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_equipamento_categoria` (
  `cd_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria_nm` VARCHAR(45) NOT NULL,
  `dt_categoria` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` VARCHAR(10) NOT NULL,
  `id_unidade` INT NOT NULL,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `dt_exclusao` DATETIME NULL,
  PRIMARY KEY (`cd_categoria`),
  INDEX `fk_tb_equipamento_categoria_tb_usuario_unidade1_idx` (`id_usuario` ASC, `id_unidade` ASC) ,
  CONSTRAINT `fk_tb_equipamento_categoria_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario` , `id_unidade`)
    REFERENCES `db_resoluton`.`tb_usuario_unidade` (`id_usuario` , `id_unidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_st_equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_st_equipamento` (
  `cd_st_equipamento` INT NOT NULL AUTO_INCREMENT,
  `nm_status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cd_st_equipamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_equipamento` (
  `cd_equipamento` INT NOT NULL AUTO_INCREMENT,
  `nm_equipamento` VARCHAR(45) NOT NULL,
  `ds_equipamento` LONGTEXT NOT NULL,
  `dt_equipamento` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st_equipamento` INT NOT NULL,
  `id_categoria` INT,
  `id_usuario` VARCHAR(10) NOT NULL,
  `id_unidade` INT NOT NULL,
  `id_sala` INT NOT NULL,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `dt_exclusao` DATETIME NULL,
  PRIMARY KEY (`cd_equipamento`),
  INDEX `fk_tb_equipamento_tb_st_equipamento1_idx` (`st_equipamento` ASC) ,
  INDEX `fk_tb_equipamento_tb_equipamento_categoria1_idx` (`id_categoria` ASC) ,
  INDEX `fk_tb_equipamento_tb_usuario_unidade1_idx` (`id_usuario` ASC, `id_unidade` ASC) ,
  INDEX `fk_tb_equipamento_tb_sala1_idx` (`id_sala` ASC) ,
  CONSTRAINT `fk_tb_equipamento_tb_st_equipamento1`
    FOREIGN KEY (`st_equipamento`)
    REFERENCES `db_resoluton`.`tb_st_equipamento` (`cd_st_equipamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_equipamento_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `db_resoluton`.`tb_equipamento_categoria` (`cd_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario` , `id_unidade`)
    REFERENCES `db_resoluton`.`tb_usuario_unidade` (`id_usuario` , `id_unidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_sala1`
    FOREIGN KEY (`id_sala`)
    REFERENCES `db_resoluton`.`tb_sala` (`cd_sala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_st_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_st_chamado` (
  `cd_st_chamado` INT NOT NULL AUTO_INCREMENT,
  `nm_status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cd_st_chamado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_chamado` (
  `cd_chamado` INT NOT NULL AUTO_INCREMENT,
  `nm_chamado` VARCHAR(45) NOT NULL,
  `ds_chamado` LONGTEXT NOT NULL,
  `ds_recado` LONGTEXT NULL,
  `dt_abertura` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_fechamento` DATETIME NULL,
  `nr_avaliacao` CHAR(5) NULL,
  `st_chamado` INT NOT NULL,
  `id_usuario_abertura` VARCHAR(10) NOT NULL,
  `id_unidade` INT NOT NULL,
  `id_usuario_fechamento` VARCHAR(10) NULL,
  `id_equipamento` INT,
  `st_ativo` TINYINT NOT NULL DEFAULT 1,
  `dt_exclusao` DATETIME NULL,
  PRIMARY KEY (`cd_chamado`),
  INDEX `fk_tb_chamado_tb_st_chamado1_idx` (`st_chamado` ASC) ,
  INDEX `fk_tb_chamado_tb_usuario_unidade1_idx` (`id_usuario_abertura` ASC, `id_unidade` ASC) ,
  INDEX `fk_tb_chamado_tb_usuario_unidade2_idx` (`id_usuario_fechamento` ASC) ,
  INDEX `fk_tb_chamado_tb_equipamento1_idx` (`id_equipamento` ASC) ,
  CONSTRAINT `fk_tb_chamado_tb_st_chamado1`
    FOREIGN KEY (`st_chamado`)
    REFERENCES `db_resoluton`.`tb_st_chamado` (`cd_st_chamado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario_abertura` , `id_unidade`)
    REFERENCES `db_resoluton`.`tb_usuario_unidade` (`id_usuario` , `id_unidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_usuario_unidade2`
    FOREIGN KEY (`id_usuario_fechamento`)
    REFERENCES `db_resoluton`.`tb_usuario_unidade` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_equipamento1`
    FOREIGN KEY (`id_equipamento`)
    REFERENCES `db_resoluton`.`tb_equipamento` (`cd_equipamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_chat` (
  `cd_mensagem` INT NOT NULL AUTO_INCREMENT,
  `mensagem` LONGTEXT NOT NULL,
  `dt_envio` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_chamado` INT NOT NULL,
  `id_usuario` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`cd_mensagem`),
  INDEX `fk_tb_chat_tb_chamado1_idx` (`id_chamado` ASC) ,
  INDEX `fk_tb_chat_tb_usuario_unidade1_idx` (`id_usuario` ASC) ,
  CONSTRAINT `fk_tb_chat_tb_chamado1`
    FOREIGN KEY (`id_chamado`)
    REFERENCES `db_resoluton`.`tb_chamado` (`cd_chamado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chat_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_resoluton`.`tb_usuario_unidade` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

insert into tb_cargo_reso (nm_cargo_reso) values 
('comum'),
('admin');

insert into tb_cargo_unidade (nm_cargo) VALUES
('criador'),
('admin'),
('suporte'),
('comum');

insert into tb_st_equipamento (nm_status) VALUES 
("Ativo"),
("Manuntenção"),
("Desativado");

insert into tb_st_sala (nm_status) values 
("Ativo"),
("Desativado");

insert into tb_st_chamado (nm_status) values
("Aberto"),
("Andamento"),
("Concluido");

select * from tb_sala;
