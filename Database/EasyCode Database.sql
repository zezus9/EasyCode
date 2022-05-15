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


-- Copiando estrutura do banco de dados para easycode
DROP DATABASE IF EXISTS `easycode`;
CREATE DATABASE IF NOT EXISTS `easycode` /*!40100 DEFAULT CHARACTER SET latin1 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.aluno: ~0 rows (aproximadamente)
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
  `fase` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.certificado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `certificado` DISABLE KEYS */;
REPLACE INTO `certificado` (`id`, `id_aluno`, `id_curso`, `id_responsavel`, `fase`, `data_inicio`, `data_fim`, `pdf`) VALUES
	(001, 001, 001, 001, 9, '2021-07-09', '2022-04-09', '001.pdf');
/*!40000 ALTER TABLE `certificado` ENABLE KEYS */;

-- Copiando estrutura para tabela easycode.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `logo` blob,
  `linguagem` varchar(40) NOT NULL,
  `campo` enum('FrontEnd','BackEnd','Database') NOT NULL,
  `fase` int(11) NOT NULL,
  `duracao` int(11) NOT NULL DEFAULT '0',
  `desc_breve` text NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.curso: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
REPLACE INTO `curso` (`id`, `logo`, `linguagem`, `campo`, `fase`, `duracao`, `desc_breve`, `descricao`) VALUES
	(001, _binary 0x69636F6E2D7068702E706E67, 'PHP', 'BackEnd', 9, 15, 'PHP é uma linguagem de script popular que é especialmente adequada para desenvolvimento web.', 'Usada originalmente apenas para o desenvolvimento de aplicações presentes e atuantes no lado do servidor, capazes de gerar conteúdo dinâmico na World Wide Web.\r\nFigura entre as primeiras linguagens passíveis de inserção em documentos HTML, dispensando em muitos casos o uso de arquivos externos para eventuais \r\nprocessamentos de dados.'),
	(002, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'JavaScript', 'FrontEnd', 10, 30, 'JavaScript é uma linguagem de script aplicado principalmente para desenvolvimento web.', 'JavaScript é uma linguagem de programação interpretada estruturada, de script em alto nível com tipagem dinâmica fraca e multiparadigma. Juntamente com HTML e\r\nCSS, o JavaScript é uma das três principais tecnologias da World Wide Web. JavaScript permite páginas da Web interativas e, portanto, é uma parte essencial dos \r\naplicativos da web. A grande maioria dos sites usa, e todos os principais navegadores têm um mecanismo JavaScript dedicado para executá-lo.'),
	(003, _binary 0x69636F6E2D6D7973716C2E706E67, 'Mysql', 'Database', 7, 20, 'O MySQL é um sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL.', 'O sistema foi desenvolvido pela empresa sueca MySQL AB e publicado, originalmente, em maio de 1995. Após, a empresa foi comprada pela Sun Microsystems e, em \r\njaneiro de 2010, integrou a transação bilionária da compra da Sun pela Oracle Corporation.'),
	(004, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'HTML', 'FrontEnd', 10, 25, 'Linguagem de Marcação usada para o desenvolvimento Web voltada para a parte semântica da página.', 'Criada pelo britânico Tim Berners-Lee, o acrônimo HTML significa HiperText Markup Language, traduzindo ao português: Linguagem de Marcação de Hipertexto.  O \r\nHTML é o componente básico da web, ele permite inserir o conteúdo e estabelecer a estrutura básica de um website.'),
	(005, _binary 0x69636F6E2D7068702E706E67, 'Python', 'BackEnd', 16, 30, 'Linguagem de Programação que prioriza a legibilidade do código e é ótima para inciantes.', 'Python é uma linguagem de programação de alto nível, interpretada de script, imperativa, orientada a objetos, funcional, de tipagem dinâmica e forte.'),
	(006, _binary 0x69636F6E2D7068702E706E67, 'Ruby', 'BackEnd', 12, 25, 'Ruby suporta programação funcional, orientada a objetos, entre outras. Inspirada em Python.', 'Ruby é uma linguagem de programação interpretada multiparadigma, de tipagem dinâmica e forte, com gerenciamento de memória automático, originalmente \r\nplanejada e desenvolvida no Japão em 1995.'),
	(007, _binary 0x69636F6E2D7068702E706E67, 'Java', 'BackEnd', 15, 25, 'Java é uma linguagem de programação orientada a objetos desenvolvida na década de 90.', 'Diferente das linguagens de programação modernas, que são compiladas para código nativo, a linguagem Java é compilada para um bytecode que é interpretado por \r\numa máquina virtual (Java Virtual Machine, mais conhecida pela sua abreviação JVM).'),
	(008, _binary 0x69636F6E2D7068702E706E67, 'CSharp', 'BackEnd', 14, 30, 'C# é uma linguagem de programação, de tipagem forte, desenvolvida pela Microsoft.', 'A sua sintaxe orientada a objetos foi baseada no C++ mas inclui muitas influências de outras linguagens de programação, como Object Pascal e, principalmente, Java. \r\nO código fonte é compilado para Common Intermediate Language (CIL) que é interpretado pela máquina virtual Common Language Runtime (CLR).'),
	(009, _binary 0x69636F6E2D7068702E706E67, 'C++', 'BackEnd', 15, 30, 'C++ é uma linguagem de programação compilada multi-paradigma e de uso geral.', 'Bjarne Stroustrup desenvolveu o C++ em 1983 no Bell Labs como um adicional à linguagem C. Novas características foram adicionadas com o tempo, como funções \r\nvirtuais, sobrecarga de operadores, herança múltipla, gabaritos e tratamento de exceções.'),
	(010, _binary 0x69636F6E2D7068702E706E67, 'C', 'BackEnd', 12, 25, 'C é uma linguagem de programação compilada de propósito geral, estruturada, imperativa, procedural.', 'C é uma das linguagens de programação mais populares e existem poucas arquiteturas para as quais não existem compiladores para C. C tem influenciado muitas \r\noutras linguagens de programação (por exemplo, a linguagem Java), mais notavelmente C++, que originalmente começou como uma extensão para C.'),
	(011, _binary 0x69636F6E2D7068702E706E67, 'JavaScript (NodeJS)', 'BackEnd', 15, 30, 'Linguagem de Script usada principalmente focado na iteratividade da página web.', 'Node.js é um fenômeno tem vários anos já. Diversos players gigantes da indústria de Internet tem adotado a plataforma, seja como uma ferramenta auxiliar, seja como \r\nsua principal tecnologia. O fato é que funciona, é eficiente e eficaz.'),
	(012, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'CSS', 'FrontEnd', 10, 25, 'CSS é um mecanismo para adicionar estilo (cores, fontes, espaçamento, etc.) a um documento web', 'CSS tem uma sintaxe simples, e utiliza uma série de palavras em inglês para especificar os nomes de diferentes propriedade de estilo de uma página.'),
	(013, _binary 0x69636F6E2D7068702E706E67, 'TypeScript', 'BackEnd', 10, 20, 'TypeScript é uma linguagem de programação de código aberto desenvolvida pela Microsoft.', 'TypeScript oferece suporte a arquivos de definição que podem conter informações de tipo de bibliotecas JavaScript existentes, assim como arquivos de cabeçalho C ++ \r\npodem descrever a estrutura de arquivos de objeto existentes.'),
	(014, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'Angular', 'FrontEnd', 9, 15, 'Angular é uma plataforma para a construção de aplicações mobile e web.', 'Angular é uma plataforma de aplicações web de código-fonte aberto e front-end baseado em TypeScript liderado pela Equipe Angular do Google e por uma comunidade de \r\nindivíduos e corporações.'),
	(016, _binary 0x69636F6E2D6A6176617363726970742E706E67, 'Bootstrap', 'FrontEnd', 12, 20, 'É o framework mais popular no mundo para o desenvolvimento de páginas web responsivas.', 'Bootstrap é um framework web com código-fonte aberto para desenvolvimento de componentes de interface e front-end para sites e aplicações web usando HTML, CSS e JavaScript, baseado em modelos de design para a tipografia, melhorando a experiência do usuário em um site amigável e responsivo.'),
	(017, _binary 0x69636F6E2D6D7973716C2E706E67, 'SQL', 'Database', 15, 30, 'SQL é a linguagem de pesquisa declarativa padrão para banco de dados relacional.', 'O SQL foi desenvolvido originalmente no início dos anos 70 nos laboratórios da IBM em San Jose, dentro do projeto System R, que tinha por objetivo demonstrar a \r\nviabilidade da implementação do modelo relacional proposto por E. F. Codd. O nome original da linguagem era SEQUEL, acrônimo para "Structured English Query \r\nLanguage" (Linguagem de Consulta Estruturada, em Inglês).'),
	(018, _binary 0x69636F6E2D6D7973716C2E706E67, 'NoSQL', 'Database', 10, 25, 'NoSQL é um termo genérico que representa os bancos de dados não relacionais.', 'Bancos de dados não relacionais existem desde o final da década de 1960, mas não obtiveram o apelido de "NoSQL" até atingirem sua onda de popularidade no início \r\ndo século vinte e um, desencadeada pelas necessidades das empresas de Web 2.0 como Facebook, Google e Amazon.com.'),
	(019, _binary 0x69636F6E2D6D7973716C2E706E67, 'SQL Server', 'Database', 15, 30, 'É um sistema gerenciador de Banco de Dados desenvolvido pela Sybase em parceria com a Microsoft.', 'Mantido pela Microsoft há anos, é um dos principais SGBDs relacionais do mercado. Distribuído em diferentes edições e com várias ferramentas integradas, esse banco \r\né capaz de atender às demandas desde os mais simples negócios até os mais complexos cenários que lidam com grande volume de dados.'),
	(020, _binary 0x69636F6E2D6D7973716C2E706E67, 'Excel', 'Database', 12, 20, 'O Microsoft Excel é um programa para manipulação de planilhas e gerenciamento de dados.', 'Seus recursos incluem uma interface intuitiva e capacitadas ferramentas de cálculo e de construção de tabelas que, juntamente com marketing agressivo, tornaram o \r\nExcel um dos mais populares aplicativos de computador até hoje.'),
	(021, _binary 0x69636F6E2D6D7973716C2E706E67, 'PostgreSQL', 'Database', 12, 25, 'O PostgreSQL é uma ferramenta que atua como sistema de gerenciamento de bancos de dados relacionados.', 'PostgreSQL é um gerenciador de banco de dados relacionados que otimiza muito o trabalho de quem precisa administrar informações nesses níveis.'),
	(022, _binary 0x69636F6E2D7068702E706E67, 'Lógica de Programação', 'BackEnd', 15, 25, 'Essêncial para um iniciante, pode ser aplicado à todas as linguagens de programação.', 'Lógica de programação é a organização coesa de uma sequência de instruções voltadas à resolução de um problema, ou à criação de um software ou aplicação.');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela easycode.professor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
REPLACE INTO `professor` (`id`, `nome`, `email`, `telefone`, `CPF`, `matricula`, `nasc`, `avatar`, `senha`) VALUES
	(001, 'Jonathan', 'jonathan.simoes01@etec.sp.gov.br', '11999999999', '0000000000', '00001', '2002-10-02', '00001.png', 'Aaa000');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
