-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2016 a las 17:49:39
-- Versión del servidor: 5.7.16-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.27-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uosi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disco`
--

CREATE TABLE `disco` (
  `id` int(11) NOT NULL,
  `disco_fabricante` varchar(30) NOT NULL,
  `disco_modelo` varchar(30) NOT NULL,
  `capacidad_gb` int(11) NOT NULL,
  `interfaz` varchar(10) NOT NULL,
  `Cant_baja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `disco`
--

INSERT INTO `disco` (`id`, `disco_fabricante`, `disco_modelo`, `capacidad_gb`, `interfaz`, `Cant_baja`) VALUES
(1, 'Samsung', 'HD080HJ', 80, 'SATA', 0),
(2, 'Hitachi', 'HDS728080PLA380', 82, 'SATA', 0),
(3, 'Samsung', 'HD161HJ', 160, 'SATA', 0),
(4, 'Seagate', 'HD502HJ', 500, 'SATA', 0),
(5, 'WDC', 'WD5000AAKX', 500, 'SATA', 0),
(6, 'WDC', 'WD800BD', 80, 'SATA', 0),
(7, 'WDC', 'WD3200AAJS', 320, 'SATA', 0),
(8, 'Seagate', 'ST500DM002', 500, 'SATA', 0),
(9, 'Toshiba', 'DT01ACA050', 500, 'SATA', 0),
(10, 'WDC', 'WD1600AABS', 160, 'SATA', 0),
(11, 'Hitachi', 'HDS722580VLAT20', 80, 'IDE', 0),
(12, 'WDC', 'WD3200AAKS', 320, 'SATA', 0),
(13, 'Samsung', 'HM502JX', 500, 'SATA', 0),
(14, 'WDC', 'WD800BB', 80, 'IDE', 0),
(15, 'Samsung', 'HD161GJ', 160, 'SATA', 0),
(16, 'WDC', 'WD1600AAJS', 160, 'SATA', 0),
(17, 'Toshiba', 'MQ01ABD050', 500, 'SATA', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuente`
--

CREATE TABLE `fuente` (
  `id` int(11) NOT NULL,
  `fuente_fabricante` varchar(30) DEFAULT NULL,
  `watts` int(11) NOT NULL,
  `cant_baja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fuente`
--

INSERT INTO `fuente` (`id`, `fuente_fabricante`, `watts`, `cant_baja`) VALUES
(0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidente`
--

CREATE TABLE `incidente` (
  `id` int(11) NOT NULL,
  `nombre_incid` varchar(30) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `detalle` varchar(100) NOT NULL,
  `id_pc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidente`
--

INSERT INTO `incidente` (`id`, `nombre_incid`, `fecha_inicio`, `fecha_fin`, `detalle`, `id_pc`) VALUES
(1, 'Error de Windows', '2016-09-19', NULL, 'Windows no localiza ningÃºn programa.\r\nSoluciÃ³n: reinstalaciÃ³n de SO y programas', 32),
(2, 'Error de grub y fuente quemada', '2016-09-06', '2016-09-07', 'Se clonÃ³ y cambiÃ³ fuente', 22),
(3, 'Fuente quemada', '2016-09-09', '2016-09-09', 'Se cambiÃ³ fuente', 30),
(4, 'Placa quemada', '2016-02-24', NULL, 'Placa quemada', 89),
(5, 'Placa quemada', '2016-08-03', NULL, 'Placa quemada. Estaba en lab2 y se reemplazÃ³ por otra', 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_numero`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitor`
--

CREATE TABLE `monitor` (
  `id` int(11) NOT NULL,
  `monitor_modelo` varchar(30) DEFAULT NULL,
  `monitor_fabricante` varchar(20) DEFAULT NULL,
  `pulgadas` int(11) DEFAULT NULL,
  `monitor_inventario` varchar(30) DEFAULT NULL,
  `cant_baja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monitor`
--

INSERT INTO `monitor` (`id`, `monitor_modelo`, `monitor_fabricante`, `pulgadas`, `monitor_inventario`, `cant_baja`) VALUES
(0, NULL, NULL, NULL, NULL, 0),
(1, 'SyncMaster 753s', 'Samsung', 17, '', 0),
(2, 'SyncMaster 793s', 'Samsung', 17, '', 0),
(3, 'SyncMaster 793v', 'Samsung', 17, '', 0),
(4, 'SyncMaster 750s', 'Samsung', 17, '', 0),
(5, 'SyncMaster 794mb', 'Samsung', 17, '', 0),
(7, 'LCD Flatron W1943TE', 'LG', 19, '', 0),
(8, 'LCD SyncMaster 633nw', 'Samsung', 16, '', 0),
(9, 'Flatron ez T710SH', 'LG', 17, '', 0),
(10, 'SyncMaster 794v', 'Samsung ', 17, '', 0),
(11, 'LCD G615HDPL', 'Benq', 16, '', 0),
(12, 'LCD SyncMaster 940nw', 'Samsung', 19, '', 0),
(13, 'EU-170A', 'EuroCase', 17, '', 0),
(14, 'G615HDPL', 'Benq', 15, '', 0),
(15, 'SyncMaster e1720', 'Samsung', 17, '', 0),
(16, 'LCD SyncMaster 740nw', 'Samsung ', 17, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mother`
--

CREATE TABLE `mother` (
  `id` int(11) NOT NULL,
  `mother_fabricante` varchar(50) NOT NULL,
  `mother_modelo` varchar(20) NOT NULL,
  `cant_bancos` int(11) NOT NULL,
  `tipo_bancos` varchar(10) NOT NULL,
  `socket` varchar(30) NOT NULL,
  `version_bios` int(11) DEFAULT NULL,
  `cant_baja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mother`
--

INSERT INTO `mother` (`id`, `mother_fabricante`, `mother_modelo`, `cant_bancos`, `tipo_bancos`, `socket`, `version_bios`, `cant_baja`) VALUES
(1, 'Asus', 'M5A78L-M LX', 2, 'DDR3', 'AM3+', 2011, 0),
(2, 'MSI', 'G31M3-F V2', 2, 'DDR2', 'LGA775', 2008, 0),
(3, 'MSI', 'G41M-P26', 2, 'DDR3', 'LGA775', 2011, 0),
(4, 'Gigabyte', 'GA-F2A55M-HD2', 4, 'DDR3', 'FM2', 2011, 0),
(5, 'Asus', 'M2N68-AM Plus', 2, 'DDR2', 'AM2+', 2010, 0),
(6, 'MSI', 'NF725GM-P43 ', 2, 'DDR3', 'AM3', 2011, 0),
(7, 'Intel', 'D915PGN', 4, 'DDR', 'LGA775', 2005, 0),
(8, 'MSI', '661FM3-V', 2, 'DDR', 'LGA775', 2005, 0),
(9, 'MSI', 'K9N6SGM-V', 2, 'DDR2', 'AM2', 2007, 0),
(10, 'MSI', 'K9N6PGM-F', 2, 'DDR2', 'AM2', 2007, 0),
(11, 'MSI', 'K9AGM3-FIH', 4, 'DDR2', 'AM2', 2007, 0),
(12, 'Asus', 'AM1I-A', 2, 'DDR3', 'AM1', 2014, 0),
(13, 'Asus', 'M2N-MX SE Plus', 2, 'DDR2', 'AM2', 2008, 0),
(14, 'NVIDIA', 'nForce 430', 4, 'DDR2', 'AM2', 2009, 0),
(15, 'Asrock', 'AM1B-M', 2, 'DDR3', 'AM1', 2010, 0),
(16, 'Asus', 'A8V-MX', 2, 'DDR', '939', 2005, 0),
(17, 'Asus', 'M2V-TVM', 2, 'DDR2', 'AM2', 2006, 0),
(18, 'Asus', 'A7V8X-MX SE', 2, 'DDR', 'A', 2004, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_us`
--

CREATE TABLE `nivel_us` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel_us`
--

INSERT INTO `nivel_us` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`id`, `nombre`) VALUES
(1, 'Alumnado'),
(2, 'AtenciÃ³n al estudiante'),
(3, 'Area econÃ³mica'),
(4, 'Ases. pedagÃ³gica'),
(5, 'BedelÃ­a'),
(6, 'Consejo directivo'),
(7, 'Mesa de entrada'),
(8, 'Personal'),
(9, 'Posgrado'),
(10, 'Sec. acadÃ©mica'),
(11, 'Sec. administrativa'),
(12, 'Sec. ciencia y tÃ©cnica'),
(13, 'Sec. de coordinaciÃ³n'),
(14, 'Relac. institucionales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pc`
--

CREATE TABLE `pc` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `nro_inventario` varchar(30) DEFAULT NULL,
  `id_mother` int(11) NOT NULL,
  `id_disco` int(11) NOT NULL,
  `id_fuente` int(11) DEFAULT NULL,
  `id_monitor` int(11) DEFAULT NULL,
  `id_laboratorio` int(11) DEFAULT NULL,
  `id_oficina` int(11) DEFAULT NULL,
  `id_procesador` int(11) NOT NULL,
  `baja` tinyint(1) NOT NULL DEFAULT '0',
  `en_incidente` tinyint(1) NOT NULL DEFAULT '0',
  `red` tinyint(1) DEFAULT NULL,
  `en_taller` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pc`
--

INSERT INTO `pc` (`id`, `nombre`, `nro_inventario`, `id_mother`, `id_disco`, `id_fuente`, `id_monitor`, `id_laboratorio`, `id_oficina`, `id_procesador`, `baja`, `en_incidente`, `red`, `en_taller`) VALUES
(1, '101001', NULL, 1, 1, 0, 1, 1, NULL, 1, 0, 0, 1, NULL),
(2, '102002', NULL, 2, 1, 0, 2, 1, NULL, 2, 0, 0, 1, NULL),
(3, '103003', NULL, 2, 1, 0, 3, 1, NULL, 2, 0, 0, NULL, NULL),
(4, '104004', NULL, 2, 2, 0, 3, 1, NULL, 2, 0, 0, NULL, NULL),
(5, '105005', NULL, 1, 3, 0, 4, 1, NULL, 1, 0, 0, NULL, NULL),
(6, '106006', NULL, 2, 1, 0, 5, 1, NULL, 2, 0, 0, NULL, NULL),
(7, '107007', NULL, 3, 4, 0, 3, 1, NULL, 3, 0, 0, NULL, NULL),
(8, '108008', NULL, 3, 4, 0, 3, 1, NULL, 3, 0, 0, NULL, NULL),
(9, '109009', NULL, 4, 5, 0, 1, 1, NULL, 4, 0, 0, NULL, NULL),
(10, '110010', NULL, 1, 6, 0, 1, 1, NULL, 1, 0, 0, NULL, NULL),
(11, '111011', NULL, 1, 6, 0, 3, 1, NULL, 1, 0, 0, NULL, NULL),
(12, '112012', NULL, 3, 4, 0, 3, 1, NULL, 3, 0, 0, NULL, NULL),
(13, '113013', NULL, 1, 1, 0, 7, 1, NULL, 1, 0, 0, NULL, NULL),
(14, '114014', NULL, 1, 7, 0, 7, 1, NULL, 1, 0, 0, NULL, NULL),
(15, '115015', NULL, 5, 7, 0, 7, 1, NULL, 5, 0, 0, NULL, NULL),
(16, '116016', NULL, 5, 7, 0, 7, 1, NULL, 5, 0, 0, NULL, NULL),
(17, '201017', NULL, 6, 8, 0, 4, 2, NULL, 6, 0, 0, NULL, NULL),
(18, '202018', NULL, 4, 9, 0, 2, 2, NULL, 4, 0, 0, NULL, NULL),
(19, '203019', NULL, 6, 8, 0, 7, 2, NULL, 8, 0, 0, NULL, NULL),
(20, '204020', NULL, 7, 1, 0, 2, 2, NULL, 7, 0, 0, NULL, NULL),
(21, '205021', NULL, 5, 7, 0, 1, 2, NULL, 5, 0, 0, NULL, NULL),
(22, '206022', NULL, 5, 7, 0, 1, 2, NULL, 5, 0, 0, NULL, NULL),
(23, '207023', NULL, 6, 8, 0, 1, 2, NULL, 6, 0, 0, NULL, NULL),
(24, '208024', NULL, 5, 13, 0, 7, 2, NULL, 5, 0, 0, NULL, NULL),
(25, '209025', NULL, 6, 8, 0, 1, 2, NULL, 6, 0, 0, NULL, NULL),
(26, '210026', NULL, 6, 8, 0, 1, 2, NULL, 6, 0, 0, NULL, NULL),
(27, '211027', NULL, 6, 8, 0, 8, 2, NULL, 6, 0, 0, NULL, NULL),
(28, '212028', NULL, 6, 8, 0, 2, 2, NULL, 6, 0, 0, NULL, NULL),
(29, '213029', NULL, 1, 10, 0, 2, 2, NULL, 1, 0, 0, NULL, NULL),
(30, '214030', NULL, 6, 8, 0, 7, 2, NULL, 6, 0, 0, NULL, NULL),
(31, '215031', NULL, 6, 8, 0, 9, 2, NULL, 6, 0, 0, NULL, NULL),
(32, 'Taller2', NULL, 8, 14, 0, 0, NULL, NULL, 9, 0, 1, NULL, 1),
(33, '217033', NULL, 7, 1, 0, 3, 2, NULL, 7, 0, 0, NULL, NULL),
(34, '218034', NULL, 5, 7, 0, 4, 2, NULL, 5, 0, 0, NULL, NULL),
(35, '219035', NULL, 5, 7, 0, 3, 2, NULL, 5, 0, 0, NULL, NULL),
(36, '220036', NULL, 6, 8, 0, 4, 2, NULL, 6, 0, 0, NULL, NULL),
(37, '221037', NULL, 10, 10, 0, 11, 2, NULL, 10, 0, 0, NULL, NULL),
(38, '222038', NULL, 11, 3, 0, 12, 2, NULL, 10, 0, 0, NULL, NULL),
(39, '301039', NULL, 3, 4, 0, 1, 3, NULL, 3, 0, 0, NULL, NULL),
(40, '302040', NULL, 7, 1, 0, 10, 3, NULL, 7, 0, 0, NULL, NULL),
(41, '303041', NULL, 12, 9, 0, 10, 3, NULL, 11, 0, 0, NULL, NULL),
(42, '304042', NULL, 7, 1, 0, 10, 3, NULL, 7, 0, 0, NULL, NULL),
(43, '305043', 'FICH004720', 13, 3, 0, 10, 3, NULL, 12, 0, 0, NULL, NULL),
(44, '306044', '100 1-260 FICH 017-08', 13, 3, 0, 13, 3, NULL, 12, 0, 0, NULL, NULL),
(45, '307045', 'FICH004718', 1, 3, 0, 1, 3, NULL, 1, 0, 0, NULL, NULL),
(46, '308046', NULL, 7, 1, 0, 10, 3, NULL, 7, 0, 0, NULL, NULL),
(47, '309047', 'FICH004722', 13, 3, 0, 13, 3, NULL, 12, 0, 0, NULL, NULL),
(48, '310048', NULL, 7, 1, 0, 10, 3, NULL, 7, 0, 0, NULL, NULL),
(49, '311049', NULL, 12, 9, 0, 10, 3, NULL, 11, 0, 0, NULL, NULL),
(50, '312050', NULL, 7, 1, 0, 10, 3, NULL, 7, 0, 0, NULL, NULL),
(51, '313051', 'FICH004721', 13, 1, 0, 10, 3, NULL, 13, 0, 0, NULL, NULL),
(52, '314052', NULL, 12, 9, 0, 10, 3, NULL, 11, 0, 0, NULL, NULL),
(53, '315053', NULL, 13, 3, 0, 10, 3, NULL, 12, 0, 0, NULL, NULL),
(54, '317055', NULL, 12, 9, 0, 3, 3, NULL, 11, 0, 0, NULL, NULL),
(55, '318056', NULL, 12, 9, 0, 4, 3, NULL, 11, 0, 0, NULL, NULL),
(56, '319057', NULL, 12, 9, 0, 3, 3, NULL, 11, 0, 0, NULL, NULL),
(57, '320058', NULL, 12, 9, 0, 10, 3, NULL, 11, 0, 0, NULL, NULL),
(58, '321059', NULL, 12, 9, 0, 0, 3, NULL, 11, 0, 0, NULL, NULL),
(59, '401060', 'FICH004923', 14, 15, 0, 10, 4, NULL, 14, 0, 0, NULL, NULL),
(60, '402061', NULL, 1, 16, 0, 10, 4, NULL, 1, 0, 0, NULL, NULL),
(61, '403062', NULL, 12, 9, 0, 10, 4, NULL, 11, 0, 0, NULL, NULL),
(62, '404063', NULL, 12, 9, 0, 10, 4, NULL, 11, 0, 0, NULL, NULL),
(63, '405064', NULL, 12, 9, 0, 10, 4, NULL, 11, 0, 0, NULL, NULL),
(64, '406065', NULL, 11, 9, 0, 10, 4, NULL, 10, 0, 0, NULL, NULL),
(65, '407066', NULL, 14, 15, 0, 0, 4, NULL, 14, 0, 0, NULL, NULL),
(66, '408067', NULL, 12, 9, 0, 10, 4, NULL, 11, 0, 0, NULL, NULL),
(67, '409068', 'FICH004600', 11, 3, 0, 10, 4, NULL, 10, 0, 0, NULL, NULL),
(68, '410069', NULL, 12, 9, 0, 10, 4, NULL, 11, 0, 0, NULL, NULL),
(69, '411070', NULL, 1, 7, 0, 10, 4, NULL, 1, 0, 0, NULL, NULL),
(70, '412071', NULL, 12, 9, 0, 10, 4, NULL, 11, 0, 0, NULL, NULL),
(71, '41372', '100 1-260 FICH 016-09', 14, 15, 0, 10, 4, NULL, 14, 0, 0, NULL, NULL),
(72, '41473', NULL, 10, 10, 0, 4, 4, NULL, 10, 0, 0, NULL, NULL),
(73, '41574', '100 1-260 FICH 019-09', 14, 15, 0, 10, 4, NULL, 14, 0, 0, NULL, NULL),
(74, '417076', '100 1-260 FICH 020-09', 14, 15, 0, 3, 4, NULL, 14, 0, 0, NULL, NULL),
(75, '418077', NULL, 1, 16, 0, 7, 4, NULL, 1, 0, 0, NULL, NULL),
(76, '419078', NULL, 7, 1, 0, 14, 4, NULL, 7, 0, 0, NULL, NULL),
(77, '420079', NULL, 5, 7, 0, 7, 4, NULL, 5, 0, 0, NULL, NULL),
(78, '421080', 'FICH005335', 5, 7, 0, 7, 4, NULL, 5, 0, 0, NULL, NULL),
(79, '501081', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, 1, NULL),
(80, '502082', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(81, '503083', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(82, '504084', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(83, '505085', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(84, '506086', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(85, '507087', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(86, '508088', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(87, '509089', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(88, '510090', NULL, 2, 12, 0, 15, 5, NULL, 15, 0, 0, NULL, NULL),
(89, '511091', NULL, 15, 17, 0, 16, 5, NULL, 16, 0, 1, NULL, 1),
(90, '601092', NULL, 16, 2, 0, 3, 6, NULL, 17, 0, 0, NULL, NULL),
(91, '602093', NULL, 7, 1, 0, 0, 6, NULL, 7, 0, 0, NULL, NULL),
(92, '603094', '100 1-052 FICH 003-07', 17, 2, 0, 10, 6, NULL, 13, 0, 0, NULL, NULL),
(93, '604095', NULL, 18, 11, 0, 8, 6, NULL, 18, 0, 0, NULL, NULL),
(94, '605096', NULL, 18, 11, 0, 8, 6, NULL, 18, 0, 0, NULL, NULL),
(95, 'Taller1', NULL, 9, 11, 0, 0, NULL, NULL, 10, 0, 1, NULL, 1),
(96, '216032', NULL, 7, 1, 0, 10, 2, NULL, 7, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pc_ram`
--

CREATE TABLE `pc_ram` (
  `id_pc` int(11) NOT NULL,
  `id_ram` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pc_ram`
--

INSERT INTO `pc_ram` (`id_pc`, `id_ram`, `cantidad`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(5, 1, 2),
(6, 2, 1),
(7, 1, 2),
(8, 1, 1),
(9, 3, 1),
(10, 1, 1),
(11, 1, 2),
(12, 1, 1),
(13, 1, 2),
(14, 1, 1),
(15, 4, 2),
(16, 4, 2),
(17, 3, 1),
(18, 3, 1),
(19, 3, 1),
(20, 5, 4),
(21, 4, 2),
(22, 4, 2),
(23, 3, 1),
(24, 4, 2),
(25, 3, 1),
(26, 3, 1),
(27, 3, 1),
(28, 3, 1),
(29, 1, 2),
(30, 3, 1),
(31, 3, 1),
(32, 6, 1),
(33, 7, 0),
(34, 4, 1),
(35, 4, 2),
(36, 3, 1),
(37, 2, 1),
(38, 2, 1),
(39, 1, 1),
(40, 5, 4),
(41, 3, 1),
(42, 5, 4),
(43, 2, 1),
(44, 2, 1),
(45, 1, 2),
(46, 5, 4),
(47, 2, 1),
(48, 5, 4),
(49, 3, 1),
(50, 5, 4),
(51, 2, 1),
(52, 3, 1),
(53, 2, 1),
(54, 3, 1),
(55, 3, 1),
(56, 3, 1),
(57, 3, 1),
(58, 3, 1),
(59, 4, 1),
(60, 3, 1),
(61, 3, 1),
(62, 3, 1),
(63, 3, 1),
(64, 5, 1),
(65, 4, 1),
(66, 3, 1),
(67, 5, 1),
(68, 3, 1),
(69, 1, 2),
(70, 3, 1),
(71, 4, 1),
(72, 5, 2),
(73, 4, 1),
(74, 4, 1),
(75, 1, 2),
(76, 7, 4),
(77, 4, 2),
(78, 4, 2),
(79, 4, 2),
(80, 4, 2),
(81, 4, 2),
(82, 4, 2),
(83, 4, 2),
(84, 4, 2),
(85, 4, 2),
(86, 4, 2),
(87, 4, 2),
(88, 4, 2),
(89, 1, 1),
(90, 6, 1),
(91, 7, 4),
(92, 7, 1),
(93, 6, 1),
(94, 6, 1),
(33, 5, 0),
(33, 5, 4),
(95, 7, 2),
(96, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pc_so`
--

CREATE TABLE `pc_so` (
  `id_pc` int(11) NOT NULL,
  `id_so` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pc_so`
--

INSERT INTO `pc_so` (`id_pc`, `id_so`) VALUES
(1, 2),
(1, 1),
(2, 4),
(2, 1),
(3, 4),
(3, 1),
(4, 2),
(4, 1),
(5, 2),
(5, 1),
(6, 2),
(6, 1),
(7, 2),
(7, 1),
(8, 2),
(8, 1),
(9, 1),
(9, 2),
(10, 2),
(10, 1),
(11, 2),
(11, 1),
(12, 2),
(12, 1),
(13, 2),
(13, 1),
(14, 2),
(14, 1),
(15, 2),
(15, 1),
(16, 2),
(16, 1),
(17, 2),
(17, 1),
(18, 2),
(18, 1),
(19, 2),
(19, 1),
(20, 4),
(20, 1),
(21, 2),
(21, 1),
(22, 2),
(22, 1),
(23, 2),
(23, 1),
(24, 2),
(24, 1),
(25, 2),
(25, 1),
(26, 2),
(26, 1),
(27, 2),
(27, 1),
(28, 2),
(28, 1),
(29, 2),
(29, 1),
(30, 2),
(30, 1),
(31, 2),
(31, 1),
(32, 5),
(32, 1),
(33, 4),
(33, 1),
(34, 5),
(34, 3),
(35, 2),
(35, 1),
(36, 2),
(36, 1),
(37, 2),
(37, 1),
(38, 2),
(38, 1),
(39, 2),
(39, 1),
(40, 5),
(40, 1),
(41, 5),
(41, 3),
(42, 5),
(42, 1),
(43, 2),
(43, 1),
(44, 2),
(44, 1),
(45, 2),
(45, 1),
(46, 4),
(46, 1),
(47, 2),
(47, 1),
(48, 5),
(48, 1),
(49, 5),
(49, 3),
(50, 5),
(50, 1),
(51, 2),
(51, 1),
(52, 5),
(52, 3),
(53, 2),
(53, 3),
(54, 3),
(55, 5),
(55, 3),
(56, 5),
(56, 3),
(57, 5),
(57, 3),
(58, 5),
(58, 3),
(59, 2),
(59, 1),
(60, 2),
(60, 1),
(61, 5),
(61, 3),
(62, 5),
(62, 3),
(63, 5),
(63, 3),
(64, 2),
(64, 1),
(65, 5),
(65, 1),
(66, 5),
(66, 3),
(67, 2),
(67, 1),
(68, 5),
(68, 3),
(69, 2),
(69, 1),
(70, 5),
(70, 3),
(71, 2),
(71, 1),
(72, 2),
(72, 1),
(73, 2),
(73, 1),
(74, 2),
(74, 1),
(75, 2),
(75, 1),
(76, 5),
(76, 3),
(77, 2),
(77, 1),
(78, 2),
(78, 1),
(79, 1),
(79, 5),
(80, 1),
(80, 5),
(81, 1),
(81, 5),
(82, 1),
(82, 5),
(83, 1),
(83, 5),
(84, 1),
(84, 5),
(85, 1),
(85, 2),
(86, 1),
(86, 5),
(87, 1),
(87, 5),
(88, 1),
(88, 5),
(89, 3),
(89, 5),
(90, 1),
(91, 1),
(91, 5),
(92, 1),
(92, 6),
(93, 1),
(93, 6),
(94, 6),
(94, 1),
(95, 4),
(95, 1),
(96, 1),
(96, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesador`
--

CREATE TABLE `procesador` (
  `id` int(11) NOT NULL,
  `procesador_fabricante` varchar(20) NOT NULL,
  `procesador_modelo` varchar(50) NOT NULL,
  `frecuencia` float NOT NULL,
  `socket_comp` varchar(20) DEFAULT NULL,
  `cant_baja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `procesador`
--

INSERT INTO `procesador` (`id`, `procesador_fabricante`, `procesador_modelo`, `frecuencia`, `socket_comp`, `cant_baja`) VALUES
(1, 'AMD', 'Athlon II X2 255', 3.1, 'AM2+ AM3', 0),
(2, 'Intel', 'Celeron E1400', 2, '775', 0),
(3, 'Intel', 'Pentium Dual-Core E5700', 3, 'LGA775', 0),
(4, 'AMD', 'A8-5600K APU', 3.6, 'FM2', 0),
(5, 'AMD', 'Athlon II X2 245', 2.9, 'AM2+ AM3', 0),
(6, 'AMD', 'Athlon II X2 260', 3.2, 'AM3', 0),
(7, 'Intel', 'Pentium 4 630', 3, 'PLGA775', 0),
(8, 'AMD', 'Athlon II X2 250  ', 3, 'AM2+ AM3', 0),
(9, 'Intel', 'Pentium 4 512', 2.8, 'PPGA478', 0),
(10, 'AMD', 'Athlon 64 X2 Dual Core 4800+', 2.5, 'AM2', 0),
(11, 'AMD', 'Athlon 5150 APU', 1.6, 'AM1', 0),
(12, 'AMD', 'Athlon 64 X2 Dual Core 5000+', 2.6, 'AM2', 0),
(13, 'AMD', 'Athlon 64 3000+', 1.8, '754', 0),
(14, 'AMD', 'Athlon II X2 240', 2.8, 'AM2', 0),
(15, 'Intel', 'Pentium Dual-Core E5400', 2.7, 'LGA775', 0),
(16, 'AMD', 'Sempron 2650 APU', 1.44, '', 0),
(17, 'AMD', 'Athlon 64 3500+', 2.2, NULL, 0),
(18, 'AMD', 'Athlon XP 2000+', 1.66, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `tamanio_mb` int(11) NOT NULL,
  `ram_fabricante` varchar(30) DEFAULT NULL,
  `cant_baja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ram`
--

INSERT INTO `ram` (`id`, `tipo`, `tamanio_mb`, `ram_fabricante`, `cant_baja`) VALUES
(1, 'DDR3', 2048, '', 0),
(2, 'DDR2', 1024, '', 0),
(3, 'DDR3', 4096, '', 0),
(4, 'DDR2', 2048, '', 0),
(5, 'DDR', 512, '', 0),
(6, 'DDR', 1024, '', 0),
(7, 'DDR2', 512, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `so`
--

CREATE TABLE `so` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `version` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `so`
--

INSERT INTO `so` (`id`, `nombre`, `version`) VALUES
(1, 'Windows', 'XP'),
(2, 'Ubuntu', '12.04'),
(3, 'Windows', '7'),
(4, 'Lubuntu', '14.04'),
(5, 'Ubuntu', '14.04'),
(6, 'MS-DOS', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `id_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `id_nivel`) VALUES
(1, 'admin', '1234', 1),
(2, 'invitado', '123', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `disco`
--
ALTER TABLE `disco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fuente`
--
ALTER TABLE `fuente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidente`
--
ALTER TABLE `incidente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_incid_pc` (`id_pc`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_numero`);

--
-- Indices de la tabla `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mother`
--
ALTER TABLE `mother`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivel_us`
--
ALTER TABLE `nivel_us`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pc_idmother` (`id_mother`),
  ADD KEY `FK_pc_iddisco` (`id_disco`),
  ADD KEY `FK_pc_idfuente` (`id_fuente`),
  ADD KEY `FK_pc_idmonitor` (`id_monitor`),
  ADD KEY `FK_pc_idlaboratorio` (`id_laboratorio`),
  ADD KEY `FK_pc_idoficina` (`id_oficina`),
  ADD KEY `FK_pc_idprocesador` (`id_procesador`);

--
-- Indices de la tabla `pc_ram`
--
ALTER TABLE `pc_ram`
  ADD KEY `FK_id_pc` (`id_pc`),
  ADD KEY `FK_id_ram` (`id_ram`);

--
-- Indices de la tabla `pc_so`
--
ALTER TABLE `pc_so`
  ADD KEY `FK_id_so` (`id_so`),
  ADD KEY `FK_id_pc` (`id_pc`);

--
-- Indices de la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `so`
--
ALTER TABLE `so`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nivel_usuario` (`id_nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `disco`
--
ALTER TABLE `disco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `fuente`
--
ALTER TABLE `fuente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `incidente`
--
ALTER TABLE `incidente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `mother`
--
ALTER TABLE `mother`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT de la tabla `procesador`
--
ALTER TABLE `procesador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `so`
--
ALTER TABLE `so`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `incidente`
--
ALTER TABLE `incidente`
  ADD CONSTRAINT `FK_incid_pc` FOREIGN KEY (`id_pc`) REFERENCES `pc` (`id`);

--
-- Filtros para la tabla `pc`
--
ALTER TABLE `pc`
  ADD CONSTRAINT `FK_pc_iddisco` FOREIGN KEY (`id_disco`) REFERENCES `disco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pc_idfuente` FOREIGN KEY (`id_fuente`) REFERENCES `fuente` (`id`),
  ADD CONSTRAINT `FK_pc_idlaboratorio` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_numero`),
  ADD CONSTRAINT `FK_pc_idmonitor` FOREIGN KEY (`id_monitor`) REFERENCES `monitor` (`id`),
  ADD CONSTRAINT `FK_pc_idmother` FOREIGN KEY (`id_mother`) REFERENCES `mother` (`id`),
  ADD CONSTRAINT `FK_pc_idoficina` FOREIGN KEY (`id_oficina`) REFERENCES `oficina` (`id`),
  ADD CONSTRAINT `FK_pc_idprocesador` FOREIGN KEY (`id_procesador`) REFERENCES `procesador` (`id`);

--
-- Filtros para la tabla `pc_ram`
--
ALTER TABLE `pc_ram`
  ADD CONSTRAINT `FK_id_pc` FOREIGN KEY (`id_pc`) REFERENCES `pc` (`id`),
  ADD CONSTRAINT `FK_id_ram` FOREIGN KEY (`id_ram`) REFERENCES `ram` (`id`);

--
-- Filtros para la tabla `pc_so`
--
ALTER TABLE `pc_so`
  ADD CONSTRAINT `FK_idpc` FOREIGN KEY (`id_pc`) REFERENCES `pc` (`id`),
  ADD CONSTRAINT `FK_idso` FOREIGN KEY (`id_so`) REFERENCES `so` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `nivel_usuario` FOREIGN KEY (`id_nivel`) REFERENCES `nivel_us` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
