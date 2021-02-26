-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.10-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para presupuestos_ventas
CREATE DATABASE IF NOT EXISTS `presupuestos_ventas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `presupuestos_ventas`;

-- Volcando estructura para tabla presupuestos_ventas.admins
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.admins: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`idUsu`, `usuario`, `nombreUsu`, `password`, `mail`, `idPerfil`) VALUES
	(1, 'admin', 'Administrador', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'sistemas2@bateriasecuador.com', 2),
	(3, 'prueba', 'Darwin Cumbajin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'cumbajindarwin@hotmail.com', 1);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.familia
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
CREATE TABLE IF NOT EXISTS `historial_ventas` (
  `idHisVen` int(11) NOT NULL AUTO_INCREMENT,
  `anio` year(4) DEFAULT NULL,
  `ventasU` int(11) DEFAULT NULL,
  `promocionU` int(11) DEFAULT NULL,
  `garantiaU` int(11) DEFAULT NULL,
  `facturadoV` double DEFAULT NULL,
  `codVen` varchar(50) DEFAULT NULL,
  `codLinea` varchar(50) DEFAULT NULL,
  `generado` int(11) DEFAULT 0,
  PRIMARY KEY (`idHisVen`),
  KEY `FK_historialven_vendedor` (`codVen`),
  KEY `FK_historialven_listalinea` (`codLinea`),
  CONSTRAINT `FK_historialven_listalinea` FOREIGN KEY (`codLinea`) REFERENCES `listalinea` (`codLinea`),
  CONSTRAINT `FK_historialven_vendedor` FOREIGN KEY (`codVen`) REFERENCES `vendedor` (`codVen`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.historial_ventas: ~208 rows (aproximadamente)
/*!40000 ALTER TABLE `historial_ventas` DISABLE KEYS */;
INSERT INTO `historial_ventas` (`idHisVen`, `anio`, `ventasU`, `promocionU`, `garantiaU`, `facturadoV`, `codVen`, `codLinea`, `generado`) VALUES
	(39, '2020', 7, 0, 0, 561.98, '00', '201', 0),
	(40, '2020', 752, 51, 67, 44393.57, '15', '201', 0),
	(41, '2020', 5332, 0, 284, 501800.63, '18', '201', 0),
	(42, '2020', 610, 8, 228, 33798.62, '25', '201', 0),
	(43, '2020', 344, 12, 4, 23703.76, '28', '201', 0),
	(44, '2020', 927, 0, 35, 84619.9, '36', '201', 0),
	(45, '2020', 25610, 2071, 908, 1579108.87, '40', '201', 0),
	(46, '2020', 297, 0, 10, 26124.9, '50', '201', 0),
	(47, '2020', 686, 0, 11, 63443.91, '51', '201', 0),
	(48, '2020', 635, 0, 32, 54602.04, '52', '201', 0),
	(49, '2020', 1, 0, 0, 100.75, '57', '201', 0),
	(50, '2020', 603, 0, 146, 39204.68, '58', '201', 0),
	(51, '2020', 9171, 641, 371, 616326.19, '59', '201', 0),
	(52, '2020', 616, 0, 11, 54790.62, '62', '201', 0),
	(53, '2020', 12206, 827, 291, 836375.7, '63', '201', 0),
	(54, '2020', 7734, 580, 293, 501493.93, '65', '201', 0),
	(55, '2020', 27683, 1607, 672, 1535475.57, '66', '201', 0),
	(56, '2020', 1159, 0, 57, 98217.12, '67', '201', 0),
	(57, '2020', 538, 0, 8, 41888, '68', '201', 0),
	(58, '2020', 414, 0, 33, 39853.95, '70', '201', 0),
	(59, '2020', 2257, 0, 13, 238883.16, '71', '201', 0),
	(60, '2020', 16011, 1136, 621, 999755.34, '75', '201', 0),
	(61, '2020', 977, 73, 26, 73873.47, '76', '201', 0),
	(62, '2020', 2611, 28, 14, 266423.98, '79', '201', 0),
	(63, '2020', 2231, 84, 24, 174813.91, '80', '201', 0),
	(64, '2020', 7920, 524, 215, 608466.39, '82', '201', 0),
	(65, '2020', 786, 0, 16, 73211.83, '83', '201', 0),
	(66, '2020', 30, 0, 0, 2495.29, '84', '201', 0),
	(67, '2020', 468, 0, 10, 42327.62, '85', '201', 0),
	(68, '2020', 392, 0, 14, 31175.52, '88', '201', 0),
	(69, '2020', 586, 1, 22, 46990.61, '89', '201', 0),
	(70, '2020', 924, 7, 39, 77282.07, '90', '201', 0),
	(71, '2020', 759, 0, 20, 57205.79, '91', '201', 0),
	(72, '2020', 1097, 0, 64, 91094.27, '92', '201', 0),
	(73, '2020', 58017, 3689, 1658, 3307345.93, '93', '201', 0),
	(74, '2020', 1194, 36, 33, 95472.07, '94', '201', 0),
	(75, '2020', 1, 0, 0, 121.97, '95', '201', 0),
	(76, '2020', 298, 0, 10, 24224.06, '97', '201', 0),
	(77, '2020', 1, 0, 0, 71.5, '98', '201', 0),
	(78, '2020', 2363, 0, 1, 178214.24, '100', '201', 0),
	(79, '2020', 321, 0, 15, 27319.57, '102', '201', 0),
	(80, '2020', 423, 14, 6, 28869.27, '104', '201', 0),
	(81, '2020', 471, 0, 33, 39292.98, '130', '201', 0),
	(82, '2020', 1, 0, 0, 98.21, '140', '201', 0),
	(83, '2020', 93, 0, 1, 9220.21, '150', '201', 0),
	(84, '2020', 0, 0, 0, 0, '190', '201', 0),
	(85, '2020', 5990, 0, 4, 329580.79, '210', '201', 0),
	(86, '2020', 2832, 253, 41, 174937.14, '220', '201', 0),
	(87, '2020', 5, 0, 1, 329.13, '221', '201', 0),
	(88, '2020', 8, 0, 0, 714.02, '225', '201', 0),
	(89, '2020', 5, 0, 0, 340.29, '255', '201', 0),
	(90, '2020', 52, 0, 0, 4607.9, '310', '201', 0),
	(91, '2020', 0, 0, 0, 0, '00', '218', 0),
	(92, '2020', 11, 0, 0, 876.69, '15', '218', 0),
	(93, '2020', 171, 0, 13, 15901.23, '18', '218', 0),
	(94, '2020', 3, 0, 0, 317, '25', '218', 0),
	(95, '2020', 8, 0, 0, 670.45, '28', '218', 0),
	(96, '2020', 30, 0, 0, 2818.43, '36', '218', 0),
	(97, '2020', 633, 81, 13, 37402.45, '40', '218', 0),
	(98, '2020', 45, 0, 1, 3580.96, '50', '218', 0),
	(99, '2020', 72, 0, 0, 7037.1, '51', '218', 0),
	(100, '2020', 90, 0, 0, 7848.38, '52', '218', 0),
	(101, '2020', 0, 0, 0, 0, '57', '218', 0),
	(102, '2020', 24, 0, 0, 1975.77, '58', '218', 0),
	(103, '2020', 1152, 133, 7, 71168.71, '59', '218', 0),
	(104, '2020', 21, 0, 0, 1788.89, '62', '218', 0),
	(105, '2020', 1897, 184, 27, 117439.01, '63', '218', 0),
	(106, '2020', 225, 16, 6, 11785.45, '65', '218', 0),
	(107, '2020', 11651, 1181, 255, 620389.98, '66', '218', 0),
	(108, '2020', 12, 0, 0, 1009.64, '67', '218', 0),
	(109, '2020', 34, 0, 1, 2906.11, '68', '218', 0),
	(110, '2020', 37, 0, 0, 3516.48, '70', '218', 0),
	(111, '2020', 59, 0, 0, 6288.45, '71', '218', 0),
	(112, '2020', 339, 46, 11, 16896.36, '75', '218', 0),
	(113, '2020', 0, 0, 0, 0, '76', '218', 0),
	(114, '2020', 363, 0, 1, 24288.17, '79', '218', 0),
	(115, '2020', 29, 1, 0, 2362.64, '80', '218', 0),
	(116, '2020', 1319, 89, 7, 86388.92, '82', '218', 0),
	(117, '2020', 109, 0, 1, 10496.39, '83', '218', 0),
	(118, '2020', 1, 0, 0, 88, '84', '218', 0),
	(119, '2020', 36, 0, 1, 2763.58, '85', '218', 0),
	(120, '2020', 12, 0, 0, 914.37, '88', '218', 0),
	(121, '2020', 55, 0, 1, 4313.08, '89', '218', 0),
	(122, '2020', 43, 0, 2, 3450.38, '90', '218', 0),
	(123, '2020', 75, 0, 0, 6079.25, '91', '218', 0),
	(124, '2020', 17, 0, 2, 1224.81, '92', '218', 0),
	(125, '2020', 513, 20, 9, 26053.94, '93', '218', 0),
	(126, '2020', 20, 0, 0, 1862.15, '94', '218', 0),
	(127, '2020', 0, 0, 0, 0, '95', '218', 0),
	(128, '2020', 26, 0, 0, 2350.11, '97', '218', 0),
	(129, '2020', 0, 0, 0, 0, '98', '218', 0),
	(130, '2020', 5, 0, 0, 1131.5, '100', '218', 0),
	(131, '2020', 52, 0, 0, 5076.09, '102', '218', 0),
	(132, '2020', 1, 0, 0, 85.8, '104', '218', 0),
	(133, '2020', 24, 0, 3, 1795.6, '130', '218', 0),
	(134, '2020', 0, 0, 0, 0, '140', '218', 0),
	(135, '2020', 0, 0, 0, 0, '150', '218', 0),
	(136, '2020', 0, 0, 0, 0, '190', '218', 0),
	(137, '2020', 0, 0, 0, 0, '210', '218', 0),
	(138, '2020', 0, 0, 0, 0, '220', '218', 0),
	(139, '2020', 0, 0, 0, 0, '221', '218', 0),
	(140, '2020', 0, 0, 0, 0, '225', '218', 0),
	(141, '2020', 0, 0, 0, 0, '255', '218', 0),
	(142, '2020', 20, 0, 0, 1558.61, '310', '218', 0),
	(143, '2020', 1, 0, 0, 154.7, '00', '213', 0),
	(144, '2020', 164, 0, 13, 13147.43, '15', '213', 0),
	(145, '2020', 269, 0, 15, 27252.52, '18', '213', 0),
	(146, '2020', 69, 3, 15, 4200.04, '25', '213', 0),
	(147, '2020', 28, 0, 0, 1972.11, '28', '213', 0),
	(148, '2020', 168, 0, 12, 13863.87, '36', '213', 0),
	(149, '2020', 301, 21, 20, 16483.08, '40', '213', 0),
	(150, '2020', 36, 0, 0, 2591.74, '50', '213', 0),
	(151, '2020', 62, 0, 0, 5054.6, '51', '213', 0),
	(152, '2020', 250, 0, 7, 21523.92, '52', '213', 0),
	(153, '2020', 0, 0, 0, 0, '57', '213', 0),
	(154, '2020', 92, 0, 9, 6443.01, '58', '213', 0),
	(155, '2020', 680, 44, 16, 35330.5, '59', '213', 0),
	(156, '2020', 49, 0, 0, 3429.35, '62', '213', 0),
	(157, '2020', 408, 39, 12, 24442.1, '63', '213', 0),
	(158, '2020', 1446, 87, 16, 69973.18, '65', '213', 0),
	(159, '2020', 69, 0, 0, 4136.78, '66', '213', 0),
	(160, '2020', 96, 0, 2, 9485.45, '67', '213', 0),
	(161, '2020', 99, 0, 0, 7660.4, '68', '213', 0),
	(162, '2020', 65, 0, 7, 5112.49, '70', '213', 0),
	(163, '2020', 46, 0, 0, 5185.67, '71', '213', 0),
	(164, '2020', 858, 65, 43, 45952.81, '75', '213', 0),
	(165, '2020', 158, 12, 2, 7740.4, '76', '213', 0),
	(166, '2020', 51, 0, 0, 4613.94, '79', '213', 0),
	(167, '2020', 252, 17, 3, 15728.19, '80', '213', 0),
	(168, '2020', 249, 29, 8, 15020.89, '82', '213', 0),
	(169, '2020', 99, 0, 1, 8814.59, '83', '213', 0),
	(170, '2020', 16, 0, 0, 1344.34, '84', '213', 0),
	(171, '2020', 84, 0, 0, 7621.61, '85', '213', 0),
	(172, '2020', 103, 0, 8, 6632.25, '88', '213', 0),
	(173, '2020', 192, 0, 6, 13408.82, '89', '213', 0),
	(174, '2020', 186, 4, 6, 16057.02, '90', '213', 0),
	(175, '2020', 183, 0, 3, 12633.37, '91', '213', 0),
	(176, '2020', 118, 0, 6, 9765.71, '92', '213', 0),
	(177, '2020', 3484, 213, 105, 183890.6, '93', '213', 0),
	(178, '2020', 141, 7, 1, 10604.49, '94', '213', 0),
	(179, '2020', 0, 0, 0, 0, '95', '213', 0),
	(180, '2020', 89, 0, 3, 7193.3, '97', '213', 0),
	(181, '2020', 0, 0, 0, 0, '98', '213', 0),
	(182, '2020', 12, 0, 0, 1443, '100', '213', 0),
	(183, '2020', 56, 0, 4, 4536.2, '102', '213', 0),
	(184, '2020', 0, 0, 0, 0, '104', '213', 0),
	(185, '2020', 43, 0, 4, 2767.13, '130', '213', 0),
	(186, '2020', 0, 0, 0, 0, '140', '213', 0),
	(187, '2020', 0, 0, 0, 0, '150', '213', 0),
	(188, '2020', 0, 0, 0, 0, '190', '213', 0),
	(189, '2020', 0, 0, 0, 0, '210', '213', 0),
	(190, '2020', 54, 6, 0, 2571, '220', '213', 0),
	(191, '2020', 0, 0, 0, 0, '221', '213', 0),
	(192, '2020', 7, 0, 0, 519.46, '225', '213', 0),
	(193, '2020', 4, 0, 0, 273.32, '255', '213', 0),
	(194, '2020', 29, 0, 0, 2195.82, '310', '213', 0),
	(195, '2020', 1, 0, 0, 90.95, '00', '301', 0),
	(196, '2020', 0, 0, 0, 0, '15', '301', 0),
	(197, '2020', 1, 0, 0, 103.2, '18', '301', 0),
	(198, '2020', 0, 0, 0, 0, '25', '301', 0),
	(199, '2020', 1, 0, 0, 73.96, '28', '301', 0),
	(200, '2020', 0, 0, 0, 0, '36', '301', 0),
	(201, '2020', 0, 0, 0, 0, '40', '301', 0),
	(202, '2020', 0, 0, 0, 0, '50', '301', 0),
	(203, '2020', 4, 0, 0, 355.45, '51', '301', 0),
	(204, '2020', 70, 0, 0, 5979.68, '52', '301', 0),
	(205, '2020', 0, 0, 0, 0, '57', '301', 0),
	(206, '2020', 0, 0, 0, 0, '58', '301', 0),
	(207, '2020', 0, 0, 0, 0, '59', '301', 0),
	(208, '2020', 4, 0, 0, 336.11, '62', '301', 0),
	(209, '2020', 0, 0, 0, 0, '63', '301', 0),
	(210, '2020', 0, 0, 0, 0, '65', '301', 0),
	(211, '2020', 0, 0, 0, 0, '66', '301', 0),
	(212, '2020', 0, 0, 0, 0, '67', '301', 0),
	(213, '2020', 1, 0, 0, 63.75, '68', '301', 0),
	(214, '2020', 0, 0, 0, 0, '70', '301', 0),
	(215, '2020', 0, 0, 0, 0, '71', '301', 0),
	(216, '2020', 0, 0, 0, 0, '75', '301', 0),
	(217, '2020', 0, 0, 0, 0, '76', '301', 0),
	(218, '2020', 0, 0, 0, 0, '79', '301', 0),
	(219, '2020', 0, 0, 0, 0, '80', '301', 0),
	(220, '2020', 0, 0, 0, 0, '82', '301', 0),
	(221, '2020', 80, 0, 0, 7419.15, '83', '301', 0),
	(222, '2020', 6, 0, 0, 531.1, '84', '301', 0),
	(223, '2020', 46, 0, 0, 3917.48, '85', '301', 0),
	(224, '2020', 62, 0, 0, 5123.08, '88', '301', 0),
	(225, '2020', 40, 0, 0, 3203.81, '89', '301', 0),
	(226, '2020', 90, 0, 0, 7397.15, '90', '301', 0),
	(227, '2020', 80, 0, 0, 6358.31, '91', '301', 0),
	(228, '2020', 0, 0, 0, 0, '92', '301', 0),
	(229, '2020', 0, 0, 0, 0, '93', '301', 0),
	(230, '2020', 134, 0, 0, 10578.94, '94', '301', 0),
	(231, '2020', 0, 0, 0, 0, '95', '301', 0),
	(232, '2020', 57, 0, 0, 4709.29, '97', '301', 0),
	(233, '2020', 0, 0, 0, 0, '98', '301', 0),
	(234, '2020', 0, 0, 0, 0, '100', '301', 0),
	(235, '2020', 47, 0, 0, 4080.48, '102', '301', 0),
	(236, '2020', 0, 0, 0, 0, '104', '301', 0),
	(237, '2020', 0, 0, 0, 0, '130', '301', 0),
	(238, '2020', 0, 0, 0, 0, '140', '301', 0),
	(239, '2020', 0, 0, 0, 0, '150', '301', 0),
	(240, '2020', 0, 0, 0, 0, '190', '301', 0),
	(241, '2020', 0, 0, 0, 0, '210', '301', 0),
	(242, '2020', 0, 0, 0, 0, '220', '301', 0),
	(243, '2020', 0, 0, 0, 0, '221', '301', 0),
	(244, '2020', 0, 0, 0, 0, '225', '301', 0),
	(245, '2020', 0, 0, 0, 0, '255', '301', 0),
	(246, '2020', 0, 0, 0, 0, '310', '301', 0);
/*!40000 ALTER TABLE `historial_ventas` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.listalinea
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
	('301', 'COMERCIAL BOSCH', _binary 0x30, 'BATE', 'BOS'),
	('315', 'PLUMAS HELLA', _binary 0x31, 'PLUM', 'HEL');
/*!40000 ALTER TABLE `listalinea` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.marca
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
CREATE TABLE IF NOT EXISTS `presupuesto_anio` (
  `idPresAnio` int(11) NOT NULL AUTO_INCREMENT,
  `anio` year(4) NOT NULL,
  `ventasPresU` int(11) DEFAULT NULL,
  `promoPresU` int(11) DEFAULT NULL,
  `garantPresU` int(11) DEFAULT NULL,
  `totalPresU` int(11) DEFAULT NULL,
  `precioMeta` float DEFAULT NULL,
  `codVen` varchar(50) DEFAULT NULL,
  `codLinea` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPresAnio`)
) ENGINE=InnoDB AUTO_INCREMENT=580 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.presupuesto_anio: ~257 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuesto_anio` DISABLE KEYS */;
INSERT INTO `presupuesto_anio` (`idPresAnio`, `anio`, `ventasPresU`, `promoPresU`, `garantPresU`, `totalPresU`, `precioMeta`, `codVen`, `codLinea`) VALUES
	(46, '2020', NULL, NULL, NULL, NULL, NULL, '220', '201'),
	(47, '2020', NULL, NULL, NULL, NULL, NULL, '15', '201'),
	(48, '2020', NULL, NULL, NULL, NULL, NULL, '18', '201'),
	(49, '2020', NULL, NULL, NULL, NULL, NULL, '25', '201'),
	(50, '2020', NULL, NULL, NULL, NULL, NULL, '28', '201'),
	(51, '2020', NULL, NULL, NULL, NULL, NULL, '36', '201'),
	(52, '2020', NULL, NULL, NULL, NULL, NULL, '40', '201'),
	(53, '2020', NULL, NULL, NULL, NULL, NULL, '50', '201'),
	(54, '2020', NULL, NULL, NULL, NULL, NULL, '51', '201'),
	(55, '2020', NULL, NULL, NULL, NULL, NULL, '52', '201'),
	(56, '2020', NULL, NULL, NULL, NULL, NULL, '58', '201'),
	(57, '2020', NULL, NULL, NULL, NULL, NULL, '59', '201'),
	(58, '2020', NULL, NULL, NULL, NULL, NULL, '62', '201'),
	(59, '2020', NULL, NULL, NULL, NULL, NULL, '63', '201'),
	(60, '2020', NULL, NULL, NULL, NULL, NULL, '65', '201'),
	(61, '2020', NULL, NULL, NULL, NULL, NULL, '66', '201'),
	(62, '2020', NULL, NULL, NULL, NULL, NULL, '67', '201'),
	(63, '2020', NULL, NULL, NULL, NULL, NULL, '68', '201'),
	(64, '2020', NULL, NULL, NULL, NULL, NULL, '70', '201'),
	(65, '2020', NULL, NULL, NULL, NULL, NULL, '71', '201'),
	(66, '2020', NULL, NULL, NULL, NULL, NULL, '75', '201'),
	(67, '2020', NULL, NULL, NULL, NULL, NULL, '76', '201'),
	(68, '2020', NULL, NULL, NULL, NULL, NULL, '79', '201'),
	(69, '2020', NULL, NULL, NULL, NULL, NULL, '80', '201'),
	(70, '2020', NULL, NULL, NULL, NULL, NULL, '82', '201'),
	(71, '2020', NULL, NULL, NULL, NULL, NULL, '83', '201'),
	(72, '2020', NULL, NULL, NULL, NULL, NULL, '84', '201'),
	(73, '2020', NULL, NULL, NULL, NULL, NULL, '85', '201'),
	(74, '2020', NULL, NULL, NULL, NULL, NULL, '88', '201'),
	(75, '2020', NULL, NULL, NULL, NULL, NULL, '89', '201'),
	(76, '2020', NULL, NULL, NULL, NULL, NULL, '90', '201'),
	(77, '2020', NULL, NULL, NULL, NULL, NULL, '91', '201'),
	(78, '2020', NULL, NULL, NULL, NULL, NULL, '92', '201'),
	(79, '2020', NULL, NULL, NULL, NULL, NULL, '93', '201'),
	(80, '2020', NULL, NULL, NULL, NULL, NULL, '94', '201'),
	(81, '2020', NULL, NULL, NULL, NULL, NULL, '97', '201'),
	(82, '2020', NULL, NULL, NULL, NULL, NULL, '100', '201'),
	(83, '2020', NULL, NULL, NULL, NULL, NULL, '102', '201'),
	(84, '2020', NULL, NULL, NULL, NULL, NULL, '104', '201'),
	(85, '2020', NULL, NULL, NULL, NULL, NULL, '130', '201'),
	(86, '2020', NULL, NULL, NULL, NULL, NULL, '150', '201'),
	(87, '2020', NULL, NULL, NULL, NULL, NULL, '210', '201'),
	(88, '2020', NULL, NULL, NULL, NULL, NULL, '15', '213'),
	(89, '2020', NULL, NULL, NULL, NULL, NULL, '18', '213'),
	(90, '2020', NULL, NULL, NULL, NULL, NULL, '25', '213'),
	(91, '2020', NULL, NULL, NULL, NULL, NULL, '28', '213'),
	(92, '2020', NULL, NULL, NULL, NULL, NULL, '36', '213'),
	(93, '2020', NULL, NULL, NULL, NULL, NULL, '40', '213'),
	(94, '2020', NULL, NULL, NULL, NULL, NULL, '50', '213'),
	(95, '2020', NULL, NULL, NULL, NULL, NULL, '51', '213'),
	(96, '2020', NULL, NULL, NULL, NULL, NULL, '52', '213'),
	(97, '2020', NULL, NULL, NULL, NULL, NULL, '58', '213'),
	(98, '2020', NULL, NULL, NULL, NULL, NULL, '59', '213'),
	(99, '2020', NULL, NULL, NULL, NULL, NULL, '62', '213'),
	(100, '2020', NULL, NULL, NULL, NULL, NULL, '63', '213'),
	(101, '2020', NULL, NULL, NULL, NULL, NULL, '65', '213'),
	(102, '2020', NULL, NULL, NULL, NULL, NULL, '66', '213'),
	(103, '2020', NULL, NULL, NULL, NULL, NULL, '67', '213'),
	(104, '2020', NULL, NULL, NULL, NULL, NULL, '68', '213'),
	(105, '2020', NULL, NULL, NULL, NULL, NULL, '70', '213'),
	(106, '2020', NULL, NULL, NULL, NULL, NULL, '71', '213'),
	(107, '2020', NULL, NULL, NULL, NULL, NULL, '75', '213'),
	(108, '2020', NULL, NULL, NULL, NULL, NULL, '76', '213'),
	(109, '2020', NULL, NULL, NULL, NULL, NULL, '79', '213'),
	(110, '2020', NULL, NULL, NULL, NULL, NULL, '80', '213'),
	(111, '2020', NULL, NULL, NULL, NULL, NULL, '82', '213'),
	(112, '2020', NULL, NULL, NULL, NULL, NULL, '83', '213'),
	(113, '2020', NULL, NULL, NULL, NULL, NULL, '84', '213'),
	(114, '2020', NULL, NULL, NULL, NULL, NULL, '85', '213'),
	(115, '2020', NULL, NULL, NULL, NULL, NULL, '88', '213'),
	(116, '2020', NULL, NULL, NULL, NULL, NULL, '89', '213'),
	(117, '2020', NULL, NULL, NULL, NULL, NULL, '90', '213'),
	(118, '2020', NULL, NULL, NULL, NULL, NULL, '91', '213'),
	(119, '2020', NULL, NULL, NULL, NULL, NULL, '92', '213'),
	(120, '2020', NULL, NULL, NULL, NULL, NULL, '93', '213'),
	(121, '2020', NULL, NULL, NULL, NULL, NULL, '94', '213'),
	(122, '2020', NULL, NULL, NULL, NULL, NULL, '97', '213'),
	(123, '2020', NULL, NULL, NULL, NULL, NULL, '100', '213'),
	(124, '2020', NULL, NULL, NULL, NULL, NULL, '102', '213'),
	(125, '2020', NULL, NULL, NULL, NULL, NULL, '104', '213'),
	(126, '2020', NULL, NULL, NULL, NULL, NULL, '130', '213'),
	(127, '2020', NULL, NULL, NULL, NULL, NULL, '150', '213'),
	(128, '2020', NULL, NULL, NULL, NULL, NULL, '210', '213'),
	(129, '2020', NULL, NULL, NULL, NULL, NULL, '15', '218'),
	(130, '2020', NULL, NULL, NULL, NULL, NULL, '18', '218'),
	(131, '2020', NULL, NULL, NULL, NULL, NULL, '25', '218'),
	(132, '2020', NULL, NULL, NULL, NULL, NULL, '28', '218'),
	(133, '2020', NULL, NULL, NULL, NULL, NULL, '36', '218'),
	(134, '2020', NULL, NULL, NULL, NULL, NULL, '40', '218'),
	(135, '2020', NULL, NULL, NULL, NULL, NULL, '50', '218'),
	(136, '2020', NULL, NULL, NULL, NULL, NULL, '51', '218'),
	(137, '2020', NULL, NULL, NULL, NULL, NULL, '52', '218'),
	(138, '2020', NULL, NULL, NULL, NULL, NULL, '58', '218'),
	(139, '2020', NULL, NULL, NULL, NULL, NULL, '59', '218'),
	(140, '2020', NULL, NULL, NULL, NULL, NULL, '62', '218'),
	(141, '2020', NULL, NULL, NULL, NULL, NULL, '63', '218'),
	(142, '2020', NULL, NULL, NULL, NULL, NULL, '65', '218'),
	(143, '2020', NULL, NULL, NULL, NULL, NULL, '66', '218'),
	(144, '2020', NULL, NULL, NULL, NULL, NULL, '67', '218'),
	(145, '2020', NULL, NULL, NULL, NULL, NULL, '68', '218'),
	(146, '2020', NULL, NULL, NULL, NULL, NULL, '70', '218'),
	(147, '2020', NULL, NULL, NULL, NULL, NULL, '71', '218'),
	(148, '2020', NULL, NULL, NULL, NULL, NULL, '75', '218'),
	(149, '2020', NULL, NULL, NULL, NULL, NULL, '76', '218'),
	(150, '2020', NULL, NULL, NULL, NULL, NULL, '79', '218'),
	(151, '2020', NULL, NULL, NULL, NULL, NULL, '80', '218'),
	(152, '2020', NULL, NULL, NULL, NULL, NULL, '82', '218'),
	(153, '2020', NULL, NULL, NULL, NULL, NULL, '83', '218'),
	(154, '2020', NULL, NULL, NULL, NULL, NULL, '84', '218'),
	(155, '2020', NULL, NULL, NULL, NULL, NULL, '85', '218'),
	(156, '2020', NULL, NULL, NULL, NULL, NULL, '88', '218'),
	(157, '2020', NULL, NULL, NULL, NULL, NULL, '89', '218'),
	(158, '2020', NULL, NULL, NULL, NULL, NULL, '90', '218'),
	(159, '2020', NULL, NULL, NULL, NULL, NULL, '91', '218'),
	(160, '2020', NULL, NULL, NULL, NULL, NULL, '92', '218'),
	(161, '2020', NULL, NULL, NULL, NULL, NULL, '93', '218'),
	(162, '2020', NULL, NULL, NULL, NULL, NULL, '94', '218'),
	(163, '2020', NULL, NULL, NULL, NULL, NULL, '97', '218'),
	(164, '2020', NULL, NULL, NULL, NULL, NULL, '100', '218'),
	(165, '2020', NULL, NULL, NULL, NULL, NULL, '102', '218'),
	(166, '2020', NULL, NULL, NULL, NULL, NULL, '104', '218'),
	(167, '2020', NULL, NULL, NULL, NULL, NULL, '130', '218'),
	(168, '2020', NULL, NULL, NULL, NULL, NULL, '150', '218'),
	(169, '2020', NULL, NULL, NULL, NULL, NULL, '210', '218'),
	(170, '2020', NULL, NULL, NULL, NULL, NULL, '15', '220'),
	(171, '2020', NULL, NULL, NULL, NULL, NULL, '18', '220'),
	(172, '2020', NULL, NULL, NULL, NULL, NULL, '25', '220'),
	(173, '2020', NULL, NULL, NULL, NULL, NULL, '28', '220'),
	(174, '2020', NULL, NULL, NULL, NULL, NULL, '36', '220'),
	(175, '2020', NULL, NULL, NULL, NULL, NULL, '40', '220'),
	(176, '2020', NULL, NULL, NULL, NULL, NULL, '50', '220'),
	(177, '2020', NULL, NULL, NULL, NULL, NULL, '51', '220'),
	(178, '2020', NULL, NULL, NULL, NULL, NULL, '52', '220'),
	(179, '2020', NULL, NULL, NULL, NULL, NULL, '58', '220'),
	(180, '2020', NULL, NULL, NULL, NULL, NULL, '59', '220'),
	(181, '2020', NULL, NULL, NULL, NULL, NULL, '62', '220'),
	(182, '2020', NULL, NULL, NULL, NULL, NULL, '63', '220'),
	(183, '2020', NULL, NULL, NULL, NULL, NULL, '65', '220'),
	(184, '2020', NULL, NULL, NULL, NULL, NULL, '66', '220'),
	(185, '2020', NULL, NULL, NULL, NULL, NULL, '67', '220'),
	(186, '2020', NULL, NULL, NULL, NULL, NULL, '68', '220'),
	(187, '2020', NULL, NULL, NULL, NULL, NULL, '70', '220'),
	(188, '2020', NULL, NULL, NULL, NULL, NULL, '71', '220'),
	(189, '2020', NULL, NULL, NULL, NULL, NULL, '75', '220'),
	(190, '2020', NULL, NULL, NULL, NULL, NULL, '76', '220'),
	(191, '2020', NULL, NULL, NULL, NULL, NULL, '79', '220'),
	(192, '2020', NULL, NULL, NULL, NULL, NULL, '80', '220'),
	(193, '2020', NULL, NULL, NULL, NULL, NULL, '82', '220'),
	(194, '2020', NULL, NULL, NULL, NULL, NULL, '83', '220'),
	(195, '2020', NULL, NULL, NULL, NULL, NULL, '84', '220'),
	(196, '2020', NULL, NULL, NULL, NULL, NULL, '85', '220'),
	(197, '2020', NULL, NULL, NULL, NULL, NULL, '88', '220'),
	(198, '2020', NULL, NULL, NULL, NULL, NULL, '89', '220'),
	(199, '2020', NULL, NULL, NULL, NULL, NULL, '90', '220'),
	(200, '2020', NULL, NULL, NULL, NULL, NULL, '91', '220'),
	(201, '2020', NULL, NULL, NULL, NULL, NULL, '92', '220'),
	(202, '2020', NULL, NULL, NULL, NULL, NULL, '93', '220'),
	(203, '2020', NULL, NULL, NULL, NULL, NULL, '94', '220'),
	(204, '2020', NULL, NULL, NULL, NULL, NULL, '97', '220'),
	(205, '2020', NULL, NULL, NULL, NULL, NULL, '102', '220'),
	(206, '2020', NULL, NULL, NULL, NULL, NULL, '104', '220'),
	(207, '2020', NULL, NULL, NULL, NULL, NULL, '130', '220'),
	(208, '2020', NULL, NULL, NULL, NULL, NULL, '150', '220'),
	(209, '2020', NULL, NULL, NULL, NULL, NULL, '210', '220'),
	(210, '2020', NULL, NULL, NULL, NULL, NULL, '15', '250'),
	(211, '2020', NULL, NULL, NULL, NULL, NULL, '18', '250'),
	(212, '2020', NULL, NULL, NULL, NULL, NULL, '25', '250'),
	(213, '2020', NULL, NULL, NULL, NULL, NULL, '28', '250'),
	(214, '2020', NULL, NULL, NULL, NULL, NULL, '36', '250'),
	(215, '2020', NULL, NULL, NULL, NULL, NULL, '40', '250'),
	(216, '2020', NULL, NULL, NULL, NULL, NULL, '50', '250'),
	(217, '2020', NULL, NULL, NULL, NULL, NULL, '51', '250'),
	(218, '2020', NULL, NULL, NULL, NULL, NULL, '52', '250'),
	(219, '2020', NULL, NULL, NULL, NULL, NULL, '58', '250'),
	(220, '2020', NULL, NULL, NULL, NULL, NULL, '59', '250'),
	(221, '2020', NULL, NULL, NULL, NULL, NULL, '62', '250'),
	(222, '2020', NULL, NULL, NULL, NULL, NULL, '63', '250'),
	(223, '2020', NULL, NULL, NULL, NULL, NULL, '65', '250'),
	(224, '2020', NULL, NULL, NULL, NULL, NULL, '66', '250'),
	(225, '2020', NULL, NULL, NULL, NULL, NULL, '67', '250'),
	(226, '2020', NULL, NULL, NULL, NULL, NULL, '68', '250'),
	(227, '2020', NULL, NULL, NULL, NULL, NULL, '70', '250'),
	(228, '2020', NULL, NULL, NULL, NULL, NULL, '71', '250'),
	(229, '2020', NULL, NULL, NULL, NULL, NULL, '75', '250'),
	(230, '2020', NULL, NULL, NULL, NULL, NULL, '76', '250'),
	(231, '2020', NULL, NULL, NULL, NULL, NULL, '79', '250'),
	(232, '2020', NULL, NULL, NULL, NULL, NULL, '80', '250'),
	(233, '2020', NULL, NULL, NULL, NULL, NULL, '82', '250'),
	(234, '2020', NULL, NULL, NULL, NULL, NULL, '83', '250'),
	(235, '2020', NULL, NULL, NULL, NULL, NULL, '84', '250'),
	(236, '2020', NULL, NULL, NULL, NULL, NULL, '85', '250'),
	(237, '2020', NULL, NULL, NULL, NULL, NULL, '88', '250'),
	(238, '2020', NULL, NULL, NULL, NULL, NULL, '89', '250'),
	(239, '2020', NULL, NULL, NULL, NULL, NULL, '90', '250'),
	(240, '2020', NULL, NULL, NULL, NULL, NULL, '91', '250'),
	(241, '2020', NULL, NULL, NULL, NULL, NULL, '92', '250'),
	(242, '2020', NULL, NULL, NULL, NULL, NULL, '93', '250'),
	(243, '2020', NULL, NULL, NULL, NULL, NULL, '94', '250'),
	(244, '2020', NULL, NULL, NULL, NULL, NULL, '97', '250'),
	(245, '2020', NULL, NULL, NULL, NULL, NULL, '102', '250'),
	(246, '2020', NULL, NULL, NULL, NULL, NULL, '104', '250'),
	(247, '2020', NULL, NULL, NULL, NULL, NULL, '130', '250'),
	(248, '2020', NULL, NULL, NULL, NULL, NULL, '210', '250'),
	(249, '2020', NULL, NULL, NULL, NULL, NULL, '15', '315'),
	(250, '2020', NULL, NULL, NULL, NULL, NULL, '18', '315'),
	(251, '2020', NULL, NULL, NULL, NULL, NULL, '25', '315'),
	(252, '2020', NULL, NULL, NULL, NULL, NULL, '28', '315'),
	(253, '2020', NULL, NULL, NULL, NULL, NULL, '36', '315'),
	(254, '2020', NULL, NULL, NULL, NULL, NULL, '40', '315'),
	(255, '2020', NULL, NULL, NULL, NULL, NULL, '50', '315'),
	(256, '2020', NULL, NULL, NULL, NULL, NULL, '51', '315'),
	(257, '2020', NULL, NULL, NULL, NULL, NULL, '52', '315'),
	(258, '2020', NULL, NULL, NULL, NULL, NULL, '58', '315'),
	(259, '2020', NULL, NULL, NULL, NULL, NULL, '59', '315'),
	(260, '2020', NULL, NULL, NULL, NULL, NULL, '62', '315'),
	(261, '2020', NULL, NULL, NULL, NULL, NULL, '63', '315'),
	(262, '2020', NULL, NULL, NULL, NULL, NULL, '65', '315'),
	(263, '2020', NULL, NULL, NULL, NULL, NULL, '66', '315'),
	(264, '2020', NULL, NULL, NULL, NULL, NULL, '67', '315'),
	(265, '2020', NULL, NULL, NULL, NULL, NULL, '68', '315'),
	(266, '2020', NULL, NULL, NULL, NULL, NULL, '70', '315'),
	(267, '2020', NULL, NULL, NULL, NULL, NULL, '71', '315'),
	(268, '2020', NULL, NULL, NULL, NULL, NULL, '75', '315'),
	(269, '2020', NULL, NULL, NULL, NULL, NULL, '79', '315'),
	(270, '2020', NULL, NULL, NULL, NULL, NULL, '80', '315'),
	(271, '2020', NULL, NULL, NULL, NULL, NULL, '82', '315'),
	(272, '2020', NULL, NULL, NULL, NULL, NULL, '83', '315'),
	(273, '2020', NULL, NULL, NULL, NULL, NULL, '84', '315'),
	(274, '2020', NULL, NULL, NULL, NULL, NULL, '85', '315'),
	(275, '2020', NULL, NULL, NULL, NULL, NULL, '88', '315'),
	(276, '2020', NULL, NULL, NULL, NULL, NULL, '89', '315'),
	(277, '2020', NULL, NULL, NULL, NULL, NULL, '90', '315'),
	(278, '2020', NULL, NULL, NULL, NULL, NULL, '91', '315'),
	(279, '2020', NULL, NULL, NULL, NULL, NULL, '92', '315'),
	(280, '2020', NULL, NULL, NULL, NULL, NULL, '93', '315'),
	(281, '2020', NULL, NULL, NULL, NULL, NULL, '94', '315'),
	(282, '2020', NULL, NULL, NULL, NULL, NULL, '97', '315'),
	(283, '2020', NULL, NULL, NULL, NULL, NULL, '100', '315'),
	(284, '2020', NULL, NULL, NULL, NULL, NULL, '102', '315'),
	(285, '2020', NULL, NULL, NULL, NULL, NULL, '104', '315'),
	(286, '2020', NULL, NULL, NULL, NULL, NULL, '130', '315'),
	(287, '2020', NULL, NULL, NULL, NULL, NULL, '150', '315'),
	(288, '2020', NULL, NULL, NULL, NULL, NULL, '210', '315'),
	(289, '2020', NULL, NULL, NULL, NULL, NULL, '190', '221'),
	(290, '2020', NULL, NULL, NULL, NULL, NULL, '190', '216'),
	(291, '2020', NULL, NULL, NULL, NULL, NULL, '190', '222'),
	(292, '2020', NULL, NULL, NULL, NULL, NULL, '52', '301'),
	(293, '2020', NULL, NULL, NULL, NULL, NULL, '83', '301'),
	(294, '2020', NULL, NULL, NULL, NULL, NULL, '85', '301'),
	(295, '2020', NULL, NULL, NULL, NULL, NULL, '88', '301'),
	(296, '2020', NULL, NULL, NULL, NULL, NULL, '89', '301'),
	(297, '2020', NULL, NULL, NULL, NULL, NULL, '90', '301'),
	(298, '2020', NULL, NULL, NULL, NULL, NULL, '91', '301'),
	(299, '2020', NULL, NULL, NULL, NULL, NULL, '94', '301'),
	(300, '2020', NULL, NULL, NULL, NULL, NULL, '97', '301'),
	(301, '2020', NULL, NULL, NULL, NULL, NULL, '102', '301'),
	(302, '2020', NULL, NULL, NULL, NULL, NULL, '220', '213');
/*!40000 ALTER TABLE `presupuesto_anio` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.presupuesto_mes
CREATE TABLE IF NOT EXISTS `presupuesto_mes` (
  `idPresMes` int(11) NOT NULL AUTO_INCREMENT,
  `idPresAnio` int(11) DEFAULT NULL,
  `mes` date DEFAULT NULL,
  `cantMesU` int(11) DEFAULT NULL,
  `cantPromoU` int(11) DEFAULT NULL,
  `cantGarantU` int(11) DEFAULT NULL,
  `cantTotalU` int(11) DEFAULT NULL,
  `presMesV` float DEFAULT NULL,
  `porcentaje` float DEFAULT NULL,
  PRIMARY KEY (`idPresMes`),
  KEY `FK_presupuesto_mes_presupuesto_anio` (`idPresAnio`),
  CONSTRAINT `FK_presupuesto_mes_presupuesto_anio` FOREIGN KEY (`idPresAnio`) REFERENCES `presupuesto_anio` (`idPresAnio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla presupuestos_ventas.presupuesto_mes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuesto_mes` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuesto_mes` ENABLE KEYS */;

-- Volcando estructura para tabla presupuestos_ventas.segmento
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
