-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2025 a las 01:31:33
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
(12, 'Familia Carvajal Ibarra', 65000, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(13, 'Eduardo Manuel Miranda Acosta', 100000, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(14, 'Fernando Urrutia', 53000, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(15, 'Familia Barrera L', 49500, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(16, 'Diezmo', 7500, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(17, 'Familia Viloria Yánez', 150000, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(18, 'Blanca Virginia García Tapias', 6000, '2025-01-05', '2025-08-14 07:57:33', '2025-08-14 07:57:33', 18),
(19, 'Cenobia Cecilia Orta Álvarez', 20000, '2025-01-05', '2025-08-14 07:57:34', '2025-08-14 07:57:34', 18),
(20, 'Amparo del Carmen Martínez Polo', 262000, '2025-01-05', '2025-08-14 07:57:34', '2025-08-14 07:57:34', 18),
(21, 'Enilecto Antonio Vargas Palmira', 5000, '2025-01-05', '2025-08-14 07:57:35', '2025-08-14 07:57:35', 18),
(22, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-05', '2025-08-14 07:57:35', '2025-08-14 07:57:35', 18),
(23, 'Diezmo', 550000, '2025-01-05', '2025-08-14 07:57:35', '2025-08-14 07:57:35', 18),
(24, 'Ledys Margoth Gómez cordero', 35000, '2025-01-05', '2025-08-14 07:57:36', '2025-08-14 07:57:36', 18),
(25, 'Livert Diaz', 15000, '2025-01-05', '2025-08-14 07:57:36', '2025-08-14 07:57:36', 18),
(26, 'Ana Cecilia Gómez cordero', 20000, '2025-01-05', '2025-08-14 07:57:36', '2025-08-14 07:57:36', 18),
(27, 'Sandra Milena Marquez Pacheco', 9000, '2025-01-05', '2025-08-14 07:57:36', '2025-08-14 07:57:36', 18),
(28, 'Jazmín Valeria Márquez pacheco', 38000, '2025-01-05', '2025-08-14 07:57:36', '2025-08-14 07:57:36', 18),
(29, 'Luis Emilio Mosquera Mosquera', 12000, '2025-01-05', '2025-08-14 07:57:37', '2025-08-14 07:57:37', 18),
(30, 'Katia Cuello', 20000, '2025-01-05', '2025-08-14 07:57:37', '2025-08-14 07:57:37', 18),
(31, 'Famila Arrieta Estrada', 60000, '2025-01-05', '2025-08-14 07:57:37', '2025-08-14 07:57:37', 18),
(32, 'Osiris del Carmen barrera Martínez', 120000, '2025-01-05', '2025-08-14 07:57:37', '2025-08-14 07:57:37', 18),
(33, 'Ofrenda', 154500, '2025-01-05', '2025-08-14 07:57:37', '2025-08-14 07:57:37', 18),
(54, 'Héctor Enrique Olivera  Ibáñez', 152000, '2025-01-12', '2025-08-14 16:54:17', '2025-08-14 16:54:17', 20),
(55, 'Diezmo', 8000, '2025-01-12', '2025-08-14 16:54:17', '2025-08-14 16:54:17', 20),
(56, 'Armando Antonio Conde Díaz', 300000, '2025-01-12', '2025-08-14 16:54:18', '2025-08-14 16:54:18', 20),
(57, 'Familia Álvarez Ramos', 300000, '2025-01-12', '2025-08-14 16:54:18', '2025-08-14 16:54:18', 20),
(58, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-12', '2025-08-14 16:54:18', '2025-08-14 16:54:18', 20),
(59, 'Familia Barrera L', 40100, '2025-01-12', '2025-08-14 16:54:19', '2025-08-14 16:54:19', 20),
(60, 'Enilecto Antonio Vargas Palmira', 3000, '2025-01-12', '2025-08-14 16:54:19', '2025-08-14 16:54:19', 20),
(61, 'Fernando Urrutia', 47000, '2025-01-12', '2025-08-14 16:54:20', '2025-08-14 16:54:20', 20),
(62, 'Diezmo', 20000, '2025-01-12', '2025-08-14 16:54:20', '2025-08-14 16:54:20', 20),
(63, 'Diezmo', 4000, '2025-01-12', '2025-08-14 16:54:20', '2025-08-14 16:54:20', 20),
(64, 'Familia Guevara Mora', 164000, '2025-01-12', '2025-08-14 16:54:20', '2025-08-14 16:54:20', 20),
(65, 'Diezmo', 10000, '2025-01-12', '2025-08-14 16:54:20', '2025-08-14 16:54:20', 20),
(66, 'Gregorio Rodríguez conde', 61200, '2025-01-12', '2025-08-14 16:54:21', '2025-08-14 16:54:21', 20),
(67, 'Diezmo', 130000, '2025-01-12', '2025-08-14 16:54:21', '2025-08-14 16:54:21', 20),
(68, 'Fanny del Carmen De la Ossa feria', 25000, '2025-01-12', '2025-08-14 16:54:21', '2025-08-14 16:54:21', 20),
(69, 'Livert Diaz', 12000, '2025-01-12', '2025-08-14 16:54:21', '2025-08-14 16:54:21', 20),
(70, 'Nelida del Carmen Muñoz Rivas', 40000, '2025-01-12', '2025-08-14 16:54:22', '2025-08-14 16:54:22', 20),
(71, 'Jazmín Valeria Márquez pacheco', 6000, '2025-01-12', '2025-08-14 16:54:22', '2025-08-14 16:54:22', 20),
(72, 'Yesenia Judith Olivera Ibáñez', 40000, '2025-01-12', '2025-08-14 16:54:22', '2025-08-14 16:54:22', 20),
(73, 'Ofrenda', 83300, '2025-01-12', '2025-08-14 16:54:22', '2025-08-14 16:54:22', 20),
(74, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-19', '2025-08-14 17:11:21', '2025-08-14 17:11:21', 21),
(75, 'Katia Cuello', 20000, '2025-01-19', '2025-08-14 17:11:21', '2025-08-14 17:11:21', 21),
(76, 'Edith del socorro pastrana González', 10000, '2025-01-19', '2025-08-14 17:11:21', '2025-08-14 17:11:21', 21),
(77, 'Luz Mary Cabrera', 10000, '2025-01-19', '2025-08-14 17:11:22', '2025-08-14 17:11:22', 21),
(78, 'Fernando Urrutia', 38000, '2025-01-19', '2025-08-14 17:11:22', '2025-08-14 17:11:22', 21),
(79, 'Eduardo Manuel Miranda Acosta', 100000, '2025-01-19', '2025-08-14 17:11:22', '2025-08-14 17:11:22', 21),
(80, 'Diezmo', 8000, '2025-01-19', '2025-08-14 17:11:22', '2025-08-14 17:11:22', 21),
(81, 'Cenobia Cecilia Orta Álvarez', 20000, '2025-01-19', '2025-08-14 17:11:23', '2025-08-14 17:11:23', 21),
(82, 'Linis Liney Herazo Vega', 200000, '2025-01-19', '2025-08-14 17:11:23', '2025-08-14 17:11:23', 21),
(83, 'Diezmo', 20000, '2025-01-19', '2025-08-14 17:11:23', '2025-08-14 17:11:23', 21),
(84, 'Gadiela Gómez Gómez', 1507000, '2025-01-19', '2025-08-14 17:11:23', '2025-08-14 17:11:23', 21),
(85, 'Enilecto Antonio Vargas Palmira', 10000, '2025-01-19', '2025-08-14 17:11:24', '2025-08-14 17:11:24', 21),
(86, 'Carmen Esther Petro Rosso', 49000, '2025-01-19', '2025-08-14 17:11:24', '2025-08-14 17:11:24', 21),
(87, 'Familia Álvarez Ramos', 100000, '2025-01-19', '2025-08-14 17:11:24', '2025-08-14 17:11:24', 21),
(88, 'Ana Cecilia Gómez cordero', 30000, '2025-01-19', '2025-08-14 17:11:24', '2025-08-14 17:11:24', 21),
(89, 'Livert Diaz', 15300, '2025-01-19', '2025-08-14 17:11:24', '2025-08-14 17:11:24', 21),
(90, 'Gloria Elena Valencia molina', 115000, '2025-01-19', '2025-08-14 17:11:25', '2025-08-14 17:11:25', 21),
(91, 'Familia Arrieta Estrada', 70000, '2025-01-19', '2025-08-14 17:11:25', '2025-08-14 17:11:25', 21),
(92, 'Grisalda Fabiola berrocal acosta', 100000, '2025-01-19', '2025-08-14 17:11:25', '2025-08-14 17:11:25', 21),
(93, 'Ledys Margoth Gómez cordero', 10000, '2025-01-19', '2025-08-14 17:11:25', '2025-08-14 17:11:25', 21),
(94, 'Claudia patricia Bustamante flores', 480000, '2025-01-19', '2025-08-14 17:11:25', '2025-08-14 17:11:25', 21),
(95, 'Santiago miguel Begambre olivera', 20000, '2025-01-19', '2025-08-14 17:11:25', '2025-08-14 17:11:25', 21),
(96, 'Omar Martinez Barrera', 40900, '2025-01-19', '2025-08-14 17:11:26', '2025-08-14 17:11:26', 21),
(97, 'Daniela Olivera Paez', 6500, '2025-01-19', '2025-08-14 17:11:26', '2025-08-14 17:11:26', 21),
(98, 'Ofrenda', 61600, '2025-01-19', '2025-08-14 17:11:26', '2025-08-14 17:11:26', 21),
(120, 'Familia Mora Agamez', 240000, '2025-01-26', '2025-08-14 21:59:27', '2025-08-14 21:59:27', 23),
(121, 'Familia Álvarez', 100000, '2025-01-26', '2025-08-14 21:59:27', '2025-08-14 21:59:27', 23),
(122, 'Fernando Urrutia', 38100, '2025-01-26', '2025-08-14 21:59:27', '2025-08-14 21:59:27', 23),
(123, 'Julio Cesar Passos Barrera', 10000, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(124, 'Ana Cecilia Gómez cordero', 24000, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(125, 'Familia Barrera', 35200, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(126, 'Nelida del Carmen Muñoz Rivas', 90000, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(127, 'Eliana Gómez Gómez', 150000, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(128, 'Santiago miguel Begambre olivera', 20000, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(129, 'Livert Diaz', 18000, '2025-01-26', '2025-08-14 21:59:28', '2025-08-14 21:59:28', 23),
(130, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-26', '2025-08-14 21:59:29', '2025-08-14 21:59:29', 23),
(131, 'Edith del socorro pastrana González', 10000, '2025-01-26', '2025-08-14 21:59:29', '2025-08-14 21:59:29', 23),
(132, 'Armando Antonio Conde Díaz', 50000, '2025-01-26', '2025-08-14 21:59:29', '2025-08-14 21:59:29', 23),
(133, 'Marta Irene mieles castro', 50500, '2025-01-26', '2025-08-14 21:59:29', '2025-08-14 21:59:29', 23),
(134, 'Diezmo', 6500, '2025-01-26', '2025-08-14 21:59:29', '2025-08-14 21:59:29', 23),
(135, 'Jazmín Valeria Márquez pacheco', 11000, '2025-01-26', '2025-08-14 21:59:30', '2025-08-14 21:59:30', 23),
(136, 'Rubí del Carmen Suarez roqueme', 40000, '2025-01-26', '2025-08-14 21:59:30', '2025-08-14 21:59:30', 23),
(137, 'Katia Cuello', 20000, '2025-01-26', '2025-08-14 21:59:31', '2025-08-14 21:59:31', 23),
(138, 'Luis Emilio Mosquera Mosquera', 16000, '2025-01-26', '2025-08-14 21:59:31', '2025-08-14 21:59:31', 23),
(139, 'Jose Ruiz Valencia', 298600, '2025-01-26', '2025-08-14 21:59:31', '2025-08-14 21:59:31', 23),
(140, 'Ofrenda', 70400, '2025-01-26', '2025-08-14 21:59:31', '2025-08-14 21:59:31', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `libro_contables`
--

CREATE TABLE `libro_contables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `mes_libro` tinyint(3) UNSIGNED NOT NULL,
  `anio_libro` smallint(5) UNSIGNED NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `libro_contables`
--

INSERT INTO `libro_contables` (`id`, `nombre`, `mes_libro`, `anio_libro`, `monto`, `estado_id`, `created_at`, `updated_at`) VALUES
(2, 'Enero 2025', 1, 2025, 0.00, 1, '2025-08-24 23:24:50', '2025-08-24 23:24:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_contable_estados`
--

CREATE TABLE `libro_contable_estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `libro_contable_estados`
--

INSERT INTO `libro_contable_estados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Abierto', '2025-08-24 23:24:26', '2025-08-24 23:24:26'),
(2, 'Cerrado', '2025-08-24 23:24:26', '2025-08-24 23:24:26'),
(3, 'Aprobado', '2025-08-24 23:24:26', '2025-08-24 23:24:26');

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
  `estado` enum('activo','inactivo','con excusa','borrado','ausente','fallecido','trasladado','no bautizado','disciplina') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id`, `nombres`, `apellidos`, `numero_identificacion`, `email`, `telefono`, `fecha_nacimiento`, `edad`, `direccion`, `barrio`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Augusto Daniel', 'Viloria Macia', '15614601', 'pastorco626@gmail.com', '3144030728', '1969-06-25', 56, 'MZ J Lot 17', '2 de septiembre', 'activo', '2025-07-03 08:55:59', '2025-08-08 07:49:58'),
(2, 'Tomas Andrés', 'Guevara Ramos', '1063358895', 'tomasguevara2024@gmail.com', '3218721623', '1990-01-03', 35, 'carrera 8G # 6c-30 sur', 'Araujo Viejos', 'activo', '2025-07-28 02:34:17', '2025-07-28 02:34:17'),
(5, 'Eduardo Manuel', 'Miranda Acosta', '1007676059', NULL, '3007892707', NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:33:43', '2025-08-13 22:33:43'),
(6, 'Fernando', 'Urrutia', '1098789', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:34:46', '2025-08-13 22:34:46'),
(7, 'Blanca Virginia', 'García Tapias', '25801834', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:35:38', '2025-08-13 22:35:38'),
(8, 'Cenobia Cecilia', 'Orta Álvarez', '50911270', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:37:45', '2025-08-13 22:37:45'),
(9, 'Amparo del Carmen', 'Martínez Polo', '34992445', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:39:28', '2025-08-13 22:39:28'),
(10, 'Enilecto Antonio', 'Vargas Palmira', '15580128', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:40:20', '2025-08-13 22:40:20'),
(11, 'Olegario Eugenio', 'Arrieta escorcia', '78696882', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:41:02', '2025-08-13 22:41:02'),
(12, 'Ledys Margoth', 'Gómez cordero', '25873256', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:41:39', '2025-08-13 22:41:39'),
(13, 'Livert', 'Diaz', '1567876', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:42:30', '2025-08-13 22:42:30'),
(14, 'Ana Cecilia', 'Gómez cordero', '25870650', NULL, NULL, '1963-05-28', 62, NULL, NULL, 'activo', '2025-08-13 22:43:54', '2025-08-13 22:43:54'),
(15, 'Sandra Milena', 'Marquez Pacheco', '25786924', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:44:33', '2025-08-13 22:44:33'),
(16, 'Jazmín Valeria', 'Márquez pacheco', '34983444', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:46:01', '2025-08-13 22:46:01'),
(17, 'Luis Emilio', 'Mosquera Mosquera', '145678989', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:46:58', '2025-08-13 22:46:58'),
(18, 'Katia', 'Cuello', '25456654', NULL, NULL, NULL, NULL, NULL, NULL, 'no bautizado', '2025-08-13 22:47:27', '2025-08-14 08:29:51'),
(19, 'Edith del socorro', 'pastrana González', '34972633', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:50:48', '2025-08-13 22:50:48'),
(20, 'Luz Mary', 'Cabrera', '14567876', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:51:17', '2025-08-13 22:51:17'),
(21, 'Linis Liney', 'Herazo Vega', '12345678', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:51:52', '2025-08-13 22:51:52'),
(22, 'Carmen Esther', 'Petro Rosso', '50909601', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:52:41', '2025-08-13 22:52:41'),
(23, 'Gloria Elena', 'Valencia molina', '34992043', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:53:32', '2025-08-13 22:53:32'),
(24, 'Grisalda Fabiola', 'berrocal acosta', '26160647', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:54:04', '2025-08-13 22:54:04'),
(25, 'Claudia patricia', 'Bustamante flores', '1067883527', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:54:48', '2025-08-13 22:54:48'),
(26, 'Santiago miguel', 'Begambre olivera', '78688388', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:55:24', '2025-08-13 22:55:24'),
(27, 'Omar', 'Martinez Barrera', '123455322', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:55:59', '2025-08-13 22:55:59'),
(28, 'Osiris del Carmen', 'barrera Martínez', '1067853192', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:56:30', '2025-08-13 22:56:30'),
(29, 'Daniela', 'Olivera Paez', '100368976542', NULL, NULL, NULL, NULL, NULL, NULL, 'no bautizado', '2025-08-13 22:57:00', '2025-08-14 08:30:28'),
(30, 'Julio Cesar', 'Passos Barrera', '15098753', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:59:03', '2025-08-13 22:59:03'),
(31, 'Nelida del Carmen', 'Muñoz Rivas', '50916781', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 22:59:42', '2025-08-13 22:59:42'),
(32, 'Eliana', 'Gómez Gómez', '10098333833', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 23:00:34', '2025-08-13 23:00:34'),
(33, 'Armando Antonio', 'Conde Díaz', '6880334', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 23:01:09', '2025-08-13 23:01:09'),
(34, 'Marta Irene', 'mieles castro', '50937352', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 23:01:44', '2025-08-13 23:01:44'),
(35, 'Rubí del Carmen', 'Suarez roqueme', '50908699', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-13 23:02:34', '2025-08-13 23:02:34'),
(36, 'Héctor Enrique', 'Olivera  Ibáñez', '78747427', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-14 07:34:50', '2025-08-14 07:34:50'),
(37, 'Gregorio', 'Rodríguez conde', '15612660', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-14 07:36:35', '2025-08-14 07:36:35'),
(38, 'Fanny del Carmen', 'De la Ossa feria', '50890768', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-14 07:37:40', '2025-08-14 07:37:40'),
(39, 'Yesenia Judith', 'Olivera Ibáñez', '25784845', NULL, NULL, NULL, NULL, NULL, NULL, 'activo', '2025-08-14 07:39:39', '2025-08-14 08:30:59'),
(40, 'Gadiela', 'Gómez Gómez', '1345667', NULL, NULL, NULL, NULL, NULL, NULL, 'no bautizado', '2025-08-14 17:01:34', '2025-08-14 17:03:03');

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
(20, '2025_07_25_115357_create_password_reset_tokens_table', 14),
(21, '2025_07_29_025907_create_reportes_table', 15),
(22, '2025_08_16_043538_create_egresos_table', 15),
(23, '2025_08_23_162933_create_libro_contable_estados_table', 15),
(24, '2025_08_23_163026_create_libro_contables_table', 15);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `libro_contable_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `presupuesto_id`, `fecha`, `consecutivo`, `tipo`, `valor`, `saldo`, `detalle`, `concepto`, `casilla`, `created_at`, `updated_at`, `libro_contable_id`) VALUES
(18, NULL, '2025-01-05', NULL, 'ingreso', 1761500.00, 1761500.00, 'Templo Unido', 'Diezmos 05  enero 2025', NULL, '2025-08-14 07:57:32', '2025-08-14 07:57:32', NULL),
(20, NULL, '2025-01-12', '46', 'ingreso', 1455600.00, 3217100.00, 'Templo Unido', 'Diezmos 12 enero 2025', NULL, '2025-08-14 16:54:16', '2025-08-21 08:58:30', NULL),
(21, NULL, '2025-01-19', NULL, 'ingreso', 3051300.00, 6268400.00, 'Templo Unido', 'Diezmos 19 enero 2025', NULL, '2025-08-14 17:11:20', '2025-08-14 17:11:20', NULL),
(23, NULL, '2025-01-26', '45', 'ingreso', 1308300.00, 8885000.00, 'Templo Unido', 'Diezmos 26 enero 2025', NULL, '2025-08-14 21:59:27', '2025-08-21 08:57:45', NULL),
(34, 22, '2025-01-10', 'TMP-20250816035046-NJD4', 'egreso', 1000.00, 8744000.00, 'Daniel Viloria', 'Bonificación Pastor 2', 'Desarrollo', '2025-08-16 08:50:46', '2025-08-16 08:50:46', NULL),
(35, 5, '2025-01-10', 'TMP-20250816035046-NJD4', 'egreso', 200.00, 8743800.00, 'Daniel Viloria', 'Bonificación Pastor 2', 'Prestación Social', '2025-08-16 08:50:46', '2025-08-16 08:50:46', NULL),
(36, 11, '2025-06-10', '13', 'egreso', 9000.00, 8742800.00, 'Daniel Viloria', 'Sueldo del Pastor', 'Gastos de Representación', '2025-08-16 09:01:21', '2025-08-19 22:49:56', NULL),
(41, 13, '2025-08-14', '23', 'egreso', 2000000.00, 6722600.00, 'Templo Unido', 'ministerio', 'Estudios Teológicos', '2025-08-16 09:20:23', '2025-08-21 08:58:05', NULL),
(42, 18, '2025-08-14', '23', 'egreso', 1000000.00, 4722600.00, 'Templo Unido', 'ministerio', 'Ministerio Infantil', '2025-08-16 09:20:24', '2025-08-16 10:31:28', NULL),
(46, 15, '2025-01-15', NULL, 'egreso', 100.00, -100.00, 'Daniel Viloria', 'Bonificación Pastor', 'Discipulado', '2025-08-25 04:28:50', '2025-08-25 04:28:50', 2);

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
(3, 'Sueldo Pastor', 'Administración Pastoral', 2860000.00, '2025', 'Héctor Olivera', '2025-07-05 22:01:49', '2025-08-10 07:46:44'),
(5, 'Prestación Social', 'Administración Pastoral', 550550.00, '2025', 'Héctor Olivera', '2025-08-15 06:59:34', '2025-08-15 06:59:34'),
(6, 'Seguridad Social', 'Administración Pastoral', 593300.00, '2025', 'Héctor Olivera', '2025-08-15 07:02:13', '2025-08-15 07:02:13'),
(7, 'Asesorías Constables', 'Servicio', 200000.00, '2025', 'Héctor Olivera', '2025-08-15 07:04:28', '2025-08-15 07:04:28'),
(8, 'Arriendo y servicio Públicos', 'Servicio', 1619000.00, '2025', 'Héctor Olivera', '2025-08-15 07:05:30', '2025-08-15 07:05:30'),
(9, 'Circuito', 'Aportes Denominacionales', 100000.00, '2025', 'Héctor Olivera', '2025-08-15 07:07:25', '2025-08-15 07:07:25'),
(10, 'Zona 13%', 'Aportes Denominacionales', 950000.00, '2025', 'Héctor Olivera', '2025-08-15 07:09:39', '2025-08-15 07:09:39'),
(11, 'Gastos de Representación', 'Administración Pastoral', 100000.00, '2025', 'Héctor Olivera', '2025-08-15 07:13:38', '2025-08-15 07:13:38'),
(12, 'Celaduría', 'Servicio', 300000.00, '2025', 'Héctor Olivera', '2025-08-15 07:17:13', '2025-08-15 07:17:13'),
(13, 'Estudios Teológicos', 'Ministerio y Formación', 50000.00, '2025', 'Tomas Guevara', '2025-08-15 07:18:23', '2025-08-15 07:18:23'),
(14, 'Adoración', 'Ministerio y Formación', 100000.00, '2025', 'Kelly Cuello', '2025-08-15 07:19:47', '2025-08-15 07:19:47'),
(15, 'Discipulado', 'Ministerio y Formación', 100000.00, '2025', 'Tomas Guevara', '2025-08-15 07:20:26', '2025-08-15 07:20:26'),
(16, 'Servicio', 'Servicio', 420000.00, '2025', 'Gregorio Rodríguez', '2025-08-15 07:21:24', '2025-08-15 07:21:24'),
(17, 'Compañerismo', 'Ministerio y Formación', 100000.00, '2025', 'Nélida Muñoz', '2025-08-15 07:22:17', '2025-08-15 07:22:17'),
(18, 'Ministerio Infantil', 'Ministerio y Formación', 250000.00, '2025', 'Lucely Agamez', '2025-08-15 07:23:21', '2025-08-15 07:23:21'),
(19, 'Evangelismo', 'Ministerio y Formación', 200000.00, '2025', 'Julio Passos R', '2025-08-15 07:24:43', '2025-08-15 07:24:43'),
(20, 'Danza', 'Ministerio y Formación', 50000.00, '2025', 'Carol Pastrana', '2025-08-15 07:26:50', '2025-08-15 07:26:50'),
(21, 'Apropiación Convención Pastoral', 'Administración Pastoral', 200000.00, '2025', 'Héctor Olivera', '2025-08-15 07:28:29', '2025-08-15 07:28:29'),
(22, 'Desarrollo', 'Otros', 188000.00, '2025', 'Ancianos', '2025-08-15 07:29:05', '2025-08-15 07:29:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` date NOT NULL,
  `autor` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('ouLFcp2VNDrqGLdwf8DIlRA5UGvekMjFkErj4Var', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQTB0UXhPaG11V0xaV2s3VW8wRXA4OTVEMnlwRll4TzNqODRPZlBvQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tb3ZpbWllbnRvcy80Ni9kZXRhbGxlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1756078141);

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
(4, 'Tomas Guevara', '1063358895', 'tomasguevara2024@gmail.com', '$2y$12$3yIl8ffYloXpsddgvTc7UelWqEfZmtWqq1TwcpxiqFvzuwMn/qYWq', 'anciano', '2025-07-03 08:31:06', '2025-08-12 03:30:32', 'activo'),
(5, 'Daniel V', '15614601', 'pastorco626@gmail.com', '$2y$12$5ZJGqT0SDqh2I2UkXatEm.yTHOgCOHy7j.lprMPTYf6YsJpjNEWzi', 'pastor', '2025-07-03 08:37:42', '2025-08-08 07:35:54', 'activo'),
(6, 'Fernando Ruiz', '10776177', 'Fiscal@gmail.com', '$2y$12$b.4lnC.s0KOwk4YE.j47JeqXw63pA87SJ1k1CRaloR5T3CiQ8tiTO', 'fiscal', '2025-08-12 03:34:22', '2025-08-12 03:34:22', 'activo'),
(7, 'Iván Olivera', '6866245', 'tesorero@gmail.com', '$2y$12$GEpa6r46EFQE5os9Vm1CnO8P0mtv22UMT9Q0xxpYs2fACEB1PN3ke', 'tesorero', '2025-08-12 03:37:57', '2025-08-12 03:37:57', 'activo'),
(8, 'Eliana Gomez', '1066373737', 'secretaria@gmail.com', '$2y$12$nyjxCHmZ03gyhAUt2TM5.eOBc0j9okMIWiAQQ4uaZWgoxFc9dQrDO', 'secretario', '2025-08-12 03:39:02', '2025-08-12 03:39:02', 'activo');

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
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `libro_contables`
--
ALTER TABLE `libro_contables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro_contables_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `libro_contable_estados`
--
ALTER TABLE `libro_contable_estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libro_contable_estados_nombre_unique` (`nombre`);

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
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `libro_contables`
--
ALTER TABLE `libro_contables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libro_contable_estados`
--
ALTER TABLE `libro_contable_estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `diezmos`
--
ALTER TABLE `diezmos`
  ADD CONSTRAINT `diezmos_movimiento_id_foreign` FOREIGN KEY (`movimiento_id`) REFERENCES `movimientos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `libro_contables`
--
ALTER TABLE `libro_contables`
  ADD CONSTRAINT `libro_contables_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `libro_contable_estados` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_presupuesto_id_foreign` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuestos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
