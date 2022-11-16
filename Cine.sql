-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 20:49:53
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
CREATE DATABASE IF NOT EXISTS `cine` DEFAULT CHARACTER SET utf16 COLLATE utf16_spanish_ci;
USE `cine`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `contrasena` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `privilegios` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `email`, `nombre`, `apellido`, `usuario`, `contrasena`, `privilegios`) VALUES
(1, 'admin@gmail.com', 'Administrador', '', 'admin', '0000', 1),
(3, 'fabiopana@gmail.com', 'A lalala', 'afefsf', 'fabian', 'asdf', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

DROP TABLE IF EXISTS `entradas`;
CREATE TABLE `entradas` (
  `entrada_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `metodo_pago_id` int(11) DEFAULT NULL,
  `funcion_id` int(11) DEFAULT NULL,
  `codigo_asiento` varchar(6) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formatos`
--

DROP TABLE IF EXISTS `formatos`;
CREATE TABLE `formatos` (
  `formato_id` int(11) NOT NULL,
  `formato` varchar(20) COLLATE utf16_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `formatos`
--

INSERT INTO `formatos` (`formato_id`, `formato`) VALUES
(1, '3D'),
(4, '5D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

DROP TABLE IF EXISTS `funciones`;
CREATE TABLE `funciones` (
  `funcion_id` int(11) NOT NULL,
  `sala_id` int(11) DEFAULT NULL,
  `pelicula_id` int(11) DEFAULT NULL,
  `idioma_id` int(11) DEFAULT NULL,
  `formato_id` int(11) DEFAULT NULL,
  `hora` datetime NOT NULL,
  `precio` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`funcion_id`, `sala_id`, `pelicula_id`, `idioma_id`, `formato_id`, `hora`, `precio`, `disponible`) VALUES
(1, 1, NULL, 2, 1, '2022-12-24 18:55:00', 100, 1),
(4, 1, NULL, 1, 1, '2022-12-09 19:19:00', 100, 1),
(5, 1, 2, 1, 1, '2022-12-01 19:27:00', 100, 1),
(6, 1, 4, 1, 1, '2022-11-25 19:48:00', 100, 1),
(7, 1, 4, 1, 1, '2022-11-29 19:48:00', 100, 1),
(8, 1, 4, 1, 1, '2022-11-20 19:48:00', 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

DROP TABLE IF EXISTS `generos`;
CREATE TABLE `generos` (
  `genero_id` int(11) NOT NULL,
  `genero` varchar(30) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`genero_id`, `genero`) VALUES
(1, 'Terror'),
(3, 'Accion'),
(5, 'Tragedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

DROP TABLE IF EXISTS `idiomas`;
CREATE TABLE `idiomas` (
  `idioma_id` int(11) NOT NULL,
  `idioma` varchar(30) COLLATE utf16_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`idioma_id`, `idioma`) VALUES
(1, 'Español'),
(2, 'Inglés'),
(3, 'Subtitulado al Español');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_de_pago`
--

DROP TABLE IF EXISTS `metodos_de_pago`;
CREATE TABLE `metodos_de_pago` (
  `metodo_pago_id` int(11) NOT NULL,
  `metodo_pago` varchar(20) COLLATE utf16_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `metodos_de_pago`
--

INSERT INTO `metodos_de_pago` (`metodo_pago_id`, `metodo_pago`) VALUES
(1, 'Débito'),
(2, 'Crédito'),
(3, 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
CREATE TABLE `peliculas` (
  `pelicula_id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `duracion` varchar(3) COLLATE utf16_spanish_ci NOT NULL,
  `director` varchar(30) COLLATE utf16_spanish_ci NOT NULL,
  `ruta_imagen` varchar(50) COLLATE utf16_spanish_ci DEFAULT NULL,
  `restriccion_id` int(11) DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`pelicula_id`, `nombre`, `duracion`, `director`, `ruta_imagen`, `restriccion_id`, `genero_id`) VALUES
(2, 'Otra peli ', '12', 'Bizarrap', NULL, 3, NULL),
(4, 'Peliculón', '123', 'Bizarrap', NULL, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restricciones`
--

DROP TABLE IF EXISTS `restricciones`;
CREATE TABLE `restricciones` (
  `restriccion_id` int(11) NOT NULL,
  `restriccion` varchar(5) COLLATE utf16_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `restricciones`
--

INSERT INTO `restricciones` (`restriccion_id`, `restriccion`) VALUES
(1, 'ATP'),
(2, '+18'),
(3, '+16'),
(4, '+13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

DROP TABLE IF EXISTS `salas`;
CREATE TABLE `salas` (
  `sala_id` int(11) NOT NULL,
  `aire_acondicionado` tinyint(1) DEFAULT NULL,
  `sala` varchar(20) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`sala_id`, `aire_acondicionado`, `sala`) VALUES
(1, NULL, 'Sala 3D'),
(2, NULL, 'Sala 1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`entrada_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `metodo_pago_id` (`metodo_pago_id`),
  ADD KEY `entradas_ibfk_2` (`funcion_id`);

--
-- Indices de la tabla `formatos`
--
ALTER TABLE `formatos`
  ADD PRIMARY KEY (`formato_id`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`funcion_id`),
  ADD KEY `sala_id` (`sala_id`),
  ADD KEY `pelicula_id` (`pelicula_id`),
  ADD KEY `idioma_id` (`idioma_id`),
  ADD KEY `formato_id` (`formato_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`genero_id`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`idioma_id`);

--
-- Indices de la tabla `metodos_de_pago`
--
ALTER TABLE `metodos_de_pago`
  ADD PRIMARY KEY (`metodo_pago_id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`pelicula_id`),
  ADD KEY `genero_id` (`genero_id`),
  ADD KEY `restriccion_id` (`restriccion_id`);

--
-- Indices de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  ADD PRIMARY KEY (`restriccion_id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`sala_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `entrada_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formatos`
--
ALTER TABLE `formatos`
  MODIFY `formato_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `funcion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `genero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `idioma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `metodos_de_pago`
--
ALTER TABLE `metodos_de_pago`
  MODIFY `metodo_pago_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `pelicula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  MODIFY `restriccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `sala_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`funcion_id`) REFERENCES `funciones` (`funcion_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `entradas_ibfk_3` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_de_pago` (`metodo_pago_id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD CONSTRAINT `funciones_ibfk_1` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`sala_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `funciones_ibfk_2` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`pelicula_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `funciones_ibfk_3` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`idioma_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `funciones_ibfk_4` FOREIGN KEY (`formato_id`) REFERENCES `formatos` (`formato_id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `genero_id` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`genero_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `restriccion_id` FOREIGN KEY (`restriccion_id`) REFERENCES `restricciones` (`restriccion_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
