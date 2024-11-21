-- MySQL Script generated by MySQL Workbench
-- Tue Oct 29 00:27:07 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_resoluton2
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_resoluton2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_resoluton2` DEFAULT CHARACTER SET utf8 ;
USE `db_resoluton2` ;
-- drop database db_resoluton2;

-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_usuario` (
  `cd_usuario` INT NOT NULL AUTO_INCREMENT,
  `nm_usuario` VARCHAR(50) NOT NULL,
  `nm_email` VARCHAR(100) NOT NULL,
  `cd_senha` VARCHAR(255) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cd_usuario`),
  UNIQUE INDEX `usuario_email_UNIQUE` (`nm_email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_conexao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_conexao` (
  `cd_conexao` INT NOT NULL AUTO_INCREMENT,
  `nm_conexao` VARCHAR(100) NOT NULL,
  `dt_conexao` DATETIME NOT NULL DEFAULT current_timestamp,
  `codigo_conexao` VARCHAR(255) NOT NULL,
  `id_criador` INT NOT NULL,
  PRIMARY KEY (`cd_conexao`),
  INDEX `fk_tb_unidade_tb_usuario1_idx` (`id_criador` ASC) ,
  CONSTRAINT `fk_tb_unidade_tb_usuario1`
    FOREIGN KEY (`id_criador`)
    REFERENCES `db_resoluton2`.`tb_usuario` (`cd_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_usuario_conexao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_usuario_conexao` (
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  `cargo_usuario` ENUM('criador','admin', 'suporte', 'comum') NOT NULL,
  `dt_entrada` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_usuario`, `id_conexao`),
  INDEX `fk_tb_usuario_has_tb_unidade_tb_unidade1_idx` (`id_conexao` ASC) ,
  INDEX `fk_tb_usuario_has_tb_unidade_tb_usuario1_idx` (`id_usuario` ASC) ,
  CONSTRAINT `fk_tb_usuario_has_tb_unidade_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_resoluton2`.`tb_usuario` (`cd_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_usuario_has_tb_unidade_tb_unidade1`
    FOREIGN KEY (`id_conexao`)
    REFERENCES `db_resoluton2`.`tb_conexao` (`cd_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_sala` (
  `cd_sala` INT NOT NULL AUTO_INCREMENT,
  `nm_sala` VARCHAR(45) NOT NULL,
  `ds_sala` VARCHAR(255) NOT NULL,
  `dt_sala` DATETIME NOT NULL DEFAULT current_timestamp,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_sala`),
  INDEX `fk_tb_sala_tb_usuario_unidade1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_sala_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton2`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_equipamento_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_equipamento_categoria` (
  `cd_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria_nm` VARCHAR(100) NOT NULL,
  `dt_categoria` DATETIME NOT NULL DEFAULT current_timestamp,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_categoria`),
  INDEX `fk_tb_equipamento_categoria_tb_usuario_unidade1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_equipamento_categoria_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton2`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_equipamento` (
  `cd_equipamento` INT NOT NULL AUTO_INCREMENT,
  `nm_equipamento` VARCHAR(45) NOT NULL,
  `ds_equipamento` LONGTEXT NOT NULL,
  `dt_equipamento` DATETIME NOT NULL DEFAULT current_timestamp,
  `st_equipamento` ENUM('Ativo', 'Manuntenção', 'Desativado') NOT NULL DEFAULT 'Desativado',
  `id_sala` INT NOT NULL,
  `id_categoria` INT NULL,
  `id_usuario` INT NOT NULL,
  `id_conexao` INT NOT NULL,
  PRIMARY KEY (`cd_equipamento`),
  INDEX `fk_tb_equipamento_tb_sala1_idx` (`id_sala` ASC) ,
  INDEX `fk_tb_equipamento_tb_equipamento_categoria1_idx` (`id_categoria` ASC) ,
  INDEX `fk_tb_equipamento_tb_usuario_unidade1_idx` (`id_usuario` ASC, `id_conexao` ASC) ,
  CONSTRAINT `fk_tb_equipamento_tb_sala1`
    FOREIGN KEY (`id_sala`)
    REFERENCES `db_resoluton2`.`tb_sala` (`cd_sala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_equipamento_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `db_resoluton2`.`tb_equipamento_categoria` (`cd_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipamento_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario` , `id_conexao`)
    REFERENCES `db_resoluton2`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_chamado` (
  `cd_chamado` INT NOT NULL AUTO_INCREMENT,
  `nm_chamado` VARCHAR(45) NOT NULL,
  `ds_chamado` LONGTEXT NOT NULL,
  `ds_recado` LONGTEXT NULL,
  `dt_abertura` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_fechamento` DATETIME NULL,
  `st_chamado`  ENUM('Aberto', 'Andamento', 'Concluido') NOT NULL DEFAULT 'Aberto',
  `nr_avaliacao` CHAR(5) NULL, 
  `id_equipamento` INT NULL,
  `id_usuario_abertura` INT NULL,
  `id_conexao` INT NOT NULL,
  `id_usuario_fechamento` INT NULL,
  PRIMARY KEY (`cd_chamado`),
  INDEX `fk_tb_chamado_tb_equipamento1_idx` (`id_equipamento` ASC) ,
  INDEX `fk_tb_chamado_tb_usuario_unidade1_idx` (`id_usuario_abertura` ASC, `id_conexao` ASC) ,
  INDEX `fk_tb_chamado_tb_usuario_conexao1_idx` (`id_usuario_fechamento` ASC) ,
  CONSTRAINT `fk_tb_chamado_tb_equipamento1`
    FOREIGN KEY (`id_equipamento`)
    REFERENCES `db_resoluton2`.`tb_equipamento` (`cd_equipamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_usuario_unidade1`
    FOREIGN KEY (`id_usuario_abertura` , `id_conexao`)
    REFERENCES `db_resoluton2`.`tb_usuario_conexao` (`id_usuario` , `id_conexao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_chamado_tb_usuario_conexao1`
    FOREIGN KEY (`id_usuario_fechamento`)
    REFERENCES `db_resoluton2`.`tb_usuario_conexao` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_categoria_faq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_categoria_faq` (
  `cd_categoria_faq` INT NOT NULL AUTO_INCREMENT,
  `nm_categoria_faq` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cd_categoria_faq`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_resoluton2`.`tb_faq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_resoluton2`.`tb_faq` (
  `cd_faq` INT NOT NULL AUTO_INCREMENT,
  `nm_pergunta_faq` VARCHAR(45) NOT NULL,
  `ds_resposta_faq` LONGTEXT NOT NULL,
  `dt_cadastro_faq` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categoria_faq` INT NOT NULL,
  PRIMARY KEY (`cd_faq`),
  INDEX `fk_tb_faq_tb_categoria_faq1_idx` (`id_categoria_faq` ASC) ,
  CONSTRAINT `fk_tb_faq_tb_categoria_faq1`
    FOREIGN KEY (`id_categoria_faq`)
    REFERENCES `db_resoluton2`.`tb_categoria_faq` (`cd_categoria_faq`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS tb_chat(
	cd_mensagem INT PRIMARY KEY AUTO_INCREMENT,
    id_chamado INT NOT NULL,
    id_usuario_remetente INT NOT NULL,
    mensagem TEXT NOT NULL,
    dt_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_chamado) REFERENCES tb_chamado(cd_chamado),
     FOREIGN KEY (id_usuario_remetente) REFERENCES tb_usuario_conexao(id_usuario)
)ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

insert into tb_usuario (nm_usuario, nm_email, cd_senha) values
 ('victor','victor@gmail.com',sha2('123',256)),
 ('lais','lais@gmail.com',sha2('123',256) ),
 ('marcio','marcio@gmail.com',sha2('123',256) ),
('ana', 'ana@gmail.com', SHA2('123', 256)),
('joao', 'joao@gmail.com', SHA2('123', 256)),
('carla', 'carla@gmail.com', SHA2('123', 256)),
('pedro', 'pedro@gmail.com', SHA2('123', 256)),
('juliana', 'juliana@gmail.com', SHA2('123', 256)),
('bruno', 'bruno@gmail.com', SHA2('123', 256)),
('maria', 'maria@gmail.com', SHA2('123', 256)),
('henrique', 'henrique@gmail.com', SHA2('123', 256)),
('lucas', 'lucas@gmail.com', SHA2('123', 256)),
('camila', 'camila@gmail.com', SHA2('123', 256)),
('fernanda', 'fernanda@gmail.com', SHA2('123', 256)),
('rafael', 'rafael@gmail.com', SHA2('123', 256)),
('leticia', 'leticia@gmail.com', SHA2('123', 256)),
('renato', 'renato@gmail.com', SHA2('123', 256)),
('aline', 'aline@gmail.com', SHA2('123', 256)),
('gustavo', 'gustavo@gmail.com', SHA2('123', 256)),
('bianca', 'bianca@gmail.com', SHA2('123', 256)),
('andre', 'andre@gmail.com', SHA2('123', 256)),
('sophia', 'sophia@gmail.com', SHA2('123', 256)),
('diego', 'diego@gmail.com', SHA2('123', 256));

 
 INSERT INTO `db_resoluton2`.`tb_conexao` (nm_conexao, codigo_conexao, id_criador) VALUES 
('Conexão 1', 'Codigo_Conexao_1', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'));

INSERT INTO `db_resoluton2`.`tb_usuario_conexao` (id_usuario, id_conexao, cargo_usuario) VALUES
((SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1, 'criador'),
((SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='lais'),1, 'suporte'),
((SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='marcio'), 1, 'comum');

INSERT INTO tb_usuario_conexao (id_usuario, id_conexao, cargo_usuario) VALUES
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='ana'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='joao'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='carla'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='pedro'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='juliana'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='bruno'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='maria'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='henrique'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='lucas'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='camila'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='fernanda'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='rafael'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='leticia'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='renato'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='aline'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='gustavo'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='bianca'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='andre'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='sophia'), 1, 'comum'),
((SELECT cd_usuario FROM tb_usuario WHERE nm_usuario='diego'), 1, 'comum');


INSERT INTO `db_resoluton2`.`tb_sala` (nm_sala, ds_sala, id_usuario, id_conexao) VALUES 
('ESTOQUE', 'Sala de Estoque', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1);

INSERT INTO `db_resoluton2`.`tb_equipamento_categoria` (categoria_nm, id_usuario, id_conexao) VALUES 
('NOTEBOOK', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1),
('TECLADO', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1),
('MOUSE', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1);

INSERT INTO `db_resoluton2`.`tb_sala` (nm_sala, ds_sala, id_usuario, id_conexao) VALUES 
('lAB01', 'Laboratório 01', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1),
('lAB02', 'Laboratório 02', (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1);

INSERT INTO `db_resoluton2`.`tb_equipamento` (nm_equipamento, ds_equipamento, id_categoria, id_sala, id_usuario, id_conexao,st_equipamento) VALUES 
('NOTE01', 'Notebook da marca X', (SELECT cd_categoria FROM db_resoluton2.tb_equipamento_categoria WHERE categoria_nm='Notebook'), (SELECT cd_sala FROM db_resoluton2.tb_sala WHERE nm_sala='lab01'), (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'),1, 'Ativo'),
('TECLADO01', 'Teclado mecânico', (SELECT cd_categoria FROM db_resoluton2.tb_equipamento_categoria WHERE categoria_nm='Teclado'), (SELECT cd_sala FROM db_resoluton2.tb_sala WHERE nm_sala='lab01'), (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1, 'Ativo'),
('MOUSE01', 'Mouse óptico', (SELECT cd_categoria FROM db_resoluton2.tb_equipamento_categoria WHERE categoria_nm='Mouse'), (SELECT cd_sala FROM db_resoluton2.tb_sala WHERE nm_sala='lab01'), (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='victor'), 1, 'Ativo');

INSERT INTO `db_resoluton2`.`tb_chamado` (nm_chamado, ds_chamado, id_equipamento, id_usuario_abertura, id_conexao, ds_recado) VALUES 
('Problema no notebook', 'Relato de que o notebook não liga', (SELECT cd_equipamento FROM db_resoluton2.tb_equipamento WHERE nm_equipamento='note01'), (SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='marcio'), 1,'Está ligando novamente.');

UPDATE `db_resoluton2`.`tb_chamado` 
SET st_chamado='Concluido', dt_fechamento=CURRENT_TIMESTAMP, id_usuario_fechamento=(SELECT cd_usuario FROM db_resoluton2.tb_usuario WHERE nm_usuario='lais')
WHERE cd_chamado = 1;

select * from tb_equipamento;

select * from tb_chamado;

select * from tb_usuario;

select * from tb_chat;
