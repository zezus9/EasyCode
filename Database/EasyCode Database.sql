-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.25 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para easycode
DROP DATABASE IF EXISTS `easycode`;
CREATE DATABASE IF NOT EXISTS `easycode` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `easycode`;

-- Copiando estrutura para tabela easycode.aluno
DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `telefone` char(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `CPF` char(11) NOT NULL,
  `matricula` varchar(5) NOT NULL,
  `nasc` date NOT NULL,
  `avatar` varchar(10) NOT NULL,
  `linkedin` varchar(512) DEFAULT NULL,
  `github` varchar(512) DEFAULT NULL,
  `link_personalizado` varchar(512) DEFAULT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `avatar` (`avatar`),
  UNIQUE KEY `email_aluno` (`email`) USING BTREE,
  UNIQUE KEY `CPF` (`CPF`) USING BTREE,
  UNIQUE KEY `matricula` (`matricula`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela easycode.aluno: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
REPLACE INTO `aluno` (`id`, `nome`, `telefone`, `email`, `CPF`, `matricula`, `nasc`, `avatar`, `linkedin`, `github`, `link_personalizado`, `senha`) VALUES
	(001, 'Jonathan', '11999999999', 'jonathan.simoes01@etec.sp.gov.br', '00000000000', '01001', '2002-10-02', '01001.png', NULL, NULL, NULL, 'Aaa000');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.certificado
DROP TABLE IF EXISTS `certificado`;
CREATE TABLE IF NOT EXISTS `certificado` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_aluno` int(3) unsigned zerofill NOT NULL,
  `id_curso` int(3) unsigned zerofill NOT NULL,
  `id_responsavel` int(3) unsigned zerofill NOT NULL,
  `fase` int NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `pdf` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK-aluno` (`id_aluno`),
  KEY `FK-curso` (`id_curso`),
  KEY `FK-professor` (`id_responsavel`),
  CONSTRAINT `FK-aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  CONSTRAINT `FK-curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK-professor` FOREIGN KEY (`id_responsavel`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela easycode.certificado: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `certificado` DISABLE KEYS */;
REPLACE INTO `certificado` (`id`, `id_aluno`, `id_curso`, `id_responsavel`, `fase`, `data_inicio`, `data_fim`, `pdf`) VALUES
	(001, 001, 001, 001, 9, '2021-07-09', '2022-04-09', '001.pdf');
/*!40000 ALTER TABLE `certificado` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `logo` blob,
  `linguagem` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `campo` enum('FrontEnd','BackEnd','Database') NOT NULL,
  `fase` int NOT NULL,
  `duracao` int NOT NULL DEFAULT '0',
  `desc_breve` text NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela easycode.curso: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
REPLACE INTO `curso` (`id`, `logo`, `linguagem`, `campo`, `fase`, `duracao`, `desc_breve`, `descricao`) VALUES
	(001, _binary 0x69636F6E2D7068702E706E67, 'PHP', 'BackEnd', 9, 15, 'PHP é uma linguagem de script de uso geral popular que é especialmente adequada para desenvolvimento web.', 'PHP (um acrônimo recursivo para "PHP: Hypertext Preprocessor", originalmente Personal Home Page) é uma linguagem interpretada livre, usada originalmente apenas para o desenvolvimento de aplicações presentes e atuantes no lado do servidor, capazes de gerar conteúdo dinâmico na World Wide Web.[3] Figura entre as primeiras linguagens passíveis de inserção em documentos HTML, dispensando em muitos casos o uso de arquivos externos para eventuais processamentos de dados. O código é interpretado no lado do servidor pelo módulo PHP, que também gera a página web a ser visualizada no lado do cliente. A linguagem evoluiu, passou a oferecer funcionalidades em linha de comando, e além disso, ganhou características adicionais, que possibilitaram usos adicionais do PHP, não relacionados a web sites. É possível instalar o PHP na maioria dos sistemas operacionais, gratuitamente. Concorrente direto da tecnologia ASP pertencente à Microsoft, o PHP é utilizado em aplicações como o MediaWiki, Facebook, Drupal, Joomla!, WordPress, Magento e o Oscommerce.'),
	(002, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'JavaScript', 'FrontEnd', 10, 50, 'JavaScript é uma linguagem de programção de uso geral, aplicada principalmente para desenvolvimento web e desenvolvimento de software.', 'JavaScript (frequentemente abreviado como JS) é uma linguagem de programação interpretada estruturada, de script em alto nível com tipagem dinâmica fraca e multiparadigma (protótipos, orientado a objeto, imperativo e, funcional).[2][3] Juntamente com HTML e CSS, o JavaScript é uma das três principais tecnologias da World Wide Web. JavaScript permite páginas da Web interativas e, portanto, é uma parte essencial dos aplicativos da web. A grande maioria dos sites usa, e todos os principais navegadores têm um mecanismo JavaScript dedicado para executá-lo.[4]'),
	(003, _binary 0x69636F6E2D6D7973716C2E706E67, 'Mysql', 'Database', 7, 20, 'O MySQL é um sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL como interface.', 'O MySQL é um sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL como interface. É atualmente um dos sistemas de gerenciamento de bancos de dados mais populares da Oracle Corporation, com mais de 10 milhões de instalações pelo mundo'),
	(004, _binary 0x69636F6E2D6D7973716C2E706E67, 'HTML', 'FrontEnd', 10, 47, 'dnssj', 'for ($i=0; $i < count($FrontEnd); $i++){');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.professor
DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telefone` char(11) NOT NULL,
  `CPF` char(11) NOT NULL,
  `matricula` varchar(5) NOT NULL,
  `nasc` date NOT NULL,
  `avatar` varchar(10) NOT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_adm` (`email`) USING BTREE,
  UNIQUE KEY `CPF_adm` (`CPF`) USING BTREE,
  UNIQUE KEY `matricula_adm` (`matricula`) USING BTREE,
  UNIQUE KEY `avatar` (`avatar`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela easycode.professor: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
REPLACE INTO `professor` (`id`, `nome`, `email`, `telefone`, `CPF`, `matricula`, `nasc`, `avatar`, `senha`) VALUES
	(001, 'Jonathan', 'jonathan.simoes01@etec.sp.gov.br', '11999999999', '0000000000', '00001', '2002-10-02', '00001.png', 'Aaa000');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
