CREATE DATABASE  IF NOT EXISTS `dbsr` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbsr`;
-- drop database dbsr;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tbl_espacios_fisicos_materiales_materiales`
--

DROP TABLE IF EXISTS `tbl_espacios_fisicos_materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_espacios_fisicos_materiales` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `espacios_fisicos_id` int(11) NOT NULL,
  `materiales_id` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `espacios_fisicos_id_fk` (`espacios_fisicos_id`),
  KEY `materiales_id_id_fk` (`materiales_id`),
  CONSTRAINT `espacios_fisicos_id_fk` FOREIGN KEY (`espacios_fisicos_id`) REFERENCES `tbl_espacios_fisicos` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `materiales_id_id_fk` FOREIGN KEY (`materiales_id`) REFERENCES `tbl_materiales` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;



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
  CONSTRAINT `eventos_id` FOREIGN KEY (`eventos_id`) REFERENCES `tbl_eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `espacios_fisicos_id` FOREIGN KEY (`espacios_fisicos_id`) REFERENCES `tbl_espacios_fisicos` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `materiales_id` FOREIGN KEY (`materiales_id`) REFERENCES `tbl_materiales` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`idRow`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `class` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `start` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `end` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `numero_personas` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `tiene_peticion` bit(1) DEFAULT b'0',
  `es_cancelado` bit(1) DEFAULT b'0',
  `fecha_cancelado` datetime DEFAULT '0001-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `usuarios_id_idx` (`usuarios_id`),
  KEY `status_id_idx` (`status_id`),
  CONSTRAINT `usuarios_id` FOREIGN KEY (`usuarios_id`) REFERENCES `tbl_usuarios` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_reservaciones_status` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_peticiones`
--

DROP TABLE IF EXISTS `tbl_peticiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_peticiones` (
  `idRow` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) CHARACTER SET latin1 NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `peticion_status` int(11) NOT NULL,
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `usuarios_id_id_fk` (`usuarios_id`),
  KEY `peticion_status_id_fk` (`peticion_status`),
  CONSTRAINT `peticion_status_id_fk` FOREIGN KEY (`peticion_status`) REFERENCES `tbl_peticiones_status` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuarios_id_id_fk` FOREIGN KEY (`usuarios_id`) REFERENCES `tbl_usuarios` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `correo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `puesto_principal_id` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRow`),
  UNIQUE KEY `idRow` (`idRow`),
  KEY `puesto_principal_id_fk` (`puesto_principal_id`),
  CONSTRAINT `puesto_principal_id_fk` FOREIGN KEY (`puesto_principal_id`) REFERENCES `tbl_roles` (`idRow`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Dumping routines for database 'dbsr'
--

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

-- Dump completed on 2016-02-06  9:30:20

-- Creacion de vistas
CREATE VIEW vw_obtAreas AS
SELECT are.idRow  AS idRow,
       are.nombre AS area_nombre,
	   are.roles_id AS roles_id,
       rol.nombre AS rol_nombre
FROM tbl_areas     AS are
JOIN tbl_roles    AS rol       ON rol.idRow = are.roles_id;

CREATE VIEW vw_obtespacios_fisicos AS
SELECT esp.idRow         AS idRow,
       esp.nombre        AS espNombre,
       esp.descripcion   AS descripcion,
       esp.capacidad     AS capacidad,
       esp.areas_id      AS areas_id,
       ars.nombre        AS arsnombre
FROM tbl_espacios_fisicos AS esp
JOIN tbl_areas            AS ars    ON ars.idRow = esp.areas_id;
