-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 11:47 AM
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
-- Table structure for table `alumnos_becas`
--

CREATE TABLE IF NOT EXISTS `alumnos_becas` (
`id_alumno_beca` int(11) NOT NULL,
  `id_alumno_programa` int(11) NOT NULL,
  `id_ciclo_escolar` int(11) NOT NULL,
  `inscripcion` int(5) NOT NULL,
  `colegiatura` int(5) NOT NULL,
  `beca_inscripcion` int(3) NOT NULL,
  `beca_1` int(11) NOT NULL,
  `beca_2` int(11) NOT NULL,
  `beca_3` int(11) NOT NULL,
  `beca_4` int(11) NOT NULL,
  `beca_5` int(11) NOT NULL,
  `beca_6` int(11) NOT NULL,
  `beca_7` int(11) NOT NULL,
  `beca_8` int(11) NOT NULL,
  `beca_9` int(11) NOT NULL,
  `beca_10` int(11) NOT NULL,
  `beca_11` int(11) NOT NULL,
  `beca_12` int(11) NOT NULL,
  `observaciones` varchar(250) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnos_becas`
--

INSERT INTO `alumnos_becas` (`id_alumno_beca`, `id_alumno_programa`, `id_ciclo_escolar`, `inscripcion`, `colegiatura`, `beca_inscripcion`, `beca_1`, `beca_2`, `beca_3`, `beca_4`, `beca_5`, `beca_6`, `beca_7`, `beca_8`, `beca_9`, `beca_10`, `beca_11`, `beca_12`, `observaciones`) VALUES
(1, 136, 8, 1000, 2500, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(2, 2, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(3, 37, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(4, 81, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(5, 82, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(6, 13, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(7, 46, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(8, 67, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(9, 94, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(10, 105, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(11, 126, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(12, 21, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(13, 29, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(14, 90, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(15, 115, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(16, 120, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(17, 132, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(18, 119, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(19, 30, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(20, 36, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(21, 40, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(22, 52, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(23, 58, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(24, 66, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(25, 83, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(26, 5, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(27, 9, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(28, 27, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(29, 56, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(30, 61, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(31, 100, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(32, 113, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(33, 124, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(34, 127, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(35, 34, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(36, 11, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(37, 22, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(38, 25, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(39, 33, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(40, 39, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(41, 42, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(42, 45, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(43, 96, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(44, 7, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(45, 78, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(46, 108, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(47, 73, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(48, 88, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(49, 91, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(50, 95, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(51, 112, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(52, 116, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(53, 122, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(54, 19, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(55, 28, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(56, 35, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(57, 44, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(58, 48, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(59, 62, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(60, 63, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(61, 92, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(62, 107, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(63, 118, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(64, 137, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(65, 138, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(66, 139, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(67, 6, 8, 1000, 2500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos_becas`
--
ALTER TABLE `alumnos_becas`
 ADD PRIMARY KEY (`id_alumno_beca`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos_becas`
--
ALTER TABLE `alumnos_becas`
MODIFY `id_alumno_beca` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
