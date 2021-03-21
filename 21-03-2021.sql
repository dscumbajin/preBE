-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.10-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para presupuestos_ventas
DROP DATABASE IF EXISTS `presupuestos_ventas`;
CREATE DATABASE IF NOT EXISTS `presupuestos_ventas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `presupuestos_ventas`;

-- Volcando estructura para tabla presupuestos_ventas.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `idUsu` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `nombreUsu` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL DEFAULT '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO',
  `mail` varchar(255) NOT NULL,
  `idPerfil` int(11) DEFAULT 1,
  PRIMARY KEY (`idUsu`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `FK_admins_perfil` (`idPerfil`),
  CONSTRAINT `FK_admins_perfil` FOREIGN KEY (`idPerfil`) REFERENCES `perfil` (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.admins: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`idUsu`, `usuario`, `nombreUsu`, `password`, `mail`, `idPerfil`) VALUES
	(1, 'admin', 'Administrador', '$2y$12$lMYD8QGS6IoWip.1d3iYVeluoPAZssk2sMMRge/2eSnQXzgPFxcpq', 'sistemas2@bateriasecuador.com', 2),
	(23, 'gjijon', 'Genesis Jijon ', '$2y$12$HYWpZCiZdEJ8SwYdGoENkO9Rv82sjtINPQOwIWB7TEG1IhKvT5HD.', 'gjijon@bateriasecuador.com', 2),
	(24, 'agonzalez', 'AndrÃ©s Gonzalez ', '$2y$12$l5KRdbZvdvdhxE1CPMjAaOET6pTMwmFfplWYBTEvQxll79FrC70SC', 'agonzales@bateriasecuador.com', 2);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.familia
DROP TABLE IF EXISTS `familia`;
CREATE TABLE IF NOT EXISTS `familia` (
  `codFam` varchar(50) NOT NULL,
  `desFam` varchar(50) DEFAULT NULL,
  `desFamilia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codFam`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.familia: 6 rows
/*!40000 ALTER TABLE `familia` DISABLE KEYS */;
INSERT INTO `familia` (`codFam`, `desFam`, `desFamilia`) VALUES
	('AGUA', 'AGUAS DESMINERALIZADA', 'AGUAS DESMINERALIZADA'),
	('ANTI', 'ANTISULFATENTES', 'ANTISULFATENTES'),
	('BATE', 'BATERIAS AUTOMOTRICES', 'BATERIAS AUTOMOTRICES'),
	('PLUM', 'PLUMAS', 'PLUMAS'),
	('RECI', 'RECICLADOF', 'RECICLADOF'),
	('TRIT', 'TRITURADO', 'TRITURADO');
/*!40000 ALTER TABLE `familia` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.historial_ventas
DROP TABLE IF EXISTS `historial_ventas`;
CREATE TABLE IF NOT EXISTS `historial_ventas` (
  `idHisVen` int(11) NOT NULL AUTO_INCREMENT,
  `codVen` varchar(50) DEFAULT NULL,
  `codLinea` varchar(50) DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `ventasU` int(11) DEFAULT NULL,
  `promocionU` int(11) DEFAULT NULL,
  `garantiaU` int(11) DEFAULT NULL,
  `facturadoV` double DEFAULT NULL,
  `generado` int(11) DEFAULT 0,
  PRIMARY KEY (`idHisVen`),
  KEY `FK_historialven_vendedor` (`codVen`),
  KEY `FK_historialven_listalinea` (`codLinea`),
  CONSTRAINT `FK_historialven_listalinea` FOREIGN KEY (`codLinea`) REFERENCES `listalinea` (`codLinea`),
  CONSTRAINT `FK_historialven_vendedor` FOREIGN KEY (`codVen`) REFERENCES `vendedor` (`codVen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.historial_ventas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historial_ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_ventas` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.listalinea
DROP TABLE IF EXISTS `listalinea`;
CREATE TABLE IF NOT EXISTS `listalinea` (
  `codLinea` varchar(50) NOT NULL DEFAULT '0',
  `nomLinea` varchar(50) NOT NULL,
  `estadoLinea` binary(1) NOT NULL DEFAULT '1',
  `codFam` varchar(50) DEFAULT NULL,
  `codMarca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codLinea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.listalinea: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `listalinea` DISABLE KEYS */;
INSERT INTO `listalinea` (`codLinea`, `nomLinea`, `estadoLinea`, `codFam`, `codMarca`) VALUES
	('108', 'TRITURADO', _binary 0x30, 'TRIT', 'NAP'),
	('124', 'RECICLADORA REFINACION (exp)', _binary 0x30, 'RECI', 'NAP'),
	('201', 'BATERIAS ECUADOR', _binary 0x31, 'BATE', 'ECU'),
	('212', 'BATERIAS VELKO EXPORTACION', _binary 0x30, 'BATE', 'MOT'),
	('213', 'BATERIAS RUBIX', _binary 0x31, 'BATE', 'RUB'),
	('216', 'BATERIAS HELLA EXPORTACION', _binary 0x30, 'BATE', 'HEL'),
	('217', 'BATERIAS KOOR  EXPORTACION', _binary 0x30, 'BATE', 'MOT'),
	('218', 'BATERIAS HELLA', _binary 0x31, 'BATE', 'HEL'),
	('220', 'AGUA DESMINERALIZADA', _binary 0x30, 'AGUA', 'ECU'),
	('221', 'BATERIAS ELEKTRA', _binary 0x30, 'BATE', 'ELE'),
	('222', 'BATERIAS MOTOREX', _binary 0x30, 'BATE', 'MOT'),
	('224', 'BATERIAS HYDRAULAN', _binary 0x30, 'BATE', 'MOT'),
	('225', 'BATERIAS SUPPLY EXPORTACION', _binary 0x30, 'BATE', 'MOT'),
	('250', 'ANTISULFATANTES', _binary 0x30, 'ANTI', 'ECU'),
	('301', 'COMERCIAL BOSCH', _binary 0x31, 'BATE', 'BOS'),
	('315', 'PLUMAS HELLA', _binary 0x30, 'PLUM', 'HEL');
/*!40000 ALTER TABLE `listalinea` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.marca
DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `codMarca` varchar(50) NOT NULL,
  `desMarca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codMarca`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.marca: 7 rows
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` (`codMarca`, `desMarca`) VALUES
	('BOS', 'BOSCH'),
	('ECU', 'ECUADOR'),
	('ELE', 'ELEKTRA'),
	('HEL', 'HELLA'),
	('MOT', 'MOTOREX'),
	('NAP', 'TRITURADO'),
	('RUB', 'RUBIX');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.perfil
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.perfil: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` (`idPerfil`, `perfil`) VALUES
	(1, 'user'),
	(2, 'admin');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.presupuesto_anio
DROP TABLE IF EXISTS `presupuesto_anio`;
CREATE TABLE IF NOT EXISTS `presupuesto_anio` (
  `idPresAnio` int(11) NOT NULL AUTO_INCREMENT,
  `anio` year(4) NOT NULL,
  `ventasPresU` int(11) DEFAULT NULL,
  `promoPresU` int(11) DEFAULT NULL,
  `garantPresU` int(11) DEFAULT NULL,
  `totalPresU` int(11) DEFAULT NULL,
  `precioMeta` double DEFAULT NULL,
  `activoAnio` int(1) DEFAULT 1,
  `codVen` varchar(50) DEFAULT NULL,
  `codLinea` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPresAnio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.presupuesto_anio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuesto_anio` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuesto_anio` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.presupuesto_mes
DROP TABLE IF EXISTS `presupuesto_mes`;
CREATE TABLE IF NOT EXISTS `presupuesto_mes` (
  `idPresMes` int(11) NOT NULL AUTO_INCREMENT,
  `idPresAnio` int(11) DEFAULT NULL,
  `mes` date DEFAULT NULL,
  `cantMesU` int(11) DEFAULT NULL,
  `cantPromoU` int(11) DEFAULT NULL,
  `cantGarantU` int(11) DEFAULT NULL,
  `cantTotalU` int(11) DEFAULT NULL,
  `presMesV` double DEFAULT NULL,
  `porcentaje` double DEFAULT NULL,
  PRIMARY KEY (`idPresMes`),
  KEY `FK_presupuesto_mes_presupuesto_anio` (`idPresAnio`),
  CONSTRAINT `FK_presupuesto_mes_presupuesto_anio` FOREIGN KEY (`idPresAnio`) REFERENCES `presupuesto_anio` (`idPresAnio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.presupuesto_mes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuesto_mes` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuesto_mes` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.segmento
DROP TABLE IF EXISTS `segmento`;
CREATE TABLE IF NOT EXISTS `segmento` (
  `codSeg` int(11) NOT NULL AUTO_INCREMENT,
  `desSeg` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codSeg`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.segmento: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `segmento` DISABLE KEYS */;
INSERT INTO `segmento` (`codSeg`, `desSeg`) VALUES
	(1, 'CALL CENTER DISTRIBUIDORES'),
	(2, 'CALL CENTER INSTITUCIONAL'),
	(3, 'COBERTURA SEG 0-1-2'),
	(4, 'COBERTURA SEG 3-4-5'),
	(5, 'COBERTURA SEG 0-1-3'),
	(6, 'COBERTURA SEG 0-1-4'),
	(7, 'COBERTURA SEG 0-1-5'),
	(8, 'COBERTURA SEG 0-1-6'),
	(9, 'COBERTURA SEG 0-1-7'),
	(10, 'COBERTURA SEG 3-4-5'),
	(11, 'OTRAS VENTAS'),
	(12, 'OTROS CANALES'),
	(13, 'PUNTOS DE SERVICIO'),
	(14, 'SEG 5'),
	(15, 'SERVICIO DOMICILIO'),
	(16, 'SUPERMERCADOS'),
	(17, 'ND');
/*!40000 ALTER TABLE `segmento` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.vendedor
DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor` (
  `codVen` varchar(50) NOT NULL DEFAULT '0',
  `nomVen` varchar(200) NOT NULL,
  `estadoVen` binary(1) NOT NULL DEFAULT '1',
  `codSeg` int(11) NOT NULL,
  PRIMARY KEY (`codVen`),
  KEY `FK_vendedor_segmento` (`codSeg`),
  CONSTRAINT `FK_vendedor_segmento` FOREIGN KEY (`codSeg`) REFERENCES `segmento` (`codSeg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.vendedor: ~53 rows (aproximadamente)
/*!40000 ALTER TABLE `vendedor` DISABLE KEYS */;
INSERT INTO `vendedor` (`codVen`, `nomVen`, `estadoVen`, `codSeg`) VALUES
	('00', 'FACTURADOR PLANTA', _binary 0x31, 17),
	('100', 'FABRIBAT CIA LTDA', _binary 0x31, 12),
	('102', '200 FACTURACION QUINCHE', _binary 0x31, 13),
	('104', 'CALLCENTER DISTRIBUIDORES GYE', _binary 0x31, 1),
	('130', '280 FACTURACION MANTA', _binary 0x31, 13),
	('140', '230 FACTURACION LATACUNGA', _binary 0x31, 17),
	('15', '30 FACTURADORA CUENCA', _binary 0x31, 13),
	('150', 'VENTA DOMICILIO GUAYAQUIL', _binary 0x31, 15),
	('18', '10 FACTURADORA OCCIDENTAL', _binary 0x31, 13),
	('190', 'VENTA DIRECTA', _binary 0x31, 17),
	('210', 'SUPERMERCADOS', _binary 0x31, 16),
	('220', 'VENDEDOR GUAYAQUIL', _binary 0x31, 17),
	('221', 'FACTURADOR MATRIZ', _binary 0x31, 17),
	('225', '225 FACTURACION IBARRA 2', _binary 0x31, 17),
	('25', '20 FACTURADORA GUAYAQUIL', _binary 0x31, 13),
	('255', '255 FACTURACION STO DOMINGO 3', _binary 0x31, 17),
	('28', 'EMPLEADOS', _binary 0x31, 12),
	('310', '310  FACTURACION RIOBAMBA', _binary 0x31, 17),
	('36', '210 FACTURACION AMBATO', _binary 0x31, 13),
	('40', 'CUENTAS CLAVES NORTE', _binary 0x31, 4),
	('50', '100 FACTURACION SUR', _binary 0x31, 13),
	('51', '140 FACTURACION TUMBACO 1', _binary 0x31, 13),
	('52', '160 FACTURACION SAN RAFAEL 1', _binary 0x31, 13),
	('57', 'FACTURACION CUE SUR', _binary 0x31, 17),
	('58', '270 FACTURACION GYE CENTRO', _binary 0x31, 13),
	('59', 'VENDEDOR IBARRA TULCAN', _binary 0x31, 3),
	('62', '70 FACTURACION UIO NORTE', _binary 0x31, 13),
	('63', 'VENDEDOR STO DGO ESMERALDAS', _binary 0x31, 3),
	('65', 'VENDEDOR MANABI', _binary 0x31, 3),
	('66', 'CLIENTES SEG 5', _binary 0x31, 14),
	('67', '240 FACTURACION STO DOMINGO 1', _binary 0x31, 13),
	('68', '40 FACTURACION CARAPUNGO 1', _binary 0x31, 13),
	('70', '220 FACTURACION IBARRA', _binary 0x31, 13),
	('71', 'VENTA DOMICILIO OCCIDENTAL', _binary 0x31, 15),
	('75', 'VENDEDOR CUENCA', _binary 0x31, 3),
	('76', 'VENDEDOR ZONA CENTRAL ', _binary 0x31, 3),
	('79', 'CALLCENTER INSTITUCIONAL', _binary 0x31, 17),
	('80', 'CALLCENTER DISTRIBUIDORES', _binary 0x31, 1),
	('82', 'VENDEDOR COCA LAGO AGRIO', _binary 0x31, 3),
	('83', '150 FACTURACION TUMBACO 2', _binary 0x31, 13),
	('84', '170 FACTURACION SAN RAFAEL 2', _binary 0x31, 13),
	('85', '130 FACTURACION GUAMANI', _binary 0x31, 13),
	('87', 'MICHAEL HUFF', _binary 0x31, 11),
	('88', '60 FACTURACION OFELIA', _binary 0x31, 13),
	('89', '90 FACTURACION VILLAFLORA', _binary 0x31, 13),
	('90', '180 FACTURACION SANGOLQUI', _binary 0x31, 13),
	('91', '80 FACTURACION INCA', _binary 0x31, 13),
	('92', '260 FACTURACION ESMERALDAS', _binary 0x31, 13),
	('93', 'CUENTAS CLAVES SUR', _binary 0x31, 4),
	('94', '50 FACTURACION CARAPUNGO 2', _binary 0x31, 13),
	('95', '250 FACTURACION STO DOMINGO 2', _binary 0x31, 17),
	('97', '110 FACTURACION MARISCAL', _binary 0x31, 13),
	('98', '120 FACTURACION QUITUMBE', _binary 0x31, 17);
/*!40000 ALTER TABLE `vendedor` ENABLE KEYS */;

-- Volcando estructura para procedimiento presupuestos_ventas.PA_REG
DROP PROCEDURE IF EXISTS `PA_REG`;
DELIMITER //
CREATE PROCEDURE `PA_REG`(IN codVen VARCHAR(50), IN codLinea VARCHAR(50),
IN anio YEAR, IN ventasU INT(11), IN promocionU INT(11) , IN garantiaU INT(11),
IN facturadoV DOUBLE)
INSERT INTO historial_ventas(codVen, codLinea, anio, ventasU, promocionU, garantiaU, facturadoV)
VALUES(codVen, codLinea, anio, ventasU, promocionU, garantiaU, facturadoV)//
DELIMITER ;

-- Volcando estructura para procedimiento presupuestos_ventas.PA_REG_PRES_ANIO
DROP PROCEDURE IF EXISTS `PA_REG_PRES_ANIO`;
DELIMITER //
CREATE PROCEDURE `PA_REG_PRES_ANIO`(IN codVen VARCHAR(50), IN codLinea VARCHAR(50), IN anio YEAR, 
IN ventasPresU INT(11), IN promoPresU INT(11), IN garantPresU INT(11), IN totalPresU INT(11))
INSERT INTO presupuesto_anio(codVen, codLinea, anio, ventasPresU, promoPresU, garantPresU,totalPresU)
VALUES(codVen, codLinea, anio, ventasPresU, promoPresU, garantPresU,totalPresU)//
DELIMITER ;

-- Volcando estructura para procedimiento presupuestos_ventas.PA_REG_PRES_MES
DROP PROCEDURE IF EXISTS `PA_REG_PRES_MES`;
DELIMITER //
CREATE PROCEDURE `PA_REG_PRES_MES`(IN idPresAnio INT(11), IN mes DATE, IN cantMesU INT(11), 
IN cantPromoU INT(11), IN cantGarantU INT(11), IN cantTotalU INT(11), IN presMesV FLOAT)
INSERT INTO presupuesto_mes(idPresAnio, mes, cantMesU, cantPromoU, cantGarantU, cantTotalU,presMesV)
VALUES(idPresAnio, mes, cantMesU, cantPromoU, cantGarantU, cantTotalU,presMesV)//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
