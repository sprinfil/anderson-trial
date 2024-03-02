/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `crud_anderson` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `crud_anderson`;

CREATE TABLE IF NOT EXISTS `participa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint DEFAULT NULL,
  `proyecto_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `FK__proyectos` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `participa` (`id`, `usuario_id`, `proyecto_id`) VALUES
	(23, 25, 13),
	(24, 32, 13);

CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `proyectos` (`id`, `nombre`) VALUES
	(13, 'SISTEMA DE CLINICAS');

CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_finalziar` date DEFAULT NULL,
  `proyecto_id` bigint NOT NULL,
  `usuario_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyecto_id` (`proyecto_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `FK__proyectos_tareas` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_tareas_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tareas` (`id`, `nombre`, `fecha_finalziar`, `proyecto_id`, `usuario_id`) VALUES
	(19, 'MODULO DE ODONTOGRAMA', '2024-03-21', 13, 25),
	(20, 'MODULO DE REPORTES', '2024-03-23', 13, 32);

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rol` enum('USUARIO','EDITOR','ADMINISTRADOR') DEFAULT 'USUARIO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `username`, `rol`) VALUES
	(25, 'JEREMIAS', '$2y$10$SdrZaYG7e2NxNtkDbSBoxuBmsq5l8RLT9.iL3l4UHRdRZ1yuaMO76', 'sprinfil', 'ADMINISTRADOR'),
	(32, 'OSMAR', '$2y$10$fJjshUlE/6MRsfGeCJ4Ti.EUMueaXG67t3MIbmxe.droiJjvnxyau', 'OSMARLG', 'EDITOR'),
	(33, 'ALDO', '$2y$10$5Gz4UFdHAiQX5.Ys1Cni8OQbqpKOOuXmG/rUL94ClJhqtH3C3j22W', 'XBOX', 'USUARIO'),
	(34, 'PABLO', '$2y$10$bVK/T1UONfxUcbnFPLwzg.kfhQLfkekxCJ/HXE4trQDeOOA5d6nFC', 'STARGHOST', 'USUARIO');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
