-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2019 a las 01:26:24
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crudpreuba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(10) UNSIGNED NOT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `ciudad`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Caracas', '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(2, 'Maracaibo', '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(3, 'Valencia', '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(4, 'Barquisimeto', '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(5, 'San Cristobal', '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `concesionarioId` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_cedula` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concesionarios`
--

CREATE TABLE `concesionarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `ciudadId` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `concesionarios`
--

INSERT INTO `concesionarios` (`id`, `ciudadId`, `nombre`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Av. Panteón', 1, '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(2, 1, 'La Floridad', 1, '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(3, 2, 'Las Delicias', 1, '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(4, 4, 'San Roman', 1, '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(5, 5, 'Plaza Toros', 1, '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL),
(6, 3, 'Av. Las Industrias', 1, '2019-03-04 00:25:25', '2019-03-04 00:25:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2019_03_01_124949_create_ciudades_table', 1),
(30, '2019_03_01_132325_create_consesionarios_table', 1),
(31, '2019_03_01_133755_create_clientes_table', 1),
(32, '2019_03_02_111121_create_status_code_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_code`
--

CREATE TABLE `status_code` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `mensaje` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `status_code`
--

INSERT INTO `status_code` (`id`, `codigo`, `tipo`, `mensaje`, `created_at`, `updated_at`) VALUES
(1, '200', 1, 'Conexion establecida', '2019-03-04 00:25:25', '2019-03-04 00:25:25'),
(2, '201', 1, 'ha sido creado de manera exitosa', '2019-03-04 00:25:25', '2019-03-04 00:25:25'),
(3, '202', 1, 'ha sido modificado con exito', '2019-03-04 00:25:25', '2019-03-04 00:25:25'),
(4, '203', 1, 'ha sido borrado', '2019-03-04 00:25:25', '2019-03-04 00:25:25'),
(5, '204', 0, 'los siguientes validaciones han fallado', '2019-03-04 00:25:25', '2019-03-04 00:25:25'),
(6, '205', 0, 'No se ha encontrado', '2019-03-04 00:25:25', '2019-03-04 00:25:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ciudades_ciudad_unique` (`ciudad`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_email_unique` (`email`),
  ADD UNIQUE KEY `clientes_cedula_unique` (`cedula`),
  ADD KEY `clientes_concesionarioid_foreign` (`concesionarioId`);

--
-- Indices de la tabla `concesionarios`
--
ALTER TABLE `concesionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `concesionarios_nombre_unique` (`nombre`),
  ADD KEY `concesionarios_ciudadid_foreign` (`ciudadId`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status_code`
--
ALTER TABLE `status_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_code_codigo_unique` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `concesionarios`
--
ALTER TABLE `concesionarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `status_code`
--
ALTER TABLE `status_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_concesionarioid_foreign` FOREIGN KEY (`concesionarioId`) REFERENCES `concesionarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `concesionarios`
--
ALTER TABLE `concesionarios`
  ADD CONSTRAINT `concesionarios_ciudadid_foreign` FOREIGN KEY (`ciudadId`) REFERENCES `ciudades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
