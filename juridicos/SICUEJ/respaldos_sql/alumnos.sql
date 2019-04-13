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
-- Table structure for table `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
`id_alumno` int(11) NOT NULL,
  `id_codigo_postal` int(11) NOT NULL,
  `usuario` int(5) unsigned zerofill NOT NULL,
  `password` varchar(12) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `fecha_baja` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `id_codigo_postal`, `usuario`, `password`, `curp`, `rfc`, `apellido_paterno`, `apellido_materno`, `nombre`, `calle`, `fecha_hora`, `fecha_baja`) VALUES
(1, 0, 00001, 'amjulio64*/', '', '', 'ACEVEDO', 'MANRIQUE', 'JULIO CÉSAR', '', '2016-07-18 11:27:50', '2016-07-18'),
(2, 29456, 00002, 'apmauricio44', '', '', 'ALFARO', 'PÉREZ', 'MAURICIO', 'JUAN TORRE BLANCA MZ 176 LT 1463-B', '2016-07-18 11:27:50', '0000-00-00'),
(3, 29980, 00003, 'abcarlos27-*', '', '', 'ALVIRDE', 'BECERRIL', 'CARLOS ALBERTO', 'JACARANDAS N° 9', '2016-07-18 11:27:50', '2016-07-18'),
(4, 0, 00004, 'ahkarla00//', '', '', 'ARELLANO', 'HERNÁNDEZ', 'KARLA LILIANA', '', '2016-07-18 11:27:50', '2016-07-18'),
(5, 28630, 00005, 'agleticia09$', '', '', 'ARMENDÁRIZ', 'GARAY', 'LETICIA', 'TAMAULIPAS 30 3R PISO', '2016-07-18 11:27:50', '0000-00-00'),
(6, 0, 00006, 'auro14/-', '', '', 'AURO', '', '', '', '2016-07-18 11:27:50', '0000-00-00'),
(7, 71867, 00007, 'aljose70@*', '', '', 'AVENDAÑO', 'LÓPEZ', 'JOSÉ RAÚL', 'CRISANTEMO N°175', '2016-07-18 11:27:50', '0000-00-00'),
(8, 0, 00008, 'blfidelfa75@', '', '', 'BALDERAS', 'LINARES', 'FIDELFA JOSEFINA', '', '2016-07-18 11:27:50', '2016-07-18'),
(9, 28372, 00009, 'bekarla25@_', '', '', 'BAÑOS', 'ESTRADA', 'KARLA JOANA', 'PLUTARCO ELIAS CALLES N°1175 INT. 101', '2016-07-18 11:27:50', '0000-00-00'),
(10, 0, 00010, 'bmdulce29-&', '', '', 'BAUTISTA', 'MEDINA', 'DULCE CHARLOTTE', '', '2016-07-18 11:27:50', '0000-00-00'),
(11, 0, 00011, 'bajulio13-$', '', '', 'BEAR', 'ARJONA', 'JULIO', '', '2016-07-18 11:27:50', '0000-00-00'),
(12, 0, 00012, 'bnarturo75#%', '', '', 'BERVERA', 'NÚÑEZ', 'ARTURO DE JESÚS', '', '2016-07-18 11:27:50', '2016-07-18'),
(13, 29052, 00013, 'bhmagnolia30', '', '', 'BLANCO', 'HERNÁNDEZ', 'MAGNOLIA ISABEL', 'SAN JOSÉ N°4', '2016-07-18 11:27:50', '0000-00-00'),
(14, 0, 00014, 'cajulian79@/', '', '', 'CALDERÓN', 'ABURTO', 'JULIÁN GABRIEL', '', '2016-07-18 11:27:50', '2016-07-18'),
(15, 0, 00015, 'cmarturo35_*', '', '', 'CARMONA', 'MARTÍNEZ', 'ARTURO', '', '2016-07-18 11:27:50', '2016-07-18'),
(16, 0, 00016, 'cfalonso09./', '', '', 'CARRILLO', 'FUENTES', 'ALONSO', '', '2016-07-18 11:27:50', '2016-07-18'),
(17, 0, 00017, 'crrita15_#', '', '', 'CASTAÑEDA', 'RICO', 'RITA', '', '2016-07-18 11:27:50', '0000-00-00'),
(18, 0, 00018, 'cmjose53/#', '', '', 'CASTELLANOS', 'MEDINA', 'JOSÉ ÁNGEL', '', '2016-07-18 11:27:50', '0000-00-00'),
(19, 29115, 00019, 'cysilvia47%*', '', '', 'CÁZARES', 'YAÑEZ', 'SILVIA FERNANDA', 'LOMA ALEGRE MZ23 C LT 22', '2016-07-18 11:27:50', '0000-00-00'),
(20, 0, 00020, 'crfernanda88', '', '', 'CEDILLO', 'ROSENDI', 'FERNANDA PAOLA', '', '2016-07-18 11:27:50', '0000-00-00'),
(21, 28472, 00021, 'chtanya90_*', '', '', 'CEJAS', 'HERNÁNDEZ', 'TANYA PAMELA', 'A MNZ X N°22', '2016-07-18 11:27:50', '0000-00-00'),
(22, 29201, 00022, 'crbernardo62', '', '', 'CERVANTES', 'REYES', 'BERNARDO DANIEL', 'BUGAMBILIAS MZ B. LT15', '2016-07-18 11:27:50', '0000-00-00'),
(23, 0, 00023, 'clhazcel39$.', '', '', 'CORREA', 'LÓPEZ', 'HAZCEL CITLALI', '', '2016-07-18 11:27:50', '0000-00-00'),
(24, 0, 00024, 'csgerardo82*', '', '', 'COSTA RICA', 'SAN PEDRO', 'GERARDO', '', '2016-07-18 11:27:50', '2016-07-18'),
(25, 0, 00025, 'cfjulio54/&', '', '', 'CRUZ', 'FLORES', 'JULIO CÉSAR', '', '2016-07-18 11:27:50', '0000-00-00'),
(26, 0, 00026, 'chfrida15&_', '', '', 'CUENCA', 'HEREDIA', 'FRIDA NOEMÍ', '', '2016-07-18 11:27:50', '0000-00-00'),
(27, 28359, 00027, 'dmperla11-&', '', '', 'DEL ÁNGEL', 'MEZA', 'PERLA MIRIAM', 'ANTILLAS 308', '2016-07-18 11:27:50', '0000-00-00'),
(28, 28169, 00028, 'dgeduardo20/', '', '', 'DÍAZ', 'GONZÁLEZ', 'EDUARDO', 'AÑO 12 MZ 20 LT 16', '2016-07-18 11:27:50', '0000-00-00'),
(29, 28169, 00029, 'dreduardo98@', '', '', 'DÍAZ', 'RUÍZ', 'EDUARDO', 'TARANGO AND. 10 MNZ 16 LT 12', '2016-07-18 11:27:50', '0000-00-00'),
(30, 0, 00030, 'elmichel94%&', '', '', 'ENRÍQUEZ', 'LÓPEZ', 'MICHEL ANDREY', '', '2016-07-18 11:27:50', '0000-00-00'),
(31, 0, 00031, 'erjoel72%$', '', '', 'ESTRADA', 'RODRÍGUEZ', 'JOEL BLADIMIR', '', '2016-07-18 11:27:50', '0000-00-00'),
(32, 0, 00032, 'erjose03%.', '', '', 'ESTRADA', 'RODRÍGUEZ', 'JOSÉ ANTONIO', '', '2016-07-18 11:27:50', '0000-00-00'),
(33, 28147, 00033, 'fostephanie2', '', '', 'FERNÁNDEZ', 'OJEDA', 'STEPHANIE TANIA', 'CIPRES N°52', '2016-07-18 11:27:50', '0000-00-00'),
(34, 29198, 00034, 'fgeliseo17$.', '', '', 'FLORES', 'GUTIÉRREZ', 'ELISEO', 'ILHUICAMINA MZ30 LT14138', '2016-07-18 11:27:50', '0000-00-00'),
(35, 70009, 00035, 'ftfabiola13#', '', '', 'FLORES', 'TÉLLEZ', 'FABIOLA', 'CARABELA N°22', '2016-07-18 11:27:50', '0000-00-00'),
(36, 29455, 00036, 'gmandy01%-', '', '', 'GALICIA', 'MARTÍNEZ', 'ANDY JHONATAN', 'ERNESTINA  HEVIA DEL PUERTO', '2016-07-18 11:27:50', '0000-00-00'),
(37, 71528, 00037, 'grdario35_@', '', '', 'GALINDO', 'RIOS', 'DARIO IVÁN', 'PROL. ALDAMA S/N', '2016-07-18 11:27:50', '0000-00-00'),
(38, 0, 00038, 'gfedson64.%', '', '', 'GAMIÑO', 'FUENTES', 'EDSON PAOLO', '', '2016-07-18 11:27:50', '0000-00-00'),
(39, 29553, 00039, 'gpmaria44.-', '', '', 'GARCÍA', 'PINEDA', 'MARÍA ELENA', 'AMAPOLAS N°3', '2016-07-18 11:27:50', '0000-00-00'),
(40, 28464, 00040, 'gdmarisol53%', '', '', 'GONZÁLEZ', 'DIONICIO', 'MARISOL', 'JUMIL N° 167', '2016-07-18 11:27:50', '0000-00-00'),
(41, 0, 00041, 'gmsamuel28_-', '', '', 'GONZÁLEZ', 'MATA', 'SAMUEL', '', '2016-07-18 11:27:50', '0000-00-00'),
(42, 0, 00042, 'glfederico46', '', '', 'GRAJALES', 'LUNA', 'FEDERICO', '', '2016-07-18 11:27:50', '0000-00-00'),
(43, 0, 00043, 'gpjosue54.$', '', '', 'GÜERECA', 'PEREZ', 'JOSUE IVAN', '', '2016-07-18 11:27:50', '0000-00-00'),
(44, 29121, 00044, 'grmaria31$%', '', '', 'GUTIÉRREZ', 'RIVAS', 'MARÍA EUGENIA', 'VILLA FRONTERA MZ 4 LT 11', '2016-07-18 11:27:50', '0000-00-00'),
(45, 29903, 00045, 'hbveronica00', '', '', 'HERNÁNDEZ', 'BERISTAIN', 'VERÓNICA', 'MARGARITA MAZA DE JUÁREZ N°39', '2016-07-18 11:27:50', '0000-00-00'),
(46, 29796, 00046, 'headrian63$%', '', '', 'HERNÁNDEZ', 'ESPINOSA', 'ADRIÁN DANIEL', 'FRANCISCO ESPEJEL N°64 J1-01', '2016-07-18 11:27:50', '0000-00-00'),
(47, 0, 00047, 'hgaldo54&/', '', '', 'HERNÁNDEZ', 'GARCÍA', 'ALDO ARAMIS', '', '2016-07-18 11:27:50', '2016-07-18'),
(48, 28464, 00048, 'hjfernando42', '', '', 'HERNÁNDEZ', 'JIMÉNEZ', 'FERNANDO', 'COAPAN N°46 INT. 1', '2016-07-18 11:27:50', '0000-00-00'),
(49, 0, 00049, 'hrcinthya73.', '', '', 'HERNÁNDEZ', 'RAMOS', 'CINTHYA VIVIANA', '', '2016-07-18 11:27:50', '2016-07-18'),
(50, 0, 00050, 'hvluis25_@', '', '', 'HERNÁNDEZ', 'VELÁZQUEZ', 'LUIS ALBERTO', '', '2016-07-18 11:27:50', '2016-07-18'),
(51, 0, 00051, 'irfernando34', '', '', 'ISLAS', 'RAMÍREZ', 'FERNANDO', '', '2016-07-18 11:27:50', '0000-00-00'),
(52, 28381, 00052, 'jvjuan89_$', '', '', 'JIMÉNEZ', 'VALDÉZ', 'JUAN CARLOS', 'ALFONSO CASO N°162 INT. 3', '2016-07-18 11:27:50', '0000-00-00'),
(53, 0, 00053, 'jljose15$&', '', '', 'JUÁREZ', 'LÓPEZ', 'JOSÉ IVÁN', '', '2016-07-18 11:27:50', '0000-00-00'),
(54, 0, 00054, 'lscesar11/&', '', '', 'LEÓN', 'SANABRIA', 'CÉSAR ROMÁN', '', '2016-07-18 11:27:50', '2016-07-18'),
(55, 0, 00055, 'lggabriel03&', '', '', 'LÓPEZ', 'GONZÁLEZ', 'GABRIEL', '', '2016-07-18 11:27:50', '2016-07-18'),
(56, 29198, 00056, 'lmedna60%*', '', '', 'LÓPEZ', 'MOSCO', 'EDNA TERESA', 'MOCTEZUMA MZ26 LT3', '2016-07-18 11:27:50', '0000-00-00'),
(57, 0, 00057, 'lrsharon57@%', '', '', 'LÓPEZ', 'RODRÍGUEZ', 'SHARON ESTEFANY', '', '2016-07-18 11:27:50', '0000-00-00'),
(58, 0, 00058, 'lpjovanni33&', '', '', 'LOYO', 'PÉREZ', 'JOVANNI', '', '2016-07-18 11:27:50', '0000-00-00'),
(59, 0, 00059, 'lnsara52@&', '', '', 'LUGO', 'NUÑEZ', 'SARA SILVIA', '', '2016-07-18 11:27:50', '0000-00-00'),
(60, 0, 00060, 'lrcristian86', '', '', 'LUNA', 'RAMÍREZ', 'CRISTIAN MAURICIO', '', '2016-07-18 11:27:50', '0000-00-00'),
(61, 28968, 00061, 'mperick68@&', '', '', 'MACÍAS', 'PAHÍ', 'ERICK', 'AV. 5 N° 308', '2016-07-18 11:27:50', '0000-00-00'),
(62, 28968, 00062, 'mpyareli98--', '', '', 'MACÍAS', 'PAHÍ', 'YARELI', 'AVENIDA 5 N°308', '2016-07-18 11:27:50', '0000-00-00'),
(63, 28359, 00063, 'msaurora81.#', '', '', 'MANCILLA', 'SIUFFE', 'AURORA PATRICIA', 'BÉLGICA N° 314', '2016-07-18 11:27:50', '0000-00-00'),
(64, 0, 00064, 'mbalma37$%', '', '', 'MARISCAL', 'BENGOA', 'ALMA FABIOLA', '', '2016-07-18 11:27:50', '2016-07-18'),
(65, 0, 00065, 'mcmaria79&*', '', '', 'MÁRQUEZ', 'CHÁVEZ', 'MARÍA DEL ROCÍO', '', '2016-07-18 11:27:50', '0000-00-00'),
(66, 71494, 00066, 'mdemmyly89*&', '', '', 'MÁRQUEZ', 'DÁVILA', 'EMMYLY BETSABET', 'NORTE 17 MZN 716 LT 2', '2016-07-18 11:27:50', '0000-00-00'),
(67, 28468, 00067, 'majuan00&*', '', '', 'MARTÍN', 'ALMANZA', 'JUAN PABLO', 'CANDELARIA S/N', '2016-07-18 11:27:50', '0000-00-00'),
(68, 0, 00068, 'mcarturo12#$', '', '', 'MARTÍNEZ', 'CARMONA', 'ARTURO', '', '2016-07-18 11:27:50', '0000-00-00'),
(69, 0, 00069, 'mgmaria50$#', '', '', 'MEDELLÍN', 'GARCÍA', 'MARÍA GUADALUPE', '', '2016-07-18 11:27:50', '0000-00-00'),
(70, 0, 00070, 'mjjorge04*.', '', '', 'MEDINA', 'JIMÉNEZ', 'JORGE EDUARDO', '', '2016-07-18 11:27:50', '2016-07-18'),
(71, 0, 00071, 'mlhector08$%', '', '', 'MELÉNDEZ', 'LÓPEZ', 'HÉCTOR IVÁN', '', '2016-07-18 11:27:50', '0000-00-00'),
(72, 0, 00072, 'mcguillermo3', '', '', 'MÉNDEZ', 'CRESCENCIO', 'GUILLERMO IVÁN', '', '2016-07-18 11:27:50', '2016-07-18'),
(73, 28851, 00073, 'mpcarlos21##', '', '', 'MÉNDEZ', 'PETERS', 'CARLOS EDUARDO', 'EXCELSIOR N°81 INT. A', '2016-07-18 11:27:50', '0000-00-00'),
(74, 0, 00074, 'mgsaul64_%', '', '', 'MENDOZA', 'GUERRERO', 'SAÚL', '', '2016-07-18 11:27:50', '0000-00-00'),
(75, 0, 00075, 'mfoctavio96&', '', '', 'MERCADO', 'FERNÁNDEZ', 'OCTAVIO JOAN', '', '2016-07-18 11:27:50', '0000-00-00'),
(76, 0, 00076, 'mdcarlos86@&', '', '', 'MONTES', 'DIAS', 'CARLOS DANIEL', '', '2016-07-18 11:27:50', '2016-07-18'),
(77, 28359, 00077, 'mrgabriela81', '', '', 'MONTIEL', 'ROJAS', 'GABRIELA BERENICE', 'ANTILLAS N°308 INT. 104', '2016-07-18 11:27:50', '0000-00-00'),
(78, 29802, 00078, 'maberenice68', '', '', 'MORALES', 'ANTONIO', 'BERENICE', 'CALLE 2 N°388 INT. 404', '2016-07-18 11:27:50', '0000-00-00'),
(79, 0, 00079, 'mckevin63.%', '', '', 'MORALES', 'CEDILLO', 'KEVIN GAMALIEL', '', '2016-07-18 11:27:50', '0000-00-00'),
(80, 0, 00080, 'ocjose76@_', '', '', 'ORTEGA', 'CAZARES', 'JOSÉ MARÍA', '', '2016-07-18 11:27:50', '0000-00-00'),
(81, 28359, 00081, 'ocanakaren21', '', '', 'ORTÍZ', 'CASTRO', 'ANAKAREN', 'MUNICIPIO LIBRE 117 DPTO 302', '2016-07-18 11:27:50', '0000-00-00'),
(82, 28359, 00082, 'ocsalvador97', '', '', 'ORTÍZ', 'CASTRO', 'SALVADOR', 'MIUNICIPIO LIBRE 117 DPTO. 302', '2016-07-18 11:27:50', '0000-00-00'),
(83, 29619, 00083, 'oqjoyce20/*', '', '', 'ORTIZ', 'QUINTERO', 'JOYCE MELISSA', 'AYUNTAMIENTO N°98', '2016-07-18 11:27:50', '0000-00-00'),
(84, 28552, 00084, 'prgilda90@_', '', '', 'PAREDES', 'RAMÍREZ', 'GILDA ARACELI', 'SAN VICTORIA MZ597 LT10', '2016-07-18 11:27:50', '0000-00-00'),
(85, 0, 00085, 'pvjose40_/', '', '', 'PASCACIO', 'VILLEGAS', 'JOSÉ CARLOS', '', '2016-07-18 11:27:50', '0000-00-00'),
(86, 0, 00086, 'pvjose51./', '', '', 'PASCACIO', 'VILLEGAS', 'JOSÉ MAURICIO', '', '2016-07-18 11:27:50', '2016-07-18'),
(87, 0, 00087, 'plcarolina67', '', '', 'PEÑALOZA', 'LUCIO', 'CAROLINA', '', '2016-07-18 11:27:50', '0000-00-00'),
(88, 0, 00088, 'pesergio59_-', '', '', 'PÉREZ', 'ESCOBAR', 'SERGIO RAÚL', '', '2016-07-18 11:27:50', '0000-00-00'),
(89, 0, 00089, 'psivan59-$', '', '', 'PÉREZ', 'SAAVEDRA', 'IVAN', '', '2016-07-18 11:27:50', '0000-00-00'),
(90, 0, 00090, 'prclaudia50#', '', '', 'PLIEGO', 'RIOJA', 'CLAUDIA HAZEL', 'FRANCISCO RIVAS N° 11 INT. 3', '2016-07-18 11:27:50', '0000-00-00'),
(91, 29144, 00091, 'prmaria84%#', '', '', 'PRECIADO', 'RAMÍREZ', 'MARÍA MERCEDES', 'SIMÓN ALQUISIRAS N°7 MZ. 17', '2016-07-18 11:27:50', '0000-00-00'),
(92, 28364, 00092, 'ralisbeth42#', '', '', 'RAMÍREZ', 'AVENDAÑO', 'LISBETH YANY', 'XOCHICALCO N°880 ÁLAMO PB2', '2016-07-18 11:27:50', '0000-00-00'),
(93, 0, 00093, 'rdluis48@#', '', '', 'RAMIREZ', 'DELGADO', 'LUIS FERNANDO', '', '2016-07-18 11:27:50', '0000-00-00'),
(94, 28359, 00094, 'rocarlos83.*', '', '', 'RAMÍREZ', 'OLACE', 'CARLOS ALBERTO', 'MUNICIPIO LIBRE 107 C-201', '2016-07-18 11:27:50', '0000-00-00'),
(95, 0, 00095, 'rtjorge90-_', '', '', 'RAMÍREZ', 'TORRES', 'JORGE OSCAR', '', '2016-07-18 11:27:50', '0000-00-00'),
(96, 28958, 00096, 'rbrodrigo60$', '', '', 'REYES', 'BARRÓN', 'RODRIGO ALEJANDRO', '2° CALLEJÓN PACHICALCO N° 7 B-507', '2016-07-18 11:27:50', '0000-00-00'),
(97, 0, 00097, 'rcvictor27-$', '', '', 'REYES', 'CÁRDENAS', 'MOISÉS SEBASTIÁN', 'LA ASUNCIÓN DEL IXTACALCO CEERO DEL TEZONTLE 116', '2016-07-18 11:27:50', '0000-00-00'),
(98, 0, 00098, 'rgcristofer5', '', '', 'REYES', 'GUADARRAMA', 'CRISTOFER', '', '2016-07-18 11:27:50', '0000-00-00'),
(99, 0, 00099, 'rmcesar96%%', '', '', 'REYES', 'MARCHEET', 'CESAR ARMANDO', '', '2016-07-18 11:27:50', '2016-07-18'),
(100, 29620, 00100, 'rmvictor23_*', '', '', 'REYES', 'MARCHEET', 'VÍCTOR ROMÁN', 'PASEO DE LAS FLORES MZ1 LT3', '2016-07-18 11:27:50', '0000-00-00'),
(101, 0, 00101, 'rpliliana85_', '', '', 'RÍOS', 'PACHECO', 'LILIANA IVONNE', '', '2016-07-18 11:27:50', '0000-00-00'),
(102, 0, 00102, 'rrjose53-_', '', '', 'RIVERA', 'REYES', 'JOSÉ FERNANDO', '', '2016-07-18 11:27:50', '0000-00-00'),
(103, 0, 00103, 'rhmaria72%/', '', '', 'RODRÍGUEZ', 'HERRERA', 'MARÍA ESTHER', '', '2016-07-18 11:27:50', '0000-00-00'),
(104, 0, 00104, 'rooscar10$_', '', '', 'RODRÍGUEZ', 'OROPEZA', 'ÓSCAR FRANCISCO', '', '2016-07-18 11:27:50', '0000-00-00'),
(105, 29853, 00105, 'rgdeasy23%&', '', '', 'ROJAS', 'GONZÁLEZ', 'DEASY MONSERRAT', 'MANIFIESTO DE VILLA MZ 30 LT11', '2016-07-18 11:27:50', '0000-00-00'),
(106, 0, 00106, 'rsadrian81*%', '', '', 'ROMÁN', 'SALGADO', 'ADRIÁN', '', '2016-07-18 11:27:50', '0000-00-00'),
(107, 28382, 00107, 'rcalfredo37*', '', '', 'ROMERO', 'CAÑEDO', 'ALFREDO', 'ISABEL LOZANO VIUDA DE BETTY N°114', '2016-07-18 11:27:50', '0000-00-00'),
(108, 0, 00108, 'rcalfredo42-', '', '', 'ROMERO', 'CEBALLOS', 'ALFREDO ESSAU', '', '2016-07-18 11:27:50', '0000-00-00'),
(109, 28382, 00109, 'rcmarleth51$', '', '', 'ROMERO', 'CEBALLOS', 'MARLETH', 'ISABEL LOZANO VDA. DE BETLI N°114', '2016-07-18 11:27:50', '0000-00-00'),
(110, 0, 00110, 'rpadrian53@-', '', '', 'ROSAS', 'PÉREZ', 'ADRIÁN', '', '2016-07-18 11:27:50', '2016-07-18'),
(111, 0, 00111, 'saselene82_-', '', '', 'SAAVEDRA', 'ARVIZU', 'SELENE', '', '2016-07-18 11:27:50', '0000-00-00'),
(112, 28394, 00112, 'spolivia09@.', '', '', 'SAAVEDRA', 'PÉREZ', 'OLIVIA', 'AV. 1° DE MAYO N°239-8', '2016-07-18 11:27:50', '0000-00-00'),
(113, 28359, 00113, 'somaria78#-', '', '', 'SADA', 'OROSA', 'MARÍA ISABEL', 'VÍCTOR HUGO N°119', '2016-07-18 11:27:50', '0000-00-00'),
(114, 0, 00114, 'svaraceli69@', '', '', 'SALOMÓN', 'VÁZQUEZ', 'ARACELI', '', '2016-07-18 11:27:50', '2016-07-18'),
(115, 71927, 00115, 'scbryan17.%', '', '', 'SÁNCHEZ', 'CRUZ', 'BRYAN', 'ORIENTE 33 301', '2016-07-18 11:27:50', '0000-00-00'),
(116, 28344, 00116, 'sdnelson01/%', '', '', 'SÁNCHEZ', 'DE LOS SANTOS', 'NELSON FERNANDO', 'PRIVADA EUGENIA N°16-1', '2016-07-18 11:27:50', '0000-00-00'),
(117, 0, 00117, 'saadrian75$_', '', '', 'SANTIAGO', 'ALVARADO', 'ADRIAN RODOLFO', '', '2016-07-18 11:27:50', '0000-00-00'),
(118, 28109, 00118, 'sdpedro01**', '', '', 'SARABIA', 'DE LA CRUZ', 'PEDRO PABLO', 'SAN FRANCISCO LT53 MZ8', '2016-07-18 11:27:50', '0000-00-00'),
(119, 68119, 00119, 'tcandrea21-$', '', '', 'TAPIA', 'CÁRDENAS', 'ANDREA ELIZABETH', 'CERRADA SATURNO N°4', '2016-07-18 11:27:50', '0000-00-00'),
(120, 29887, 00120, 'tlitoshi37$&', '', '', 'TOMINAGA', 'LÓPEZ', 'ITOSHI', 'CAMINO A SANTIAGO MNZ 2 LT 4', '2016-07-18 11:27:50', '0000-00-00'),
(121, 0, 00121, 'tcdiana52&/', '', '', 'TUMALÁN', 'CASTAÑEDA', 'DIANA LILENI', '', '2016-07-18 11:27:50', '0000-00-00'),
(122, 29610, 00122, 'vberasmo77-#', '', '', 'VALDÉZ', 'BLAS', 'ERASMO', '4° CERRADA GUADALUPE VICTORIA MZ 31 LT 15', '2016-07-18 11:27:50', '0000-00-00'),
(123, 29773, 00123, 'vfguadalupe2', '', '', 'VALENCIA', 'FRANCO', 'GUADALUPE NOEMÍ NAYELI', 'HÉROES DE NACOZARI N°8 B-201', '2016-07-18 11:27:50', '0000-00-00'),
(124, 28464, 00124, 'vlana98$%', '', '', 'VARGAS', 'LÓPEZ', 'ANA ELENA', 'XOCHIAPAN N° 179', '2016-07-18 11:27:50', '0000-00-00'),
(125, 0, 00125, 'vmtonatiuh29', '', '', 'VARGAS', 'MAPP', 'TONATIUH', '', '2016-07-18 11:27:50', '0000-00-00'),
(126, 29137, 00126, 'vrjennyfer88', '', '', 'VÁZQUEZ', 'RUBIO', 'JENNYFER', 'PABLO GONZÁLEZ N°38 B', '2016-07-18 11:27:50', '0000-00-00'),
(127, 0, 00127, 'vcenrique19$', '', '', 'VEGA', 'CORONEL', 'ENRIQUE', '', '2016-07-18 11:27:50', '0000-00-00'),
(128, 0, 00128, 'vfjulio93/@', '', '', 'VELASCO', 'FLORES', 'JULIO CÉSAR', '', '2016-07-18 11:27:50', '0000-00-00'),
(129, 0, 00129, 'vrkaren75@-', '', '', 'VELÁZQUEZ', 'RODRÍGUEZ', 'KAREN LIZBETH', '', '2016-07-18 11:27:50', '0000-00-00'),
(130, 0, 00130, 'vpeduardo23@', '', '', 'VERA', 'PERALTA', 'EDUARDO JAIR', '', '2016-07-18 11:27:50', '0000-00-00'),
(131, 0, 00131, 'vmjorge83/*', '', '', 'VIAY', 'MENDOZA', 'JORGE ALEJANDRO', '', '2016-07-18 11:27:50', '0000-00-00'),
(132, 28446, 00132, 'vcalejandra3', '', '', 'VILLAMAR', 'CORTÉS', 'ALEJANDRA GABRIELA', 'CIENEGA 5', '2016-07-18 11:27:50', '0000-00-00'),
(133, 0, 00133, 'zchector01%*', '', '', 'ZAMORA', 'CONSTANTINO', 'HECTOR', '', '2016-07-18 11:27:50', '2016-07-18'),
(134, 0, 00134, 'zdpablo93#%', '', '', 'ZARAGOZA', 'DIEGO', 'PABLO', '', '2016-07-18 11:27:50', '0000-00-00'),
(135, 0, 00135, 'zgjorge36#*', '', '', 'ZÚÑIGA', 'GARCÍA', 'JORGE IVÁN', '', '2016-07-18 11:27:50', '0000-00-00'),
(136, 29958, 00136, 'gzdiana45#&', '', '', 'GARCÍA', 'ZAMORA', 'DIANA LIBERTAD', 'AVENIDA HIDALGO NO. 142', '0000-00-00 00:00:00', '0000-00-00'),
(137, 29070, 00137, 'cgarminda28.', '', '', 'CERVANTES', 'GARCÍA', 'ARMINDA', 'EMILIO MADERO MZ. 54 LT458', '0000-00-00 00:00:00', '0000-00-00'),
(138, 29520, 00138, 'cgerick27&.', '', '', 'CUENCA', 'GURROLA', 'ERICK FERNANDO', 'CALVARIO', '0000-00-00 00:00:00', '0000-00-00'),
(139, 29021, 00139, 'mrgilberto93', '', '', 'MENDOZA ', 'RAYA', 'GILBERTO', 'JESÚS ROMERO FLORES N° 122', '0000-00-00 00:00:00', '0000-00-00'),
(140, 28636, 00140, 'cpnorma82$.', '', '', 'CRUZ', 'PALOMERA', 'NORMA GABRIELA', 'JUAN SEBASTIÁN BACH N°99 INT. 3', '0000-00-00 00:00:00', '0000-00-00'),
(141, 63721, 00141, 'ebmara84%*', '', '', 'ESCOBAR', 'BECERRIL', 'MARÍA DE MONTSERRAT', 'MANIUEL VILLADA 203', '0000-00-00 00:00:00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
 ADD PRIMARY KEY (`id_alumno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnos`
--
ALTER TABLE `alumnos`
MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=142;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
