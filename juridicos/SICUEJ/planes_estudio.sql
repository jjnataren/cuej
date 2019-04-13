-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-07-2016 a las 14:52:36
-- Versión del servidor: 5.7.10-log
-- Versión de PHP: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sicuej`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_estudio`
--

CREATE TABLE `planes_estudio` (
  `id_plan_estudio` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `plan_estudios` varchar(50) NOT NULL,
  `acuerdo_sep` varchar(50) NOT NULL,
  `clave_sep` varchar(25) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `antecedente` varchar(25) NOT NULL,
  `creditos` float NOT NULL,
  `duracion` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planes_estudio`
--

INSERT INTO `planes_estudio` (`id_plan_estudio`, `id_carrera`, `plan_estudios`, `acuerdo_sep`, `clave_sep`, `fecha`, `antecedente`, `creditos`, `duracion`) VALUES
(1, 1, '2012', '20121990', '', '28 DE SEPTIEMBRE DE 2012', 'BACHILLERATO', 308, 8),
(2, 2, '2015', '20150103', '', '', 'LICENCIATURA', 78.75, 6),
(3, 3, '2014', '20150104', '', 'MAYO 2014', 'LICENCIATURA', 91, 6),
(4, 4, '2011', '20121644', '', '11 DE AGOSTO DE 2011', 'LICENCIATURA', 82.18, 6),
(5, 5, '2013', '20150061', '', 'JULIO 2013', 'LICENCIATURA', 77, 6),
(6, 6, '2013', '20130002', '', '', 'MAESTRÍA', 0, 4),
(7, 4, '2015', '', '', 'FEBRERO 2015', 'LICENCIATURA', 82.18, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  ADD PRIMARY KEY (`id_plan_estudio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  MODIFY `id_plan_estudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
