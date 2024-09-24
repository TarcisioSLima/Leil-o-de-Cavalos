-- Adminer 4.8.1 MySQL 5.5.5-10.5.20-MariaDB-1:10.5.20+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `db_quarter_horse`;
CREATE DATABASE `db_quarter_horse` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_quarter_horse`;

DROP TABLE IF EXISTS `tb_cavalo`;
CREATE TABLE `tb_cavalo` (
  `id_cavalo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cavalo` varchar(45) NOT NULL,
  `raca_cavalo` varchar(45) NOT NULL,
  `pelagem_cavalo` varchar(45) NOT NULL,
  `premio_cavalo` varchar(55) DEFAULT NULL,
  `situacao_cavalo` enum('Ativo','Inativo','Vendido') NOT NULL DEFAULT 'Inativo',
  `modalidade_cavalo` enum('3 Tambores','Laço','Vaquejada') NOT NULL,
  `destaque` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `img_cavalo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cavalo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_cavalo` (`id_cavalo`, `nome_cavalo`, `raca_cavalo`, `pelagem_cavalo`, `premio_cavalo`, `situacao_cavalo`, `modalidade_cavalo`, `destaque`, `img_cavalo`) VALUES
(1,	'Tornado',	'Puro Sangue',	'Alazão',	'Troféu de Velocidade',	'Ativo',	'3 Tambores',	'Sim',	'tornado.jpg'),
(2,	'Relâmpago',	'Mangalarga',	'Tordilho',	'Troféu de Resistência',	'Vendido',	'Laço',	'Não',	'relampago.jpg'),
(3,	'Ventania',	'Crioulo',	'Baio',	'Medalha de Ouro',	'Ativo',	'Vaquejada',	'Sim',	'ventania.jpg'),
(4,	'Estrela',	'Árabe',	'Preto',	'Troféu de Agilidade',	'Inativo',	'3 Tambores',	'Não',	'estrela.jpg'),
(5,	'Diamante',	'Lusitano',	'Castanho',	'Certificado de Excelência',	'Ativo',	'Laço',	'Sim',	'diamante.jpg'),
(6,	'Pegasus',	'Appaloosa',	'Malhado',	NULL,	'Vendido',	'Vaquejada',	'Não',	'pegasus.jpg'),
(7,	'Fênix',	'Puro Sangue',	'Alazão',	'Troféu de Participação',	'Ativo',	'3 Tambores',	'Sim',	'fenix.jpg'),
(8,	'Jatobá',	'Mangalarga Marchador',	'Lobuno',	NULL,	'Inativo',	'Laço',	'Não',	'jatoba.jpg'),
(9,	'Caramelo',	'Andaluz',	'Palomino',	'Troféu de Estilo',	'Vendido',	'Vaquejada',	'Sim',	'caramelo.jpg'),
(10,	'Aurora',	'Quarto de Milha',	'Rosilho',	'Medalha de Prata',	'Ativo',	'3 Tambores',	'Sim',	'aurora.jpg'),
(11,	'Cleber',	'Bravo',	'Azul',	'Mortal de 2 patas',	'Inativo',	'Laço',	'Não',	'../public/assets/img/1726794310a47fdd2ae7a0a0f6f24d9a3fc2b3232727.png')
ON DUPLICATE KEY UPDATE `id_cavalo` = VALUES(`id_cavalo`), `nome_cavalo` = VALUES(`nome_cavalo`), `raca_cavalo` = VALUES(`raca_cavalo`), `pelagem_cavalo` = VALUES(`pelagem_cavalo`), `premio_cavalo` = VALUES(`premio_cavalo`), `situacao_cavalo` = VALUES(`situacao_cavalo`), `modalidade_cavalo` = VALUES(`modalidade_cavalo`), `destaque` = VALUES(`destaque`), `img_cavalo` = VALUES(`img_cavalo`);

DROP TABLE IF EXISTS `tb_lance`;
CREATE TABLE `tb_lance` (
  `id_lance` int(11) NOT NULL AUTO_INCREMENT,
  `valor_lance` decimal(10,2) NOT NULL,
  `data_lance` datetime NOT NULL,
  `tb_usuario_id_usuario` int(11) DEFAULT NULL,
  `tb_lote_id_lote` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lance`),
  KEY `tb_usuario_id_usuario` (`tb_usuario_id_usuario`),
  KEY `tb_lote_id_lote` (`tb_lote_id_lote`),
  CONSTRAINT `tb_lance_ibfk_1` FOREIGN KEY (`tb_usuario_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`),
  CONSTRAINT `tb_lance_ibfk_2` FOREIGN KEY (`tb_lote_id_lote`) REFERENCES `tb_lote` (`id_lote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `tb_lote`;
CREATE TABLE `tb_lote` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `valor_lote` decimal(10,2) NOT NULL,
-- Adminer 4.8.1 MySQL 5.5.5-10.5.26-MariaDB-ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_cavalo`;
CREATE TABLE `tb_cavalo` (
  `id_cavalo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cavalo` varchar(45) NOT NULL,
  `raca_cavalo` varchar(45) NOT NULL,
  `pelagem_cavalo` varchar(45) NOT NULL,
  `premio_cavalo` varchar(55) DEFAULT NULL,
  `situacao_cavalo` enum('Ativo','Inativo','Vendido') NOT NULL DEFAULT 'Inativo',
  `modalidade_cavalo` enum('3 Tambores','Laço','Vaquejada') NOT NULL,
  `destaque` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `img_cavalo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cavalo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_cavalo` (`id_cavalo`, `nome_cavalo`, `raca_cavalo`, `pelagem_cavalo`, `premio_cavalo`, `situacao_cavalo`, `modalidade_cavalo`, `destaque`, `img_cavalo`) VALUES
(1,	'Tornado',	'Puro Sangue',	'Alazão',	'Troféu de Velocidade',	'Ativo',	'3 Tambores',	'Sim',	'tornado.jpg'),
(2,	'Relâmpago',	'Mangalarga',	'Tordilho',	'Troféu de Resistência',	'Vendido',	'Laço',	'Não',	'relampago.jpg'),
(3,	'Ventania',	'Crioulo',	'Baio',	'Medalha de Ouro',	'Ativo',	'Vaquejada',	'Sim',	'ventania.jpg'),
(4,	'Estrela',	'Árabe',	'Preto',	'Troféu de Agilidade',	'Inativo',	'3 Tambores',	'Não',	'estrela.jpg'),
(5,	'Diamante',	'Lusitano',	'Castanho',	'Certificado de Excelência',	'Ativo',	'Laço',	'Sim',	'diamante.jpg'),
(6,	'Pegasus',	'Appaloosa',	'Malhado',	NULL,	'Vendido',	'Vaquejada',	'Não',	'pegasus.jpg'),
(7,	'Fênix',	'Puro Sangue',	'Alazão',	'Troféu de Participação',	'Ativo',	'3 Tambores',	'Sim',	'fenix.jpg'),
(8,	'Jatobá',	'Mangalarga Marchador',	'Lobuno',	NULL,	'Inativo',	'Laço',	'Não',	'jatoba.jpg'),
(9,	'Caramelo',	'Andaluz',	'Palomino',	'Troféu de Estilo',	'Vendido',	'Vaquejada',	'Sim',	'caramelo.jpg'),
(10,	'Aurora',	'Quarto de Milha',	'Rosilho',	'Medalha de Prata',	'Ativo',	'3 Tambores',	'Sim',	'aurora.jpg'),
(11,	'Cleber',	'Bravo',	'Azul',	'Mortal de 2 patas',	'Inativo',	'Laço',	'Não',	'../public/assets/img/1726794310a47fdd2ae7a0a0f6f24d9a3fc2b3232727.png');

DROP TABLE IF EXISTS `tb_lance`;
CREATE TABLE `tb_lance` (
  `id_lance` int(11) NOT NULL AUTO_INCREMENT,
  `valor_lance` decimal(10,2) NOT NULL,
  `data_lance` datetime NOT NULL,
  `tb_usuario_id_usuario` int(11) DEFAULT NULL,
  `tb_lote_id_lote` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lance`),
  KEY `tb_usuario_id_usuario` (`tb_usuario_id_usuario`),
  KEY `tb_lote_id_lote` (`tb_lote_id_lote`),
  CONSTRAINT `tb_lance_ibfk_1` FOREIGN KEY (`tb_usuario_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`),
  CONSTRAINT `tb_lance_ibfk_2` FOREIGN KEY (`tb_lote_id_lote`) REFERENCES `tb_lote` (`id_lote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `tb_lote`;
CREATE TABLE `tb_lote` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `valor_lote` decimal(10,2) NOT NULL,
  `data_fechamento` datetime NOT NULL,
  `estado_lote` enum('Disponível','Finalizado','Cancelado') NOT NULL,
  `tb_cavalo_id_cavalo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lote`),
  KEY `tb_cavalo_id_cavalo` (`tb_cavalo_id_cavalo`),
  CONSTRAINT `tb_lote_ibfk_1` FOREIGN KEY (`tb_cavalo_id_cavalo`) REFERENCES `tb_cavalo` (`id_cavalo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(45) NOT NULL,
  `tipo_usuario` enum('Admin','Cliente') DEFAULT 'Cliente',
  `p_modalidade` enum('Sem preferência','3 Tambores','Laço','Vaquejada') DEFAULT 'Sem preferência',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `tipo_usuario`, `p_modalidade`) VALUES
(1,	'James',	'cjames@gmail.com',	'123',	'Admin',	'3 Tambores'),
(6,	'Fernando',	'mortinboludo@gmail.com',	'321',	'Cliente',	'Laço'),
(7,	'Samuel',	'leumas@gmail.com',	'4321',	'Cliente',	'3 Tambores'),
(8,	'Rayssa',	'rayrbm@gmail.com',	'lilas',	'Cliente',	'3 Tambores'),
(9,	'tarcisio',	'tarcisioara9@gmail.com',	'senha',	'Cliente',	'Laço');

-- 2024-09-24 11:49:27  `estado_lote` enum('Disponível','Finalizado','Cancelado') NOT NULL,
  `tb_cavalo_id_cavalo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lote`),
  KEY `tb_cavalo_id_cavalo` (`tb_cavalo_id_cavalo`),
  CONSTRAINT `tb_lote_ibfk_1` FOREIGN KEY (`tb_cavalo_id_cavalo`) REFERENCES `tb_cavalo` (`id_cavalo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(45) NOT NULL,
  `tipo_usuario` enum('Admin','Cliente') DEFAULT 'Cliente',
  `p_modalidade` enum('Sem preferência','3 Tambores','Laço','Vaquejada') DEFAULT 'Sem preferência',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tb_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `tipo_usuario`, `p_modalidade`) VALUES
(1,	'James',	'cjames@gmail.com',	'123',	'Admin',	'3 Tambores'),
(6,	'Fernando',	'mortinboludo@gmail.com',	'321',	'Cliente',	'Laço'),
(7,	'Samuel',	'leumas@gmail.com',	'4321',	'Cliente',	'3 Tambores'),
(8,	'Rayssa',	'rayrbm@gmail.com',	'lilas',	'Cliente',	'3 Tambores'),
(9,	'tarcisio',	'tarcisioara9@gmail.com',	'senha',	'Cliente',	'Laço')
ON DUPLICATE KEY UPDATE `id_usuario` = VALUES(`id_usuario`), `nome_usuario` = VALUES(`nome_usuario`), `email_usuario` = VALUES(`email_usuario`), `senha_usuario` = VALUES(`senha_usuario`), `tipo_usuario` = VALUES(`tipo_usuario`), `p_modalidade` = VALUES(`p_modalidade`);

-- 2024-09-20 01:08:55