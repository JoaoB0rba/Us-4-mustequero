
-- -----------------------------------------------------
-- Schema bancoveiculos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bancoveiculos` DEFAULT CHARACTER SET utf8 ;
USE `bancoveiculos` ;

-- -----------------------------------------------------
-- Table `tb_pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pagamento` (
  `idtb_pagamento` INT NOT NULL AUTO_INCREMENT,
  `tipo_pagamento` VARCHAR(45) NOT NULL,
  `preco_pagamento` VARCHAR(45) NOT NULL,
  `valor_valorkm` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtb_pagamento`))
ENGINE = InnoDB;

-- Inserir dados na tabela `tb_pagamento`
INSERT INTO `tb_pagamento` (tipo_pagamento, preco_pagamento, valor_valorkm) VALUES
('Cartão de Crédito', '150.00', '0.50'),
('Dinheiro', '100.00', '0.45'),
('Transferência', '120.00', '0.48'),
('Pix', '130.00', '0.47'),
('Boleto', '140.00', '0.46'),
('Cartão de Débito', '160.00', '0.55'),
('Dinheiro', '110.00', '0.49'),
('Pix', '125.00', '0.51'),
('Cartão de Crédito', '180.00', '0.60'),
('Transferência', '140.00', '0.52'),
('Boleto', '135.00', '0.53'),
('Cartão de Débito', '150.00', '0.58'),
('Dinheiro', '90.00', '0.43'),
('Transferência', '170.00', '0.54'),
('Pix', '160.00', '0.57'),
('Boleto', '145.00', '0.59'),
('Dinheiro', '105.00', '0.48'),
('Cartão de Crédito', '190.00', '0.62'),
('Transferência', '200.00', '0.65'),
('Pix', '175.00', '0.61');

-- -----------------------------------------------------
-- Table `tb_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_funcionario` (
  `idtb_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome_funcionario` VARCHAR(45) NOT NULL,
  `cpf_funcionario` VARCHAR(45) NOT NULL,
  `telefone_funcionario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtb_funcionario`))
ENGINE = InnoDB;

-- Inserir dados na tabela `tb_funcionario`
INSERT INTO `tb_funcionario` (nome_funcionario, cpf_funcionario, telefone_funcionario) VALUES
('João Silva', '11122233344', '(62) 91234-5678'),
('Maria Souza', '22233344455', '(62) 92345-6789'),
('Pedro Costa', '33344455566', '(62) 93456-7890'),
('Ana Lima', '44455566677', '(62) 94567-8901'),
('Carlos Santos', '55566677788', '(62) 95678-9012'),
('Beatriz Carvalho', '66677788899', '(62) 96789-0123'),
('Fernando Torres', '77788899900', '(62) 97890-1234'),
('Juliana Pereira', '88899900011', '(62) 98901-2345'),
('Bruno Rocha', '99900011122', '(62) 99012-3456'),
('Isabela Mendes', '00011122233', '(62) 90123-4567'),
('Marcos Dias', '11122233344', '(62) 91234-5678'),
('Laura Costa', '22233344455', '(62) 92345-6789'),
('Lucas Nunes', '33344455566', '(62) 93456-7890'),
('Renata Oliveira', '44455566677', '(62) 94567-8901'),
('Thiago Moreira', '55566677788', '(62) 95678-9012'),
('Paula Gomes', '66677788899', '(62) 96789-0123'),
('Gabriel Freitas', '77788899900', '(62) 97890-1234'),
('Camila Souza', '88899900011', '(62) 98901-2345'),
('Ricardo Martins', '99900011122', '(62) 99012-3456'),
('Fernanda Lima', '00011122233', '(62) 90123-4567');

-- -----------------------------------------------------
-- Table `tb_pessoas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pessoas` (
  `idpessoas` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpessoas`))
ENGINE = InnoDB;

-- Inserir dados na tabela `tb_pessoas`
INSERT INTO `tb_pessoas` (nome, tipo, telefone) VALUES
('João Silva', 'Física', '(62) 91234-5678'),
('Maria Souza', 'Física', '(62) 92345-6789'),
('Empresa X', 'Jurídica', '(62) 93456-7890'),
('Pedro Costa', 'Física', '(62) 94567-8901'),
('Ana Lima', 'Física', '(62) 95678-9012'),
('Empresa Y', 'Jurídica', '(62) 96789-0123'),
('Beatriz Carvalho', 'Física', '(62) 97890-1234'),
('Fernando Torres', 'Física', '(62) 98901-2345'),
('Juliana Pereira', 'Física', '(62) 99012-3456'),
('Empresa Z', 'Jurídica', '(62) 90123-4567'),
('Bruno Rocha', 'Física', '(62) 91234-5678'),
('Isabela Mendes', 'Física', '(62) 92345-6789'),
('Marcos Dias', 'Física', '(62) 93456-7890'),
('Laura Costa', 'Física', '(62) 94567-8901'),
('Lucas Nunes', 'Física', '(62) 95678-9012'),
('Renata Oliveira', 'Física', '(62) 96789-0123'),
('Thiago Moreira', 'Física', '(62) 97890-1234'),
('Empresa A', 'Jurídica', '(62) 98901-2345'),
('Paula Gomes', 'Física', '(62) 99012-3456'),
('Gabriel Freitas', 'Física', '(62) 90123-4567');

-- -----------------------------------------------------
-- Table `tb_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_veiculo` (
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
  PRIMARY KEY (`idtb_veiculo`))
ENGINE = InnoDB;

-- Inserir dados na tabela `tb_veiculo`
INSERT INTO `tb_veiculo` (marca_veiculo, placa_veiculo, modelo_veiculo, numero_chaci_veiculo, tipo_veiculo, cor_veiculo, capacidade_veiculo, porta_mala_veiculo, alugado_veiculo) VALUES
('Toyota', 'ABC1234', 'Corolla', '1HGBH41JXMN109186', 'Sedan', 'Preto', '5', '500L', 'N'),
('Honda', 'DEF5678', 'Civic', '1HGBH41JXMN109187', 'Sedan', 'Branco', '5', '520L', 'S'),
('Ford', 'GHI9012', 'Focus', '1HGBH41JXMN109188', 'Hatch', 'Azul', '5', '450L', 'N'),
('Chevrolet', 'JKL3456', 'Onix', '1HGBH41JXMN109189', 'Hatch', 'Vermelho', '5', '400L', 'N'),
('Fiat', 'MNO7890', 'Argo', '1HGBH41JXMN109190', 'Hatch', 'Cinza', '5', '370L', 'S'),
('Volkswagen', 'PQR1234', 'Golf', '1HGBH41JXMN109191', 'Hatch', 'Preto', '5', '460L', 'N'),
('Hyundai', 'STU5678', 'HB20', '1HGBH41JXMN109192', 'Hatch', 'Branco', '5', '420L', 'S'),
('Nissan', 'VWX9012', 'Kicks', '1HGBH41JXMN109193', 'SUV', 'Azul', '5', '500L', 'N'),
('Jeep', 'YZA3456', 'Renegade', '1HGBH41JXMN109194', 'SUV', 'Vermelho', '5', '520L', 'S'),
('Renault', 'BCD7890', 'Captur', '1HGBH41JXMN109195', 'SUV', 'Cinza', '5', '480L', 'N');

-- -----------------------------------------------------
-- Table `tb_pessoa_juridica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pessoa_juridica` (
  `idpessoa_juridica` INT NOT NULL AUTO_INCREMENT,
  `cnpj` VARCHAR(45) NOT NULL,
  `tb_pessoas_idpessoas` INT NOT NULL,
  PRIMARY KEY (`idpessoa_juridica`),
  INDEX `fk_tb_pessoa_juridica_tb_pessoas1_idx` (`tb_pessoas_idpessoas` ASC) VISIBLE,
  CONSTRAINT `fk_tb_pessoa_juridica_tb_pessoas1`
    FOREIGN KEY (`tb_pessoas_idpessoas`)
    REFERENCES `bancoveiculos`.`tb_pessoas` (`idpessoas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Inserindo dados na tabela tb_pessoa_juridica
INSERT INTO `tb_pessoa_juridica` (cnpj, tb_pessoas_idpessoas) VALUES
('12.345.678/0001-00', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Empresa X')),
('23.456.789/0001-11', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Empresa Y')),
('34.567.890/0001-22', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Empresa Z')),
('45.678.901/0001-33', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Empresa A'));


-- -----------------------------------------------------
-- Table `tb_pessoa_fisica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_pessoa_fisica` (
  `idpessoa_fisica` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(45) NOT NULL,
  `cnh` VARCHAR(45) NOT NULL,
  `tb_pessoas_idpessoas` INT NOT NULL,
  PRIMARY KEY (`idpessoa_fisica`),
  INDEX `fk_tb_pessoa_fisica_tb_pessoas1_idx` (`tb_pessoas_idpessoas` ASC) VISIBLE,
  CONSTRAINT `fk_tb_pessoa_fisica_tb_pessoas1`
    FOREIGN KEY (`tb_pessoas_idpessoas`)
    REFERENCES `bancoveiculos`.`tb_pessoas` (`idpessoas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Inserindo dados na tabela tb_pessoa_fisica
INSERT INTO `tb_pessoa_fisica` (cpf, cnh, tb_pessoas_idpessoas) VALUES
('123.456.789-00', '123456789012345', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'João Silva')),
('234.567.890-11', '234567890123456', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Maria Souza')),
('345.678.901-22', '345678901234567', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Pedro Costa')),
('456.789.012-33', '456789012345678', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Ana Lima')),
('567.890.123-44', '567890123456789', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Beatriz Carvalho')),
('678.901.234-55', '678901234567890', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Fernando Torres')),
('789.012.345-66', '789012345678901', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Juliana Pereira')),
('890.123.456-77', '890123456789012', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Bruno Rocha')),
('901.234.567-88', '901234567890123', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Isabela Mendes')),
('012.345.678-99', '012345678901234', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Marcos Dias')),
('123.456.789-01', '123456789012345', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Laura Costa')),
('234.567.890-12', '234567890123456', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Lucas Nunes')),
('345.678.901-23', '345678901234567', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Renata Oliveira')),
('456.789.012-34', '456789012345678', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Thiago Moreira')),
('567.890.123-45', '567890123456789', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Paula Gomes')),
('678.901.234-56', '678901234567890', (SELECT idpessoas FROM tb_pessoas WHERE nome = 'Gabriel Freitas'));


-- -----------------------------------------------------
-- Table `tb_aluguel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_aluguel` (
  `idtb_aluguel` INT NOT NULL AUTO_INCREMENT,
  `data_inicial` DATE NOT NULL,
  `tb_funcionario_idtb_funcionario` INT NOT NULL,
  `tb_pessoas_idpessoas` INT NOT NULL,
  `tb_pagamento_idtb_pagamento` INT NOT NULL,
  PRIMARY KEY (`idtb_aluguel`),
  INDEX `fk_tb_aluguel_tb_funcionario1_idx` (`tb_funcionario_idtb_funcionario` ASC) VISIBLE,
  INDEX `fk_tb_aluguel_tb_pessoas1_idx` (`tb_pessoas_idpessoas` ASC) VISIBLE,
  INDEX `fk_tb_aluguel_tb_pagamento1_idx` (`tb_pagamento_idtb_pagamento` ASC) VISIBLE,
  CONSTRAINT `fk_tb_aluguel_tb_funcionario1`
    FOREIGN KEY (`tb_funcionario_idtb_funcionario`)
    REFERENCES `bancoveiculos`.`tb_funcionario` (`idtb_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_aluguel_tb_pessoas1`
    FOREIGN KEY (`tb_pessoas_idpessoas`)
    REFERENCES `bancoveiculos`.`tb_pessoas` (`idpessoas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_aluguel_tb_pagamento1`
    FOREIGN KEY (`tb_pagamento_idtb_pagamento`)
    REFERENCES `bancoveiculos`.`tb_pagamento` (`idtb_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Inserir dados na tabela `tb_aluguel`
INSERT INTO `tb_aluguel` (data_inicial, tb_funcionario_idtb_funcionario, tb_pessoas_idpessoas, tb_pagamento_idtb_pagamento) VALUES
('2024-09-01', 1, 1, 1),
('2024-09-02', 2, 2, 2),
('2024-09-03', 3, 3, 3),
('2024-09-04', 4, 4, 4),
('2024-09-05', 5, 5, 5),
('2024-09-06', 6, 6, 6),
('2024-09-07', 7, 7, 7),
('2024-09-08', 8, 8, 8),
('2024-09-09', 9, 9, 9),
('2024-09-10', 10, 10, 10),
('2024-09-11', 11, 11, 11),
('2024-09-12', 12, 12, 12),
('2024-09-13', 13, 13, 13),
('2024-09-14', 14, 14, 14),
('2024-09-15', 15, 15, 15),
('2024-09-16', 16, 16, 16),
('2024-09-17', 17, 17, 17),
('2024-09-18', 18, 18, 18),
('2024-09-19', 19, 19, 19),
('2024-09-20', 20, 20, 20);

-- -----------------------------------------------------
-- Table `tb_aluguel_has_tb_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_aluguel_has_tb_veiculo` (
  `tb_aluguel_idtb_aluguel` INT NOT NULL,
  `tb_veiculo_idtb_veiculo` INT NOT NULL,
  `kmfinal` VARCHAR(45) NOT NULL,
  `kminicial` VARCHAR(45) NOT NULL,
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

-- Inserir dados na tabela `tb_aluguel_has_tb_veiculo`
INSERT INTO `tb_aluguel_has_tb_veiculo` (tb_aluguel_idtb_aluguel, tb_veiculo_idtb_veiculo, kmfinal, kminicial) VALUES
(1, 1, '1000', '500'),
(2, 2, '2000', '1500'),
(3, 3, '3000', '2500'),
(4, 4, '4000', '3500'),
(5, 5, '5000', '4500'),
(6, 6, '6000', '5500'),
(7, 7, '7000', '6500'),
(8, 8, '8000', '7500'),
(9, 9, '9000', '8500'),
(10, 10, '10000', '9500'),
(11, 11, '11000', '10500'),
(12, 12, '12000', '11500'),
(13, 13, '13000', '12500'),
(14, 14, '14000', '13500'),
(15, 15, '15000', '14500'),
(16, 16, '16000', '15500'),
(17, 17, '17000', '16500'),
(18, 18, '18000', '17500'),
(19, 19, '19000', '18500'),
(20, 20, '20000', '19500');
