-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-07-2016 a las 14:53:58
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
-- Estructura de tabla para la tabla `profesores_contactos`
--

CREATE TABLE `profesores_contactos` (
  `id_profesor_contacto` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `tipo_contacto` int(1) NOT NULL COMMENT '1= Telefono Casa 2 = Telefono Celular 3 = correo electronico 1 4 = correo electronico 2',
  `contacto` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores_contactos`
--

INSERT INTO `profesores_contactos` (`id_profesor_contacto`, `id_profesor`, `tipo_contacto`, `contacto`) VALUES
(1, 1, 3, 'enriquepeñagomez@hotmail.com '),
(2, 1, 1, '5594 7039'),
(3, 1, 2, ' 044 552657 3402'),
(4, 2, 3, ' alefranco08@hotmail.com'),
(5, 2, 4, ' alefranco@gmail.com'),
(6, 2, 1, '5680-6635'),
(7, 2, 2, '5527-5545-00 '),
(8, 3, 3, ' miguelzenen@yahoo.com.mx'),
(9, 3, 2, '55 4355 3956 '),
(10, 4, 3, ' magdaleno_villanuevaflores@yahoo.com'),
(11, 4, 2, '5527149934'),
(12, 5, 3, ' svazan@derecho.unam.mx'),
(13, 5, 2, '55-18092240 '),
(14, 6, 3, 'rabindrana1@yahoo.com.mx'),
(15, 7, 3, ' toris_83@hotmail.com'),
(16, 7, 2, '55-21858762 '),
(17, 8, 3, ' consultoriajuridica.penalcivil@hotmail.com'),
(18, 8, 2, '5545757934'),
(19, 9, 3, ' hvaldezv2004@yahoo.com.mx'),
(20, 9, 1, ' 5671-6403 '),
(21, 9, 2, '55-2313-8958 '),
(22, 10, 3, ' ocampoabogados1@hotmail.com'),
(23, 10, 1, '5533944567'),
(24, 10, 2, '5510943721'),
(25, 11, 3, ' chuchuso@hotmail.com'),
(26, 11, 2, '044 55 2309 0349 '),
(27, 12, 3, ' baezitan@yahoo.com.mx'),
(28, 12, 1, '5336 5471 '),
(29, 12, 2, '044 55 1335 1499'),
(30, 13, 3, ' guadalupe.romero13@yahoo.com.mx'),
(31, 13, 1, '52350468'),
(32, 13, 2, ' 55-26660349 '),
(33, 14, 1, '3540 3212 '),
(34, 14, 2, '044 55 3900 5581'),
(35, 15, 3, ' rafaelromero1955@hotmail.com'),
(36, 15, 1, '569696-51 '),
(37, 15, 2, '5513-2991-74'),
(38, 16, 3, ' lucygh_miro@hotmail.com'),
(39, 16, 1, '41714371'),
(40, 16, 2, '5536608220'),
(41, 17, 3, ' scuevasn@sre.gob.mx'),
(42, 17, 2, '55-30-70-69-39 '),
(43, 18, 3, ' vrncbzn@gmail.com'),
(44, 18, 2, '55-40010447 '),
(45, 19, 3, 'juan-angeles@hotmail.com'),
(46, 21, 3, ' alejvaz@hotmail.com'),
(47, 21, 1, '5766-6772 '),
(48, 21, 2, '5520-8321-41  55-45666928 '),
(49, 23, 3, ' jmonteslaw@yahoo.com.mx'),
(50, 23, 1, '5422-2856'),
(51, 23, 2, '5554-3337-99'),
(52, 24, 3, 'yovacolin@hotmail.com'),
(53, 24, 1, '57405174'),
(54, 24, 2, '445549352193'),
(55, 25, 3, ' juiciosoralesjm@hotmail.com'),
(56, 25, 2, '044-55-13-22-76-18 '),
(57, 26, 1, '5696-0956'),
(58, 26, 2, '55-18136397'),
(59, 29, 3, ' jessijulym@gmail.com'),
(60, 29, 2, '55-14732831 '),
(61, 31, 3, ' julyes2010@hotmail.com'),
(62, 31, 1, '5510116661'),
(63, 31, 2, '044 55 34 830830 '),
(64, 32, 3, ' ixchel_4691@hotmail.com'),
(65, 32, 2, '445523337887'),
(66, 33, 2, '55-43418594'),
(67, 34, 3, ' enrique_bautistapaz@outlook.com'),
(68, 34, 2, '445513631095'),
(69, 35, 1, '56867381'),
(70, 35, 2, ' 04455 2687 '),
(71, 37, 3, 'miguelgava01@gmail.com'),
(72, 38, 3, ' jaga91@hotmail.com'),
(73, 38, 2, '044 5521 28 6044'),
(74, 39, 1, '11018495'),
(75, 39, 2, '445510060628'),
(76, 40, 3, 'ednasanjuan@hotmail.com '),
(77, 40, 2, '445540909594'),
(78, 41, 3, ' jorgezaldivar@yahoo.com.mx'),
(79, 41, 2, '445518384651'),
(80, 42, 3, ' guerecajuridico@yahoo.com.mx'),
(81, 42, 2, '5530555118'),
(82, 43, 3, 'saraesteban@prodigy.net.mx '),
(83, 43, 1, '55710074'),
(84, 43, 2, '445555045851'),
(85, 44, 3, 'hmv_derecho2222@yahoo.com.mx'),
(86, 45, 3, ' carlosverduzco1103@yahoo.com'),
(87, 45, 2, '445537330045'),
(88, 46, 3, 'isidrocanedoosnaya15@gmail.com'),
(89, 46, 1, '5679-2467 '),
(90, 46, 2, '445554574221'),
(91, 49, 3, ' rossypi_2003@yahoo.com.mx'),
(92, 49, 1, '2615-0807'),
(93, 49, 2, '5526-9977-14  552649-6714 '),
(94, 50, 2, '5513876929'),
(95, 52, 3, ' mgranadosatlaco@yahoo.com.mx4'),
(96, 52, 1, '5590-5578 '),
(97, 52, 2, ' 5554-1399-93 '),
(98, 53, 3, ' marmorpoc@yahoo.es'),
(99, 53, 1, '56017971'),
(100, 53, 2, ' 55-40668019'),
(101, 54, 1, ' 5624-5390'),
(102, 54, 2, '04455-1850-7558'),
(103, 50, 3, 'pdanielalucio@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profesores_contactos`
--
ALTER TABLE `profesores_contactos`
  ADD PRIMARY KEY (`id_profesor_contacto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesores_contactos`
--
ALTER TABLE `profesores_contactos`
  MODIFY `id_profesor_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
