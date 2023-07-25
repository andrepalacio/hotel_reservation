-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-05-2023 a las 14:37:48
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservation`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int NOT NULL,
  `usNombre` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `usClave` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `avaliable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usNombre`, `usClave`, `nombre`, `email`, `direccion`, `avaliable`) VALUES
(0, 'admin', 'a#1234', 'administrador0', 'noaplica@correo', 'hotel', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

DROP TABLE IF EXISTS `habitaciones`;
CREATE TABLE IF NOT EXISTS `habitaciones` (
  `num` int NOT NULL,
  `camas` int NOT NULL,
  `ocupantes` int NOT NULL,
  `categoria` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ocupada` tinyint(1) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`num`, `camas`, `ocupantes`, `categoria`, `ocupada`) VALUES
(1, 1, 2, 'Sencilla', 0),
(2, 1, 2, 'Sencilla', 0),
(3, 1, 2, 'Suite', 0),
(4, 2, 2, 'Cama Doble', 0),
(5, 2, 2, 'Cama Doble', 0),
(6, 2, 4, 'Familiar', 0),
(7, 2, 4, 'Familiar', 0),
(8, 1, 2, 'Suite', 0),
(9, 1, 2, 'Sencilla', 0),
(10, 2, 4, 'Familiar', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones_borradas`
--

DROP TABLE IF EXISTS `habitaciones_borradas`;
CREATE TABLE IF NOT EXISTS `habitaciones_borradas` (
  `num` int NOT NULL,
  `camas` int NOT NULL,
  `ocupantes` int NOT NULL,
  `categoria` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `idEmpleado` int NOT NULL,
  `fecha_borrado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_reservas`
--

DROP TABLE IF EXISTS `historial_reservas`;
CREATE TABLE IF NOT EXISTS `historial_reservas` (
  `id` int NOT NULL,
  `numHabitacion` int NOT NULL,
  `idEmpleado` int DEFAULT NULL,
  `idCliente` int NOT NULL,
  `nombreCliente` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ingreso` date NOT NULL,
  `salida` date NOT NULL,
  `fecha_historial` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `numHabitacion` (`numHabitacion`),
  KEY `idEmpleado` (`idEmpleado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numHabitacion` int NOT NULL,
  `idEmpleado` int DEFAULT NULL,
  `idCliente` int NOT NULL,
  `nombreCliente` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ingreso` date NOT NULL,
  `salida` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numHabitacion` (`numHabitacion`),
  KEY `idEmpleado` (`idEmpleado`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `reservas_canceladas`
--

DROP TABLE IF EXISTS `reservas_canceladas`;
CREATE TABLE IF NOT EXISTS `reservas_canceladas` (
  `id` int NOT NULL,
  `numHabitacion` int NOT NULL,
  `idEmpleado` int DEFAULT NULL,
  `idCliente` int NOT NULL,
  `nombreCliente` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ingreso` date NOT NULL,
  `salida` date NOT NULL,
  `fecha_cancelada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `numHabitacion` (`numHabitacion`),
  KEY `idEmpleado` (`idEmpleado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
