DROP database  IF exists dbsr;
CREATE DATABASE  IF NOT EXISTS `dbsr` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbsr`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: dbsr
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `tbl_areas`
--

DROP TABLE IF EXISTS `tbl_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_areas` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  `eliminado` bit(1) DEFAULT b'0',
  `roles_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `usuarios_id_fk_idx` (`roles_id`),
  CONSTRAINT `roles_id` FOREIGN KEY (`roles_id`) REFERENCES `tbl_roles` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_areas`
--

LOCK TABLES `tbl_areas` WRITE;
/*!40000 ALTER TABLE `tbl_areas` DISABLE KEYS */;
INSERT INTO `tbl_areas` VALUES (1,'TicÂ´s','\0',2),(2,'Talleres y Mantenimi','\0',3),(3,'Deportivas','\0',4),(4,'Auditorio','\0',5);
/*!40000 ALTER TABLE `tbl_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_espacios_fisicos`
--

DROP TABLE IF EXISTS `tbl_espacios_fisicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_espacios_fisicos` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `descripcion` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `areas_id` int(11) DEFAULT NULL,
  `eliminado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`idRow`),
  KEY `areas_id_idx` (`areas_id`),
  CONSTRAINT `areas_id` FOREIGN KEY (`areas_id`) REFERENCES `tbl_areas` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_espacios_fisicos`
--

LOCK TABLES `tbl_espacios_fisicos` WRITE;
/*!40000 ALTER TABLE `tbl_espacios_fisicos` DISABLE KEYS */;
INSERT INTO `tbl_espacios_fisicos` VALUES (1,'Centro de Computo','Es el centro de computo',30,1,'\0'),(2,'Mixto','Centro Mixto',30,1,'\0'),(3,'Centro de Idiomas','Centro de idiomas',30,1,'\0'),(4,'Centro de idiomas Audio','Centro de idiomas audiovisual',30,1,'\0'),(5,'Automotris','Automotris',30,2,'\0'),(6,'Electromecanica','Electromecanica',30,2,'\0'),(7,'Enfermeria','Enfermeria',30,2,'\0'),(8,'Mantemiento','Mantenimiento',30,2,'\0'),(9,'Futbol Uruguayo','Futbol Uruguayo',22,3,'\0'),(10,'FrontÃ³n','Fronton',30,3,'\0'),(11,'Usus Multiples1','Usus Multiples 1',30,3,'\0'),(12,'Usus Multiples2','Usus Multiples2',30,3,'\0'),(13,'Sala Audiovisual','Sala Audiovisual',30,4,'\0'),(14,'Aula Tipo','Aula Tipo',30,4,'\0');
/*!40000 ALTER TABLE `tbl_espacios_fisicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_evento_cancelado`
--

DROP TABLE IF EXISTS `tbl_evento_cancelado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_evento_cancelado` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(11) NOT NULL,
  `eventos_id` int(11) NOT NULL,
  `comentario` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `usuarios_id_cancel_fk` (`usuarios_id`),
  KEY `reservaciones_id_cancel_fk` (`eventos_id`),
  CONSTRAINT `usuarios_id_cancel_fk` FOREIGN KEY (`usuarios_id`) REFERENCES `tbl_usuarios` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_evento_cancelado`
--

LOCK TABLES `tbl_evento_cancelado` WRITE;
/*!40000 ALTER TABLE `tbl_evento_cancelado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_evento_cancelado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_evento_detalle`
--

DROP TABLE IF EXISTS `tbl_evento_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_evento_detalle` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `eventos_id` int(11) DEFAULT NULL,
  `espacios_fisicos_id` int(11) DEFAULT NULL,
  `materiales_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRow`),
  KEY `eventos_id_idx` (`eventos_id`),
  KEY `espacios_fisicos_id_idx` (`espacios_fisicos_id`),
  KEY `materiales_id_idx` (`materiales_id`),
  CONSTRAINT `espacios_fisicos_id` FOREIGN KEY (`espacios_fisicos_id`) REFERENCES `tbl_espacios_fisicos` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `eventos_id` FOREIGN KEY (`eventos_id`) REFERENCES `tbl_eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `materiales_id` FOREIGN KEY (`materiales_id`) REFERENCES `tbl_materiales` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_evento_detalle`
--

LOCK TABLES `tbl_evento_detalle` WRITE;
/*!40000 ALTER TABLE `tbl_evento_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_evento_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_evento_peticion`
--

DROP TABLE IF EXISTS `tbl_evento_peticion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_evento_peticion` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `eventos_id` int(11) DEFAULT NULL,
  `peticion_id` int(11) DEFAULT NULL,
  `eliminado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`idRow`),
  KEY `eventos_id_idx` (`eventos_id`),
  KEY `peticion_id_idx` (`peticion_id`),
  CONSTRAINT `eventos_id_fk` FOREIGN KEY (`eventos_id`) REFERENCES `tbl_eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `peticion_id_fk` FOREIGN KEY (`peticion_id`) REFERENCES `tbl_peticiones` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_evento_peticion`
--

LOCK TABLES `tbl_evento_peticion` WRITE;
/*!40000 ALTER TABLE `tbl_evento_peticion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_evento_peticion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_eventos`
--

DROP TABLE IF EXISTS `tbl_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `body` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `class` varchar(45) CHARACTER SET latin1 DEFAULT 'event-important',
  `start` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `end` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `numero_personas` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `tiene_peticion` bit(1) DEFAULT b'0',
  `es_cancelado` bit(1) DEFAULT b'0',
  `fecha_cancelado` datetime DEFAULT '0001-01-01 00:00:00',
  `inicio_normal` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `final_normal` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_id_idx` (`usuarios_id`),
  KEY `status_id_idx` (`status_id`),
  CONSTRAINT `status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_reservaciones_status` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuarios_id` FOREIGN KEY (`usuarios_id`) REFERENCES `tbl_usuarios` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_eventos`
--

LOCK TABLES `tbl_eventos` WRITE;
/*!40000 ALTER TABLE `tbl_eventos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_materiales`
--

DROP TABLE IF EXISTS `tbl_materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_materiales` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 NOT NULL,
  `existencias` int(11) NOT NULL,
  `imagen` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_materiales`
--

LOCK TABLES `tbl_materiales` WRITE;
/*!40000 ALTER TABLE `tbl_materiales` DISABLE KEYS */;
INSERT INTO `tbl_materiales` VALUES (5,'CaÃ±on proyector x','es el caÃ±on que tiene la marca beg',3,'img/img_upload/4718755035166.jpg',0),(6,'Pinzas de electricco','son las de color verde',28,'img/img_upload/267G.jpg',0),(7,'caÃ±on que voy a bor','hahaha',60,'img/img_upload/4718755035166.jpg',1);
/*!40000 ALTER TABLE `tbl_materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_peticiones`
--

DROP TABLE IF EXISTS `tbl_peticiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_peticiones` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) CHARACTER SET latin1 NOT NULL,
  `eventos_id` int(11) NOT NULL,
  `peticion_status` int(11) NOT NULL,
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `usuarios_id_id_fk` (`eventos_id`),
  KEY `peticion_status_id_fk` (`peticion_status`),
  CONSTRAINT `eventos_id_id_fk` FOREIGN KEY (`eventos_id`) REFERENCES `tbl_eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `peticion_status_id_fk` FOREIGN KEY (`peticion_status`) REFERENCES `tbl_peticiones_status` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_peticiones`
--

LOCK TABLES `tbl_peticiones` WRITE;
/*!40000 ALTER TABLE `tbl_peticiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_peticiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_peticiones_status`
--

DROP TABLE IF EXISTS `tbl_peticiones_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_peticiones_status` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_peticiones_status`
--

LOCK TABLES `tbl_peticiones_status` WRITE;
/*!40000 ALTER TABLE `tbl_peticiones_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_peticiones_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reservaciones_status`
--

DROP TABLE IF EXISTS `tbl_reservaciones_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reservaciones_status` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reservaciones_status`
--

LOCK TABLES `tbl_reservaciones_status` WRITE;
/*!40000 ALTER TABLE `tbl_reservaciones_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reservaciones_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'admin','administrador del sistema',0),(2,'tics','supervisor de las areas y espacios fisicos de tics',0),(3,'Taller y Manten','supervisor de los talleres y las areas de mantenimieno ',0),(4,'Deportivas','supervisor de las areas deportivas',0),(5,'Audirio','supervisor del auditorio',0),(6,'Personal','Es el personal que solo puede reservar un area',0);
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuarios` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  `app` varchar(20) CHARACTER SET latin1 NOT NULL,
  `apm` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `usuario` varchar(10) CHARACTER SET latin1 NOT NULL,
  `password` varchar(8) CHARACTER SET latin1 NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `puesto_principal_id` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `puesto_principal_id_fk` (`puesto_principal_id`),
  CONSTRAINT `puesto_principal_id_fk` FOREIGN KEY (`puesto_principal_id`) REFERENCES `tbl_roles` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'admin','admin','admin','admin','12345678','admin',1,0),(2,'Javier','Mendez','Delgado','Javier','12345678','javier@gmail',2,0);
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios_roles`
--

DROP TABLE IF EXISTS `tbl_usuarios_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuarios_roles` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `usuarios_id_usu_rol_fk` (`usuarios_id`),
  KEY `roles_id_usu_rol_fk` (`roles_id`),
  CONSTRAINT `roles_id_usu_rol_fk` FOREIGN KEY (`roles_id`) REFERENCES `tbl_roles` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuarios_id_usu_rol_fk` FOREIGN KEY (`usuarios_id`) REFERENCES `tbl_usuarios` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios_roles`
--

LOCK TABLES `tbl_usuarios_roles` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios_roles` DISABLE KEYS */;
INSERT INTO `tbl_usuarios_roles` VALUES (1,1,1,0),(2,1,2,0),(3,1,3,0),(4,1,4,0),(5,1,5,0);
/*!40000 ALTER TABLE `tbl_usuarios_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_obtareas`
--

DROP TABLE IF EXISTS `vw_obtareas`;
/*!50001 DROP VIEW IF EXISTS `vw_obtareas`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_obtareas` (
  `idRow` tinyint NOT NULL,
  `area_nombre` tinyint NOT NULL,
  `roles_id` tinyint NOT NULL,
  `rol_nombre` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_obtespacios_fisicos`
--

DROP TABLE IF EXISTS `vw_obtespacios_fisicos`;
/*!50001 DROP VIEW IF EXISTS `vw_obtespacios_fisicos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_obtespacios_fisicos` (
  `idRow` tinyint NOT NULL,
  `espNombre` tinyint NOT NULL,
  `descripcion` tinyint NOT NULL,
  `capacidad` tinyint NOT NULL,
  `areas_id` tinyint NOT NULL,
  `arsnombre` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_obtusuario`
--

DROP TABLE IF EXISTS `vw_obtusuario`;
/*!50001 DROP VIEW IF EXISTS `vw_obtusuario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_obtusuario` (
  `idRow` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `app` tinyint NOT NULL,
  `apm` tinyint NOT NULL,
  `usuario` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `correo` tinyint NOT NULL,
  `puesto_principal_id` tinyint NOT NULL,
  `nombre_rol` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'dbsr'
--

--
-- Dumping routines for database 'dbsr'
--

--
-- Final view structure for view `vw_obtareas`
--

/*!50001 DROP TABLE IF EXISTS `vw_obtareas`*/;
/*!50001 DROP VIEW IF EXISTS `vw_obtareas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_obtareas` AS select `are`.`idRow` AS `idRow`,`are`.`nombre` AS `area_nombre`,`are`.`roles_id` AS `roles_id`,`rol`.`nombre` AS `rol_nombre` from (`tbl_areas` `are` join `tbl_roles` `rol` on((`rol`.`idRow` = `are`.`roles_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_obtespacios_fisicos`
--

/*!50001 DROP TABLE IF EXISTS `vw_obtespacios_fisicos`*/;
/*!50001 DROP VIEW IF EXISTS `vw_obtespacios_fisicos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_obtespacios_fisicos` AS select `esp`.`idRow` AS `idRow`,`esp`.`nombre` AS `espNombre`,`esp`.`descripcion` AS `descripcion`,`esp`.`capacidad` AS `capacidad`,`esp`.`areas_id` AS `areas_id`,`ars`.`nombre` AS `arsnombre` from (`tbl_espacios_fisicos` `esp` join `tbl_areas` `ars` on((`ars`.`idRow` = `esp`.`areas_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_obtusuario`
--

/*!50001 DROP TABLE IF EXISTS `vw_obtusuario`*/;
/*!50001 DROP VIEW IF EXISTS `vw_obtusuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_obtusuario` AS select `usu`.`idRow` AS `idRow`,`usu`.`nombre` AS `nombre`,`usu`.`app` AS `app`,`usu`.`apm` AS `apm`,`usu`.`usuario` AS `usuario`,`usu`.`password` AS `password`,`usu`.`correo` AS `correo`,`usu`.`puesto_principal_id` AS `puesto_principal_id`,`rol`.`nombre` AS `nombre_rol` from (`tbl_usuarios` `usu` join `tbl_roles` `rol` on((`rol`.`idRow` = `usu`.`puesto_principal_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-11 10:17:56

-- Registros base
INSERT INTO `dbsr`.`tbl_peticiones_status` (`idRow`, `nombre`, `eliminado`) VALUES ('1', 'Nueva', '0');
INSERT INTO `dbsr`.`tbl_peticiones_status` (`idRow`, `nombre`, `eliminado`) VALUES ('2', 'Atendiendo', '0');
INSERT INTO `dbsr`.`tbl_peticiones_status` (`idRow`, `nombre`, `eliminado`) VALUES ('3', 'Solucionada', '0');

INSERT INTO `dbsr`.`tbl_reservaciones_status` (`idRow`, `nombre`, `eliminado`) VALUES ('1', 'Creada', '0');
INSERT INTO `dbsr`.`tbl_reservaciones_status` (`idRow`, `nombre`, `eliminado`) VALUES ('2', 'Cancelada', '0');

Create view vw_peticiones AS
SELECT pet.idRow       AS peticion_id,
	   pet.descripcion AS descripcion,
     pet.peticion_status AS peticion_status,
       pst.nombre        AS nombre_estarus,
       evt.id          AS eventos_id,
       evt.title       AS evento_titulo,
	   usu.usuario     AS usuario
FROM tbl_eventos    AS evt
JOIN tbl_peticiones AS pet   ON evt.id    = pet.eventos_id
JOIN tbl_usuarios   AS usu   ON usu.idRow = evt.usuarios_id
JOIN tbl_peticiones_status AS pst ON pst.idRow = pet.peticion_status
WHERE evt.es_cancelado = 0 OR evt.status_id = 1;

CREATE View vw_sentCorreoUsuarioReserva AS
select usu.correo    AS correo_usuario,
       usu.usuario   AS usuario_no,
       usu.nombre    AS nombre,
       usu.app       AS apellido_1,
       usu.apm       AS apellido_2,
       evn.id        AS eventos_id
FROM tbl_eventos   AS evn
JOIN tbl_usuarios AS usu  ON usu.idRow = evn.usuarios_id;
