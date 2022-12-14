-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.33 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela easycode.aluno
DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int(3) unsigned zerofill NOT NULL,
  `nome` varchar(40) NOT NULL,
  `telefone` char(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `CPF` char(11) NOT NULL,
  `matricula` varchar(6) NOT NULL,
  `nasc` date NOT NULL,
  `avatar` varchar(15) NOT NULL,
  `linkedin` varchar(512) DEFAULT NULL,
  `github` varchar(512) DEFAULT NULL,
  `link_personalizado` varchar(512) DEFAULT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_aluno` (`email`) USING BTREE,
  UNIQUE KEY `CPF` (`CPF`) USING BTREE,
  UNIQUE KEY `matricula` (`matricula`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.aluno: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
REPLACE INTO `aluno` (`id`, `nome`, `telefone`, `email`, `CPF`, `matricula`, `nasc`, `avatar`, `linkedin`, `github`, `link_personalizado`, `senha`) VALUES
	(001, 'Jonathan de Jesus Simões', '11999999999', 'jonathan.simoes01@etec.sp.gov.br', '00000000000', '022001', '2002-10-02', '022001.png', 'https://www.linkedin.com/in/jonathan-de-jesus9/', 'https://github.com/zezus9', '', 'Aaa000'),
	(002, 'Erika Nunes', '11888888888', 'erika.nunes@etec.sp.gov.br', '31515998002', '022002', '2002-02-28', 'd_img.png', NULL, NULL, NULL, 'Bbb111'),
	(003, 'Jefferson Gomes', '11777777777', 'jefferson@etec.sp.gov.br', '22297238045', '022003', '2005-12-13', 'd_img.png', NULL, NULL, NULL, 'Ccc222'),
	(004, 'Priscila Miguel', '11666666666', 'priscila@etec.sp.gov.br', '83652788044', '022004', '2003-03-05', 'd_img.png', NULL, NULL, NULL, 'Ddd333');
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.certificado
DROP TABLE IF EXISTS `certificado`;
CREATE TABLE IF NOT EXISTS `certificado` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_aluno` int(3) unsigned zerofill NOT NULL,
  `id_curso` int(3) unsigned zerofill NOT NULL,
  `id_responsavel` int(3) unsigned zerofill NOT NULL,
  `fase` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `status` enum('INICIADO','TERMINADO') NOT NULL DEFAULT 'INICIADO',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK-aluno` (`id_aluno`),
  KEY `FK-curso` (`id_curso`),
  KEY `FK-professor` (`id_responsavel`),
  CONSTRAINT `FK-aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  CONSTRAINT `FK-curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK-professor` FOREIGN KEY (`id_responsavel`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.certificado: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `certificado` DISABLE KEYS */;
REPLACE INTO `certificado` (`id`, `id_aluno`, `id_curso`, `id_responsavel`, `fase`, `data_inicio`, `data_fim`, `status`) VALUES
	(001, 001, 001, 001, 9, '2021-07-09', '2022-04-09', 'TERMINADO'),
	(002, 001, 007, 001, 15, '2022-05-21', '2022-05-21', 'TERMINADO'),
	(007, 001, 002, 001, 8, '2022-06-05', NULL, 'INICIADO'),
	(008, 001, 010, 001, 3, '2022-06-05', NULL, 'INICIADO'),
	(009, 001, 003, 001, 3, '2022-06-05', NULL, 'INICIADO'),
	(010, 001, 022, 001, 5, '2022-06-05', NULL, 'INICIADO'),
	(011, 001, 016, 001, 2, '2022-06-05', NULL, 'INICIADO'),
	(012, 001, 009, 001, 1, '2022-06-15', NULL, 'INICIADO'),
	(013, 001, 012, 001, 1, '2022-06-18', NULL, 'INICIADO'),
	(014, 001, 021, 001, 1, '2022-06-18', NULL, 'INICIADO'),
	(015, 001, 005, 001, 13, '2022-06-18', '2022-06-23', 'TERMINADO');
/*!40000 ALTER TABLE `certificado` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_responsavel` int(3) unsigned zerofill NOT NULL,
  `logo` blob,
  `linguagem` varchar(40) NOT NULL,
  `campo` enum('FrontEnd','BackEnd','Database') NOT NULL,
  `fase` int(11) NOT NULL,
  `duracao` int(11) NOT NULL DEFAULT '0',
  `desc_breve` text NOT NULL,
  `fases` varchar(500) DEFAULT NULL,
  `status` enum('SIM','NÃO') NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK-responsavel` (`id_responsavel`),
  CONSTRAINT `FK-responsavel` FOREIGN KEY (`id_responsavel`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.curso: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
REPLACE INTO `curso` (`id`, `id_responsavel`, `logo`, `linguagem`, `campo`, `fase`, `duracao`, `desc_breve`, `fases`, `status`) VALUES
	(001, 001, _binary 0x69636F6E2D7068702E706E67, 'PHP', 'BackEnd', 9, 15, 'PHP é uma linguagem de script popular que é especialmente adequada para desenvolvimento web.', NULL, 'NÃO'),
	(002, 001, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'JavaScript', 'FrontEnd', 10, 30, 'JavaScript é uma linguagem de script aplicado principalmente para desenvolvimento web.', NULL, 'NÃO'),
	(003, 001, _binary 0x69636F6E2D6D7973716C2E706E67, 'MySQL', 'Database', 7, 20, 'O MySQL é um sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL.', NULL, 'NÃO'),
	(004, 001, _binary 0x69636F6E2D68746D6C2E706E67, 'HTML', 'FrontEnd', 10, 25, 'Linguagem de Marcação usada para o desenvolvimento Web voltada para a parte semântica da página.', NULL, 'NÃO'),
	(005, 001, _binary 0x69636F6E2D707974686F6E2E706E67, 'Python', 'BackEnd', 13, 30, 'Linguagem de Programação que prioriza a legibilidade do código e é ótima para inciantes.', 'Introdução - O que é Python?._.\nTipos de Dados._.\nVariáveis._.\nInserindo Comentários._.\nFUNÇÃO._.\nOperadores._.\nIndentação Python._.\nEstrutura de decisão._.\nEstrutura de repetição._.\nQuestão 1._.\nQuestão 2._.\nQuestão 3._.\nCadê a porta?', 'SIM'),
	(006, 001, _binary 0x69636F6E2D727562792E706E67, 'Ruby', 'BackEnd', 12, 25, 'Ruby suporta programação funcional, orientada a objetos, entre outras. Inspirada em Python.', NULL, 'NÃO'),
	(007, 001, _binary 0x69636F6E2D6A6176612E706E67, 'Java', 'BackEnd', 15, 25, 'Java é uma linguagem de programação orientada a objetos desenvolvida na década de 90.', NULL, 'NÃO'),
	(008, 001, _binary 0x69636F6E2D6373686172702E706E67, 'C#', 'BackEnd', 14, 30, 'C# é uma linguagem de programação, de tipagem forte, desenvolvida pela Microsoft.', NULL, 'NÃO'),
	(009, 001, _binary 0x69636F6E2D63706C7573706C75732E706E67, 'C++', 'BackEnd', 15, 30, 'C++ é uma linguagem de programação compilada multi-paradigma e de uso geral.', NULL, 'NÃO'),
	(010, 001, _binary 0x69636F6E2D632E706E67, 'C', 'BackEnd', 12, 25, 'C é uma linguagem de programação compilada de propósito geral, estruturada, imperativa, procedural.', NULL, 'NÃO'),
	(011, 001, _binary 0x69636F6E2D6E6F64656A732E706E67, 'JavaScript (NodeJS)', 'BackEnd', 15, 30, 'Linguagem de Script principalmente focado na iteratividade da página web.', NULL, 'NÃO'),
	(012, 001, _binary 0x69636F6E2D6373732E706E67, 'CSS', 'FrontEnd', 10, 25, 'CSS é um mecanismo para adicionar estilo (cores, fontes, espaçamento, etc.) a um documento web', NULL, 'NÃO'),
	(013, 001, _binary 0x69636F6E2D747970657363726970742E706E67, 'TypeScript', 'BackEnd', 10, 20, 'TypeScript é uma linguagem de programação de código aberto desenvolvida pela Microsoft.', NULL, 'NÃO'),
	(014, 001, _binary 0x69636F6E2D616E67756C61722E706E67, 'Angular', 'FrontEnd', 9, 15, 'Angular é uma plataforma para a construção de aplicações mobile e web.', NULL, 'NÃO'),
	(016, 001, _binary 0x69636F6E2D626F6F7473747261702E706E67, 'Bootstrap', 'FrontEnd', 12, 20, 'É o framework mais popular no mundo para o desenvolvimento de páginas web responsivas.', NULL, 'NÃO'),
	(017, 001, _binary 0x69636F6E2D73716C2E706E67, 'SQL', 'Database', 15, 30, 'SQL é a linguagem de pesquisa declarativa padrão para banco de dados relacional.', NULL, 'NÃO'),
	(018, 001, _binary 0x69636F6E2D6E6F73716C2E706E67, 'NoSQL', 'Database', 10, 25, 'NoSQL é um termo genérico que representa os bancos de dados não relacionais.', NULL, 'NÃO'),
	(019, 001, _binary 0x69636F6E2D73716C7365727665722E706E67, 'SQL Server', 'Database', 15, 30, 'É um sistema gerenciador de Banco de Dados desenvolvido pela Sybase em parceria com a Microsoft.', NULL, 'NÃO'),
	(020, 001, _binary 0x69636F6E2D657863656C2E706E67, 'Excel', 'Database', 12, 20, 'O Microsoft Excel é um programa para manipulação de planilhas e gerenciamento de dados.', NULL, 'NÃO'),
	(021, 001, _binary 0x69636F6E2D706F73746772652E706E67, 'PostgreSQL', 'Database', 12, 25, 'O PostgreSQL é uma ferramenta que atua como sistema de gerenciamento de bancos de dados relacionados.', NULL, 'NÃO'),
	(022, 001, _binary 0x69636F6E2D6C6F67696361646570726F6772616D6163616F2E706E67, 'Lógica de Programação', 'BackEnd', 15, 25, 'Essêncial para um iniciante, pode ser aplicado à todas as linguagens de programação.', NULL, 'NÃO');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.professor
DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(3) unsigned zerofill NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telefone` char(11) NOT NULL,
  `CPF` char(11) NOT NULL,
  `matricula` varchar(6) NOT NULL,
  `nasc` date NOT NULL,
  `avatar` varchar(15) NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `linkedin` varchar(512) DEFAULT NULL,
  `github` varchar(512) DEFAULT NULL,
  `link_personalizado` varchar(512) DEFAULT NULL,
  `senha` varchar(15) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_adm` (`email`) USING BTREE,
  UNIQUE KEY `CPF_adm` (`CPF`) USING BTREE,
  UNIQUE KEY `matricula_adm` (`matricula`) USING BTREE,
  UNIQUE KEY `avatar` (`avatar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.professor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
REPLACE INTO `professor` (`id`, `nome`, `email`, `telefone`, `CPF`, `matricula`, `nasc`, `avatar`, `descricao`, `linkedin`, `github`, `link_personalizado`, `senha`) VALUES
	(001, 'Jonathan de Jesus Simões', 'jonathan.simoes@gmail.com', '11999999999', '0000000000', '122001', '2002-10-02', 'd_img.png', 'cassacsacsacascsacasc\r\ncasnclskacsaklcas\r\ncasmcsklacalkscnsacas', 'http://localhost/EasyCode/src/php/perfil.php', 'http://localhost/EasyCode/src/php/perfil.php', 'http://localhost/EasyCode/src/php/perfil.php', 'Aaa000');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
