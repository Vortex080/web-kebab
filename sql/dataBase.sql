/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET NAMES utf8 */
;

/*!50503 SET NAMES utf8mb4 */
;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;

/*!40103 SET TIME_ZONE='+00:00' */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

-- Volcando estructura de base de datos para kebab
CREATE DATABASE IF NOT EXISTS `kebab`
/*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */
;

USE `kebab`;

-- Volcando estructura para tabla kebab.alergenos
CREATE TABLE IF NOT EXISTS `alergenos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla kebab.ingredientes
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla kebab.ingredientes_has_alergenos
CREATE TABLE IF NOT EXISTS `ingredientes_has_alergenos` (
  `id_ingrediente` int(11) DEFAULT NULL,
  `id_alergenos` int(11) DEFAULT NULL,
  KEY `FK_ingredientes_has_alergenos_ingredientes` (`id_ingrediente`),
  KEY `FK_ingredientes_has_alergenos_alergenos` (`id_alergenos`),
  CONSTRAINT `FK_ingredientes_has_alergenos_alergenos` FOREIGN KEY (`id_alergenos`) REFERENCES `alergenos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ingredientes_has_alergenos_ingredientes` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla kebab.kebab
CREATE TABLE IF NOT EXISTS `kebab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla kebab.kebab_has_ingredientes
CREATE TABLE IF NOT EXISTS `kebab_has_ingredientes` (
  `id_kebab` int(11) DEFAULT NULL,
  `id_ingrediente` int(11) DEFAULT NULL,
  KEY `FK__kebab` (`id_kebab`),
  KEY `FK__ingredientes` (`id_ingrediente`),
  CONSTRAINT `FK__ingredientes` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__kebab` FOREIGN KEY (`id_kebab`) REFERENCES `kebab` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla kebab.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` time NOT NULL DEFAULT '00:00:00',
  `estado` varchar(50) NOT NULL DEFAULT '0',
  `precio` varchar(50) NOT NULL DEFAULT '0',
  `direction` varchar(50) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK__usuario` (`userid`),
  CONSTRAINT `FK__usuario` FOREIGN KEY (`userid`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla kebab.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `monedero` int(11) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `direccition` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.
/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */
;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */
;

/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */
;