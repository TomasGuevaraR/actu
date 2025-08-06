-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2025 a las 05:50:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `actu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diezmos`
--

CREATE TABLE `diezmos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `movimiento_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diezmos`
--

INSERT INTO `diezmos` (`id`, `nombre`, `valor`, `fecha`, `created_at`, `updated_at`, `movimiento_id`) VALUES
(1, 'daniel viloria', 500000, '2025-07-13', '2025-07-14 02:50:29', '2025-07-14 02:50:29', NULL),
(2, 'tomas guevara', 1000000, '2025-07-13', '2025-07-14 02:50:29', '2025-07-14 02:50:29', NULL),
(3, 'ruth mora', 60000, '2025-07-13', '2025-07-14 02:50:29', '2025-07-14 02:50:29', NULL),
(4, 'Adiel Guevara', 100000, '2025-07-17', '2025-07-18 01:14:57', '2025-07-18 01:14:57', NULL),
(5, 'María Pérez', 60000, '2025-07-17', '2025-07-18 01:14:58', '2025-07-18 01:14:58', NULL),
(7, 'pable G', 200000, '2025-07-21', '2025-07-22 03:42:19', '2025-07-22 03:42:19', 11),
(8, 'pablo jesus', 1000000, '2025-07-21', '2025-07-22 03:42:19', '2025-07-22 03:42:19', 11),
(9, 'Ofrenda', 120000, '2025-07-21', '2025-07-22 03:42:19', '2025-07-22 03:42:19', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anio` year(4) NOT NULL DEFAULT 2025,
  `mes` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `saldo_inicial` decimal(15,2) NOT NULL DEFAULT 0.00,
  `entradas` decimal(15,2) NOT NULL DEFAULT 0.00,
  `salidas` decimal(15,2) NOT NULL DEFAULT 0.00,
  `saldo_final` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `anio`, `mes`, `saldo_inicial`, `entradas`, `salidas`, `saldo_final`, `created_at`, `updated_at`) VALUES
(1, '2025', 1, 5060045.00, 0.00, 0.00, 5060045.00, '2025-07-07 18:05:45', '2025-07-07 18:05:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `numero_identificacion` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `barrio` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo','con excusa permanente','borrado','ausente') DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id`, `nombres`, `apellidos`, `numero_identificacion`, `email`, `telefono`, `fecha_nacimiento`, `edad`, `direccion`, `barrio`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Augusto Daniel', 'Viloria Macia', '15614601', 'pastorco626@gmail.com', '3144030728', '1969-06-25', 56, 'MZ J Lot 17', '2 de septiembre', 'activo', '2025-07-03 08:55:59', '2025-07-29 06:47:34'),
(2, 'Tomas Andrés', 'Guevara Ramos', '1063358895', 'tomasguevara2024@gmail.com', '3218721623', '1990-01-03', 35, 'carrera 8G # 6c-30 sur', 'Araujo Viejos', 'activo', '2025-07-28 02:34:17', '2025-07-28 02:34:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000002_create_jobs_table', 1),
(2, '2025_05_26_132725_create_miembros_table', 1),
(3, '2025_06_24_201456_create_usuarios_table.', 1),
(4, '2025_06_24_203737_create_sessions_table', 1),
(5, '2025_06_24_205438_create_cache_table', 1),
(6, '2025_06_25_231222_remove_alias_from_usuarios_table', 1),
(7, '2025_07_03_193251_create_presupuestos_table', 1),
(8, '2025_07_03_215805_create_movimientos_table', 2),
(9, '2025_07_04_223207_add_responsable_to_presupuestos_table', 3),
(10, '2025_07_05_152949_update_tipo_to_categoria_in_presupuestos_table', 4),
(11, '2025_07_07_120302_create_estados_table', 5),
(12, '2025_07_07_122801_update_estados_for_finanzas', 6),
(13, '2025_07_07_123329_add_campos_financieros_to_estados_table', 7),
(14, '2025_07_10_173259_add_detalle_concepto_casilla_to_movimientos', 8),
(15, '2025_07_10_173940_remove_descripcion_from_movimientos_table', 9),
(16, '2025_07_10_221300_make_presupuesto_id_nullable_in_movimientos', 10),
(17, '2025_07_13_205936_create_diezmos_table', 11),
(18, '2025_07_13_214912_create_diezmos_table', 12),
(19, '2025_07_15_215046_add_movimiento_id_to_diezmos_table', 13),
(20, '2025_07_25_115357_create_password_reset_tokens_table', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `presupuesto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `consecutivo` varchar(255) DEFAULT NULL,
  `tipo` enum('ingreso','egreso') NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `saldo` decimal(15,2) DEFAULT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `casilla` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `presupuesto_id`, `fecha`, `consecutivo`, `tipo`, `valor`, `saldo`, `detalle`, `concepto`, `casilla`, `created_at`, `updated_at`) VALUES
(3, NULL, '2025-07-10', '09', 'egreso', 1423500.00, -1423500.00, 'Daniel Viloria', 'Sueldo del Pastor', 'Sueldo Pastor', '2025-07-11 03:54:22', '2025-07-15 06:05:53'),
(4, NULL, '2025-07-10', '124', 'ingreso', 50000.00, -1373500.00, 'Iglesia Templo Unido', 'ofrenda especial', NULL, '2025-07-11 04:35:09', '2025-07-11 04:35:09'),
(5, NULL, '2025-07-11', '125', 'ingreso', 1000000.00, -373500.00, 'Iglesia Templo Unido', 'ofrenda', NULL, '2025-07-11 17:39:00', '2025-07-11 17:39:00'),
(7, NULL, '2025-07-13', '126', 'ingreso', 1580000.00, -217000.00, 'Templo Unido', 'escuela dominical', NULL, '2025-07-14 02:50:30', '2025-07-15 03:37:16'),
(8, NULL, '2025-07-14', '10', 'egreso', 600000.00, -717000.00, 'Daniel Viloria', 'Bonificación Pastor', 'Sueldo Pastor', '2025-07-15 06:07:32', '2025-07-15 06:09:27'),
(11, NULL, '2025-07-21', '131', 'ingreso', 1320000.00, 603000.00, 'Templo Unido', 'diezmo domingo 21', NULL, '2025-07-22 03:42:19', '2025-07-22 03:46:10'),
(14, 3, '2025-07-24', '13', 'egreso', 500001.00, 102999.00, 'Daniel Viloria', 'Bonificación Pastor 2', 'Sueldo Pastor', '2025-07-25 08:55:46', '2025-07-25 08:55:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('tomasguevara2024@gmail.com', '$2y$12$tPXHdiF0ijs027g3lgUZJ.8GqhLbd80Jz3m5QJNwX2ux9QU.Fvvw2', '2025-07-26 06:16:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_casilla` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `valor_mensual` decimal(12,2) NOT NULL,
  `año` year(4) NOT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`id`, `nombre_casilla`, `categoria`, `valor_mensual`, `año`, `responsable`, `created_at`, `updated_at`) VALUES
(3, 'Sueldo Pastor', 'Administración Pastoral', 2860000.00, '2025', 'Héctor Olivera', '2025-07-05 22:01:49', '2025-07-05 22:01:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BjMC8J2hrrIujSejogmj0noo3BwBHizE2UMFxLrs', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQkVrRVJXNllFcGlkYWFvTXRZODdRODFQc25SWFd1ZVF0UHJlRENyOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1753760974);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `numero_identificacion` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` enum('pastor','anciano','fiscal','tesorero','secretario') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `numero_identificacion`, `email`, `password`, `rol`, `created_at`, `updated_at`, `estado`) VALUES
(4, 'Tomas Guevara', '1063358895', 'tomasguevara2024@gmail.com', '$2y$12$3yIl8ffYloXpsddgvTc7UelWqEfZmtWqq1TwcpxiqFvzuwMn/qYWq', 'pastor', '2025-07-03 08:31:06', '2025-07-28 02:30:39', 'activo'),
(5, 'Daniel V', '15614601', 'pastorco626@gmail.com', '$2y$12$p0HZHWjcGDsOxPuX0CXVtuFEfUyYJTWkFJXk1X3LNn096wrhpC3IW', 'pastor', '2025-07-03 08:37:42', '2025-07-29 06:47:33', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `diezmos`
--
ALTER TABLE `diezmos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diezmos_movimiento_id_foreign` (`movimiento_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_presupuesto_id_foreign` (`presupuesto_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `numero_identificacion` (`numero_identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `diezmos`
--
ALTER TABLE `diezmos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `diezmos`
--
ALTER TABLE `diezmos`
  ADD CONSTRAINT `diezmos_movimiento_id_foreign` FOREIGN KEY (`movimiento_id`) REFERENCES `movimientos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_presupuesto_id_foreign` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuestos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
