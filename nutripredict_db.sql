-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2026 a las 12:56:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nutripredict_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL DEFAULT 0,
  `tipo_deficiencia` varchar(80) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `nivel` enum('critica','alta','media','baja') NOT NULL DEFAULT 'media',
  `estado` enum('activa','resuelta','ignorada') NOT NULL DEFAULT 'activa',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_resolucion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id`, `id_estudiante`, `tipo_deficiencia`, `descripcion`, `nivel`, `estado`, `fecha_creacion`, `fecha_resolucion`) VALUES
(1, 1, 'Hierro', 'Consumo de hierro por debajo del 60% recomendado en los últimos 7 días.', 'alta', 'activa', '2026-03-17 23:23:45', NULL),
(2, 2, 'Vitamina D', 'Déficit de Vitamina D detectado en el análisis semanal.', 'alta', 'activa', '2026-03-17 23:23:45', NULL),
(3, 3, 'Calcio', 'Ingesta de calcio insuficiente. Se recomienda incluir más lácteos.', 'media', 'activa', '2026-03-17 23:23:45', NULL),
(4, 4, 'Proteinas', 'Consumo proteico bajo en relación con su edad y peso.', 'media', 'activa', '2026-03-17 23:23:45', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `categoria` enum('cereal','proteina','lacteo','verdura','fruta','grasa','bebida','otro') NOT NULL,
  `calorias` decimal(7,2) NOT NULL DEFAULT 0.00,
  `proteinas_g` decimal(6,2) NOT NULL DEFAULT 0.00,
  `carbohidratos_g` decimal(6,2) NOT NULL DEFAULT 0.00,
  `grasas_g` decimal(6,2) NOT NULL DEFAULT 0.00,
  `hierro_mg` decimal(6,2) NOT NULL DEFAULT 0.00,
  `calcio_mg` decimal(6,2) NOT NULL DEFAULT 0.00,
  `vitamina_d_ug` decimal(6,2) NOT NULL DEFAULT 0.00,
  `zinc_mg` decimal(6,2) NOT NULL DEFAULT 0.00,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `nombre`, `categoria`, `calorias`, `proteinas_g`, `carbohidratos_g`, `grasas_g`, `hierro_mg`, `calcio_mg`, `vitamina_d_ug`, `zinc_mg`, `activo`) VALUES
(1, 'Arroz blanco cocido', 'cereal', 130.00, 2.70, 28.20, 0.30, 0.20, 10.00, 0.00, 0.40, 1),
(2, 'Frijoles rojos cocidos', 'proteina', 127.00, 8.70, 22.80, 0.50, 2.90, 28.00, 0.00, 1.00, 1),
(3, 'Pollo pechuga cocida', 'proteina', 165.00, 31.00, 0.00, 3.60, 1.00, 15.00, 0.10, 1.00, 1),
(4, 'Leche entera', 'lacteo', 61.00, 3.20, 4.80, 3.30, 0.00, 113.00, 1.20, 0.40, 1),
(5, 'Huevo entero cocido', 'proteina', 155.00, 13.00, 1.10, 11.00, 1.90, 50.00, 2.00, 1.30, 1),
(6, 'Avena cocida', 'cereal', 71.00, 2.50, 12.00, 1.50, 1.20, 14.00, 0.00, 0.90, 1),
(7, 'Zanahoria cocida', 'verdura', 35.00, 0.80, 8.20, 0.20, 0.30, 30.00, 0.00, 0.20, 1),
(8, 'Plátano maduro', 'fruta', 89.00, 1.10, 22.80, 0.30, 0.30, 5.00, 0.00, 0.20, 1),
(9, 'Arepa de maíz', 'cereal', 219.00, 4.00, 46.00, 2.00, 0.50, 10.00, 0.00, 0.40, 1),
(10, 'Espinaca cocida', 'verdura', 23.00, 2.90, 3.80, 0.30, 3.60, 99.00, 0.00, 0.80, 1),
(11, 'Jugo de naranja natural', 'bebida', 45.00, 0.70, 10.40, 0.20, 0.20, 11.00, 0.00, 0.10, 1),
(12, 'Lenteja cocida', 'proteina', 116.00, 9.00, 20.10, 0.40, 3.30, 19.00, 0.00, 1.30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `asistio` tinyint(1) NOT NULL DEFAULT 1,
  `observacion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_estudiante`, `fecha`, `asistio`, `observacion`) VALUES
(1, 1, '2026-03-17', 1, NULL),
(2, 2, '2026-03-17', 1, NULL),
(3, 3, '2026-03-17', 1, NULL),
(4, 4, '2026-03-17', 1, NULL),
(5, 5, '2026-03-17', 1, NULL),
(6, 6, '2026-03-17', 1, NULL),
(7, 7, '2026-03-17', 0, NULL),
(8, 8, '2026-03-17', 1, NULL),
(9, 9, '2026-03-17', 0, NULL),
(10, 10, '2026-03-17', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobertura_nutricional`
--

CREATE TABLE `cobertura_nutricional` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nutriente` varchar(80) NOT NULL,
  `porcentaje` decimal(5,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cobertura_nutricional`
--

INSERT INTO `cobertura_nutricional` (`id`, `fecha`, `nutriente`, `porcentaje`) VALUES
(1, '2026-03-11', 'Hierro', 68.00),
(2, '2026-03-11', 'Calcio', 80.00),
(3, '2026-03-11', 'Proteinas', 88.00),
(4, '2026-03-11', 'Vitamina D', 45.00),
(5, '2026-03-11', 'Zinc', 64.00),
(6, '2026-03-12', 'Hierro', 70.00),
(7, '2026-03-12', 'Calcio', 83.00),
(8, '2026-03-12', 'Proteinas', 90.00),
(9, '2026-03-12', 'Vitamina D', 47.00),
(10, '2026-03-12', 'Zinc', 66.00),
(11, '2026-03-13', 'Hierro', 72.00),
(12, '2026-03-13', 'Calcio', 85.00),
(13, '2026-03-13', 'Proteinas', 91.00),
(14, '2026-03-13', 'Vitamina D', 48.00),
(15, '2026-03-13', 'Zinc', 67.00),
(16, '2026-03-14', 'Hierro', 69.00),
(17, '2026-03-14', 'Calcio', 82.00),
(18, '2026-03-14', 'Proteinas', 89.00),
(19, '2026-03-14', 'Vitamina D', 46.00),
(20, '2026-03-14', 'Zinc', 65.00),
(21, '2026-03-15', 'Hierro', 74.00),
(22, '2026-03-15', 'Calcio', 87.00),
(23, '2026-03-15', 'Proteinas', 93.00),
(24, '2026-03-15', 'Vitamina D', 50.00),
(25, '2026-03-15', 'Zinc', 69.00),
(26, '2026-03-16', 'Hierro', 71.00),
(27, '2026-03-16', 'Calcio', 84.00),
(28, '2026-03-16', 'Proteinas', 91.00),
(29, '2026-03-16', 'Vitamina D', 48.00),
(30, '2026-03-16', 'Zinc', 67.00),
(31, '2026-03-17', 'Hierro', 72.00),
(32, '2026-03-17', 'Calcio', 85.00),
(33, '2026-03-17', 'Proteinas', 91.00),
(34, '2026-03-17', 'Vitamina D', 48.00),
(35, '2026-03-17', 'Zinc', 67.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` enum('M','F','Otro') NOT NULL,
  `id_grado` int(11) NOT NULL,
  `peso_kg` decimal(5,2) DEFAULT NULL,
  `talla_cm` decimal(5,2) DEFAULT NULL,
  `imc` decimal(5,2) DEFAULT NULL,
  `imc_clasificacion` varchar(50) DEFAULT NULL,
  `nivel_riesgo` enum('alto','medio','bajo','sin_riesgo') NOT NULL DEFAULT 'sin_riesgo',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `nombre`, `apellido`, `fecha_nac`, `genero`, `id_grado`, `peso_kg`, `talla_cm`, `imc`, `imc_clasificacion`, `nivel_riesgo`, `activo`, `fecha_registro`) VALUES
(1, 'Juan', 'Pérez García', '2018-03-12', 'M', 3, 22.50, 112.00, 17.94, 'Normal', 'alto', 1, '2026-03-17 23:23:45'),
(2, 'Sofía', 'Gómez Ruiz', '2017-07-25', 'F', 5, 19.80, 108.50, 16.82, 'Normal', 'alto', 1, '2026-03-17 23:23:45'),
(3, 'María', 'López Castro', '2019-01-08', 'F', 5, 24.30, 118.00, 17.45, 'Normal', 'medio', 1, '2026-03-17 23:23:45'),
(4, 'Carlos', 'Ruiz Mendoza', '2016-11-30', 'M', 7, 28.10, 125.50, 17.84, 'Normal', 'medio', 1, '2026-03-17 23:23:45'),
(5, 'Ana', 'Torres Vega', '2020-05-14', 'F', 1, 17.20, 99.00, 17.55, 'Normal', 'bajo', 1, '2026-03-17 23:23:45'),
(6, 'Luis', 'Martínez Díaz', '2018-09-22', 'M', 3, 23.00, 113.00, 18.01, 'Normal', 'sin_riesgo', 1, '2026-03-17 23:23:45'),
(7, 'Valentina', 'Herrera Mora', '2019-04-03', 'F', 5, 21.50, 110.00, 17.77, 'Normal', 'sin_riesgo', 1, '2026-03-17 23:23:45'),
(8, 'Santiago', 'Vargas Ortiz', '2017-12-19', 'M', 7, 27.80, 124.00, 18.08, 'Normal', 'medio', 1, '2026-03-17 23:23:45'),
(9, 'Isabella', 'Romero Salcedo', '2016-08-07', 'F', 9, 31.20, 131.00, 18.18, 'Normal', 'sin_riesgo', 1, '2026-03-17 23:23:45'),
(10, 'Mateo', 'Jiménez Pardo', '2015-02-28', 'M', 11, 35.60, 138.50, 18.56, 'Normal', 'bajo', 1, '2026-03-17 23:23:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nivel` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `nombre`, `nivel`) VALUES
(1, '0°A', 0),
(2, '0°B', 0),
(3, '1°A', 1),
(4, '1°B', 1),
(5, '2°A', 2),
(6, '2°B', 2),
(7, '3°A', 3),
(8, '3°B', 3),
(9, '4°A', 4),
(10, '4°B', 4),
(11, '5°A', 5),
(12, '5°B', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_tiempo` enum('desayuno','almuerzo','merienda') NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `nutrientes_cubre` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nutrientes_cubre`)),
  `totales_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`totales_json`)),
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_alimentos`
--

CREATE TABLE `menu_alimentos` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `porcion_g` decimal(6,2) NOT NULL DEFAULT 100.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `tipo` enum('nutricional','asistencia','riesgo','general') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `archivo_path` varchar(300) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `riesgo_diario`
--

CREATE TABLE `riesgo_diario` (
  `id` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nivel_riesgo` enum('alto','medio','bajo','sin_riesgo') NOT NULL,
  `score` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `riesgo_diario`
--

INSERT INTO `riesgo_diario` (`id`, `id_estudiante`, `fecha`, `nivel_riesgo`, `score`) VALUES
(1, 1, '2026-03-13', 'alto', 0.87),
(2, 2, '2026-03-13', 'alto', 0.82),
(3, 3, '2026-03-13', 'medio', 0.61),
(4, 4, '2026-03-13', 'medio', 0.58),
(5, 5, '2026-03-13', 'bajo', 0.32),
(6, 1, '2026-03-14', 'alto', 0.89),
(7, 2, '2026-03-14', 'alto', 0.85),
(8, 3, '2026-03-14', 'medio', 0.63),
(9, 4, '2026-03-14', 'medio', 0.60),
(10, 5, '2026-03-14', 'bajo', 0.30),
(11, 1, '2026-03-15', 'alto', 0.88),
(12, 2, '2026-03-15', 'alto', 0.83),
(13, 3, '2026-03-15', 'medio', 0.59),
(14, 4, '2026-03-15', 'medio', 0.55),
(15, 5, '2026-03-15', 'bajo', 0.28),
(16, 1, '2026-03-16', 'alto', 0.90),
(17, 2, '2026-03-16', 'alto', 0.86),
(18, 3, '2026-03-16', 'medio', 0.62),
(19, 4, '2026-03-16', 'medio', 0.57),
(20, 5, '2026-03-16', 'bajo', 0.31),
(21, 1, '2026-03-17', 'alto', 0.91),
(22, 2, '2026-03-17', 'alto', 0.84),
(23, 3, '2026-03-17', 'medio', 0.61),
(24, 4, '2026-03-17', 'medio', 0.56),
(25, 5, '2026-03-17', 'bajo', 0.29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','nutricionista','docente','encargado_restaurante') NOT NULL DEFAULT 'docente',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `activo`, `fecha_creacion`) VALUES
(8, 'Administrador', 'admin@nutripredict.edu.co', '$2y$10$OilrJOKtGiPNWeg3wYprrePZmIii83HwhpsRduRtfKsfXpE1U3JKm', 'admin', 1, '2026-03-17 23:46:37'),
(9, 'Carlos Mendoza', 'restaurante@nutripredict.edu.co', '$2y$10$OilrJOKtGiPNWeg3wYprrePZmIii83HwhpsRduRtfKsfXpE1U3JKm', 'encargado_restaurante', 1, '2026-03-17 23:46:37'),
(10, 'Prof. Laura Gómez', 'docente@nutripredict.edu.co', '$2y$10$OilrJOKtGiPNWeg3wYprrePZmIii83HwhpsRduRtfKsfXpE1U3JKm', 'docente', 1, '2026-03-17 23:46:37'),
(11, 'Directora Ana Torres', 'directora@nutripredict.edu.co', '$2y$10$OilrJOKtGiPNWeg3wYprrePZmIii83HwhpsRduRtfKsfXpE1U3JKm', '', 1, '2026-03-17 23:46:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_asistencia` (`id_estudiante`,`fecha`);

--
-- Indices de la tabla `cobertura_nutricional`
--
ALTER TABLE `cobertura_nutricional`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cobertura` (`fecha`,`nutriente`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_menu_dia` (`fecha`,`tipo_tiempo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `menu_alimentos`
--
ALTER TABLE `menu_alimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_alimento` (`id_alimento`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `riesgo_diario`
--
ALTER TABLE `riesgo_diario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_riesgo_dia` (`id_estudiante`,`fecha`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cobertura_nutricional`
--
ALTER TABLE `cobertura_nutricional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `menu_alimentos`
--
ALTER TABLE `menu_alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `riesgo_diario`
--
ALTER TABLE `riesgo_diario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `alertas_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id`);

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `menu_alimentos`
--
ALTER TABLE `menu_alimentos`
  ADD CONSTRAINT `menu_alimentos_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_alimentos_ibfk_2` FOREIGN KEY (`id_alimento`) REFERENCES `alimentos` (`id`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `riesgo_diario`
--
ALTER TABLE `riesgo_diario`
  ADD CONSTRAINT `riesgo_diario_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
