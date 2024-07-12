-- MySQL Script generated by MySQL Workbench
-- Thu Jul 11 18:12:34 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bancoveiculos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bancoveiculos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bancoveiculos` DEFAULT CHARACTER SET utf8 ;
USE `bancoveiculos` ;

-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_pagamento` (
  `idtb_pagamento` INT NOT NULL AUTO_INCREMENT,
  `tipo_pagamento` VARCHAR(45) NOT NULL,
  `preco_pagamento` VARCHAR(45) NOT NULL,
  `km_final` VARCHAR(45) NOT NULL,
  `valor_valorkm` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtb_pagamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_funcionario` (
  `idtb_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome_funcionario` VARCHAR(45) NOT NULL,
  `cpf_funcionario` VARCHAR(45) NOT NULL,
  `telefone_funcionario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtb_funcionario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_aluguel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_aluguel` (
  `idtb_aluguel` INT NOT NULL AUTO_INCREMENT,
  `data_inicial` DATE NOT NULL,
  `tb_pagamento_idtb_pagamento` INT NOT NULL,
  `tb_funcionario_idtb_funcionario` INT NOT NULL,
  PRIMARY KEY (`idtb_aluguel`),
  INDEX `fk_tb_aluguel_tb_pagamento1_idx` (`tb_pagamento_idtb_pagamento` ASC) VISIBLE,
  INDEX `fk_tb_aluguel_tb_funcionario1_idx` (`tb_funcionario_idtb_funcionario` ASC) VISIBLE,
  CONSTRAINT `fk_tb_aluguel_tb_pagamento1`
    FOREIGN KEY (`tb_pagamento_idtb_pagamento`)
    REFERENCES `bancoveiculos`.`tb_pagamento` (`idtb_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_aluguel_tb_funcionario1`
    FOREIGN KEY (`tb_funcionario_idtb_funcionario`)
    REFERENCES `bancoveiculos`.`tb_funcionario` (`idtb_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_veiculo` (
  `idtb_veiculo` INT NOT NULL AUTO_INCREMENT,
  `marca_veiculo` VARCHAR(45) NOT NULL,
  `placa_veiculo` VARCHAR(45) NOT NULL,
  `modelo_veiculo` VARCHAR(45) NOT NULL,
  `numero_chaci_veiculo` VARCHAR(45) NOT NULL,
  `tipo_veiculo` VARCHAR(45) NOT NULL,
  `cor_veiculo` VARCHAR(45) NOT NULL,
  `capacidade_veiculo` VARCHAR(45) NOT NULL,
  `porta_mala_veiculo` VARCHAR(45) NOT NULL,
  `alugado_veiculo` CHAR(1) NOT NULL,
  `km_inicial_veiculo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtb_veiculo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_pessoas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_pessoas` (
  `idpessoas` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpessoas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_pessoa_juridica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_pessoa_juridica` (
  `idpessoa juridica` INT NOT NULL AUTO_INCREMENT,
  `cnpj` VARCHAR(45) NOT NULL,
  `tb_pessoas_idpessoas` INT NOT NULL,
  PRIMARY KEY (`idpessoa juridica`),
  INDEX `fk_tb_pessoa_juridica_tb_pessoas1_idx` (`tb_pessoas_idpessoas` ASC) VISIBLE,
  CONSTRAINT `fk_tb_pessoa_juridica_tb_pessoas1`
    FOREIGN KEY (`tb_pessoas_idpessoas`)
    REFERENCES `bancoveiculos`.`tb_pessoas` (`idpessoas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_pessoa_fisica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_pessoa_fisica` (
  `idpessoa fisica` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(45) NOT NULL,
  `cnh` VARCHAR(45) NOT NULL,
  `tb_pessoas_idpessoas` INT NOT NULL,
  PRIMARY KEY (`idpessoa fisica`),
  INDEX `fk_tb_pessoa_fisica_tb_pessoas1_idx` (`tb_pessoas_idpessoas` ASC) VISIBLE,
  CONSTRAINT `fk_tb_pessoa_fisica_tb_pessoas1`
    FOREIGN KEY (`tb_pessoas_idpessoas`)
    REFERENCES `bancoveiculos`.`tb_pessoas` (`idpessoas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_aluguel_has_tb_pessoas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_aluguel_has_tb_pessoas` (
  `tb_aluguel_idtb_aluguel` INT NOT NULL,
  `tb_pessoas_idpessoas` INT NOT NULL,
  PRIMARY KEY (`tb_aluguel_idtb_aluguel`, `tb_pessoas_idpessoas`),
  INDEX `fk_tb_aluguel_has_tb_pessoas_tb_pessoas1_idx` (`tb_pessoas_idpessoas` ASC) VISIBLE,
  INDEX `fk_tb_aluguel_has_tb_pessoas_tb_aluguel1_idx` (`tb_aluguel_idtb_aluguel` ASC) VISIBLE,
  CONSTRAINT `fk_tb_aluguel_has_tb_pessoas_tb_aluguel1`
    FOREIGN KEY (`tb_aluguel_idtb_aluguel`)
    REFERENCES `bancoveiculos`.`tb_aluguel` (`idtb_aluguel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_aluguel_has_tb_pessoas_tb_pessoas1`
    FOREIGN KEY (`tb_pessoas_idpessoas`)
    REFERENCES `bancoveiculos`.`tb_pessoas` (`idpessoas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bancoveiculos`.`tb_aluguel_has_tb_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bancoveiculos`.`tb_aluguel_has_tb_veiculo` (
  `tb_aluguel_idtb_aluguel` INT NOT NULL,
  `tb_veiculo_idtb_veiculo` INT NOT NULL,
  PRIMARY KEY (`tb_aluguel_idtb_aluguel`, `tb_veiculo_idtb_veiculo`),
  INDEX `fk_tb_aluguel_has_tb_veiculo_tb_veiculo1_idx` (`tb_veiculo_idtb_veiculo` ASC) VISIBLE,
  INDEX `fk_tb_aluguel_has_tb_veiculo_tb_aluguel1_idx` (`tb_aluguel_idtb_aluguel` ASC) VISIBLE,
  CONSTRAINT `fk_tb_aluguel_has_tb_veiculo_tb_aluguel1`
    FOREIGN KEY (`tb_aluguel_idtb_aluguel`)
    REFERENCES `bancoveiculos`.`tb_aluguel` (`idtb_aluguel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_aluguel_has_tb_veiculo_tb_veiculo1`
    FOREIGN KEY (`tb_veiculo_idtb_veiculo`)
    REFERENCES `bancoveiculos`.`tb_veiculo` (`idtb_veiculo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
