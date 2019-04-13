-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 11:48 AM
-- Server version: 5.5.49-0+deb8u1
-- PHP Version: 5.6.22-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sicuej`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos_programas`
--

CREATE TABLE IF NOT EXISTS `alumnos_programas` (
`id_alumno_programa` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_plan_estudio` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `cuenta` varchar(10) NOT NULL,
  `clave` varchar(9) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_baja` date NOT NULL,
  `fecha_concluido` date NOT NULL,
  `fecha_titulado` date NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `estatus` int(1) NOT NULL COMMENT '1= ACTIVO , 0 = INACTIVO'
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnos_programas`
--

INSERT INTO `alumnos_programas` (`id_alumno_programa`, `id_alumno`, `id_plan_estudio`, `id_grupo`, `cuenta`, `clave`, `fecha_inicio`, `fecha_baja`, `fecha_concluido`, `fecha_titulado`, `observaciones`, `estatus`) VALUES
(1, 1, 1, 0, '120201002', '120201002', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(2, 2, 1, 0, '160801135', '160801135', '2016-01-25', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(3, 3, 1, 0, '140501060', '140501060', '2014-08-16', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(4, 4, 1, 0, '130301009', '130301009', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(5, 5, 1, 0, '140401035', '140401035', '2014-02-14', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(6, 6, 1, 0, '151201129', '151201129', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(7, 7, 1, 0, '150601080', '150601080', '2015-02-03', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(8, 8, 1, 0, '120201013', '120201013', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(9, 9, 1, 0, '120201014', '120201014', '2013-09-09', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(10, 10, 1, 0, '150701102', '150701102', '2015-08-17', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(11, 11, 1, 0, '160801143', '160801143', '2016-02-02', '0000-00-00', '0000-00-00', '0000-00-00', 'No tenemos acta de nacimiento, ni comprobante de domicilio del alumno', 1),
(12, 12, 1, 0, '120201015', '120201015', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(13, 13, 1, 0, '160801145', '160801145', '2016-04-11', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(14, 14, 1, 0, '130301008', '130301008', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(15, 15, 1, 0, '140501068', '140501068', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(16, 16, 1, 0, '140401037', '140401037', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(17, 17, 1, 0, '150701117', '150701117', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(18, 18, 1, 0, '140401036', '140401036', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(19, 19, 1, 0, '130301003', '130301003', '2013-02-08', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(20, 20, 1, 0, '150701130', '150701130', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(21, 21, 1, 0, '150601088', '150601088', '2015-08-07', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(22, 22, 1, 0, '160801134', '160801134', '2016-01-18', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(23, 23, 1, 0, '150701104', '150701104', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(24, 24, 1, 0, '140501061', '140501061', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(25, 25, 1, 0, '160801138', '160801138', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(26, 26, 1, 0, '150501078', '150501078', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(27, 27, 1, 0, '140401038', '140401038', '2014-02-21', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(28, 28, 1, 0, '120201026', '120201026', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(29, 29, 1, 0, '150701105', '150701105', '2015-07-11', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(30, 30, 1, 0, '140501070', '140501070', '2015-07-30', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(31, 31, 1, 0, '150701122', '150701122', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(32, 32, 1, 0, '150701118', '150701118', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(33, 33, 1, 0, '160801133', '160801133', '2016-01-19', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(34, 34, 1, 0, '150501093', '150501093', '2015-07-16', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(35, 35, 1, 0, '130301007', '130301007', '2013-04-16', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(36, 36, 1, 0, '140501062', '140501062', '2014-08-22', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(37, 37, 1, 0, '150601089', '150601089', '2015-08-04', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(38, 38, 1, 0, '150501076', '150501076', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(39, 39, 1, 0, '160801139', '160801139', '2016-02-03', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(40, 40, 1, 0, '140501063', '140501063', '2014-08-18', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(41, 41, 1, 0, '150701123', '150701123', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(42, 42, 1, 0, '161201147', '161201147', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(43, 43, 1, 0, '140501071', '140501071', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(44, 44, 1, 0, '130301012', '130301012', '2013-03-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(45, 45, 1, 0, '150601096', '150601096', '2015-08-17', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(46, 46, 1, 0, '160801131', '160801131', '2015-12-28', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(47, 47, 1, 0, '150501086', '150501086', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(48, 48, 1, 0, '140401056', '140401056', '2014-05-16', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(49, 49, 1, 0, '120201025', '120201025', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(50, 50, 1, 0, '130301010', '130301010', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(51, 51, 1, 0, '150701124', '150701124', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(52, 52, 1, 0, '140401050', '140401050', '2014-07-25', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(53, 53, 1, 0, '150501072', '150501072', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(54, 54, 1, 0, '140401042', '140401042', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(55, 55, 1, 0, '120201001', '120201001', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(56, 56, 1, 0, '120201016', '120201016', '2013-08-13', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(57, 57, 1, 0, '150601092', '150601092', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(58, 58, 1, 0, '140401058', '140401058', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(59, 59, 1, 0, '140501064', '140501064', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(60, 60, 1, 0, '140401054', '140401054', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(61, 61, 1, 0, '130201017', '130201017', '2013-08-13', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(62, 62, 1, 0, '130201027', '130201027', '2013-09-17', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(63, 63, 1, 0, '130301004', '130301004', '2013-02-11', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(64, 64, 1, 0, '140401040', '140401040', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(65, 65, 1, 0, '130301005', '130301005', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(66, 66, 1, 0, '140501065', '140501065', '2014-08-19', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(67, 67, 1, 0, '160801132', '160801132', '2016-02-03', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(68, 68, 1, 0, '140401059', '140401059', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(69, 69, 1, 0, '150701108', '150701108', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(70, 70, 1, 0, '140401041', '140401041', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(71, 71, 1, 0, '150601094', '150601094', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(72, 72, 1, 0, '120201031', '120201031', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(73, 73, 1, 0, '150501077', '150501077', '2015-02-16', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(74, 74, 1, 0, '160801137', '160801137', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(75, 75, 1, 0, '150501079', '150501079', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(76, 76, 1, 0, '120201032', '120201032', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(77, 77, 1, 0, '140501069', '140501069', '2014-08-15', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(78, 78, 1, 0, '150601087', '150601087', '2015-08-10', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(79, 79, 1, 0, '150601091', '150601091', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(80, 80, 1, 0, '150701119', '150701119', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(81, 81, 1, 0, '150701126', '150701126', '2015-10-26', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(82, 82, 1, 0, '150701127', '150701127', '2015-10-26', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(83, 83, 1, 0, '140401057', '140401057', '2014-06-26', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(84, 84, 1, 0, '150701125', '150701125', '2015-06-30', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(85, 85, 1, 0, '140401055', '140401055', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(86, 86, 1, 0, '140401043', '140401043', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(87, 87, 1, 0, '160801146', '160801146', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(88, 88, 1, 0, '140401044', '140401044', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(89, 89, 1, 0, '140401053', '140401053', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(90, 90, 1, 0, '150601085', '150601085', '2015-08-17', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(91, 91, 1, 0, '140401045', '140401045', '2014-01-21', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(92, 92, 1, 0, '120201028', '120201028', '2013-07-27', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(93, 93, 1, 0, '150601081', '150601081', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(94, 94, 1, 0, '160801033', '160801033', '2016-01-13', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(95, 95, 1, 0, '140401046', '140401046', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(96, 96, 1, 0, '150601090', '150601090', '2015-08-04', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(97, 97, 1, 0, '140501066', '140501066', '2014-08-18', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(98, 98, 1, 0, '160801142', '160801142', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(99, 99, 1, 0, '130201018', '130201018', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(100, 100, 1, 0, '130201019', '130201019', '2013-06-17', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(101, 101, 1, 0, '130201020', '130201020', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(102, 102, 1, 0, '130301006', '130301006', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(103, 103, 1, 0, '150701128', '150701128', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(104, 104, 1, 0, '150601097', '150601097', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(105, 105, 1, 0, '160801141', '160801141', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(106, 106, 1, 0, '150701120', '150701120', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(107, 107, 1, 0, '130201029', '130201029', '2013-08-07', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(108, 108, 1, 0, '150501073', '150501073', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'TIENE CERTIFICADO DE BACHILLERATO, PERO FALTA EL FORMULARIO DE INSCRIPCIÓN.', 1),
(109, 109, 1, 0, '140401049', '140401049', '2014-02-11', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(110, 110, 1, 0, '120201030', '120201030', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(111, 111, 1, 0, '140401034', '140401034', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(112, 112, 1, 0, '140401051', '140401051', '2014-02-04', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(113, 113, 1, 0, '130201021', '130201021', '2013-08-21', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(114, 114, 1, 0, '120201033', '120201033', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(115, 115, 1, 0, '150601082', '150601082', '2015-07-21', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(116, 116, 1, 0, '140401047', '140401047', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 'NO CONTAMOS CON DOCUMENTACIÓN NI CON CORREO ELECTRÓNICO', 1),
(117, 117, 1, 0, '150501074', '150501074', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(118, 118, 1, 0, '130301011', '130301011', '2013-02-07', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(119, 119, 1, 0, '150601084', '150601084', '2015-08-03', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(120, 120, 1, 0, '150601083', '150601083', '2015-07-30', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(121, 121, 1, 0, '150701121', '150701121', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(122, 122, 1, 0, '140401052', '140401052', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(123, 123, 1, 0, '120201022', '120201022', '2013-08-19', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(124, 124, 1, 0, '120201023', '120201023', '2013-08-17', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(125, 125, 1, 0, '160801144', '160801144', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(126, 126, 1, 0, '160801140', '160801140', '2016-02-02', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(127, 127, 1, 0, '150501075', '150501075', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(128, 128, 1, 0, '150601098', '150601098', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(129, 129, 1, 0, '160801136', '160801136', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(130, 130, 1, 0, '150601099', '150601099', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(131, 131, 1, 0, '150601100', '150601100', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(132, 132, 1, 0, '150601101', '150601101', '2015-09-01', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(133, 133, 1, 0, '120201024', '120201024', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(134, 134, 1, 0, '150601095', '150601095', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(135, 135, 1, 0, '140501067', '140501067', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(136, 136, 1, 1, '160901136', '160901136', '2016-07-18', '0000-00-00', '0000-00-00', '0000-00-00', 'fecha de inscripción 18-07/2016', 1),
(137, 138, 1, 12, '16901137', '16901137', '2016-07-23', '0000-00-00', '0000-00-00', '0000-00-00', '', 1),
(138, 139, 1, 1, '16901138', '16901138', '2016-07-25', '0000-00-00', '0000-00-00', '0000-00-00', '', 0),
(139, 140, 1, 1, '16901139', '16901139', '2016-07-26', '0000-00-00', '0000-00-00', '0000-00-00', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos_programas`
--
ALTER TABLE `alumnos_programas`
 ADD PRIMARY KEY (`id_alumno_programa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos_programas`
--
ALTER TABLE `alumnos_programas`
MODIFY `id_alumno_programa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
