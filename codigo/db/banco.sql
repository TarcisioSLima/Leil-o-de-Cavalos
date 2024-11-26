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
(13,	'Tornado',	'Puro Sangue',	'Alazão',	'Troféu de Velocidade',	'Inativo',	'3 Tambores',	'Não',	'/public/assets/img/1732589276c78b06c339049b2e7a51d05a70f7ecd729.jpg'),
(14,	'Estrela',	'Quarto de Milha',	'Rosilho',	'Medalha de Bronze',	'Inativo',	'3 Tambores',	'Não',	'/public/assets/img/17325893604de18c4f7ca0a1744c3492e46973a5cf38.jpg'),
(15,	'Relâmpago',	'Crioulo',	'Castanho',	'Certificado de Desempenho',	'Inativo',	'3 Tambores',	'Não',	'/public/assets/img/1732589446ec3b4144f12a53632b9d7e9ef6b5f26425.png'),
(16,	'Cometa',	'Puro Sangue',	'Baio',	'Medalha de Ouro',	'Inativo',	'3 Tambores',	'Não',	'/public/assets/img/1732589512a8c7155c2ad89d78452015f79e497ad073.jpg'),
(17,	'Àquila',	'Lusitano',	'Castanho',	'Troféu de Participação',	'Inativo',	'3 Tambores',	'Não',	'/public/assets/img/1732589612e0f6d8eb636e694ea3c7750a5595557150.jpg'),
(18,	'Ventania',	'Crioulo',	'Baio',	'Medalha de Ouro',	'Inativo',	'Vaquejada',	'Não',	'/public/assets/img/173258969034224b4e128d7978506952428af4161684.jpg'),
(19,	'Diamante',	'Lusitano',	'Castanho',	'Execelência',	'Inativo',	'Vaquejada',	'Não',	'/public/assets/img/1732589737f6454eb3484c5e38263aa16b4ad63cc065.jpg'),
(20,	'Pegasus',	'Puro Sangue',	'Alazão',	'Medalha de Bronze',	'Inativo',	'Vaquejada',	'Não',	'/public/assets/img/17325898131f58eea9e1c3e0048baa6a89c050a4f478.jpg'),
(21,	'Tigre',	'Quarto de Milha',	'Rosilho',	'Medalha de prata',	'Inativo',	'Vaquejada',	'Não',	'/public/assets/img/17325898531f6063bb248ea02a1fdf7d139ed6792f46.jpg')
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
  CONSTRAINT `tb_lance_ibfk_3` FOREIGN KEY (`tb_usuario_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `tb_lance_ibfk_4` FOREIGN KEY (`tb_lote_id_lote`) REFERENCES `tb_lote` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `tb_lote`;
CREATE TABLE `tb_lote` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `valor_lote` decimal(10,2) NOT NULL,
  `data_fechamento` datetime NOT NULL,
  `estado_lote` enum('Ativo','Inativo','Encerrado') NOT NULL,
  `tb_cavalo_id_cavalo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lote`),
  KEY `tb_cavalo_id_cavalo` (`tb_cavalo_id_cavalo`),
  CONSTRAINT `tb_lote_ibfk_2` FOREIGN KEY (`tb_cavalo_id_cavalo`) REFERENCES `tb_cavalo` (`id_cavalo`) ON DELETE CASCADE
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
(12,	'Tarciso',	'email_raro@gmail.com',	'senha_forte',	'Admin',	'Sem preferência')
ON DUPLICATE KEY UPDATE `id_usuario` = VALUES(`id_usuario`), `nome_usuario` = VALUES(`nome_usuario`), `email_usuario` = VALUES(`email_usuario`), `senha_usuario` = VALUES(`senha_usuario`), `tipo_usuario` = VALUES(`tipo_usuario`), `p_modalidade` = VALUES(`p_modalidade`);

-- 2024-11-26 02:58:49