-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2017 a las 07:06:29
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transportebd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente'),
(3, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ciudad` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre`, `ciudad`, `direccion`) VALUES
(1, 'Constructora Alanoca', 'LA PAZ', 'Av. Jaime Mendoza # 1254');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id_maquinaria` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `placa` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `peso_unitario` int(11) DEFAULT NULL,
  `id_tipo_movilizacion` int(11) DEFAULT NULL,
  `foto` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id_maquinaria`, `nombre`, `placa`, `estado`, `peso_unitario`, `id_tipo_movilizacion`, `foto`) VALUES
(1, 'AUTOHORMIGUERA (CARMIX)', 'RGE1455', '1', 15, 1, 'd447b-3.jpg'),
(2, 'CAMION VOLQUETE 15 m3', '3565POR', '1', 11, 2, 'a47c6-5.jpg'),
(3, 'CARGADOR FRONTAL', '2341BRF', '1', 15, 3, '6debc-6.jpg'),
(4, 'EXCAVADORA SOBRE ORUGAS', '3452FSD', '1', 12, 3, '8dd2d-7.jpg'),
(5, 'MOTONIVELADORA', '3423ADF', '1', 11, 1, '1d1aa-8.jpg'),
(6, 'RETROEXCABADORA SOBRE LLANTAS', '3423FGD', '1', 10, 1, 'dee37-9.jpg'),
(7, 'RODILLO BERMERO 1 TON', '3244RTE', '1', 8, 4, '27761-10.jpg'),
(8, 'RODILLO LISO VIBRATORIO 10 Ton', '6786CFS', '1', 13, 1, '10d31-11.jpg'),
(9, 'VIBROPISON', '3332', '1', 11, 4, 'e413d-12.jpg'),
(10, 'RODILLO VIBROCOMPACTADOR', '87543ÑLK', '1', 19, 3, 'a1960-13.jpg'),
(11, 'MANLIFT', '345DFF', '1', 23, 3, '61ef1-15.jpg'),
(12, 'CAMION BARANDA', '4563SDB', '1', 14, 2, '2c934-16.jpg'),
(13, 'CAMION GRUA 3 TON', '3453SDD', '1', 3, 2, 'aaede-17.jpg'),
(14, 'CAMION HIAB 10 TON', '4564SDFG', '1', 10, 2, '70853-18.jpg'),
(15, 'GRUA DE 25 TON', '3422DXD', '1', 25, 3, '6886b-20.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria_reserva`
--

CREATE TABLE `maquinaria_reserva` (
  `id_maquinaria_reserva` int(11) NOT NULL,
  `id_maquinaria` int(11) DEFAULT NULL,
  `id_reserva` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `maquinaria_reserva`
--

INSERT INTO `maquinaria_reserva` (`id_maquinaria_reserva`, `id_maquinaria`, `id_reserva`, `fecha`) VALUES
(4, 1, 1, '2017-06-23 14:21:24'),
(6, 2, 1, '2017-06-26 12:01:37'),
(7, 5, 1, '2017-06-26 12:01:42'),
(8, 9, 1, '2017-06-26 12:01:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_traslado`
--

CREATE TABLE `pago_traslado` (
  `id_pago_traslado` int(11) NOT NULL,
  `monto` float DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` char(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_traslado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pago_traslado`
--

INSERT INTO `pago_traslado` (`id_pago_traslado`, `monto`, `fecha`, `estado`, `id_traslado`) VALUES
(1, 1000, '2017-06-26 11:44:35', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `paterno` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `materno` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `tipo_licencia` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `foto` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombre`, `paterno`, `materno`, `celular`, `tipo_licencia`, `foto`, `id_empresa`) VALUES
(1, 'CARLOS', 'ORTEGA', 'ORELLANA', 78669933, 'A', 'db0cf-e201d-img_profile_goldberg_301_303_s_c1.jpg', 1),
(2, 'MARIO', 'VILLANUEVA', 'MONTES', 78996545, 'A', 'b3c26-s.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_cargo`
--

CREATE TABLE `persona_cargo` (
  `id_persona_cargo` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `estado` varchar(1) COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `persona_cargo`
--

INSERT INTO `persona_cargo` (`id_persona_cargo`, `id_persona`, `id_cargo`, `estado`, `usuario`, `password`) VALUES
(1, 1, 1, '1', '4dceb5c03676a0b4ad8c454541c970a4505c72c4', '4dceb5c03676a0b4ad8c454541c970a4505c72c4'),
(2, 2, 2, '1', '265392dc2782778664cc9d56c8e3cd9956661bb0', '4dceb5c03676a0b4ad8c454541c970a4505c72c4'),
(3, 1, 1, '1', 'ab5e2bca84933118bbc9d48ffaccce3bac4eeb64', 'ab5e2bca84933118bbc9d48ffaccce3bac4eeb64');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(1) COLLATE latin1_spanish_ci NOT NULL DEFAULT '1',
  `destino` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `costo_hora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_persona`, `nombre`, `fecha`, `estado`, `destino`, `costo_hora`) VALUES
(1, 2, 'CONSTRUCCION CAMINO ASFALTO MOJOCOYA-TARVITA ', '2017-06-23 09:42:50', '1', 'MOJOCOYA', 0),
(2, 1, 'proyecto de prueba', '2017-10-22 19:23:21', '2', 'lejos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movilizacion`
--

CREATE TABLE `tipo_movilizacion` (
  `id_tipo_movilizacion` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_movilizacion`
--

INSERT INTO `tipo_movilizacion` (`id_tipo_movilizacion`, `nombre`) VALUES
(1, 'CAMA BAJA'),
(2, 'PROPIOS MEDIOS'),
(3, 'CAMA BAJA-CARGA ANCHA'),
(4, 'CAMION BARANDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslado`
--

CREATE TABLE `traslado` (
  `id_traslado` int(11) NOT NULL,
  `id_reserva` int(11) DEFAULT NULL,
  `fecha_inicio_ida` datetime NOT NULL,
  `fecha_fin_ida` datetime NOT NULL,
  `fecha_inicio_vuelta` datetime NOT NULL,
  `fecha_fin_vuelta` datetime NOT NULL,
  `tiempo` int(11) NOT NULL,
  `origen` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `destino` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `costo_hora` int(11) NOT NULL,
  `estado` varchar(1) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_via` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `longitud` int(11) NOT NULL,
  `velocidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `traslado`
--

INSERT INTO `traslado` (`id_traslado`, `id_reserva`, `fecha_inicio_ida`, `fecha_fin_ida`, `fecha_inicio_vuelta`, `fecha_fin_vuelta`, `tiempo`, `origen`, `destino`, `costo_hora`, `estado`, `tipo_via`, `longitud`, `velocidad`) VALUES
(2, 1, '2017-06-26 07:00:00', '2017-06-26 17:00:00', '2017-06-28 06:00:00', '2017-06-28 16:00:00', 10, 'SUCRE', 'MOJOCOYA', 450, '1', 'Compacto', 180, 35);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_maquinas_asignadas`
--
CREATE TABLE `v_maquinas_asignadas` (
`id_traslado` int(11)
,`peso_unitario` int(11)
,`maquina` varchar(45)
,`movilizacion` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_registro_maquinas`
--
CREATE TABLE `v_registro_maquinas` (
`id_maquinaria_reserva` int(11)
,`fecha` datetime
,`id_reserva` int(11)
,`maquina` varchar(45)
,`estado` char(1)
,`peso_unitario` int(11)
,`proyecto` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_registro_reservas`
--
CREATE TABLE `v_registro_reservas` (
`id_reserva` int(11)
,`proyecto` varchar(150)
,`fecha` datetime
,`id_persona` int(11)
,`cliente` varchar(137)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_registro_traslados`
--
CREATE TABLE `v_registro_traslados` (
`id_reserva` int(11)
,`id_persona` int(11)
,`proyecto` varchar(150)
,`id_traslado` int(11)
,`origen` varchar(45)
,`destino` varchar(30)
,`fecha_inicio_ida` datetime
,`fecha_fin_ida` datetime
,`tipo_via` varchar(30)
,`longitud` int(11)
,`velocidad` int(11)
,`fecha_inicio_vuelta` datetime
,`fecha_fin_vuelta` datetime
,`estado` varchar(1)
,`costo_hora` int(11)
,`tiempo` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_maquinas_asignadas`
--
DROP TABLE IF EXISTS `v_maquinas_asignadas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_maquinas_asignadas`  AS  select `t`.`id_traslado` AS `id_traslado`,`m`.`peso_unitario` AS `peso_unitario`,`m`.`nombre` AS `maquina`,`tp`.`nombre` AS `movilizacion` from (((((`traslado` `t` join `reserva` `r`) join `maquinaria_reserva` `mr`) join `maquinaria` `m`) join `persona` `p`) join `tipo_movilizacion` `tp`) where ((`t`.`id_reserva` = `r`.`id_reserva`) and (`p`.`id_persona` = `r`.`id_persona`) and (`mr`.`id_reserva` = `r`.`id_reserva`) and (`mr`.`id_maquinaria` = `m`.`id_maquinaria`) and (`m`.`id_tipo_movilizacion` = `tp`.`id_tipo_movilizacion`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_registro_maquinas`
--
DROP TABLE IF EXISTS `v_registro_maquinas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_registro_maquinas`  AS  select `mr`.`id_maquinaria_reserva` AS `id_maquinaria_reserva`,`mr`.`fecha` AS `fecha`,`r`.`id_reserva` AS `id_reserva`,`m`.`nombre` AS `maquina`,`m`.`estado` AS `estado`,`m`.`peso_unitario` AS `peso_unitario`,`r`.`nombre` AS `proyecto` from ((`maquinaria_reserva` `mr` join `maquinaria` `m`) join `reserva` `r`) where ((`mr`.`id_maquinaria` = `m`.`id_maquinaria`) and (`mr`.`id_reserva` = `r`.`id_reserva`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_registro_reservas`
--
DROP TABLE IF EXISTS `v_registro_reservas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_registro_reservas`  AS  select `r`.`id_reserva` AS `id_reserva`,`r`.`nombre` AS `proyecto`,`r`.`fecha` AS `fecha`,`p`.`id_persona` AS `id_persona`,concat(`p`.`nombre`,' ',`p`.`paterno`,' ',`p`.`materno`) AS `cliente` from (`reserva` `r` join `persona` `p`) where (`p`.`id_persona` = `r`.`id_persona`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_registro_traslados`
--
DROP TABLE IF EXISTS `v_registro_traslados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_registro_traslados`  AS  select `r`.`id_reserva` AS `id_reserva`,`r`.`id_persona` AS `id_persona`,`r`.`nombre` AS `proyecto`,`t`.`id_traslado` AS `id_traslado`,`t`.`origen` AS `origen`,`t`.`destino` AS `destino`,`t`.`fecha_inicio_ida` AS `fecha_inicio_ida`,`t`.`fecha_fin_ida` AS `fecha_fin_ida`,`t`.`tipo_via` AS `tipo_via`,`t`.`longitud` AS `longitud`,`t`.`velocidad` AS `velocidad`,`t`.`fecha_inicio_vuelta` AS `fecha_inicio_vuelta`,`t`.`fecha_fin_vuelta` AS `fecha_fin_vuelta`,`t`.`estado` AS `estado`,`t`.`costo_hora` AS `costo_hora`,`t`.`tiempo` AS `tiempo` from (`traslado` `t` join `reserva` `r`) where (`t`.`id_reserva` = `r`.`id_reserva`) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id_maquinaria`),
  ADD KEY `fk_id_tipo_movilizacion_id_maquinaria_idx` (`id_tipo_movilizacion`);

--
-- Indices de la tabla `maquinaria_reserva`
--
ALTER TABLE `maquinaria_reserva`
  ADD PRIMARY KEY (`id_maquinaria_reserva`),
  ADD KEY `fk_id_reserva_id_maquinaria_reservar_idx` (`id_reserva`),
  ADD KEY `fk_id_maquinaria_id_maquinaria_reserva` (`id_maquinaria`);

--
-- Indices de la tabla `pago_traslado`
--
ALTER TABLE `pago_traslado`
  ADD PRIMARY KEY (`id_pago_traslado`),
  ADD KEY `fk_id_traslado_id_pago_traslado_idx` (`id_traslado`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `fk_id_empresa_id_persona_idx` (`id_empresa`);

--
-- Indices de la tabla `persona_cargo`
--
ALTER TABLE `persona_cargo`
  ADD PRIMARY KEY (`id_persona_cargo`),
  ADD KEY `fk_id_persona_id_persona_cargo_idx` (`id_persona`),
  ADD KEY `fk_id_cargo_id_persona_cargo_idx` (`id_cargo`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_id_persona_id_reserva_idx` (`id_persona`);

--
-- Indices de la tabla `tipo_movilizacion`
--
ALTER TABLE `tipo_movilizacion`
  ADD PRIMARY KEY (`id_tipo_movilizacion`);

--
-- Indices de la tabla `traslado`
--
ALTER TABLE `traslado`
  ADD PRIMARY KEY (`id_traslado`),
  ADD KEY `fk_id_reserva_id_traslado_idx` (`id_reserva`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `id_maquinaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `maquinaria_reserva`
--
ALTER TABLE `maquinaria_reserva`
  MODIFY `id_maquinaria_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `pago_traslado`
--
ALTER TABLE `pago_traslado`
  MODIFY `id_pago_traslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `persona_cargo`
--
ALTER TABLE `persona_cargo`
  MODIFY `id_persona_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_movilizacion`
--
ALTER TABLE `tipo_movilizacion`
  MODIFY `id_tipo_movilizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `traslado`
--
ALTER TABLE `traslado`
  MODIFY `id_traslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `fk_id_tipo_movilizacion_id_maquinaria` FOREIGN KEY (`id_tipo_movilizacion`) REFERENCES `tipo_movilizacion` (`id_tipo_movilizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maquinaria_reserva`
--
ALTER TABLE `maquinaria_reserva`
  ADD CONSTRAINT `fk_id_maquinaria_id_maquinaria_reserva` FOREIGN KEY (`id_maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_reserva_id_maquinaria_reservar` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago_traslado`
--
ALTER TABLE `pago_traslado`
  ADD CONSTRAINT `fk_id_traslado_id_pago_traslado` FOREIGN KEY (`id_traslado`) REFERENCES `traslado` (`id_traslado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_id_empresa_id_persona` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona_cargo`
--
ALTER TABLE `persona_cargo`
  ADD CONSTRAINT `fk_id_cargo_id_persona_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_persona_id_persona_cargo` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_id_persona_id_reserva` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `traslado`
--
ALTER TABLE `traslado`
  ADD CONSTRAINT `fk_id_reserva_id_traslado` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
