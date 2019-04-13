-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-07-2016 a las 14:53:31
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
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `apellido_paterno` varchar(150) NOT NULL,
  `apellido_materno` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `rfc` varchar(18) NOT NULL,
  `nivel_estudios` int(1) NOT NULL COMMENT '1=Licenciatura, 2= Especialidad, 3=Maestria, 4 = Doctorado',
  `estudios` varchar(200) NOT NULL,
  `titulo` varchar(15) NOT NULL,
  `cedula_profesional` varchar(10) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL,
  `estatus` int(1) NOT NULL COMMENT '1= activo 0 = inactivo'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `apellido_paterno`, `apellido_materno`, `nombre`, `curp`, `rfc`, `nivel_estudios`, `estudios`, `titulo`, `cedula_profesional`, `usuario`, `password`, `estatus`) VALUES
(1, 'PEÑA', 'GÓMEZ', 'ENRIQUE', '', '', 0, '', 'LIC.', '', 'pgenrique', 'enriquepp17-@', 1),
(2, 'FRANCO', 'ROSAS', 'ALEJANDRO JAVIER', '', '', 0, '', 'MTRO.', '', 'fralejandro', 'alejandroff53&%', 1),
(3, 'MIGUEL', 'CRUZ', 'ZENEN', '', '', 0, '', 'MTRO.', '', 'mczenen', 'zenenmm43_@', 1),
(4, 'VILLANUEVA', 'FLORES', 'MAGDALENO', '', '', 0, '', 'MTRO.', '', 'vfmagdaleno', 'magdalenovv02&-', 1),
(5, 'BAZÁN', 'ORTEGA', 'SERGIO', '', '', 0, '', 'MTRO.', '', 'bosergio', 'sergiobb49.-', 1),
(6, 'CISNEROS', 'GARCÍA', 'JUAN RABINDRANA', '', '', 0, '', 'MTRO.', '', 'cgjuan', 'juancc81%*', 1),
(7, 'SALAZAR', 'HERNÁNDEZ', 'HÉCTOR MANUEL', '', '', 0, '', 'DR.', '', 'shhector', 'hectorss15*%', 1),
(8, 'MARTÍNEZ', 'VILLEGAS', 'RAYMUNDO ALEJANDRO', '', '', 0, '', 'MTRO.', '', 'mvraymundo', 'raymundomm57%.', 1),
(9, 'VALDÉZ', 'BORROEL', 'HUGO MOISÉS', '', '', 0, '', 'MTRO.', '', 'vbhugo', 'hugovv06%$', 1),
(10, 'OCAMPO', 'CASTILLA', 'MAURICIO', '', '', 0, '', 'LIC.', '', 'ocmauricio', 'mauriciooo98#&', 1),
(11, 'AYALA', 'ENSUÁSTEGUI', 'LUZ MARÍA ELENA', '', '', 0, '', 'MTRA.', '', 'aeluz', 'luzaa11_#', 1),
(12, 'BAEZA', 'LARIOS', 'NORMA', '', '', 0, '', 'LIC.', '', 'blnorma', 'normabb81-_', 1),
(13, 'ROMERO', 'PINEDA', 'GUADALUPE', '', '', 0, '', 'LIC.', '', 'rpguadalupe', 'guadaluperr08#*', 1),
(14, 'FLORES', 'MEDINA', 'VÍCTOR', '', '', 0, '', 'LIC.', '', 'fmvictor', 'victorff95&-', 1),
(15, 'ROMERO', 'TOLEDO', 'RAFAEL', '', '', 0, '', 'LIC.', '', 'rtrafael', 'rafaelrr53_&', 1),
(16, 'GONZÁLEZ', 'HERNÁNDEZ', 'LUCÍA CITLALI', '', '', 0, '', 'LIC.', '', 'ghlucia', 'luciagg06%-', 1),
(17, 'CUEVAS', 'NIEVES', 'SANDRA XANTAL', '', '', 0, '', 'LIC.', '', 'cnsandra', 'sandracc34--', 1),
(18, 'BAZÁN', 'ORTEGA', 'VERÓNICA VIRGINIA', '', '', 0, '', 'LIC.', '', 'boveronica', 'veronicabb82#.', 1),
(19, 'ÁNGELES', 'LEÓN', 'JUAN CARLOS', '', '', 0, '', 'LIC.', '', 'aljuan', 'juan29#$', 1),
(20, 'DÍAZ', 'RODRÍGUEZ', 'RAÚL', '', '', 0, '', 'LIC.', '', 'drraul', 'rauldd00%@', 1),
(21, 'VÁZQUEZ', 'FLORES', 'MANUEL ALEJANDRO', '', '', 0, '', 'DR.', '', 'vfmanuel', 'manuelvv05-&', 1),
(22, 'ÁVILA', 'VANEGAS', 'JOSEFINA', '', '', 0, '', 'LIC.', '', 'avjosefina', 'josefina48.-', 1),
(23, 'MONTES', 'SOLÍS', 'JAIME', '', '', 0, '', 'MTRO.', '', 'msjaime', 'jaimemm30$_', 1),
(24, 'COLÍN', 'RODRÍGUEZ', 'JESÚS GIOVVANNY RAFAEL', '', '', 0, '', 'LIC.', '', 'crjesus', 'jesuscc84@&', 1),
(25, 'MONDRAGÓN', 'ZÚÑIGA', 'JUAN MARIO', '', '', 0, '', 'LIC.', '', 'mzjuan', 'juanmm90#/', 1),
(26, 'MARÍN', 'GÓMEZ', 'EDGAR RENÉ', '', '', 0, '', 'LIC.', '', 'mgedgar', 'edgarmm04.#', 1),
(27, 'FERNÁNDEZ', 'GONZÁLEZ', 'ALMA ROSA', '', '', 0, '', 'LIC.', '', 'fgalma', 'almaff75*@', 1),
(28, 'TORRES', 'NÚÑEZ', 'CUAUHTÉMOC', '', '', 0, '', 'MTRO.', '', 'tncuauhtemoc', 'cuauhtemoctt57*$', 1),
(29, 'RODRÍGUEZ', 'NÚÑEZ', 'JESSICA JULIETA', '', '', 0, '', 'MTRA.', '', 'rnjessica', 'jessicarr31%#', 1),
(30, 'ZAPATA', 'SILVA', 'EMILIANO', '', '', 0, '', 'LIC.', '', 'zsemiliano', 'emilianozz30&_', 1),
(31, 'CAMACHO', 'SERRANO', 'JULY', '', '', 0, '', 'LIC.', '', 'csjuly', 'julycc55%.', 1),
(32, 'CISNEROS', 'GROSSO', 'MIRIAM IXCHEL', '', '', 0, '', 'LIC.', '', 'cgmiriam', 'miriamcc10/%', 1),
(33, 'SOBERÓN', 'SANTISTEBAN', 'ADRIANA', '', '', 0, '', 'LIC.', '', 'ssadriana', 'adrianass06._', 1),
(34, 'BAUTISTA', 'PAZ', 'ENRIQUE', '', '', 0, '', 'LIC.', '', 'bpenrique', 'enriquebb56/$', 1),
(35, 'OLALDE', 'VIEYRA', 'JAIME ARMANDO', '', '', 0, '', 'MTRO.', '', 'ovjaime', 'jaimeoo60_@', 1),
(36, 'RUEDA', 'MARTÍNEZ', 'DAVID', '', '', 0, '', 'MTRO.', '', 'rmdavid', 'davidrr43*-', 1),
(37, 'GARCÍA', 'VÁZQUEZ', 'MIGUEL', '', '', 0, '', 'MTRO.', '', 'gvmiguel', 'miguelgg05_*', 1),
(38, 'GRANADOS', 'ATLACO', 'JOSÉ ANTONIO', '', '', 0, '', 'MTRO.', '', 'gajose', 'josegg61%@', 1),
(39, 'CRUZ', 'HERNÁNDEZ', 'HUMBERTO', '', '', 0, '', 'MTRO.', '', 'chhumberto', 'humbertocc09/#', 1),
(40, 'SAN JUAN', 'VALENZUELA', 'EDNA', '', '', 0, '', 'MTRA.', '', 'svedna', 'ednass76@%', 1),
(41, 'ZALDIVAR', 'VELÁSQUEZ', 'JORGE', '', '', 0, '', 'DR.', '', 'zvjorge', 'jorgezz40$#', 1),
(42, 'GUTIÉRREZ', 'GÜERECA', 'MIGUEL ANTONIO', '', '', 0, '', 'MTRO.', '', 'ggmiguel', 'miguelgg56@@', 1),
(43, 'ESTEBAN', 'CABRERA', 'SARA', '', '', 0, '', 'MTRA.', '', 'ecsara', 'saraee84%@', 1),
(44, 'MORENO', 'VALDÉZ', 'HADAR', '', '', 0, '', 'DR.', '', 'mvhadar', 'hadarmm78#$', 1),
(45, 'VERDUZCO', 'REINA', 'CARLOS', '', '', 0, '', 'MTRO.', '', 'vrcarlos', 'carlosvv19_.', 1),
(46, 'CAÑEDO', 'OSNAYA', 'ISIDRO', '', '', 0, '', 'MTRO.', '', 'coisidro', 'isidrocc20@%', 1),
(47, 'PILIADO', 'FLORES', 'WILFRIDO MAXIMILIANO', '', '', 0, '', 'MTRO.', '', 'pfwilfrido', 'wilfridopp92#/', 1),
(48, 'ESCAMILLA', 'GUTIÉRREZ', 'ARMANDO', '', '', 0, '', 'MTRO.', '', 'egarmando', 'armandoee60&&', 1),
(49, 'PINZÓN', 'CABALLERO', 'ROSA ELOISA', '', '', 0, '', 'MTRA.', '', 'pcrosa', 'rosapp12.&', 1),
(50, 'LUCIO', 'ESPINO', 'PATRICIA DANIELA', '', '', 0, '', 'MTRA.', '', 'lepatricia', 'patriciall85%@', 1),
(51, 'DÁVILA', 'FLORES', 'JUANA', '', '', 0, '', 'MTRA.', '', 'dfjuana', 'juanadd46#/', 1),
(52, 'GRANADOS', 'ATLACO', 'MIGUEL ÁNGEL', '', '', 0, '', 'DR.', '', 'gamiguel', 'miguelgg42_@', 1),
(53, 'MORANCHEL', 'POCATERRA', 'MARIANA', '', '', 0, '', 'DRA.', '', 'mpmariana', 'marianamm51%#', 1),
(54, 'PÉREZ', 'COLÍN', 'IGNACIO', '', '', 0, '', 'DR.', '', 'pcignacio', 'ignaciopp28/_', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
