-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2022 a las 04:14:41
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
-- Base de datos: `mascotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_afiliaciones`
--

CREATE TABLE `tb_afiliaciones` (
  `id_afiliacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_mascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estados`
--

CREATE TABLE `tb_estados` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_estados`
--

INSERT INTO `tb_estados` (`id_estado`, `nombre_estado`) VALUES
(1, 'Activo'),
(2, 'InActivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_mascotas`
--

CREATE TABLE `tb_mascotas` (
  `id_mascota` int(11) NOT NULL,
  `nombre_mascota` varchar(30) NOT NULL,
  `color` varchar(15) NOT NULL,
  `raza` varchar(45) DEFAULT NULL,
  `id_usuario` varchar(15) NOT NULL,
  `id_tipo_mascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_medicamentos`
--

CREATE TABLE `tb_medicamentos` (
  `id_medicamento` int(11) NOT NULL,
  `nombre_medicamento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_recibo_meds`
--

CREATE TABLE `tb_recibo_meds` (
  `id_recibo_med` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `id_medicamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_mascotas`
--

CREATE TABLE `tb_tipo_mascotas` (
  `id_tipo_mascota` int(11) NOT NULL,
  `tipo_mascota` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_tipo_mascotas`
--

INSERT INTO `tb_tipo_mascotas` (`id_tipo_mascota`, `tipo_mascota`) VALUES
(1, 'Perros'),
(2, 'Aves');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_usuarios`
--

CREATE TABLE `tb_tipo_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_tipo_usuarios`
--

INSERT INTO `tb_tipo_usuarios` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Veterinario'),
(3, 'Propietario'),
(10, 'Auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` varchar(15) NOT NULL,
  `nombre_usuario` varchar(60) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `tarj_prof` varchar(15) DEFAULT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombre_usuario`, `direccion`, `correo`, `telefono`, `password`, `tarj_prof`, `id_tipo_usuario`, `id_estado`) VALUES
('1086498975', 'German', 'calle 5', 'german@gmail.com', '7345678', '1234', '1086498975', 2, 1),
('1086498976', 'CARLOS', 'carlos@gmail.com', 'carlos@gmail.com', '7203456', '1234', '1086498976', 1, 1),
('1086498977', 'Jimena', 'calle 13', 'jimena@gmail.com', '7309090', '1234', '454645645', 3, 1),
('1086498978', 'Maria Erazo', 'calle 4', 'maria@gmail.com', '45345', '1234', '1086498978', 2, 1),
('1086498979', 'Silvana', 'calle 6', 'silvana@gmail.com', '7204567', '12345', '', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_visitas`
--

CREATE TABLE `tb_visitas` (
  `id_visita` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `temperatura` double NOT NULL,
  `frec_respiratoria` int(11) NOT NULL,
  `frec_cardiaca` int(11) NOT NULL,
  `peso` double NOT NULL,
  `recomendacion` text NOT NULL,
  `costo` double NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_afiliaciones`
--
ALTER TABLE `tb_afiliaciones`
  ADD PRIMARY KEY (`id_afiliacion`),
  ADD KEY `fk_afiliacion_mascota` (`id_mascota`) USING BTREE;

--
-- Indices de la tabla `tb_estados`
--
ALTER TABLE `tb_estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tb_mascotas`
--
ALTER TABLE `tb_mascotas`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `fk_mascota_usuario` (`id_usuario`) USING BTREE,
  ADD KEY `fk_mascota_tipo_mascota` (`id_tipo_mascota`) USING BTREE;

--
-- Indices de la tabla `tb_medicamentos`
--
ALTER TABLE `tb_medicamentos`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `tb_recibo_meds`
--
ALTER TABLE `tb_recibo_meds`
  ADD PRIMARY KEY (`id_recibo_med`),
  ADD KEY `fk_recibo_meds_visita` (`id_visita`) USING BTREE,
  ADD KEY `fk_recibo_meds_medicamento` (`id_medicamento`) USING BTREE;

--
-- Indices de la tabla `tb_tipo_mascotas`
--
ALTER TABLE `tb_tipo_mascotas`
  ADD PRIMARY KEY (`id_tipo_mascota`);

--
-- Indices de la tabla `tb_tipo_usuarios`
--
ALTER TABLE `tb_tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_tipo_usuario` (`id_tipo_usuario`) USING BTREE,
  ADD KEY `fk_usuario_estado` (`id_estado`) USING BTREE;

--
-- Indices de la tabla `tb_visitas`
--
ALTER TABLE `tb_visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `fk_visita_mascota` (`id_mascota`) USING BTREE,
  ADD KEY `fk_visita_estado` (`id_estado`) USING BTREE,
  ADD KEY `fk_visita_usuario` (`id_usuario`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_afiliaciones`
--
ALTER TABLE `tb_afiliaciones`
  MODIFY `id_afiliacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_estados`
--
ALTER TABLE `tb_estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_mascotas`
--
ALTER TABLE `tb_mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_medicamentos`
--
ALTER TABLE `tb_medicamentos`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_recibo_meds`
--
ALTER TABLE `tb_recibo_meds`
  MODIFY `id_recibo_med` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_tipo_mascotas`
--
ALTER TABLE `tb_tipo_mascotas`
  MODIFY `id_tipo_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_tipo_usuarios`
--
ALTER TABLE `tb_tipo_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tb_visitas`
--
ALTER TABLE `tb_visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_afiliaciones`
--
ALTER TABLE `tb_afiliaciones`
  ADD CONSTRAINT `fk_afiliacion_mascota` FOREIGN KEY (`id_mascota`) REFERENCES `tb_mascotas` (`id_mascota`);

--
-- Filtros para la tabla `tb_mascotas`
--
ALTER TABLE `tb_mascotas`
  ADD CONSTRAINT `fk_mascota_tipo_mascota` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tb_tipo_mascotas` (`id_tipo_mascota`),
  ADD CONSTRAINT `fk_mascota_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tb_recibo_meds`
--
ALTER TABLE `tb_recibo_meds`
  ADD CONSTRAINT `fk_recibo_meds_medicamento` FOREIGN KEY (`id_medicamento`) REFERENCES `tb_medicamentos` (`id_medicamento`),
  ADD CONSTRAINT `fk_recibo_meds_visita` FOREIGN KEY (`id_visita`) REFERENCES `tb_visitas` (`id_visita`);

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `fk_usuario_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`),
  ADD CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tb_tipo_usuarios` (`id_tipo_usuario`);

--
-- Filtros para la tabla `tb_visitas`
--
ALTER TABLE `tb_visitas`
  ADD CONSTRAINT `fk_visita_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estados` (`id_estado`),
  ADD CONSTRAINT `fk_visita_mascota` FOREIGN KEY (`id_mascota`) REFERENCES `tb_mascotas` (`id_mascota`),
  ADD CONSTRAINT `fk_visita_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
