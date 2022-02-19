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

-- Copiando estrutura para tabela easycode.aluno
DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `nome` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nUsuario` varchar(15) NOT NULL,
  `data_nasc` date NOT NULL,
  `certificados` varchar(20) NOT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.aluno: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
REPLACE INTO `aluno` (`id`, `nome`, `email`, `nUsuario`, `data_nasc`, `certificados`, `senha`) VALUES
	(1, 'Gustavo Matos Francisco', 'gustavo.francisco@hotmail.com', 'gustaFran', '2005-02-23', '2', '147963852'),
	(2, 'Pedro Henrique Nascimento', 'pedro.nascimento@hotmail.com', 'PedroH', '2002-12-13', '1', '7554954'),
	(3, 'Lucia Silva Pereira', 'lucia.pereira@gmail.com', 'LuciaP', '2001-11-15', '2;3', '4564895'),
	(4, 'Gabriela Santos', 'gabriela.santos@outlook.com', 'gabiS', '2000-05-09', '1;3', '987321654');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `nome` varchar(50) NOT NULL,
  `valor (R$)` double NOT NULL,
  `duracao (h)` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.curso: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
REPLACE INTO `curso` (`id`, `nome`, `valor (R$)`, `duracao (h)`) VALUES
	(1, 'Python', 15, 25),
	(2, 'C#', 15, 20),
	(3, 'Lógica de Programação', 20, 25),
	(4, 'MySQL', 18, 25);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.professor
DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `nome` varchar(25) NOT NULL,
  `escola` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.professor: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
REPLACE INTO `professor` (`id`, `nome`, `escola`, `email`, `senha`) VALUES
	(1, 'Jonathan de Jesus Simões', 'ETEC Jd. Angela', 'jonathan.simoes01@etec.sp.gov.br', '123456789'),
	(2, 'Erika de Souza', 'ETEC Jd. Angela', 'erika.souza@etec.sp.gov.br', '987654321'),
	(3, 'Jefferson de Souza', 'ETEC Jd. Angela', 'jefferson.souza@etec.sp.gov.br', '159753654');
	(4, 'Priscila Miguel', 'ETEC Jd. Angela', 'priscila.miguel@etec.sp.gov.br', '125453239');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
