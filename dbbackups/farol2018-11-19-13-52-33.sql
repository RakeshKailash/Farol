-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: farol
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

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
-- Table structure for table `acoes`
--

DROP TABLE IF EXISTS `acoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acoes` (
  `idacao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idacao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acoes`
--

LOCK TABLES `acoes` WRITE;
/*!40000 ALTER TABLE `acoes` DISABLE KEYS */;
INSERT INTO `acoes` VALUES (1,'Criar'),(2,'Editar'),(3,'Excluir'),(4,'Visualizar');
/*!40000 ALTER TABLE `acoes` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `capa_curso`
--

DROP TABLE IF EXISTS `capa_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capa_curso` (
  `idcapa` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  `caminho_arquivo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`idcapa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capa_curso`
--

LOCK TABLES `capa_curso` WRITE;
/*!40000 ALTER TABLE `capa_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `capa_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credenciais_pagseguro`
--

DROP TABLE IF EXISTS `credenciais_pagseguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credenciais_pagseguro` (
  `idcredencial` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcredencial`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credenciais_pagseguro`
--

LOCK TABLES `credenciais_pagseguro` WRITE;
/*!40000 ALTER TABLE `credenciais_pagseguro` DISABLE KEYS */;
INSERT INTO `credenciais_pagseguro` VALUES (1,'marcelo.boemeke@gmail.com','3A53E4A6ABB246DFA4832F31051EB511',1);
/*!40000 ALTER TABLE `credenciais_pagseguro` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias_eventos`
--

LOCK TABLES `dias_eventos` WRITE;
/*!40000 ALTER TABLE `dias_eventos` DISABLE KEYS */;
INSERT INTO `dias_eventos` VALUES (46,18,'2018-10-13 09:00:00','2018-10-13 18:00:00',NULL,NULL),(47,21,'2018-09-17 09:00:00','2018-09-17 18:30:00',NULL,NULL),(48,22,'2018-09-15 09:00:00','2018-09-15 18:00:00','2018-09-15 12:30:00','2018-09-15 14:00:00'),(49,23,'2018-10-03 09:00:00','2018-10-03 18:30:00',NULL,NULL),(50,24,'2018-10-06 09:00:00','2018-10-06 18:30:00','2018-10-06 12:30:00','2018-10-06 14:00:00'),(51,24,'2018-10-07 09:00:00','2018-10-07 13:00:00',NULL,NULL),(52,25,'2018-11-10 09:00:00','2018-11-10 18:30:00','2018-11-10 12:30:00','2018-11-10 14:00:00'),(53,26,'2018-12-01 09:00:00','2018-12-01 18:30:00','2018-12-01 12:30:00','2018-12-01 14:00:00'),(54,26,'2018-12-02 09:00:00','2018-12-02 13:00:00',NULL,NULL),(55,27,'2018-12-20 09:00:00','2018-12-20 18:30:00','2018-12-20 12:30:00','2018-12-20 14:00:00'),(56,28,'2018-12-15 09:00:00','2018-12-15 18:30:00','2018-12-15 12:30:00','2018-12-15 14:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (24,3,24,1,'Aula Inaugural','<p>﻿<strong>Certificação:</strong> Formação em Terapias Holísticas Integrativas\r\n</p><p><strong>Atuação:</strong> Terapeuta Holístico\r\n</p>\r\n<p><strong>– 30 vagas –\r\n</strong></p>\r\n<p><strong>Público alvo:</strong> Terapeutas atuantes, profissionais da saúde, pessoas interessadas em práticas holísticas e terapias naturais para autoconhecimento, benefício próprio ou se tornarem profissionais da área.\r\n</p>\r\n<p><strong>Objetivo:</strong> Capacitar os alunos para a atuação profissional, mediante a utilização de terapias integrativas naturais, corporais e vibracionais.\r\n</p>\r\n<p><strong>Pré-requisito:</strong> Ensino Médio.\r\n</p>\r\n<p><strong>Duração:</strong> 18 meses (1º final de semana de cada mês).\r\n</p><p><strong>Sábado:</strong> das 9:00h às 12:30h e das 14:00 às 18:00h.\r\n</p><p><strong>Domingo:</strong> das 9:00h às 13:00h.\r\n</p>\r\n<p><strong><u>Conteúdo Resumido:\r\n</u></strong></p><p>Módulo Fundamentos e Conceitos\r\n</p><p>Introdução ao Paradigma Holístico e Práticas Integrativas;\r\n</p><p>Ética, Postura, Legislação e Registro Profissional;\r\n</p><p>Anatomia e Fisiologia Corporal;\r\n</p><p>Energia, Aura e Chakras;\r\n</p><p>Princípios da MC – Yin/Yang, 5 Movimentos, Meridianos e Diagnóstico;\r\n</p><p>Anamnese, Diagnóstico e Recomendação.\r\n</p><p>Módulo Autoconhecimento\r\n</p><p>Consciência Corporal;\r\n</p><p>Meditação e Respiração;\r\n</p><p>Módulo Terapias Naturais\r\n</p><p>Nutrição humana e terapêutica Ortomolecular;\r\n</p><p>Fitoterapia Brasileira;\r\n</p><p>Auriculoterapia;\r\n</p><p>Moxabustão, Ventosaterapia e Gua Sha;\r\n</p><p>Argiloterapia;\r\n</p><p>Cones Chineses.\r\n</p><p>Módulo Terapias Corporais\r\n</p><p>Cinesiologia;\r\n</p><p>Anmá (Massagem Oriental);\r\n</p><p>Reflexologia Podal.\r\n</p><p>Módulo Terapias Vibracionais\r\n</p><p>Radiestesia e Radiônica;\r\n</p><p>Reiki Usui/Tibetano;\r\n</p><p>Aromaterapia;\r\n</p><p>Cristais;\r\n</p><p>Florais.\r\n</p>\r\n<p><strong>* Curso teórico, vivencial e prático, totalmente apostilado.\r\n</strong></p><p><strong>** Estágio supervisionado, trabalhos para conclusão do curso.\r\n</strong></p>\r\n<p><strong>Instrutores:</strong> Corpo docente do Farol, com profissionais altamente capacitados, constantemente atualizados, especialistas, mestres e doutores.\r\n</p>\r\n<p><strong>Informações:\r\n</strong></p><p><u>e-mail:</u> secretaria@farolterapeutico.com.br\r\n</p><p><u>fones:</u> 53. 3325 0002 / 98468 5163 (oi/whatsapp) / 99131 9062 (claro)</p>',0.00,NULL,1),(25,3,25,1,'',NULL,0.00,NULL,1),(26,3,24,1,'Aula de Revisão 1',NULL,0.00,NULL,1),(27,3,26,1,'Mrq-01 Aula',NULL,0.00,NULL,1),(28,3,27,1,'Barras',NULL,0.00,NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_investimento`
--

LOCK TABLES `forma_investimento` WRITE;
/*!40000 ALTER TABLE `forma_investimento` DISABLE KEYS */;
INSERT INTO `forma_investimento` VALUES (24,24,3,18,330.00,5940.00,7,NULL,1),(25,24,1,1,NULL,5940.00,NULL,'2018-09-10',1),(26,25,1,1,NULL,250.00,NULL,'2018-11-05',1),(27,25,2,3,93.33,280.00,NULL,NULL,1),(28,26,1,1,NULL,180.00,NULL,'2018-11-15',1),(29,26,2,3,70.00,210.00,NULL,NULL,1),(30,26,4,1,NULL,210.00,NULL,NULL,1),(31,27,1,1,NULL,380.00,NULL,'2018-12-10',1),(32,27,2,3,140.00,420.00,NULL,NULL,1),(33,27,4,1,NULL,420.00,NULL,NULL,1);
/*!40000 ALTER TABLE `forma_investimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_inscricoes`
--

DROP TABLE IF EXISTS `historico_inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_inscricoes` (
  `idhistorico` int(11) NOT NULL AUTO_INCREMENT,
  `idinscricao` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '0',
  `status_anterior` int(11) NOT NULL,
  `status_novo` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idhistorico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_inscricoes`
--

LOCK TABLES `historico_inscricoes` WRITE;
/*!40000 ALTER TABLE `historico_inscricoes` DISABLE KEYS */;
INSERT INTO `historico_inscricoes` VALUES (1,0,0,2,0,'2018-11-16 12:55:12'),(2,0,0,1,2,'2018-11-16 13:01:14'),(3,0,0,2,2,'2018-11-16 13:01:27'),(4,0,0,2,1,'2018-11-16 13:07:03'),(5,60,0,1,2,'2018-11-19 09:53:47');
/*!40000 ALTER TABLE `historico_inscricoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagens_professores`
--

DROP TABLE IF EXISTS `imagens_professores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagens_professores` (
  `idimagem` int(11) NOT NULL AUTO_INCREMENT,
  `idprofessor` int(11) NOT NULL,
  `caminho_arquivo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idimagem`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens_professores`
--

LOCK TABLES `imagens_professores` WRITE;
/*!40000 ALTER TABLE `imagens_professores` DISABLE KEYS */;
INSERT INTO `imagens_professores` VALUES (1,19,'uploads/equipe/teacher_icon_m2.png'),(2,6,'uploads/equipe/teacher_icon_m1.png'),(3,1,'uploads/equipe/teacher_icon1.png'),(4,2,'uploads/equipe/teacher_icon_m.png'),(5,3,'uploads/equipe/teacher_icon2.png');
/*!40000 ALTER TABLE `imagens_professores` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscricoes`
--

LOCK TABLES `inscricoes` WRITE;
/*!40000 ALTER TABLE `inscricoes` DISABLE KEYS */;
INSERT INTO `inscricoes` VALUES (10,NULL,24,6,'2018-08-28 15:00:04',NULL,2),(11,NULL,25,6,'2018-08-28 17:13:08',NULL,2),(12,NULL,26,6,'2018-09-27 11:07:09',NULL,1),(14,NULL,25,6,'2018-10-22 11:44:14',NULL,1),(15,NULL,26,6,'2018-10-22 11:50:01',NULL,1),(16,NULL,27,6,'2018-11-09 09:21:14',NULL,1),(17,NULL,27,6,'2018-11-09 12:11:21',NULL,1),(18,NULL,27,6,'2018-11-09 12:12:53',NULL,1),(19,NULL,27,6,'2018-11-09 12:13:35',NULL,1),(20,NULL,27,6,'2018-11-09 12:14:39',NULL,1),(21,NULL,27,6,'2018-11-09 12:15:02',NULL,1),(22,NULL,27,6,'2018-11-09 12:15:28',NULL,1),(23,NULL,27,6,'2018-11-09 12:15:41',NULL,1),(24,NULL,27,6,'2018-11-09 12:18:12',NULL,1),(25,NULL,26,6,'2018-11-09 12:33:13',NULL,1),(26,NULL,26,6,'2018-11-09 12:33:46',NULL,1),(27,NULL,26,6,'2018-11-09 12:36:08',NULL,1),(28,NULL,26,6,'2018-11-09 12:37:14',NULL,1),(29,NULL,27,6,'2018-11-09 12:38:02',NULL,1),(30,NULL,27,6,'2018-11-09 12:38:35',NULL,1),(31,NULL,27,6,'2018-11-09 12:54:43',NULL,1),(32,NULL,27,6,'2018-11-09 12:58:49',NULL,1),(33,NULL,27,6,'2018-11-09 13:00:51',NULL,1),(34,NULL,27,6,'2018-11-09 13:04:44',NULL,1),(35,NULL,27,6,'2018-11-09 13:05:11',NULL,1),(36,NULL,27,6,'2018-11-09 13:05:39',NULL,1),(37,NULL,27,6,'2018-11-09 13:07:46',NULL,1),(38,NULL,27,6,'2018-11-09 13:11:14',NULL,1),(39,NULL,27,6,'2018-11-09 13:12:48',NULL,1),(40,NULL,27,6,'2018-11-09 13:16:48',NULL,1),(41,NULL,27,6,'2018-11-09 13:17:19',NULL,1),(42,NULL,27,6,'2018-11-09 13:19:38',NULL,1),(43,NULL,27,6,'2018-11-09 13:20:23',NULL,1),(44,NULL,26,6,'2018-11-09 13:53:15',NULL,1),(45,NULL,26,1,'2018-11-12 08:16:36',NULL,1),(46,NULL,26,1,'2018-11-12 08:26:06',NULL,1),(47,NULL,26,1,'2018-11-12 08:26:24',NULL,1),(48,NULL,26,1,'2018-11-12 08:28:20',NULL,1),(49,NULL,26,1,'2018-11-12 08:29:23',NULL,1),(50,NULL,26,1,'2018-11-12 08:29:39',NULL,1),(51,NULL,27,1,'2018-11-12 08:31:47',NULL,1),(52,NULL,27,1,'2018-11-12 08:32:14',NULL,1),(53,NULL,27,1,'2018-11-12 08:33:41',NULL,3),(54,NULL,26,1,'2018-11-12 09:48:09',NULL,1),(55,NULL,27,1,'2018-11-12 09:52:46',NULL,1),(56,NULL,27,1,'2018-11-12 09:53:31',NULL,1),(57,NULL,27,1,'2018-11-12 09:54:43',NULL,1),(58,NULL,27,1,'2018-11-12 09:54:49',NULL,1),(59,NULL,27,1,'2018-11-12 09:54:51',NULL,1),(60,NULL,27,1,'2018-11-16 12:50:13',NULL,2);
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
  `status` int(11) DEFAULT '0' COMMENT '0 = Devedor; 1 = Pago;',
  PRIMARY KEY (`idinvestimento`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `investimentos_inscricoes`
--

LOCK TABLES `investimentos_inscricoes` WRITE;
/*!40000 ALTER TABLE `investimentos_inscricoes` DISABLE KEYS */;
INSERT INTO `investimentos_inscricoes` VALUES (28,10,6,24,'2018-08-28 15:01:20',18,0),(29,11,6,27,'2018-08-28 17:13:17',3,0),(30,12,6,29,'2018-09-27 11:07:26',2,0),(32,14,6,27,'2018-10-22 11:44:14',3,0),(33,15,6,28,'2018-10-22 11:50:01',1,0),(34,16,6,33,'2018-11-09 09:21:14',1,0),(35,17,6,33,'2018-11-09 12:11:21',1,0),(36,18,6,33,'2018-11-09 12:12:53',1,0),(37,19,6,33,'2018-11-09 12:13:35',1,0),(38,20,6,33,'2018-11-09 12:14:40',1,0),(39,21,6,33,'2018-11-09 12:15:02',1,0),(40,22,6,33,'2018-11-09 12:15:28',1,0),(41,23,6,33,'2018-11-09 12:15:41',1,0),(42,24,6,33,'2018-11-09 12:18:12',1,0),(43,25,6,30,'2018-11-09 12:33:14',1,0),(44,26,6,30,'2018-11-09 12:33:46',1,0),(45,27,6,30,'2018-11-09 12:36:08',1,0),(46,28,6,30,'2018-11-09 12:37:14',1,0),(47,29,6,33,'2018-11-09 12:38:02',1,0),(48,30,6,33,'2018-11-09 12:38:35',1,0),(49,31,6,33,'2018-11-09 12:54:43',1,0),(50,32,6,33,'2018-11-09 12:58:49',1,0),(51,33,6,33,'2018-11-09 13:00:51',1,0),(52,34,6,33,'2018-11-09 13:04:44',1,0),(53,35,6,33,'2018-11-09 13:05:11',1,0),(54,36,6,33,'2018-11-09 13:05:39',1,0),(55,37,6,33,'2018-11-09 13:07:46',1,0),(56,38,6,33,'2018-11-09 13:11:14',1,0),(57,39,6,33,'2018-11-09 13:12:48',1,0),(58,40,6,33,'2018-11-09 13:16:48',1,0),(59,41,6,33,'2018-11-09 13:17:19',1,0),(60,42,6,33,'2018-11-09 13:19:38',1,0),(61,43,6,33,'2018-11-09 13:20:23',1,0),(62,44,6,30,'2018-11-09 13:53:15',1,0),(63,45,1,30,'2018-11-12 08:16:36',1,0),(64,46,1,30,'2018-11-12 08:26:06',1,0),(65,47,1,30,'2018-11-12 08:26:24',1,0),(66,48,1,30,'2018-11-12 08:28:20',1,0),(67,49,1,30,'2018-11-12 08:29:23',1,0),(68,50,1,30,'2018-11-12 08:29:39',1,0),(69,51,1,33,'2018-11-12 08:31:47',1,0),(70,52,1,33,'2018-11-12 08:32:14',1,0),(71,53,1,33,'2018-11-12 08:33:41',1,0),(72,54,1,30,'2018-11-12 09:48:09',1,0),(73,55,1,33,'2018-11-12 09:52:46',1,0),(74,56,1,33,'2018-11-12 09:53:31',1,0),(75,57,1,33,'2018-11-12 09:54:43',1,0),(76,58,1,33,'2018-11-12 09:54:50',1,0),(77,59,1,33,'2018-11-12 09:54:51',1,0),(78,60,1,33,'2018-11-16 12:50:13',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loadfiles`
--

LOCK TABLES `loadfiles` WRITE;
/*!40000 ALTER TABLE `loadfiles` DISABLE KEYS */;
INSERT INTO `loadfiles` VALUES (1,'js/jquery-3.3.1.min.js','3'),(2,'css/system.css','2'),(3,'css/reset.css','3'),(4,'css/font_loader.css','3'),(5,'js/main.js','3'),(6,'js/materialize.js','3'),(7,'css/materialize.css','3'),(8,'js/jquery.mask.min.js','3'),(9,'js/table_filter.js','3'),(10,'css/site.css','1'),(11,'js/site.js','1');
/*!40000 ALTER TABLE `loadfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_turma`
--

DROP TABLE IF EXISTS `material_turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_turma` (
  `idmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `idupload` int(11) NOT NULL,
  `idturma` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_turma`
--

LOCK TABLES `material_turma` WRITE;
/*!40000 ALTER TABLE `material_turma` DISABLE KEYS */;
INSERT INTO `material_turma` VALUES (1,1,24,6,'2018-09-18 09:42:50'),(2,3,24,1,'2018-09-24 11:26:42'),(3,1,25,1,'2018-09-24 11:27:11');
/*!40000 ALTER TABLE `material_turma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_upload`
--

DROP TABLE IF EXISTS `material_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_upload` (
  `idupload` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  `caminho_arquivo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tamanho` int(11) DEFAULT '0',
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idupload`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_upload`
--

LOCK TABLES `material_upload` WRITE;
/*!40000 ALTER TABLE `material_upload` DISABLE KEYS */;
INSERT INTO `material_upload` VALUES (1,'Livro 1','Alguém','2018-09-14 10:56:31',1,'uploads/material/40d6c75c73452ed64e4f25c7b305f633.pdf',275,'a0be179234efb5f0f805f5ee6c7a4ae6'),(3,'Meu livro','Eu mesmo','2018-09-14 10:58:22',1,'uploads/material/620df3eb2f857d57fdf00f271b1ecad7.pdf',86,'d10a8aed26448625d7f0091ead840d2a'),(6,'Meu livro','Eu mesmo','2018-09-14 10:58:57',1,'uploads/material/3abebe432d2c33e27ad3021c94d46a64.pdf',111,'1d2684e6b45a3ad0ac71e211d592edf8');
/*!40000 ALTER TABLE `material_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_acao`
--

DROP TABLE IF EXISTS `modulo_acao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_acao` (
  `idmoduloacao` int(11) NOT NULL AUTO_INCREMENT,
  `idmodulo` int(11) NOT NULL,
  `idacao` int(11) NOT NULL,
  PRIMARY KEY (`idmoduloacao`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo_acao`
--

LOCK TABLES `modulo_acao` WRITE;
/*!40000 ALTER TABLE `modulo_acao` DISABLE KEYS */;
INSERT INTO `modulo_acao` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,2,1),(6,2,2),(7,2,3),(8,2,4),(9,3,1),(10,3,2),(11,3,3),(12,3,4),(13,4,1),(14,4,2),(15,4,3),(16,4,4),(17,5,1),(18,5,2),(19,5,3),(20,5,4),(21,6,1),(22,6,2),(23,6,3),(24,6,4),(25,7,1),(26,7,2),(27,7,3),(28,7,4),(29,8,1),(30,8,2),(31,8,3),(32,8,4);
/*!40000 ALTER TABLE `modulo_acao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `idmodulo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'Cursos'),(2,'Professores'),(3,'Agenda'),(4,'Arquivos'),(5,'Turmas'),(6,'Inscricoes'),(7,'Usuarios'),(8,'Financeiro');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacoes_pagseguro`
--

DROP TABLE IF EXISTS `notificacoes_pagseguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacoes_pagseguro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `notification_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_recebimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacoes_pagseguro`
--

LOCK TABLES `notificacoes_pagseguro` WRITE;
/*!40000 ALTER TABLE `notificacoes_pagseguro` DISABLE KEYS */;
INSERT INTO `notificacoes_pagseguro` VALUES (1,'teste','teste','2018-11-09 09:47:31'),(2,'teste','teste','2018-11-09 09:48:57'),(3,'erro','erro','2018-11-12 09:17:07'),(4,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-12 09:17:35'),(5,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-12 09:33:13'),(6,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-12 10:31:46'),(7,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-12 12:00:32'),(8,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-12 12:08:02'),(9,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-13 09:14:29'),(10,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-13 11:07:21'),(11,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-13 11:08:41'),(12,'C365895C47A147A1DC45544CAFB56486CD17','transaction','2018-11-13 11:09:43'),(13,'04B551343F6D3F6DE96224472F9476BFB24F','transaction','2018-11-13 11:11:17'),(14,'47BD6991580F580F9EF004914F8F8B00D30D','transaction','2018-11-16 12:53:52'),(15,'47BD6991580F580F9EF004914F8F8B00D30D','transaction','2018-11-16 12:55:05'),(16,'47BD6991580F580F9EF004914F8F8B00D30D','transaction','2018-11-16 13:01:03'),(17,'47BD6991580F580F9EF004914F8F8B00D30D','transaction','2018-11-16 13:01:22'),(18,'C0A53A61F8B7F8B73B2FF4FC1FB0D188228A','transaction','2018-11-16 13:04:16'),(19,'C0A53A61F8B7F8B73B2FF4FC1FB0D188228A','transaction','2018-11-16 13:04:49'),(20,'C0A53A61F8B7F8B73B2FF4FC1FB0D188228A','transaction','2018-11-16 13:06:28'),(21,'C0A53A61F8B7F8B73B2FF4FC1FB0D188228A','transaction','2018-11-16 13:07:02'),(22,'696C8F90C763C7633CFAA48B7F9A4119CE62','transaction','2018-11-19 09:53:45');
/*!40000 ALTER TABLE `notificacoes_pagseguro` ENABLE KEYS */;
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
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = A pagar; 1 = Paga;',
  PRIMARY KEY (`idparcela`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcelas_investimentos`
--

LOCK TABLES `parcelas_investimentos` WRITE;
/*!40000 ALTER TABLE `parcelas_investimentos` DISABLE KEYS */;
INSERT INTO `parcelas_investimentos` VALUES (14,29,93.34,NULL,1),(15,29,93.33,NULL,0),(16,29,93.33,NULL,0),(17,30,105.00,NULL,0),(18,30,105.00,NULL,0),(19,28,330.00,'2018-09-11',0),(20,28,330.00,'2018-10-11',0),(21,28,330.00,'2018-11-11',0),(22,28,330.00,'2018-12-11',0),(23,28,330.00,'2019-01-11',0),(24,28,330.00,'2019-02-11',0),(25,28,330.00,'2019-03-11',0),(26,28,330.00,'2019-04-11',0),(27,28,330.00,'2019-05-11',0),(28,28,330.00,'2019-06-11',0),(29,28,330.00,'2019-07-11',0),(30,28,330.00,'2019-08-11',0),(31,28,330.00,'2019-09-11',0),(32,28,330.00,'2019-10-11',0),(33,28,330.00,'2019-11-11',0),(34,28,330.00,'2019-01-11',0),(35,28,330.00,'2019-12-11',0),(36,28,330.00,NULL,0),(40,32,93.34,NULL,0),(41,32,93.33,NULL,0),(42,32,93.33,NULL,0);
/*!40000 ALTER TABLE `parcelas_investimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissoes` (
  `idpermissao` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idmoduloacao` int(11) NOT NULL,
  PRIMARY KEY (`idpermissao`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (5,2,1),(10,1,8),(17,1,12),(21,1,16),(25,1,20),(29,1,24),(33,1,28),(37,1,32),(40,1,4);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
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
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `equipe` tinyint(4) NOT NULL DEFAULT '0',
  `formacao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professores`
--

LOCK TABLES `professores` WRITE;
/*!40000 ALTER TABLE `professores` DISABLE KEYS */;
INSERT INTO `professores` VALUES (1,'Beltrano das Plantas','beltrano@ervateiro.com.br','53991171142','53991171142','53991171142','53991171142',1,1,'Ervateiro'),(2,'Fulano de Teste','fulano@tester.com.br','5332715749',NULL,NULL,'53984382243',1,0,'Testador'),(3,'Lu Albuquerque','contato@farolterapeutico.com.br','5332264156',NULL,NULL,'53984481526',1,1,'Terapeuta Holística'),(4,'Professor de Alunos','professor@dealunos.com.br','5332272830',NULL,NULL,'53981253269',1,0,'Professor'),(5,'Outro Professor de Testes','outro@teste.com.br','53984382243',NULL,NULL,'53991171142',0,0,NULL),(6,'Professor','professor@deteste.com.br','5332715749',NULL,NULL,'53991171142',1,1,'Professor'),(19,'Alguem','alguem@professor.com','00000000000',NULL,NULL,'00000000000',1,1,'Humano');
/*!40000 ALTER TABLE `professores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitacoes_pagseguro`
--

DROP TABLE IF EXISTS `solicitacoes_pagseguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitacoes_pagseguro` (
  `idsolicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `idinvestimento` int(11) NOT NULL,
  `codigo_retorno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idsolicitacao`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitacoes_pagseguro`
--

LOCK TABLES `solicitacoes_pagseguro` WRITE;
/*!40000 ALTER TABLE `solicitacoes_pagseguro` DISABLE KEYS */;
INSERT INTO `solicitacoes_pagseguro` VALUES (1,42,'656F5DCA8A8A87C004E53FA138DD24EF','2018-11-09 12:18:13'),(2,43,'27C3B1DD969626BBB47E1FB1FFA05F7C','2018-11-09 12:33:14'),(3,44,'A5CC89FA454525988487BFB8CB74E72D','2018-11-09 12:33:47'),(4,45,'D00296D60A0A608EE4DABF8698B88ECC','2018-11-09 12:36:09'),(5,46,'D4BF6A448585CB811451DFBED54D9D25','2018-11-09 12:37:15'),(6,47,'90B0E463A1A1C8DCC48F4FB669D63FC9','2018-11-09 12:38:03'),(7,48,'11858442ECECF81334C1FFA4717A577A','2018-11-09 12:38:36'),(8,49,'D3DD2C396E6E1418849EBFB9E3BF3794','2018-11-09 12:54:44'),(9,50,'94CC8B784A4AEE7114B32FA3AE5CBCA3','2018-11-09 12:58:50'),(10,51,'74B2CE2F9E9EC4AFF4B44FBD236524B3','2018-11-09 13:00:53'),(11,52,'FF9AD364A6A6A224446BAF8A2AA3D5D3','2018-11-09 13:04:45'),(12,53,'687E04CB1E1E943444763FB871A9D6AD','2018-11-09 13:05:12'),(13,54,'D7C07F1E1212E7A4447D7F8D40605237','2018-11-09 13:05:40'),(14,55,'C6E8D9A5D4D4494224990FA566427B2B','2018-11-09 13:07:47'),(15,56,'F4C98903E1E12B8BB47B5FA046E557DA','2018-11-09 13:11:15'),(16,57,'61E20047C7C714B3347B2F90A98202A4','2018-11-09 13:12:49'),(17,58,'0C4D427CBCBC55BDD4C5CFAA6DDEA51D','2018-11-09 13:16:49'),(18,59,'85BC365640401796649C5FA1224E4CB3','2018-11-09 13:17:20'),(19,60,'A4CDA8752E2E5A6CC4EF8F9AE7323D31','2018-11-09 13:19:39'),(20,61,'5500875BFEFE904664EDFF823C4B67D5','2018-11-09 13:20:24'),(21,62,'6C3C86B34343C2A554197F8199066125','2018-11-09 13:53:16'),(22,63,'45A9AC487D7DFBEBB47E6FAAAB228F3D','2018-11-12 08:16:38'),(23,66,'040A67EB0F0FDBB334F6CF9FE4807E2B','2018-11-12 08:28:22'),(24,67,'3066C0A5696962B99473FF8A749ACD2F','2018-11-12 08:29:39'),(25,68,'359923FD131344D0048F8FAF2B4AE1D6','2018-11-12 08:29:40'),(26,69,'8D4CB9A11C1CDB8994B95FB2E02B4CE2','2018-11-12 08:32:13'),(27,70,'925C28BED4D46DE7749ABF990AF812AA','2018-11-12 08:32:15'),(28,71,'E9083A39CBCB6A69944E4FACB8A317A2','2018-11-12 08:33:42'),(29,72,'37B703AFA9A93A5EE4889FA15A27BD17','2018-11-12 09:48:19'),(30,73,'509DA913A7A77428840E8FABD3F13988','2018-11-12 09:52:47'),(31,74,'FDF0C97C6666490884EDAF98DC9043CD','2018-11-12 09:53:32'),(32,78,'3D09DBE99696BC500405EFA20F9962B7','2018-11-16 12:50:14');
/*!40000 ALTER TABLE `solicitacoes_pagseguro` ENABLE KEYS */;
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
  `status_reg` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Excluída; 1 = Ativa',
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (24,2,'TER01',30,120.00,'2018-09-10',2,0,1),(25,1,'RI01',10,0.00,'2018-11-05',2,1,1),(26,3,'MRQ-01',10,0.00,'2018-11-15',2,1,1),(27,5,'BA02',10,120.00,'2018-12-10',2,1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Marcelo Boemeke da Silveira','marcelo.boemeke@gmail.com',1,'$2y$10$wqtDAQD2dMFJfN7qTiRXjO/b3L1HSIcp.dhRk3M7p64LIRZmeKW1S','04059242080','1123434531','1998-10-03','Desenvolvedor Web','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142','53984481526','5332715749','53991171142',5),(3,'Marcelo Boemeke da Silveira','marcelo.boemeke@hotmail.com',1,'$2y$10$TxNr9fyxZl.l7A6hjQJqNOUMbZFnVM4EzQSVSwBNr0inHHaAp1KqW','04059242083','1123434531','0000-00-00','Desenvolvedor','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142','53984382243','5332715749',NULL,3),(4,'Usuário de Testes','tester@testes.com.br',1,'$2y$10$lC97dKOvnp7dtewda34/feFYSOdMLEMFg8PsjIRjlcgGDmf6k/QYm','04059242081','1123434531','1957-08-24','Tester','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142',NULL,NULL,'53991171142',2),(5,'Fulano dos Testes','fulano@fulano.com.br',0,'$2y$10$S00MakJwsPpW/nf6EeHDsu6Nfuryrl7auSiWiEPrdZHrI8rt3J9cq','00000000002','0000000000','1998-10-03','Desocupado','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53991171142',NULL,NULL,NULL,2),(6,'Isamar Boemeke da Silveira','isamar@gmail.com',1,'$2y$10$JD.aX0o//NPCE2YlTvBwT.coUs7WGWQP3msA8phuQm4/1tX6dwbrO','03000000002','','1957-08-24','Dona de Casa','96090340','RS','Pelotas','Laranjal','Hulha Negra',1894,NULL,'53984481526','5332715749',NULL,NULL,2),(7,'Dona Proprietária','contato@farolterapeutico.com.br',1,'$2y$10$cODEiMaHgymnEWbri/1Bfeufz4F8qY104SnWPQjf0nCkPtrX58Oqe','00000000040','0000000000','2010-10-10','Dona Proprietária','96090000','RS','Pelotas','Exemplo','Exemplo',1234,NULL,'5332000000',NULL,NULL,'53991000000',4);
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

-- Dump completed on 2018-11-19 13:52:33
