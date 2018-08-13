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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Reiki I e II Intensivo','Aqui vai a descrição do curso, muitas palavras.',1),(2,'Terapeuta Holístico','Abraçando a saúde, de ponta a ponta',1),(3,'Mesa Radiônica Quântica Rosa','Lorem ipsum dolor sit amet',1),(4,'Acupuntura','Prática milenar da MTC',1);
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
  `obs` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias_eventos`
--

LOCK TABLES `dias_eventos` WRITE;
/*!40000 ALTER TABLE `dias_eventos` DISABLE KEYS */;
INSERT INTO `dias_eventos` VALUES (1,1,'2018-08-08 10:00:00','2018-08-08 18:00:00',NULL,NULL,NULL),(2,1,'2018-08-09 10:00:00','2018-08-09 12:00:00',NULL,NULL,NULL),(3,2,'2018-08-15 22:09:46','2018-08-16 22:09:57',NULL,NULL,'Reforço'),(4,3,'2018-08-25 09:00:00','2018-08-25 18:30:00',NULL,NULL,NULL),(5,4,'2018-08-20 18:30:00','2018-08-20 22:00:00',NULL,NULL,NULL),(6,6,'2018-08-28 17:30:00','2018-08-28 18:41:00',NULL,NULL,NULL),(7,7,'2018-08-21 18:00:00','2018-08-22 18:30:00',NULL,NULL,NULL),(8,8,'2018-08-19 20:00:00','2018-08-19 21:00:00',NULL,NULL,NULL),(9,8,'2018-08-20 21:00:00','2018-08-20 22:00:00',NULL,NULL,NULL),(10,9,'2018-08-12 09:00:00','2018-08-12 18:30:00',NULL,NULL,NULL),(11,10,'2018-08-26 09:00:00','2018-08-26 18:30:00','2018-08-26 12:30:00','2018-08-26 14:00:00',NULL),(12,11,'2018-08-18 09:00:00','2018-08-18 18:30:00','2018-08-18 12:30:00','2018-08-18 14:00:00',NULL),(13,11,'2018-08-19 09:00:00','2018-08-19 13:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(14,12,'2018-08-18 09:00:00','2018-08-18 18:30:00','2018-08-18 12:30:00','2018-08-18 14:00:00',NULL),(15,12,'2018-08-25 09:00:00','2018-08-25 13:00:00',NULL,'0000-00-00 00:00:00',NULL),(16,13,'2018-08-18 09:00:00','2018-08-18 18:30:00','2018-08-18 12:30:00','2018-08-18 14:00:00',NULL),(17,13,'2018-08-19 09:00:00','2018-08-19 13:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(18,14,'2018-08-18 09:00:00','2018-08-18 18:30:00','2018-08-18 12:30:00','2018-08-18 14:00:00',NULL),(19,14,'2018-08-19 09:00:00','2018-08-19 13:00:00',NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,1,NULL,2,'Palestra sobre Palestras','Uma palestra pra te explicar o que são palestras',120.00,'2018-10-08 00:00:00',1),(2,1,2,1,'Teste 1','Testando 1',0.00,NULL,1);
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
  `forma` int(11) NOT NULL DEFAULT '1' COMMENT '1 = À vista; 2 = Parcelado Farol; 3 = Cartão;',
  `parcelas` int(11) DEFAULT '1',
  `valor_parcela` decimal(13,2) DEFAULT NULL,
  `total` decimal(13,2) NOT NULL,
  `dia_vencimento` int(11) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Matrícula; 2 = Mensalidade;',
  PRIMARY KEY (`idinvestimento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_investimento`
--

LOCK TABLES `forma_investimento` WRITE;
/*!40000 ALTER TABLE `forma_investimento` DISABLE KEYS */;
INSERT INTO `forma_investimento` VALUES (1,8,1,1,NULL,180.00,NULL,'2018-09-10',1),(2,8,2,2,100.00,200.00,10,NULL,1),(3,11,2,20,330.00,6600.00,2,NULL,1),(4,12,2,20,330.00,6600.00,2,NULL,1),(5,13,1,1,NULL,180.00,NULL,'2018-10-07',1),(6,14,1,1,NULL,180.00,NULL,'2018-10-10',1),(7,14,2,3,70.00,210.00,7,NULL,1);
/*!40000 ALTER TABLE `forma_investimento` ENABLE KEYS */;
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
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL AUTO_INCREMENT,
  `idturma` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `data_ingresso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmatricula`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
INSERT INTO `matricula` VALUES (1,1,1,'2018-08-06 10:19:43');
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
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
  `sobrenome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `atividade` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professores`
--

LOCK TABLES `professores` WRITE;
/*!40000 ALTER TABLE `professores` DISABLE KEYS */;
INSERT INTO `professores` VALUES (1,'Beltrano','das Plantas','Frentista de Tesla','fulano@ervateiro.com.br'),(2,'Fulano','de Teste','Testador','fulano@tester.com.br'),(3,'Lu','Albuquerque','Terapeuta Holística','contato@farolterapeutico.com.br'),(4,'Professor','de Alunos','Professor','professor@dealunos.com.br');
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
  `data_limite_inscricao` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Aguarde; 2 = Andamento; 3 = Encerrada;',
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (1,1,'Turma 1',0,0.00,'0000-00-00',1),(2,2,'Turma 133',0,0.00,'0000-00-00',1),(3,4,'Turma 1',0,0.00,'0000-00-00',1),(4,1,'Turma 2',0,0.00,'0000-00-00',1),(5,1,'Turma 2',0,0.00,'0000-00-00',1),(6,1,'Turma 3',0,0.00,'0000-00-00',1),(7,1,'Turma 4',0,0.00,'0000-00-00',1),(8,3,'Turma 1',0,0.00,'0000-00-00',1),(9,4,'Turma A1',30,150.00,'0000-00-00',1),(10,4,'Turma A2',28,120.00,'2018-09-10',1),(11,1,'Turma A3',30,130.00,'2018-09-10',1),(12,4,'Turma B1',30,120.00,'2018-08-10',1),(13,3,'Turma 10',10,0.00,'2018-09-07',1),(14,3,'Turma 10',10,0.00,'2018-09-10',1);
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
  `sobrenome` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Inativo; 1 = Ativo',
  `senha` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `ocupacao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rua` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `fone_1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fone_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acesso` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Usuário; 2 = Aluno; 3 = Funcionário; 4 = Administrador; 5 = Desenvolvedor;',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Marcelo','Boemeke da Silveira','dev','marcelo.boemeke@hotmail.com',1,'$2y$10$wqtDAQD2dMFJfN7qTiRXjO/b3L1HSIcp.dhRk3M7p64LIRZmeKW1S','040.592.420-80','1123434531','1998-10-03','Desenvolvedor Web','96090-340','RS','Pelotas','Laranjal','Hulha Negra',1894,'(53)9911-71142','(53)9844-81526','(53)3271-5749','(53)9911-71142',5),(3,'Marcelo','Boemeke da Silveira','','marcelo.boemeke@gmail.com',1,'','04059242080','1123434531','0000-00-00','Desenvolvedor','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,'53991171142','53984382243','5332715749','',1),(4,'Isamar','Boemeke da Silveira','minhamae','isamar@gmail.com',1,'$2y$10$F3GtMkpfDq3yjpmlbp/7w.3RDUCkhzmtHZ05nJ.r8wx1DATjJDkvm','','','1957-08-24','Dona de casa','96090-340','RS','Pelotas','Laranjal','Hulha Negra',1894,'(53)9844-81526','(53)3271-5749','','',1),(5,'Fulano','dos Testes','fulano','fulano@fulano.com.br',1,'$2y$10$S00MakJwsPpW/nf6EeHDsu6Nfuryrl7auSiWiEPrdZHrI8rt3J9cq','000.000.000-00','0000000000','1998-10-03','Desocupado','96090-340','RS','Pelotas','Laranjal','Hulha Negra',1894,'(53)9911-71142','','','',2),(6,'Usuário','de Testes','tester','tester@testes.com.br',1,'$2y$10$lC97dKOvnp7dtewda34/feFYSOdMLEMFg8PsjIRjlcgGDmf6k/QYm','040.592.420-80','1123434531','1957-08-24','Tester','96090-340','RS','Pelotas','Laranjal','Hulha Negra',1894,'(53)9911-71142','','','(53)9911-71142',2);
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

-- Dump completed on 2018-08-13  9:49:52
