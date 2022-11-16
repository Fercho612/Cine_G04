-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 15:10:29
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restricciones`
--
-- Creación: 16-11-2022 a las 14:05:38
--

DROP TABLE IF EXISTS `restricciones`;
CREATE TABLE `restricciones` (
  `restriccion_id` int(11) NOT NULL,
  `restriccion` varchar(5) COLLATE utf16_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- RELACIONES PARA LA TABLA `restricciones`:
--

--
-- Volcado de datos para la tabla `restricciones`
--

INSERT INTO `restricciones` (`restriccion_id`, `restriccion`) VALUES
(1, 'ATP'),
(2, '+18'),
(3, '+16'),
(4, '+13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  ADD PRIMARY KEY (`restriccion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  MODIFY `restriccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
