CREATE DATABASE `ggtest` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ggtest`;

DROP TABLE IF EXISTS `tbl_clientes`;
CREATE TABLE `tbl_clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `tbl_clientes` (`id`, `nome`) VALUES
(1,	'Cliente 1'),
(2,	'Cliente 2'),
(3,	'Cliente 3');

DROP TABLE IF EXISTS `tbl_fornecedores`;
CREATE TABLE `tbl_fornecedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `tbl_fornecedores` (`id`, `nome`) VALUES
(1,	'Fornecedor 1'),
(2,	'Fornecedor 2'),
(3,	'Fornecedor 3'),
(4,	'Fornecedor 4'),
(5,	'Fornecedor 5');

DROP TABLE IF EXISTS `tbl_itens`;
CREATE TABLE `tbl_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagem` longtext NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `tbl_itens` (`id`, `imagem`, `nome`, `descricao`) VALUES
(1,	'produto-teste.jpg',	'Nome do Produto 1',	'Descrição do produto 1'),
(2,	'produto-teste.jpg',	'Nome do Produto 2',	'Descrição do produto 2'),
(3,	'produto-teste.jpg',	'Nome do Produto 3',	'Descrição do produto 3'),
(4,	'produto-teste.jpg',	'Nome do Produto 4',	'Descrição do produto 4'),
(5,	'produto-teste.jpg',	'Nome do Produto 5',	'Descrição do produto 5'),
(6,	'produto-teste.jpg',	'Nome do Produto 6',	'Descrição do produto 6'),
(7,	'produto-teste.jpg',	'Nome do Produto 7',	'Descrição do produto 7'),
(8,	'produto-teste.jpg',	'Nome do Produto 8',	'Descrição do produto 8');

DROP TABLE IF EXISTS `tbl_itens_orcamentos`;
CREATE TABLE `tbl_itens_orcamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_orcamento` int NOT NULL,
  `id_item` int NOT NULL,
  `id_preco` int DEFAULT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `tbl_orcamentos`;
CREATE TABLE `tbl_orcamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_cliente` int NOT NULL,
  `aprovado` tinyint NOT NULL DEFAULT '0',
  `dia` smallint NOT NULL,
  `mes` smallint NOT NULL,
  `ano` smallint NOT NULL,
  `hora` smallint NOT NULL,
  `minuto` smallint NOT NULL,
  `segundo` smallint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `tbl_precos_itens`;
CREATE TABLE `tbl_precos_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_item` int NOT NULL,
  `id_fornecedor` int NOT NULL,
  `preco` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `tbl_precos_itens` (`id`, `id_item`, `id_fornecedor`, `preco`) VALUES
(1,	1,	1,	20),
(2,	1,	2,	21.45),
(3,	1,	3,	19.99),
(4,	1,	4,	18.99),
(5,	2,	1,	58.98),
(6,	2,	2,	59.99),
(7,	2,	4,	61.01),
(8,	2,	5,	17.76),
(9,	3,	1,	1.99),
(10,	3,	2,	1.98),
(11,	3,	3,	1.96),
(12,	3,	4,	2.21),
(13,	3,	5,	2.03);

DROP TABLE IF EXISTS `tbl_tipos_usuarios`;
CREATE TABLE `tbl_tipos_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `tbl_tipos_usuarios` (`id`, `tipo`) VALUES
(1,	'Comprador'),
(2,	'Gerente');

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_tipo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `tbl_usuarios` (`id`, `nome`, `login`, `senha`, `id_tipo`) VALUES
(1,	'teste',	'teste',	'698dc19d489c4e4db73e28a713eab07b',	1),
(2,	'rodrigo',	'rodrigo',	'2e247e2eb505c42b362e80ed4d05b078',	2);
