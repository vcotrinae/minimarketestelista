-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-02-2026 a las 05:36:56
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `minimarketestelista`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `cat_id` int NOT NULL,
  `cat_categoria` varchar(200) DEFAULT NULL,
  `cat_fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cat_fecha_update` datetime DEFAULT NULL,
  `cat_fecha_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_id`, `cat_categoria`, `cat_fecha_create`, `cat_fecha_update`, `cat_fecha_delete`) VALUES
(1, 'Gaseosas', '2024-12-04 22:05:05', NULL, NULL),
(2, 'Bebidas', '2024-12-04 22:16:33', '2023-12-01 10:00:00', NULL),
(3, 'Snacks', '2024-12-04 22:16:33', '2023-12-02 14:45:00', NULL),
(4, 'Abarrotes', '2024-12-04 22:16:33', '2023-12-03 09:30:00', NULL),
(5, 'Láctu', '2024-12-11 12:18:58', '2023-12-04 08:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cli_id` int NOT NULL,
  `cli_nombre` varchar(200) DEFAULT NULL,
  `cli_documento` int DEFAULT NULL,
  `cli_email` varchar(200) DEFAULT NULL,
  `cli_telefono` varchar(20) DEFAULT NULL,
  `cli_direccion` varchar(200) DEFAULT NULL,
  `cli_fecha_nacimiento` date DEFAULT NULL,
  `cli_compras` int DEFAULT NULL,
  `cli_ultima_compra` datetime DEFAULT NULL,
  `cli_fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cli_fecha_update` datetime DEFAULT NULL,
  `cli_fecha_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_id`, `cli_nombre`, `cli_documento`, `cli_email`, `cli_telefono`, `cli_direccion`, `cli_fecha_nacimiento`, `cli_compras`, `cli_ultima_compra`, `cli_fecha_create`, `cli_fecha_update`, `cli_fecha_delete`) VALUES
(3, 'Juan Rodriguez', 2147483647, 'juan@hotmail.com', '(51) 946-515-190', 'Calle 23 # 45 - 56', '1980-10-29', 33, '2024-12-11 01:05:38', '2025-10-20 03:18:30', '2024-11-25 01:10:46', NULL),
(4, 'Pedro Pérez', 2147483647, 'pedro@gmail.com', '(399) 876-5432', 'Calle 34 N33 -56', '1970-08-07', 22, '2025-10-20 01:09:34', '2025-10-20 06:09:34', NULL, NULL),
(5, 'Miguel Murillo', 325235235, 'miguel@hotmail.com', '(254) 545-3446', 'calle 34 # 34 - 23', '1976-03-04', 42, '2024-12-11 01:11:17', '2024-12-11 06:11:17', NULL, NULL),
(6, 'Margarita Londoño', 34565432, 'margarita@hotmail.com', '(344) 345-6678', 'Calle 45 # 34 - 56', '1976-11-30', 15, '2024-12-12 22:39:12', '2024-12-13 03:39:12', NULL, NULL),
(7, 'Julian Ramirez', 786786545, 'julian@hotmail.com', '(675) 674-5453', 'Carrera 45 # 54 - 56', '1980-04-05', 3, '2024-12-10 15:05:28', '2024-12-10 20:05:28', NULL, NULL),
(8, 'Stella Jaramillo', 65756735, 'stella@gmail.com', '(435) 346-3463', 'Carrera 34 # 45- 56', '1956-06-05', 33, '2024-12-10 12:28:04', '2024-12-10 17:28:04', NULL, NULL),
(9, 'Eduardo López', 2147483647, 'eduardo@gmail.com', '(534) 634-6565', 'Carrera 67 # 45sur', '1978-03-04', 17, '2024-12-10 17:14:46', '2024-12-10 22:14:46', NULL, NULL),
(10, 'Ximena Restrepo', 436346346, 'ximena@gmail.com', '(543) 463-4634', 'calle 45 # 23 - 45', '1956-03-04', NULL, NULL, '2024-12-07 04:42:31', NULL, NULL),
(11, 'David Guzman', 43634643, 'david@hotmail.com', '(354) 574-5634', 'carrera 45 # 45 ', '1967-05-04', NULL, NULL, '2024-12-07 04:42:37', NULL, NULL),
(12, 'Gonzalo Pérez', 436346346, 'gonzalo@yahoo.com', '(235) 346-3464', 'Carrera 34 # 56 - 34', '1967-08-09', 13, '2024-12-11 01:12:13', '2024-12-11 06:12:13', NULL, NULL),
(15, 'Carlos Moran', 98765412, 'carlosmoran@GMAIL.COM', '(51) 946-515-190', 'AV. LOS CHANCAS 524', '2000-02-02', 3, '2024-12-08 19:32:56', '2024-12-09 00:32:56', '2024-12-07 23:27:40', NULL),
(16, 'PEPE LUNA 2', 98765412, 'cotrina@gmail.com', '(51) 946-515-190', 'av. las palmera 352', '2020-01-28', NULL, NULL, '2024-12-07 04:43:11', NULL, NULL),
(17, 'VICTOR RAMRIO COTRINA', 98765412, 'cotrina@gmail.com', '(51) 946-515-190', 'Av. La Marina 152', '2020-01-28', NULL, NULL, '2024-12-07 04:43:04', NULL, NULL),
(18, 'Andrea', 1208, 'Andrea@gmail.com', '(51) 988-491-121', 'Avenida Lima 502', '2008-02-20', 1, '2025-10-20 03:17:56', '2025-10-20 03:18:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pro_id` int NOT NULL,
  `pro_id_categoria` int DEFAULT NULL,
  `pro_id_proveedor` int DEFAULT NULL,
  `pro_codigo` varchar(200) DEFAULT NULL,
  `pro_descripcion` varchar(200) DEFAULT NULL,
  `pro_imagen` text,
  `pro_stock` int DEFAULT NULL,
  `pro_precio_compra` float DEFAULT NULL,
  `pro_precio_venta` float DEFAULT NULL,
  `pro_ventas` int DEFAULT NULL,
  `pro_fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pro_fecha_update` datetime DEFAULT NULL,
  `pro_fecha_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`pro_id`, `pro_id_categoria`, `pro_id_proveedor`, `pro_codigo`, `pro_descripcion`, `pro_imagen`, `pro_stock`, `pro_precio_compra`, `pro_precio_venta`, `pro_ventas`, `pro_fecha_create`, `pro_fecha_update`, `pro_fecha_delete`) VALUES
(1, 1, 1, 'PROD-1001', 'Coca Cola 500ml', 'vistas/img/productos/PROD-1001/303.png', 90, 3, 4.2, 10, '2024-12-10 20:37:47', NULL, NULL),
(2, 1, 1, 'PROD-1002', 'Pack 4 Inca Kola x 1 Lt', 'vistas/img/productos/PROD-1002/170.png', 17, 11, 15.4, 3, '2024-12-10 20:07:33', NULL, NULL),
(3, 5, 4, 'PROD-5001', 'Leche Reconstituida Enriquecida GLORIA Azul Lata 390g', 'vistas/img/productos/PROD-5001/961.png', 180, 3.8, 5.32, 20, '2024-12-10 20:07:33', NULL, NULL),
(4, 5, 4, 'PROD-5002', 'LECHE UHT GLORIA NIÑOS CAJA 1L', 'vistas/img/productos/PROD-5002/526.png', 100, 6.2, 8.68, NULL, '2024-12-07 05:29:07', NULL, NULL),
(5, 5, 3, 'PROD-5003', ' Gloria  Leche Fresca GLORIA UHT Entera Bolsa 900ml ', 'vistas/img/productos/PROD-5003/163.jpg', 60, 4.7, 6.58, NULL, '2024-12-07 05:37:55', NULL, NULL),
(6, 4, 4, 'PROD-4001', 'Lenteja Bebé VALLENORTE Bolsa 500 gr', 'vistas/img/productos/PROD-4001/670.jpg', 40, 5.5, 7.7, 5, '2024-12-10 20:38:45', NULL, NULL),
(7, 4, 4, 'PROD-4002', 'Arroz Gran Reserva Extra VALLENORTE Bolsa 750g', 'vistas/img/productos/PROD-4002/896.png', 60, 4.6, 6.44, NULL, '2024-12-07 05:45:41', NULL, NULL),
(8, 4, 4, 'PROD-4003', 'Arroz Gran Reserva Extra VALLENORTE Bolsa 5kg', 'vistas/img/productos/PROD-4003/399.png', 35, 26.5, 37.1, NULL, '2024-12-07 05:48:40', NULL, NULL),
(9, 4, 4, 'PROD-4004', 'Mayonesa ALACENA Sachet 95gr', 'vistas/img/productos/PROD-4004/650.png', 58, 3.12, 4.368, 2, '2024-12-08 04:29:02', NULL, NULL),
(10, 4, 4, 'PROD-4005', 'Mayonesa ALACENA Doypack 190g', 'vistas/img/productos/PROD-4005/732.png', 75, 7, 11.2, 5, '2024-12-10 22:14:46', NULL, NULL),
(11, 4, 4, 'PROD-4006', 'Crema de Ají TARI Sachet 85g', 'vistas/img/productos/PROD-4006/503.png', 100, 3.5, 4.9, NULL, '2024-12-07 05:53:11', NULL, NULL),
(12, 4, 4, 'PROD-4007', 'Arveja Verde VALLENORTE Bolsa 500 gr', 'vistas/img/productos/PROD-4007/833.jpg', 60, 3.9, 5.46, NULL, '2024-12-07 05:57:13', NULL, NULL),
(13, 4, 4, 'PROD-4008', 'Maíz Pop Corn VALLENORTE Bolsa 500g', 'vistas/img/productos/PROD-4008/646.jpg', 50, 4.1, 5.74, NULL, '2024-12-07 05:58:45', NULL, NULL),
(14, 4, 4, 'PROD-4009', 'Quinua VALLENORTE Bolsa 500g', 'vistas/img/productos/PROD-4009/612.jpg', 45, 7.9, 11.06, NULL, '2024-12-07 06:01:25', NULL, NULL),
(15, 4, 4, 'PROD-4010', 'Trigo Mote VALLENORTE Bolsa 500 gr', 'vistas/img/productos/PROD-4010/752.jpg', 25, 4, 5.6, NULL, '2024-12-07 06:03:13', NULL, NULL),
(16, 4, 4, 'PROD-4011', 'Frejol Canario VALLENORTE Bolsa 500g', 'vistas/img/productos/PROD-4011/630.jpg', 15, 6.5, 9.1, NULL, '2024-12-07 06:05:24', NULL, NULL),
(17, 4, 4, 'PROD-4012', 'Vinagre Blanco DEL FIRME Botella 500 ml', 'vistas/img/productos/PROD-4012/354.jpg', 25, 2.5, 3.5, NULL, '2024-12-07 06:06:54', NULL, NULL),
(18, 4, 4, 'PROD-4013', 'Ajos Molido SIBARITA Doypack 550 g', 'vistas/img/productos/PROD-4013/962.jpg', 14, 14, 19.6, NULL, '2024-12-07 06:08:44', NULL, NULL),
(19, 4, 4, 'PROD-4014', 'Amarillin SIBARITA Doypack 100 gr', 'vistas/img/productos/PROD-4014/312.png', 43, 1.58, 2.212, 5, '2025-10-15 03:01:52', NULL, NULL),
(20, 4, 4, 'PROD-4015', 'Amarillin SIBARITA Doypack 550gr', 'vistas/img/productos/PROD-4015/473.png', 10, 14, 19.6, NULL, '2024-12-07 06:13:40', NULL, NULL),
(21, 4, 4, 'PROD-4016', 'Panquita SIBARITA Doypack 550g', 'vistas/img/productos/PROD-4016/290.png', 8, 12, 16.8, NULL, '2024-12-07 06:14:49', NULL, NULL),
(22, 4, 4, 'PROD-4017', 'Culantrito SIBARITA con Espinaca 550g', 'vistas/img/productos/PROD-4017/486.png', 5, 12, 16.8, NULL, '2024-12-07 06:15:44', NULL, NULL),
(23, 4, 4, 'PROD-4018', 'Duraznos en Mitades ACONCAGUA en Almíbar Lata 820g', 'vistas/img/productos/PROD-4018/106.jpg', 19, 10.75, 15.05, NULL, '2024-12-07 06:16:46', NULL, NULL),
(24, 4, 4, 'PROD-4019', 'Aceite Vegetal Cocinero Botella 900ml', 'vistas/img/productos/PROD-4019/272.png', 50, 8.8, 12.32, NULL, '2024-12-07 06:18:45', NULL, NULL),
(25, 4, 4, 'PROD-4020', 'Salsa a la Bolognesa con Tomate y Carne Pomarola MOLITALIA Doypack 370g', 'vistas/img/productos/PROD-4020/618.png', 24, 5.2, 7.28, NULL, '2024-12-07 06:20:31', NULL, NULL),
(26, 4, 4, 'PROD-4021', 'Fideos Linguini Grosso DON VICTORIO Bolsa 450G', 'vistas/img/productos/PROD-4021/861.png', 60, 3.25, 4.55, NULL, '2024-12-07 06:22:47', NULL, NULL),
(27, 4, 4, 'PROD-4022', 'Fideos Tornillo MARCO POLO bolsa 235g', 'vistas/img/productos/PROD-4022/522.png', 55, 1.13, 1.582, 5, '2024-12-10 17:28:04', NULL, NULL),
(28, 4, 4, 'PROD-4023', 'ACEITUNAS OLIVOS DEL SUR DOYPACK 250G', 'vistas/img/productos/PROD-4023/576.png', 15, 5.5, 7.7, 5, '2024-12-10 17:28:04', NULL, NULL),
(29, 4, 4, 'PROD-4024', 'ARROZ EXTRA CAMPERO BOLSA 5KG', 'vistas/img/productos/PROD-4024/742.png', 10, 25, 35, NULL, '2024-12-07 06:30:33', NULL, NULL),
(30, 4, 4, 'PROD-4025', 'COMINO SIBARITA SOBRE X 10GR', 'vistas/img/productos/PROD-4025/684.png', 100, 0.9, 1.26, NULL, '2024-12-07 06:34:30', NULL, NULL),
(31, 4, 4, 'PROD-4026', 'PIMIENTA MOLIDA SIBARITA SOBRE X 10GR', 'vistas/img/productos/PROD-4026/979.png', 50, 0.9, 1.26, NULL, '2024-12-07 06:37:02', NULL, NULL),
(32, 4, 4, 'PROD-4027', 'Filete de Atún en Aceite Vegetal FLORIDA Lata 140g', 'vistas/img/productos/PROD-4027/236.png', 35, 6, 6.6, NULL, '2024-12-07 06:38:59', NULL, NULL),
(33, 4, 4, 'PROD-4028', 'Filete de Atún en Agua FLORIDA Lata 140g', 'vistas/img/productos/PROD-4028/734.png', 48, 5.5, 5.61, NULL, '2024-12-07 06:40:30', NULL, NULL),
(34, 4, 4, 'PROD-4029', 'Aceite Vegetal PALMA REAL Botella 900ml', 'vistas/img/productos/PROD-4029/617.png', 20, 6.5, 9.1, 10, '2024-12-10 20:05:28', NULL, NULL),
(35, 4, 4, 'PROD-4030', 'Aceite Vegetal PRIMOR Botella 900ml', 'vistas/img/productos/PROD-4030/833.png', 45, 10.5, 14.7, 3, '2024-12-10 17:27:15', NULL, NULL),
(36, 4, 4, 'PROD-4031', 'Aceite Vegetal PRIMOR PREMIUM Botella 900ML', 'vistas/img/productos/PROD-4031/190.png', 35, 11.5, 16.1, 13, '2024-12-08 04:29:02', NULL, NULL),
(37, 4, 4, 'PROD-4032', 'Aceite Vegetal PALMA REAL Galonera 2L', 'vistas/img/productos/PROD-4032/791.png', 3, 13.66, 19.124, 5, '2024-12-13 03:39:12', NULL, NULL),
(38, 4, 4, 'PROD-4033', 'Arroz Superior PAISANA Bolsa 5Kg', 'vistas/img/productos/PROD-4033/833.png', 4, 24, 33.6, 1, '2024-12-11 06:11:17', NULL, NULL),
(39, 3, 4, 'PROD-3001', 'Papas PRINGLES sabor original lata 104 gr', 'vistas/img/productos/PROD-3001/759.png', 17, 10, 14, 3, '2025-10-20 06:09:34', NULL, NULL),
(40, 3, 4, 'PROD-3002', 'Palitos de Maíz CHIZITOS Queso Bolsa 16g', 'vistas/img/productos/PROD-3002/292.png', 11, 0.5, 0.7, 14, '2024-12-13 03:39:12', NULL, NULL),
(41, 3, 4, 'PROD-3003', 'Palitos de Maiz CHEESE TRIS Queso Bolsa 16g', 'vistas/img/productos/PROD-3003/437.png', 28, 0.6, 0.84, 33, '2025-10-20 03:17:56', NULL, NULL),
(42, 3, 4, 'PROD-3004', 'Nachos de Maíz LOS CUATES Picante Bolsa 26g', 'vistas/img/productos/PROD-3004/467.png', 0, 0.5, 0.7, 20, '2024-12-13 03:39:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `prove_id` int NOT NULL,
  `prove_ruc` varchar(20) DEFAULT NULL,
  `prove_razon_social` varchar(200) DEFAULT NULL,
  `prove_nombre_comercial` varchar(200) DEFAULT NULL,
  `prove_email` varchar(200) DEFAULT NULL,
  `prove_telefono` varchar(20) DEFAULT NULL,
  `prove_direccion` varchar(200) DEFAULT NULL,
  `prove_fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prove_fecha_update` datetime DEFAULT NULL,
  `prove_fecha_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`prove_id`, `prove_ruc`, `prove_razon_social`, `prove_nombre_comercial`, `prove_email`, `prove_telefono`, `prove_direccion`, `prove_fecha_create`, `prove_fecha_update`, `prove_fecha_delete`) VALUES
(1, '20265428399', 'DISTRIBUIDORA KATITA EIRL', 'DISTRIBUIDORA KATITA', 'compras@distribuidorakatita.com', '969005500', 'Calle Francisco Moreno 1017  Ex Santa Rosa -Surquillo – Lima', '2024-12-07 04:58:02', '2023-12-01 12:00:00', NULL),
(2, '20601043557', 'PROLIDER EMPRESARIAL S.A.C.', 'PROLIDER EMPRESARIAL', 'ventas@prolider.pe', '922139093', 'Calle Bateria Independencia 275 Urb. Santa Catalina La Victoria - Lima - Lima', '2024-12-07 05:08:53', '2023-12-02 15:30:00', NULL),
(3, '20502257987', 'CORPORACION VEGA S.A.C.', 'VEGA', 'atencionalcliente@corporacionvega.pe', '934567890', 'Av. Javier Prado Este Nro. 1372', '2024-12-07 05:14:13', '2023-12-03 10:00:00', NULL),
(4, '20606493739', 'ALMACENES MAK S.A.C.', 'ALMACENES MAK', 'ventas.amak@gmail.com', '(51) 995-916-179', 'Mz Y-1 Lote 12 Urb. El Alamo de Vipol II Etapa. Comas, Lima, Lima , Perú', '2024-12-07 05:20:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int NOT NULL,
  `usu_nombre` varchar(100) DEFAULT NULL,
  `usu_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `usu_usuario` varchar(50) DEFAULT NULL,
  `usu_password` varchar(255) DEFAULT NULL,
  `usu_perfil` varchar(50) DEFAULT NULL,
  `usu_foto` text,
  `usu_estado` int DEFAULT NULL,
  `usu_ultimo_login` datetime DEFAULT NULL,
  `usu_fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usu_fecha_update` datetime DEFAULT NULL,
  `usu_fecha_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nombre`, `usu_email`, `usu_usuario`, `usu_password`, `usu_perfil`, `usu_foto`, `usu_estado`, `usu_ultimo_login`, `usu_fecha_create`, `usu_fecha_update`, `usu_fecha_delete`) VALUES
(1, 'Usuario Administrado', 'admin@gmail.com', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/994.png', 1, '2026-02-20 22:53:47', '2026-02-21 03:53:47', NULL, NULL),
(2, 'Victor Cotrina Enrique', '', 'vcotrina', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Especial', 'vistas/img/usuarios/vcotrina/143.png', 1, '2025-01-15 16:30:17', '2025-10-21 04:46:27', NULL, NULL),
(3, 'Ramiro Cotrina Enrique', '', 'rcotrina', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Vendedor', 'vistas/img/usuarios/rcotrina/410.png', 1, '2025-01-15 16:30:58', '2025-10-21 04:46:33', NULL, NULL),
(4, 'Lizandro Enrique Zuñiga Lorenzo', '', 'lzuniga', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Vendedor', '', 0, '2024-12-07 19:34:34', '2025-10-21 04:46:43', NULL, NULL),
(5, 'John Pablo Cajamarca Nájera', '', 'jcajamarca', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Vendedor', '', 0, '2024-12-10 15:19:34', '2025-10-21 04:46:48', NULL, NULL),
(6, 'Maria Avila', 'mavila@vcodesystems.com', 'mavila', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'Administrador', '', NULL, NULL, '2026-02-21 05:35:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ven_id` int NOT NULL,
  `ven_codigo` int DEFAULT NULL,
  `ven_id_cliente` int DEFAULT NULL,
  `ven_id_vendedor` int DEFAULT NULL,
  `ven_productos` text,
  `ven_impuesto` float DEFAULT NULL,
  `ven_neto` float DEFAULT NULL,
  `ven_total` float DEFAULT NULL,
  `ven_metodo_pago` varchar(200) DEFAULT NULL,
  `ven_fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ven_fecha_update` datetime DEFAULT NULL,
  `ven_fecha_delete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ven_id`, `ven_codigo`, `ven_id_cliente`, `ven_id_vendedor`, `ven_productos`, `ven_impuesto`, `ven_neto`, `ven_total`, `ven_metodo_pago`, `ven_fecha_create`, `ven_fecha_update`, `ven_fecha_delete`) VALUES
(1, 10001, 3, 1, '[{\"json_pro_id\":\"41\",\"json_pro_descripcion\":\"Palitos de Maiz CHEESE TRIS Queso Bolsa 16g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"50\",\"json_pro_precio\":\"0.84\",\"json_pro_total\":\"8.4\"},{\"json_pro_id\":\"36\",\"json_pro_descripcion\":\"Aceite Vegetal PRIMOR PREMIUM Botella 900ML\",\"json_pro_cantidad\":\"8\",\"json_pro_stock\":\"40\",\"json_pro_precio\":\"16.1\",\"json_pro_total\":\"128.8\"}]', 24.696, 137.2, 161.896, 'T-C-589264', '2024-10-02 07:05:57', NULL, NULL),
(2, 10002, 5, 3, '[{\"json_pro_id\":\"3\",\"json_pro_descripcion\":\"Leche Reconstituida Enriquecida GLORIA Azul Lata 390g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"190\",\"json_pro_precio\":\"5.32\",\"json_pro_total\":\"53.2\"},{\"json_pro_id\":\"1\",\"json_pro_descripcion\":\"Coca Cola 500ml\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"99\",\"json_pro_precio\":\"4.2\",\"json_pro_total\":\"4.2\"}]', 10.332, 57.4, 67.732, 'Efectivo', '2024-10-10 07:25:40', NULL, NULL),
(3, 10003, 5, 3, '[{\"json_pro_id\":\"43\",\"json_pro_descripcion\":\"Palitos de Maiz CHIZITOS Queso Bolsa 40g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"25\",\"json_pro_precio\":\"1.4\",\"json_pro_total\":\"14\"}]', 2.52, 14, 16.52, 'Efectivo', '2024-10-12 13:21:06', NULL, NULL),
(4, 10004, 8, 4, '[{\"json_pro_id\":\"41\",\"json_pro_descripcion\":\"Palitos de Maiz CHEESE TRIS Queso Bolsa 16g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"40\",\"json_pro_precio\":\"0.84\",\"json_pro_total\":\"8.4\"},{\"json_pro_id\":\"42\",\"json_pro_descripcion\":\"Nachos de Maíz LOS CUATES Picante Bolsa 26g\",\"json_pro_cantidad\":\"7\",\"json_pro_stock\":\"13\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"4.9\"},{\"json_pro_id\":\"40\",\"json_pro_descripcion\":\"Palitos de Maíz CHIZITOS Queso Bolsa 16g\",\"json_pro_cantidad\":\"6\",\"json_pro_stock\":\"19\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"4.2\"}]', 3.15, 17.5, 20.65, 'Efectivo', '2024-10-15 00:37:53', NULL, NULL),
(5, 10005, 5, 3, '[{\"json_pro_id\":\"36\",\"json_pro_descripcion\":\"Aceite Vegetal PRIMOR PREMIUM Botella 900ML\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"35\",\"json_pro_precio\":\"16.1\",\"json_pro_total\":\"80.5\"},{\"json_pro_id\":\"34\",\"json_pro_descripcion\":\"Aceite Vegetal PALMA REAL Botella 900ml\",\"json_pro_cantidad\":\"6\",\"json_pro_stock\":\"24\",\"json_pro_precio\":\"9.1\",\"json_pro_total\":\"54.6\"},{\"json_pro_id\":\"9\",\"json_pro_descripcion\":\"Mayonesa ALACENA Sachet 95gr\",\"json_pro_cantidad\":\"2\",\"json_pro_stock\":\"58\",\"json_pro_precio\":\"4.368\",\"json_pro_total\":\"8.74\"}]', 25.8912, 143.84, 169.731, 'T-C-5421456', '2024-11-04 04:29:02', NULL, NULL),
(6, 10006, 15, 3, '[{\"json_pro_id\":\"40\",\"json_pro_descripcion\":\"Palitos de Maíz CHIZITOS Queso Bolsa 16g\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"18\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"0.7\"},{\"json_pro_id\":\"34\",\"json_pro_descripcion\":\"Aceite Vegetal PALMA REAL Botella 900ml\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"23\",\"json_pro_precio\":\"9.1\",\"json_pro_total\":\"9.1\"},{\"json_pro_id\":\"2\",\"json_pro_descripcion\":\"Pack 4 Inca Kola x 1 Lt\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"19\",\"json_pro_precio\":\"15.4\",\"json_pro_total\":\"15.4\"}]', 4.536, 25.2, 29.736, 'Efectivo', '2024-11-07 00:32:56', NULL, NULL),
(7, 10007, 4, 3, '[{\"json_pro_id\":\"43\",\"json_pro_descripcion\":\"Palitos de Maiz CHIZITOS Queso Bolsa 40g\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"20\",\"json_pro_precio\":\"1.4\",\"json_pro_total\":\"7\"},{\"json_pro_id\":\"37\",\"json_pro_descripcion\":\"Aceite Vegetal PALMA REAL Galonera 2L\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"7\",\"json_pro_precio\":\"19.124\",\"json_pro_total\":\"19.124\"}]', 4.70232, 26.124, 30.8263, 'T-C-7895462', '2024-11-15 17:22:59', NULL, NULL),
(8, 10008, 6, 3, '[{\"json_pro_id\":\"35\",\"json_pro_descripcion\":\"Aceite Vegetal PRIMOR Botella 900ml\",\"json_pro_cantidad\":\"3\",\"json_pro_stock\":\"45\",\"json_pro_precio\":\"14.7\",\"json_pro_total\":\"44.1\"}]', 7.938, 44.1, 52.038, 'Efectivo', '2024-12-10 17:27:15', NULL, NULL),
(9, 10009, 8, 3, '[{\"json_pro_id\":\"27\",\"json_pro_descripcion\":\"Fideos Tornillo MARCO POLO bolsa 235g\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"55\",\"json_pro_precio\":\"1.582\",\"json_pro_total\":\"7.91\"},{\"json_pro_id\":\"28\",\"json_pro_descripcion\":\"ACEITUNAS OLIVOS DEL SUR DOYPACK 250G\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"15\",\"json_pro_precio\":\"7.7\",\"json_pro_total\":\"38.5\"}]', 8.3538, 46.41, 54.7638, 'Efectivo', '2024-12-10 17:28:04', NULL, NULL),
(10, 10010, 7, 3, '[{\"json_pro_id\":\"34\",\"json_pro_descripcion\":\"Aceite Vegetal PALMA REAL Botella 900ml\",\"json_pro_cantidad\":\"3\",\"json_pro_stock\":\"20\",\"json_pro_precio\":\"9.1\",\"json_pro_total\":\"27.3\"}]', 4.914, 27.3, 32.214, 'Efectivo', '2024-12-10 20:05:28', NULL, NULL),
(11, 10011, 9, 5, '[{\"json_pro_id\":\"3\",\"json_pro_descripcion\":\"Leche Reconstituida Enriquecida GLORIA Azul Lata 390g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"180\",\"json_pro_precio\":\"5.32\",\"json_pro_total\":\"53.2\"},{\"json_pro_id\":\"2\",\"json_pro_descripcion\":\"Pack 4 Inca Kola x 1 Lt\",\"json_pro_cantidad\":\"2\",\"json_pro_stock\":\"17\",\"json_pro_precio\":\"15.4\",\"json_pro_total\":\"30.8\"}]', 15.12, 84, 99.12, 'Efectivo', '2024-12-10 20:07:33', NULL, NULL),
(12, 10012, 3, 5, '[{\"json_pro_id\":\"1\",\"json_pro_descripcion\":\"Coca Cola 500ml\",\"json_pro_cantidad\":\"9\",\"json_pro_stock\":\"90\",\"json_pro_precio\":\"4.2\",\"json_pro_total\":\"37.8\"}]', 6.804, 37.8, 44.604, 'Efectivo', '2024-12-10 20:37:47', NULL, NULL),
(13, 10013, 5, 5, '[{\"json_pro_id\":\"6\",\"json_pro_descripcion\":\"Lenteja Bebé VALLENORTE Bolsa 500 gr\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"40\",\"json_pro_precio\":\"7.7\",\"json_pro_total\":\"38.5\"}]', 6.93, 38.5, 45.43, 'Efectivo', '2024-12-10 20:38:45', NULL, NULL),
(14, 10014, 9, 3, '[{\"json_pro_id\":\"10\",\"json_pro_descripcion\":\"Mayonesa ALACENA Doypack 190g\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"75\",\"json_pro_precio\":\"11.2\",\"json_pro_total\":\"56\"}]', 10.08, 56, 66.08, 'Efectivo', '2024-12-10 22:14:46', NULL, NULL),
(15, 10015, 3, 1, '[{\"json_pro_id\":\"43\",\"json_pro_descripcion\":\"Palitos de Maiz CHIZITOS Queso Bolsa 40g\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"15\",\"json_pro_precio\":\"1.4\",\"json_pro_total\":\"7\"},{\"json_pro_id\":\"39\",\"json_pro_descripcion\":\"Papas PRINGLES sabor original lata 104 gr\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"19\",\"json_pro_precio\":\"14\",\"json_pro_total\":\"14\"}]', 3.78, 21, 24.78, 'Efectivo', '2024-12-11 01:05:38', NULL, NULL),
(16, 10016, 5, 1, '[{\"json_pro_id\":\"40\",\"json_pro_descripcion\":\"Palitos de Maíz CHIZITOS Queso Bolsa 16g\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"17\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"0.7\"},{\"json_pro_id\":\"39\",\"json_pro_descripcion\":\"Papas PRINGLES sabor original lata 104 gr\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"18\",\"json_pro_precio\":\"14\",\"json_pro_total\":\"14\"},{\"json_pro_id\":\"38\",\"json_pro_descripcion\":\"Arroz Superior PAISANA Bolsa 5Kg\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"4\",\"json_pro_precio\":\"33.6\",\"json_pro_total\":\"33.6\"}]', 8.694, 48.3, 56.994, 'Efectivo', '2024-12-11 06:11:17', NULL, NULL),
(17, 10017, 12, 1, '[{\"json_pro_id\":\"42\",\"json_pro_descripcion\":\"Nachos de Maíz LOS CUATES Picante Bolsa 26g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"3\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"7\"},{\"json_pro_id\":\"41\",\"json_pro_descripcion\":\"Palitos de Maiz CHEESE TRIS Queso Bolsa 16g\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"39\",\"json_pro_precio\":\"0.84\",\"json_pro_total\":\"0.84\"},{\"json_pro_id\":\"40\",\"json_pro_descripcion\":\"Palitos de Maíz CHIZITOS Queso Bolsa 16g\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"16\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"0.7\"},{\"json_pro_id\":\"41\",\"json_pro_descripcion\":\"Palitos de Maiz CHEESE TRIS Queso Bolsa 16g\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"39\",\"json_pro_precio\":\"0.84\",\"json_pro_total\":\"0.84\"}]', 1.6884, 9.38, 11.0684, 'Efectivo', '2024-12-11 06:12:13', NULL, NULL),
(18, 10018, 6, 1, '[{\"json_pro_id\":\"42\",\"json_pro_descripcion\":\"Nachos de Maíz LOS CUATES Picante Bolsa 26g\",\"json_pro_cantidad\":\"3\",\"json_pro_stock\":\"0\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"2.1\"},{\"json_pro_id\":\"40\",\"json_pro_descripcion\":\"Palitos de Maíz CHIZITOS Queso Bolsa 16g\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"11\",\"json_pro_precio\":\"0.7\",\"json_pro_total\":\"3.5\"},{\"json_pro_id\":\"37\",\"json_pro_descripcion\":\"Aceite Vegetal PALMA REAL Galonera 2L\",\"json_pro_cantidad\":\"4\",\"json_pro_stock\":\"3\",\"json_pro_precio\":\"19.124\",\"json_pro_total\":\"76.5\"}]', 14.778, 82.1, 96.878, 'T-C-535425', '2024-12-13 03:39:12', NULL, NULL),
(19, 10019, 4, 1, '[{\"json_pro_id\":\"41\",\"json_pro_descripcion\":\"Palitos de Maiz CHEESE TRIS Queso Bolsa 16g\",\"json_pro_cantidad\":\"10\",\"json_pro_stock\":\"29\",\"json_pro_precio\":\"0.84\",\"json_pro_total\":\"8.4\"},{\"json_pro_id\":\"19\",\"json_pro_descripcion\":\"Amarillin SIBARITA Doypack 100 gr\",\"json_pro_cantidad\":\"5\",\"json_pro_stock\":\"43\",\"json_pro_precio\":\"2.212\",\"json_pro_total\":\"11.06\"}]', 3.5028, 19.46, 22.9628, 'Efectivo', '2025-10-15 03:01:52', NULL, NULL),
(24, 10024, 18, 1, '[{\"json_pro_id\":\"41\",\"json_pro_descripcion\":\"Palitos de Maiz CHEESE TRIS Queso Bolsa 16g\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"28\",\"json_pro_precio\":\"0.84\",\"json_pro_total\":\"0.84\"}]', 0.042, 0.84, 0.882, 'Efectivo', '2025-10-20 03:17:56', NULL, NULL),
(25, 10025, 4, 1, '[{\"json_pro_id\":\"39\",\"json_pro_descripcion\":\"Papas PRINGLES sabor original lata 104 gr\",\"json_pro_cantidad\":\"1\",\"json_pro_stock\":\"17\",\"json_pro_precio\":\"14\",\"json_pro_total\":\"14\"}]', 0.28, 14, 14.28, 'Efectivo', '2025-10-20 06:09:34', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `pro_id_categoria` (`pro_id_categoria`),
  ADD KEY `pro_id_proveedor` (`pro_id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`prove_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ven_id`),
  ADD KEY `ven_id_cliente` (`ven_id_cliente`),
  ADD KEY `ven_id_vendedor` (`ven_id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cli_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `pro_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `prove_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ven_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`pro_id_categoria`) REFERENCES `categorias` (`cat_id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`pro_id_proveedor`) REFERENCES `proveedores` (`prove_id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ven_id_cliente`) REFERENCES `clientes` (`cli_id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`ven_id_vendedor`) REFERENCES `usuarios` (`usu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
