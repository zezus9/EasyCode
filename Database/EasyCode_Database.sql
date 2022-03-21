-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.25 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para easycode
DROP DATABASE IF EXISTS `easycode`;
CREATE DATABASE IF NOT EXISTS `easycode` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `easycode`;

-- Copiando estrutura para tabela easycode.administrador
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_adm` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome_adm` varchar(40) NOT NULL,
  `email_adm` varchar(30) NOT NULL,
  `telefone` char(11) NOT NULL,
  `CPF_adm` char(11) NOT NULL,
  `matricula_adm` varchar(5) NOT NULL,
  `nasc_adm` date NOT NULL,
  `avatar` varchar(10) NOT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id_adm`),
  UNIQUE KEY `email_adm` (`email_adm`),
  UNIQUE KEY `CPF_adm` (`CPF_adm`),
  UNIQUE KEY `matricula_adm` (`matricula_adm`),
  UNIQUE KEY `avatar` (`avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela easycode.aluno
DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id_aluno` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(40) NOT NULL,
  `telefone` char(11) NOT NULL,
  `email_aluno` varchar(30) NOT NULL,
  `CPF_aluno` char(11) NOT NULL,
  `matricula_aluno` varchar(5) NOT NULL,
  `nasc_aluno` date NOT NULL,
  `avatar` varchar(10) NOT NULL,
  `linkedin` varchar(512) DEFAULT NULL,
  `github` varchar(512) DEFAULT NULL,
  `link_personalizado` varchar(512) DEFAULT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `email_aluno` (`email_aluno`),
  UNIQUE KEY `avatar` (`avatar`),
  UNIQUE KEY `CPF` (`CPF_aluno`) USING BTREE,
  UNIQUE KEY `matricula` (`matricula_aluno`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela easycode.certificado
DROP TABLE IF EXISTS `certificado`;
CREATE TABLE IF NOT EXISTS `certificado` (
  `id_certificado` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_aluno` int(3) NOT NULL,
  `id_curso` int(3) NOT NULL,
  `fase` int(2) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `pdf` varchar(20) DEFAULT NULL,
  `responsavel` varchar(30) NOT NULL,
  `link` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id_certificado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela easycode.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(40) NOT NULL,
  `campo` varchar(15) NOT NULL,
  `fase` int(2) NOT NULL,
  `duração` time NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
