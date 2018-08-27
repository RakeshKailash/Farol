-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: farol
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aulas`
--

DROP TABLE IF EXISTS `aulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aulas` (
  `idaula` int(11) NOT NULL AUTO_INCREMENT,
  `idturma` int(11) NOT NULL,
  `idprofessor` int(11) NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Cancelada; 1 = Ativa;',
  PRIMARY KEY (`idaula`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aulas`
--

LOCK TABLES `aulas` WRITE;
/*!40000 ALTER TABLE `aulas` DISABLE KEYS */;
INSERT INTO `aulas` VALUES (1,8,1,'Aula de teste',1),(2,8,2,'Aula de reforço',1),(3,4,2,'Aula de Revisão T2',1),(4,3,2,'Aula de Avaliação',1),(5,7,1,'Teste',1),(6,7,1,'Teste',1),(7,6,1,'Teste 2',1),(8,12,1,'Teste Testoso',1),(9,14,3,'Aula 1/1',1),(10,12,3,'Teste de Agulhas',1),(11,1,3,'Reiki I e II',1),(12,1,3,'Reiki I e II (Segunda chamada)',1),(13,1,3,'Reiki I e II (Terceira chamada)',1),(14,1,3,'Reiki I e II (Quarta chamada)',1);
/*!40000 ALTER TABLE `aulas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Reiki I e II Intensivo','Aqui vai a descrição do curso, muitas palavras.',1),(2,'Terapeuta Holístico','Abraçando a saúde, de ponta a ponta',1),(3,'Mesa Radiônica Quântica Rosa','Lorem ipsum dolor sit amet',1),(4,'Acupuntura','Prática milenar da MTC',1),(5,'Barras de Access','É uma técnica de barras de access',1);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos_opcoes`
--

DROP TABLE IF EXISTS `cursos_opcoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos_opcoes` (
  `idopcao` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `num_opcao` int(11) NOT NULL,
  PRIMARY KEY (`idopcao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos_opcoes`
--

LOCK TABLES `cursos_opcoes` WRITE;
/*!40000 ALTER TABLE `cursos_opcoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos_opcoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dias_eventos`
--

DROP TABLE IF EXISTS `dias_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dias_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idevento` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL,
  `almoco_inicio` datetime DEFAULT NULL,
  `almoco_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias_eventos`
--

LOCK TABLES `dias_eventos` WRITE;
/*!40000 ALTER TABLE `dias_eventos` DISABLE KEYS */;
INSERT INTO `dias_eventos` VALUES (46,18,'2018-10-13 09:00:00','2018-10-13 18:00:00',NULL,NULL),(47,21,'2018-09-17 09:00:00','2018-09-17 18:30:00',NULL,NULL),(48,22,'2018-09-15 09:00:00','2018-09-15 18:00:00','2018-09-15 12:30:00','2018-09-15 14:00:00'),(49,23,'2018-10-03 09:00:00','2018-10-03 18:30:00',NULL,NULL);
/*!40000 ALTER TABLE `dias_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `idevento` int(11) NOT NULL AUTO_INCREMENT,
  `idprofessor` int(11) DEFAULT NULL,
  `idturma` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT '1' COMMENT '1=Aula; 2=Outros;',
  `nome` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `taxa` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prazo_inscricao` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Cancelado; 1 = Agendado;',
  PRIMARY KEY (`idevento`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (18,3,22,1,'Aula Inaugural','<p><strong>Certificado Internacional de Terapeuta de Facelift Energético Access Consciousness®\r\n</strong></p><p><strong>\r\n</strong></p><p><strong>– Como seria você nutrir seu corpo ao invés de julgá-lo?\r\n</strong></p><p><strong>– Como seria liberar os julgamentos que você tem sobre você e seu corpo?\r\n</strong></p>\r\n<p>Access Facelift Energético® é um dos processos corporais de Access Consciousness™ criado por Gary Douglas. É uma técnica que envolve a ativação de 29 frequências energéticas que desbloqueiam o fluxo energético do corpo, suavizando linhas, rugas e flacidez facial. Usando as mãos como neurotransmissoras, o toque suave é aplicado na face, pescoço e colo, liberando estresse, pontos de vista fixos, julgamentos e conclusões que causam o envelhecimento do nosso corpo. Que crenças você tem sobre envelhecer e como seu corpo vai envelhecer?\r\n</p>\r\n<p>Quando participamos de um curso onde trabalhamos nossos corpos, começamos a receber e reconhecer os talentos, dons e habilidades que possuímos e que nossos corpos possuem. Assim, podemos ter uma relação diferente com nossos corpos e com o mundo. Quando temos muitos pontos de vista fixos, estes causam estagnação deixando \"marcas\" no corpo, o que acaba impedindo o fluxo energético natural e saudável. O Facelift® ajuda a mudar os pontos de vista e julgamentos que estão travados no corpo, desfazendo-os. Com a energia fluindo, os músculos começam a relaxar, recuperando a vitalidade. Ao nos liberarmos de julgamentos, nos tornamos internamente e externamente mais jovens, pois ficamos mais leves e abertos às infinitas possibilidades. O Facelift Energético® é indicado para bruxismo, questões relacionadas a baixa-estima, auto-julgamento, pessoas que sofreram bullying, traumas etc.</p><br><p><strong>Público Alvo:</strong> Terapeutas e pessoas que queiram aplicar a técnica em benefício próprio e de outros.\r\n</p>\r\n<p><strong>Carga Horária e Conteúdo:</strong> O curso é composto de 6 horas com parte teórica e parte prática, onde cada aluno aplica e recebe 2 sessões de Facelift®. Ao final do curso, o aluno recebe o certificado válido em qualquer país onde queira atuar como terapeuta de Facelift Energético Access Consciousness®.\r\n</p>\r\n<p><strong>– Vagas Limitadas –\r\n</strong></p>\r\n<p><strong>Facilitadora\r\n</strong></p><p>Zuleika Escobar (Porto Alegre/RS) – Terapeuta e Facilitadora licenciada de Barras de Access®, Access Facelift Energético® e Processos Corporais Access Consciousness®. Terapeuta ThetaHealing® (DNA3®, Aprofundando no Digging®, Você e o Criador®, Anatomia Intuitiva®). Master Reiki. www.zuescobar.wixsite.com\r\n</p>\r\n<p><strong>Informações\r\n</strong></p><p><strong></strong>e-mail: <strong><u>secretaria@farolterapeutico.com.br\r\n</u></strong></p><p><strong></strong>fones: <u style=\"font-weight: bold;\">53. 3325 0002</u> / <u style=\"font-weight: bold;\">98468 5163</u> (oi/whatsapp) / <u style=\"font-weight: bold;\">99131 9062</u> (claro)</p>',0.00,NULL,1),(21,2,15,1,'Aula 1/1','<p><strong>Certificado Internacional de Terapeuta de Facelift Energético Access Consciousness®\r\n</strong></p><p><strong>\r\n</strong></p><p><strong>– Como seria você nutrir seu corpo ao invés de julgá-lo?\r\n</strong></p><p><strong>– Como seria liberar os julgamentos que você tem sobre você e seu corpo?\r\n</strong></p>\r\n<p>Access Facelift Energético® é um dos processos corporais de Access Consciousness™ criado por Gary Douglas. É uma técnica que envolve a ativação de 29 frequências energéticas que desbloqueiam o fluxo energético do corpo, suavizando linhas, rugas e flacidez facial. Usando as mãos como neurotransmissoras, o toque suave é aplicado na face, pescoço e colo, liberando estresse, pontos de vista fixos, julgamentos e conclusões que causam o envelhecimento do nosso corpo. Que crenças você tem sobre envelhecer e como seu corpo vai envelhecer?\r\n</p>\r\n<p>Quando participamos de um curso onde trabalhamos nossos corpos, começamos a receber e reconhecer os talentos, dons e habilidades que possuímos e que nossos corpos possuem. Assim, podemos ter uma relação diferente com nossos corpos e com o mundo. Quando temos muitos pontos de vista fixos, estes causam estagnação deixando \"marcas\" no corpo, o que acaba impedindo o fluxo energético natural e saudável. O Facelift® ajuda a mudar os pontos de vista e julgamentos que estão travados no corpo, desfazendo-os. Com a energia fluindo, os músculos começam a relaxar, recuperando a vitalidade. Ao nos liberarmos de julgamentos, nos tornamos internamente e externamente mais jovens, pois ficamos mais leves e abertos às infinitas possibilidades. O Facelift Energético® é indicado para bruxismo, questões relacionadas a baixa-estima, auto-julgamento, pessoas que sofreram bullying, traumas etc.</p><br><p><strong>Público Alvo:</strong> Terapeutas e pessoas que queiram aplicar a técnica em benefício próprio e de outros.\r\n</p>\r\n<p><strong>Carga Horária e Conteúdo:</strong> O curso é composto de 6 horas com parte teórica e parte prática, onde cada aluno aplica e recebe 2 sessões de Facelift®. Ao final do curso, o aluno recebe o certificado válido em qualquer país onde queira atuar como terapeuta de Facelift Energético Access Consciousness®.\r\n</p>\r\n<p><strong>– Vagas Limitadas –\r\n</strong></p>\r\n<p><strong>Facilitadora\r\n</strong></p><p>Zuleika Escobar (Porto Alegre/RS) – Terapeuta e Facilitadora licenciada de Barras de Access®, Access Facelift Energético® e Processos Corporais Access Consciousness®. Terapeuta ThetaHealing® (DNA3®, Aprofundando no Digging®, Você e o Criador®, Anatomia Intuitiva®). Master Reiki. www.zuescobar.wixsite.com\r\n</p>\r\n<p><strong>Informações\r\n</strong></p><p><strong></strong>e-mail: <strong><u>secretaria@farolterapeutico.com.br\r\n</u></strong></p><p><strong></strong>fones: <u style=\"font-weight: bold;\">53. 3325 0002</u> / <u style=\"font-weight: bold;\">98468 5163</u> (oi/whatsapp) / <u style=\"font-weight: bold;\">99131 9062</u> (claro)</p>',0.00,NULL,1),(22,3,23,1,'',NULL,0.00,NULL,1),(23,1,7,1,'Aula de Teste de Formatação','<p><strong><u>Aula de Teste</u></strong></p>',0.00,NULL,1);
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_investimento`
--

DROP TABLE IF EXISTS `forma_investimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_investimento` (
  `idinvestimento` int(11) NOT NULL AUTO_INCREMENT,
  `idturma` int(11) NOT NULL,
  `forma` int(11) NOT NULL DEFAULT '1' COMMENT '1 = À vista; 2 = Parcelado Farol; 3 = Mensalidade; 4 = Cartão;',
  `parcelas` int(11) DEFAULT '1',
  `valor_parcela` decimal(13,2) DEFAULT NULL,
  `total` decimal(13,2) NOT NULL,
  `dia_vencimento` int(11) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Matrícula; 2 = Mensalidade;',
  PRIMARY KEY (`idinvestimento`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_investimento`
--

LOCK TABLES `forma_investimento` WRITE;
/*!40000 ALTER TABLE `forma_investimento` DISABLE KEYS */;
INSERT INTO `forma_investimento` VALUES (1,8,1,1,NULL,180.00,NULL,'2018-09-10',1),(2,8,3,2,100.00,200.00,10,NULL,1),(3,11,3,20,330.00,6600.00,2,NULL,1),(4,12,3,20,330.00,6600.00,2,NULL,1),(5,13,1,1,NULL,180.00,NULL,'2018-10-07',1),(6,14,1,1,NULL,180.00,NULL,'2018-10-10',1),(7,14,3,3,70.00,210.00,7,NULL,1),(8,15,1,1,NULL,400.00,NULL,'2018-09-10',1),(9,15,3,3,140.00,420.00,5,NULL,1),(12,17,1,1,NULL,180.00,NULL,'2018-09-10',1),(13,17,3,3,70.00,210.00,10,NULL,1),(14,18,1,1,NULL,180.00,NULL,'2018-09-10',1),(15,18,3,3,70.00,210.00,10,NULL,1),(16,21,1,1,NULL,180.00,NULL,'2018-09-10',1),(17,21,2,3,70.00,210.00,NULL,NULL,1),(18,22,3,18,450.00,8100.00,10,NULL,1),(19,22,1,1,NULL,8100.00,NULL,'2018-09-10',1),(20,22,4,1,NULL,8100.00,NULL,NULL,1),(21,23,1,1,NULL,180.00,NULL,'2018-09-10',1),(22,23,2,6,35.00,100.00,NULL,NULL,1),(23,23,4,1,NULL,120.00,NULL,NULL,1);
/*!40000 ALTER TABLE `forma_investimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscricoes`
--

DROP TABLE IF EXISTS `inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscricoes` (
  `idinscricao` int(11) NOT NULL AUTO_INCREMENT,
  `idevento` int(11) DEFAULT NULL,
  `idturma` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `data_ingresso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opcao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Aguardando; 2 = Confirmada; 3 = Cancelada;',
  PRIMARY KEY (`idinscricao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricoes`
--

LOCK TABLES `inscricoes` WRITE;
/*!40000 ALTER TABLE `inscricoes` DISABLE KEYS */;
INSERT INTO `inscricoes` VALUES (1,18,1,1,'2018-08-06 10:19:43',NULL,1),(2,NULL,2,5,'2018-08-20 18:21:55',NULL,1),(3,NULL,12,1,'2018-08-20 18:22:06',NULL,1),(4,NULL,18,7,'2018-08-20 18:22:59',NULL,1),(5,NULL,23,1,'2018-08-23 10:41:44',NULL,1),(6,NULL,23,1,'2018-08-27 09:25:55',NULL,1);
/*!40000 ALTER TABLE `inscricoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `investimentos_inscricoes`
--

DROP TABLE IF EXISTS `investimentos_inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `investimentos_inscricoes` (
  `idinvestimento` int(11) NOT NULL AUTO_INCREMENT,
  `idinscricao` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idforma` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parcelas` int(11) DEFAULT '1',
  PRIMARY KEY (`idinvestimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `investimentos_inscricoes`
--

LOCK TABLES `investimentos_inscricoes` WRITE;
/*!40000 ALTER TABLE `investimentos_inscricoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `investimentos_inscricoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loadfiles`
--

DROP TABLE IF EXISTS `loadfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loadfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `place` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '3' COMMENT '1 Site | 2 Sistema | 3 Common',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loadfiles`
--

LOCK TABLES `loadfiles` WRITE;
/*!40000 ALTER TABLE `loadfiles` DISABLE KEYS */;
INSERT INTO `loadfiles` VALUES (1,'https://code.jquery.com/jquery-3.3.1.min.js','3'),(2,'css/system.css','2'),(3,'css/reset.css','3'),(4,'css/font_loader.css','3'),(5,'js/main.js','3'),(6,'js/materialize.js','3'),(7,'css/materialize.css','3'),(8,'js/jquery.mask.min.js','3');
/*!40000 ALTER TABLE `loadfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parcelas_investimentos`
--

DROP TABLE IF EXISTS `parcelas_investimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parcelas_investimentos` (
  `idparcela` int(11) NOT NULL AUTO_INCREMENT,
  `idinvestimento` int(11) NOT NULL,
  `valor` decimal(13,2) NOT NULL DEFAULT '0.00',
  `vencimento` date DEFAULT NULL,
  PRIMARY KEY (`idparcela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcelas_investimentos`
--

LOCK TABLES `parcelas_investimentos` WRITE;
/*!40000 ALTER TABLE `parcelas_investimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `parcelas_investimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professores`
--

DROP TABLE IF EXISTS `professores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professores` (
  `idprofessor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fone_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professores`
--

LOCK TABLES `professores` WRITE;
/*!40000 ALTER TABLE `professores` DISABLE KEYS */;
INSERT INTO `professores` VALUES (1,'Beltrano das Plantas','beltrano@ervateiro.com.br','53991171142','53991171142','53991171142','53991171142'),(2,'Fulano de Teste','fulano@tester.com.br','5332715749',NULL,NULL,'53984382243'),(3,'Lu Albuquerque','contato@farolterapeutico.com.br','5332264156',NULL,NULL,'53984481526'),(4,'Professor de Alunos','professor@dealunos.com.br','5332272830',NULL,NULL,'53981253269'),(5,'Outro Professor de Testes','outro@teste.com.br','53984382243',NULL,NULL,'53991171142');
/*!40000 ALTER TABLE `professores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_documentos`
--

DROP TABLE IF EXISTS `tipos_documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_documentos` (
  `iddocumento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iddocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_documentos`
--

LOCK TABLES `tipos_documentos` WRITE;
/*!40000 ALTER TABLE `tipos_documentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turmas`
--

DROP TABLE IF EXISTS `turmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turmas` (
  `idturma` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  `identificacao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vagas` int(11) NOT NULL,
  `taxa_inscricao` decimal(13,2) NOT NULL DEFAULT '0.00',
  `data_limite_inscricao` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Aguarde; 2 = Ativa; 3 = Encerrada;',
  `aula_unica` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (1,1,'Turma 1',25,0.00,NULL,1,0),(2,2,'TER03',20,0.00,'2018-08-31',2,0),(3,4,'Turma 1',10,0.00,NULL,1,0),(4,1,'Turma 2',10,0.00,NULL,1,0),(5,1,'Turma 2',30,0.00,NULL,1,0),(6,1,'Turma 3',20,0.00,NULL,1,0),(7,1,'Turma 4',20,0.00,NULL,1,0),(8,3,'Turma 1',10,0.00,NULL,1,0),(9,4,'Turma A1',30,150.00,NULL,1,0),(10,4,'Turma A2',28,120.00,'2018-07-18',2,0),(11,1,'Turma A3',30,130.00,'2018-09-10',1,0),(12,4,'Turma B1',30,120.00,'2018-08-10',1,0),(13,3,'Turma 10',10,0.00,'2018-09-07',2,0),(14,3,'Turma 10',10,0.00,'2018-09-10',2,0),(15,5,'BA01',10,120.00,'2018-09-10',2,0),(17,3,'MRQ01',10,0.00,'2018-09-10',2,0),(18,3,'MRQ Rosa 02',10,0.00,'2018-09-10',2,0),(19,1,'Caridade',10,80.00,'2018-09-10',2,0),(20,1,'Caridade',10,80.00,'2018-09-10',2,0),(21,3,'MRQ Rosa 03',10,0.00,'2018-08-15',2,0),(22,4,'A01',30,120.00,'2018-08-18',2,0),(23,3,'Teste de Investimentos',10,0.00,'2018-09-10',2,1);
/*!40000 ALTER TABLE `turmas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
  `senha` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `atividade` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rua` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fone_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acesso` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Usuário; 2 = Aluno; 3 = Equipe; 4 = Administrador; 5 = Desenvolvedor;',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Marcelo Boemeke da Silveira','marcelo.boemeke@gmail.com',1,'$2y$10$wqtDAQD2dMFJfN7qTiRXjO/b3L1HSIcp.dhRk3M7p64LIRZmeKW1S','04059242080','1123434531','1998-10-03','Desenvolvedor Web','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142','53984481526','5332715749','53991171142',5),(3,'Marcelo Boemeke da Silveira','marcelo.boemeke@hotmail.com',1,'$2y$10$TxNr9fyxZl.l7A6hjQJqNOUMbZFnVM4EzQSVSwBNr0inHHaAp1KqW','04059242083','1123434531','0000-00-00','Desenvolvedor','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142','53984382243','5332715749',NULL,3),(4,'Isamar Boemeke da Silveira','isamar@gmail.com',1,'$2y$10$F3GtMkpfDq3yjpmlbp/7w.3RDUCkhzmtHZ05nJ.r8wx1DATjJDkvm','03000000002','','1957-08-24','Dona de Casa','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53984481526','5332715749',NULL,NULL,1),(5,'Fulano dos Testes','fulano@fulano.com.br',1,'$2y$10$S00MakJwsPpW/nf6EeHDsu6Nfuryrl7auSiWiEPrdZHrI8rt3J9cq','00000000002','0000000000','1998-10-03','Desocupado','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142',NULL,NULL,NULL,2),(6,'Usuário de Testes','tester@testes.com.br',1,'$2y$10$lC97dKOvnp7dtewda34/feFYSOdMLEMFg8PsjIRjlcgGDmf6k/QYm','04059242081','1123434531','1957-08-24','Tester','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142',NULL,NULL,'53991171142',2),(7,'Dona Proprietária','contato@farolterapeutico.com.br',1,'$2y$10$cODEiMaHgymnEWbri/1Bfeufz4F8qY104SnWPQjf0nCkPtrX58Oqe','00000000040','0000000000','2010-10-10','Dona Proprietária','96090000','RS','Pelotas','Exemplo','Exemplo',1234,NULL,'5332000000',NULL,NULL,'53991000000',4),(8,'João da Silva','joaodasilva@gmail.com',1,'$2y$10$9p8aPIDQnIkkD9jMstHu4u/VRfaLzXUR0LavphmvGDMbJ.VwsRunK','00011122233','1123434532','1998-10-03','Frentista de Tesla','00112233','AC','Cidade do Estado','Bairro','Rua Avenida',18,'Kakkakakamamaamalalal teste, testando o','53991171142',NULL,NULL,'53991171142',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_farol`
--

DROP TABLE IF EXISTS `usuarios_farol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_farol` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `senha` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `fone_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fone_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acesso` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Funcionário; 2 = Administrador; 3 = Desenvolvedor;',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_farol`
--

LOCK TABLES `usuarios_farol` WRITE;
/*!40000 ALTER TABLE `usuarios_farol` DISABLE KEYS */;
INSERT INTO `usuarios_farol` VALUES (1,'Marcelo','Da TI','marcelo.boemeke@gmail.com','',1,'$2y$10$dt5DghZIMFPb12p33MpvUuM','0000-00-00','(53)9911-71142','(53)9843-82243','(53)3271-5749','(53)9911-71142',3),(2,'Lúcia','Helena de Albuquerque','lu@farolterapeutico.com.br','',1,'$2y$10$n/z0JTIeS92KdYLi97YGP.c','0000-00-00','(53)9911-71142','','','',2),(3,'Gurizinho','da TI','marcelo.boemeke@hotmail.com','',1,'$2y$10$UIN4OYzr9z/frX5nchYNQeU','0000-00-00','(53)9911-71142','(53)9843-82243','(53)3271-5749','(53)9911-71142',3),(5,'Funcionário','de Teste','funcionario@deteste.com.br','',0,'$2y$10$/0rIZ.2Ea/Sc1WlI4Q55A.L','0000-00-00','(53)9911-71142','(53)9843-82243','','',1),(6,'Marcelo','Silveira 2','marcelo.boemeke@emaiil.com','',0,'$2y$10$.wJTEEVwKlCvXK.dl6D.YeV','0000-00-00','(53)9911-71142','','','',2),(7,'Marcelo','Silveira 3','marcelo.boemeke@email.com','',1,'$2y$10$8.k/4g2IkDVOZjYKYX.SWuM','0000-00-00','(53)3271-5749','','','',1),(8,'Marcelo','Teste','marcelo.boemeke@emaildeteste.com','dev',1,'$2y$10$24A2JC7JcMTnNiSMsDt53ecDSANTlk3wtg8R7hYBILg.1IJBROq56','1998-10-03','(53)9911-71142','','','',3);
/*!40000 ALTER TABLE `usuarios_farol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-27 14:45:52
