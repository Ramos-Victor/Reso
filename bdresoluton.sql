-- MySQL Script generated by MySQL Workbench
-- Sat Sep 21 17:28:45 2024
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

-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_usuario` (
  `cd_usuario` INT NOT NULL AUTO_INCREMENT,
  `nm_usuario` VARCHAR(50) NOT NULL,
  `nm_email` VARCHAR(100) NOT NULL,
  `cd_senha` VARCHAR(255) NOT NULL,
--  `verificado` CHAR(1) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cd_usuario`),
  UNIQUE INDEX `usuario_email_UNIQUE` (`nm_email` ASC) )
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_conexao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_conexao` (
  `cd_conexao` INT NOT NULL AUTO_INCREMENT,
  `nm_conexao` VARCHAR(100) NOT NULL,
  `dt_conexao` DATETIME NOT NULL DEFAULT current_timestamp,
  `codigo_conexao` VARCHAR(255) NOT NULL UNIQUE,
  `id_criador` INT NOT NULL,
  PRIMARY KEY (`cd_conexao`),
  INDEX `fk_tb_conexao_tb_usuario1_idx` (`id_criador` ASC) ,
  CONSTRAINT `fk_tb_conexao_tb_usuario1`
    FOREIGN KEY (`id_criador`)
    REFERENCES `db_resoluton`.`tb_usuario` (`cd_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_usuario_conexao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_usuario_conexao` (
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  `cargo_usuario` ENUM('criador','admin', 'suporte', 'comum') NOT NULL,
  `dt_entrada` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_usuario`, `id_conexao`),
  INDEX `fk_tb_usuario_has_tb_conexao_tb_conexao1_idx` (`id_conexao` ASC) ,
  INDEX `fk_tb_usuario_has_tb_conexao_tb_usuario1_idx` (`id_usuario` ASC) ,
  CONSTRAINT `fk_tb_usuario_has_tb_conexao_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_resoluton`.`tb_usuario` (`cd_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_has_tb_conexao_tb_conexao1`
    FOREIGN KEY (`id_conexao`)
    REFERENCES `db_resoluton`.`tb_conexao` (`cd_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_sala` (
  `cd_sala` INT NOT NULL AUTO_INCREMENT,
  `nr_sala` VARCHAR(45) NOT NULL,
  `localizacao_sala` VARCHAR(255) NOT NULL,
  `dt_sala` DATETIME NOT NULL DEFAULT current_timestamp,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_sala`),
  UNIQUE INDEX `nr_sala_UNIQUE` (`nr_sala` ASC) ,
  INDEX `fk_tb_sala_tb_usuario_conexao1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_sala_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_equipamento_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_equipamento_categoria` (
  `cd_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria_nm` VARCHAR(100) NOT NULL,
  `dt_categoria` DATETIME NOT NULL DEFAULT current_timestamp,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_categoria`),
  INDEX `fk_tb_equipamento_categoria_tb_usuario_conexao1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_equipamento_categoria_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_equipamento` (
  `cd_equipamento` INT NOT NULL AUTO_INCREMENT,
  `equipamento_nm` VARCHAR(45) NOT NULL,
  `equipamento_ds` LONGTEXT NOT NULL,
  `equipamento_dt` DATETIME NOT NULL DEFAULT current_timestamp,
  `st_equipamento` ENUM('Ativo', 'Manuntenção', 'Desativado') NOT NULL DEFAULT 'Ativo',
  `id_sala` INT NOT NULL,
  `id_categoria` INT NULL,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_equipamento`),
  INDEX `fk_tb_equipamento_tb_sala1_idx` (`id_sala` ASC) ,
  INDEX `fk_tb_equipamento_tb_equipamento_categoria1_idx` (`id_categoria` ASC) ,
  INDEX `fk_tb_equipamento_tb_usuario_conexao1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_equipamento_tb_sala1`
    FOREIGN KEY (`id_sala`)
    REFERENCES `db_resoluton`.`tb_sala` (`cd_sala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_equipamento_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `db_resoluton`.`tb_equipamento_categoria` (`cd_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_chamado` (
  `cd_chamado` INT NOT NULL AUTO_INCREMENT,
  `nm_chamado` VARCHAR(45) NOT NULL,
  `ds_chamado` LONGTEXT NOT NULL,
  `dt_abertura` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_fechamento` DATETIME NULL,
  `st_equipamento` ENUM('Pendente', 'Andamento', 'Concluido') NOT NULL DEFAULT 'Pendente',
  `id_equipamento` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_chamado`),
  INDEX `fk_tb_chamado_tb_equipamento1_idx` (`id_equipamento` ASC) ,
  INDEX `fk_tb_chamado_tb_usuario_conexao1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_chamado_tb_equipamento1`
    FOREIGN KEY (`id_equipamento`)
    REFERENCES `db_resoluton`.`tb_equipamento` (`cd_equipamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_categoria_faq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_categoria_faq` (
  `cd_categoria_faq` INT NOT NULL AUTO_INCREMENT,
  `nm_categoria_faq` VARCHAR(45) NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_categoria_faq`),
  INDEX `fk_tb_categoria_faq_tb_usuario_conexao1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_categoria_faq_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton`.`tb_faq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton`.`tb_faq` (
  `cd_faq` INT NOT NULL AUTO_INCREMENT,
  `nm_pergunta_faq` VARCHAR(45) NOT NULL,
  `ds_resposta_faq` LONGTEXT NOT NULL,
  `dt_cadastro_faq` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categoria_faq` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_faq`),
  INDEX `fk_tb_faq_tb_categoria_faq1_idx` (`id_categoria_faq` ASC) ,
  INDEX `fk_tb_faq_tb_usuario_conexao1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_faq_tb_categoria_faq1`
    FOREIGN KEY (`id_categoria_faq`)
    REFERENCES `db_resoluton`.`tb_categoria_faq` (`cd_categoria_faq`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_faq_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

select * from tb_usuario;

insert into tb_usuario (nm_usuario, nm_email, cd_senha) values
 ('victor','victor@gmail.com',sha2('123',256)),
 ('lais','lais@gmail.com',sha2('123',256) );
 
select * from tb_conexao;
	
select * from tb_usuario_conexao;
        
select cd_conexao, nm_conexao,codigo_conexao, id_usuario, cargo_usuario, id_conexao from tb_conexao
inner join tb_usuario_conexao on id_usuario = 2 where id_conexao = cd_conexao;
        
select cd_usuario, nm_usuario, nm_email, dt_entrada, cargo_usuario from tb_usuario 
inner join tb_usuario_conexao on id_usuario = cd_usuario where id_conexao = 1 and cargo_usuario != "criador";

show tables;

select * from tb_equipamento;

select * from tb_equipamento_categoria;

SELECT cd_usuario, nm_usuario, cd_categoria, categoria_nm, dt_categoria, id_usuario, id_conexao 
                FROM tb_equipamento_categoria 
                INNER JOIN tb_usuario 
                ON id_conexao = 1 and and cd_usuario = id_usuario;
        
