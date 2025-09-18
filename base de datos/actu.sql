-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2025 a las 14:25:19
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

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_filcal@gmail.com|127.0.0.1', 'i:1;', 1757902019),
('laravel_cache_filcal@gmail.com|127.0.0.1:timer', 'i:1757902019;', 1757902019);

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
(160, 'Familia Carvajal Ibarra', 65000, '2025-01-05', '2025-09-02 00:14:14', '2025-09-02 00:14:14', 72),
(161, 'Eduardo Manuel Miranda Acosta', 100000, '2025-01-05', '2025-09-02 00:14:15', '2025-09-02 00:14:15', 72),
(162, 'Fernando Urrutia', 53000, '2025-01-05', '2025-09-02 00:14:15', '2025-09-02 00:14:15', 72),
(163, 'Familia Barrera Lozada', 49500, '2025-01-05', '2025-09-02 00:14:15', '2025-09-02 00:14:15', 72),
(164, 'Diezmo', 7500, '2025-01-05', '2025-09-02 00:14:15', '2025-09-02 00:14:15', 72),
(165, 'Familia Viloria Yánez', 150000, '2025-01-05', '2025-09-02 00:14:15', '2025-09-02 00:14:15', 72),
(166, 'Blanca Virginia García Tapias', 6000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(167, 'Cenobia Cecilia Orta Álvarez', 20000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(168, 'Amparo del Carmen Martínez Polo', 262000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(169, 'Enilecto Antonio Vargas Palmira', 5000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(170, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(171, 'Diezmo', 550000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(172, 'Ledys Margoth Gómez cordero', 35000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(173, 'Livert Diaz', 15000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(174, 'Ana Cecilia Gómez cordero', 20000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(175, 'Sandra Milena Marquez Pacheco', 9000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(176, 'Jazmín Valeria Márquez pacheco', 38000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(177, 'Luis Emilio Mosquera Mosquera', 12000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(178, 'Katia Cuello', 20000, '2025-01-05', '2025-09-02 00:14:16', '2025-09-02 00:14:16', 72),
(179, 'Familia Arrieta Estrada', 60000, '2025-01-05', '2025-09-02 00:14:17', '2025-09-02 00:14:17', 72),
(180, 'Osiris del Carmen barrera Martínez', 120000, '2025-01-05', '2025-09-02 00:14:17', '2025-09-02 00:14:17', 72),
(181, 'Ofrenda', 154000, '2025-01-05', '2025-09-02 00:14:17', '2025-09-02 00:14:17', 72),
(202, 'Héctor Enrique Olivera  Ibáñez', 152000, '2025-01-12', '2025-09-04 07:47:33', '2025-09-04 07:47:33', 81),
(203, 'Diezmo', 8000, '2025-01-12', '2025-09-04 07:47:33', '2025-09-04 07:47:33', 81),
(204, 'Armando Antonio Conde Díaz', 300000, '2025-01-12', '2025-09-04 07:47:33', '2025-09-04 07:47:33', 81),
(205, 'Familia Álvarez Ramos', 300000, '2025-01-12', '2025-09-04 07:47:33', '2025-09-04 07:47:33', 81),
(206, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-12', '2025-09-04 07:47:33', '2025-09-04 07:47:33', 81),
(207, 'Familia Barrera Lozano', 40100, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(208, 'Enilecto Antonio Vargas Palmira', 3000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(209, 'Fernando Urrutia', 47000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(210, 'Diezmo', 20000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(211, 'Diezmo', 4000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(212, 'Familia Guevara Mora', 164000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(213, 'Diezmo', 10000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(214, 'Gregorio Rodríguez conde', 61200, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(215, 'Diezmo', 130000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(216, 'Fanny del Carmen De la Ossa feria', 25000, '2025-01-12', '2025-09-04 07:47:34', '2025-09-04 07:47:34', 81),
(217, 'Livert Diaz', 12000, '2025-01-12', '2025-09-04 07:47:35', '2025-09-04 07:47:35', 81),
(218, 'Nelida del Carmen Muñoz Rivas', 40000, '2025-01-12', '2025-09-04 07:47:35', '2025-09-04 07:47:35', 81),
(219, 'Jazmín Valeria Márquez pacheco', 6000, '2025-01-12', '2025-09-04 07:47:35', '2025-09-04 07:47:35', 81),
(220, 'Yesenia Judith Olivera Ibáñez', 40000, '2025-01-12', '2025-09-04 07:47:35', '2025-09-04 07:47:35', 81),
(221, 'Ofrenda', 83300, '2025-01-12', '2025-09-04 07:47:35', '2025-09-04 07:47:35', 81),
(222, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-19', '2025-09-08 20:34:15', '2025-09-08 20:34:15', 129),
(223, 'Katia Cuello', 20000, '2025-01-19', '2025-09-08 20:34:15', '2025-09-08 20:34:15', 129),
(224, 'Edith del socorro pastrana González', 10000, '2025-01-19', '2025-09-08 20:34:15', '2025-09-08 20:34:15', 129),
(225, 'Luz Mary Cabrera', 10000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(226, 'Fernando Urrutia', 38000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(227, 'Eduardo Manuel Miranda Acosta', 100000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(228, 'Diezmo', 8000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(229, 'Cenobia Cecilia Orta Álvarez', 20000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(230, 'Linis Liney Herazo Vega', 200000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(231, 'Gadiela Gómez Gómez', 1507000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(232, 'Diezmo', 20000, '2025-01-19', '2025-09-08 20:34:16', '2025-09-08 20:34:16', 129),
(233, 'Enilecto Antonio Vargas Palmira', 10000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(234, 'Carmen Esther Petro Rosso', 49000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(235, 'Familia Ramos Álvarez', 100000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(236, 'Ana Cecilia Gómez cordero', 30000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(237, 'Livert Diaz', 15300, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(238, 'Gloria Elena Valencia molina', 115000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(239, 'Familia Arrieta Estrada', 70000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(240, 'Grisalda Fabiola berrocal acosta', 100000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(241, 'Ledys Margoth Gómez cordero', 10000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(242, 'Claudia patricia Bustamante flores', 480000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(243, 'Santiago miguel Begambre olivera', 20000, '2025-01-19', '2025-09-08 20:34:17', '2025-09-08 20:34:17', 129),
(244, 'Omar Martinez Barrera', 40900, '2025-01-19', '2025-09-08 20:34:18', '2025-09-08 20:34:18', 129),
(245, 'Daniela Olivera Paez', 6500, '2025-01-19', '2025-09-08 20:34:18', '2025-09-08 20:34:18', 129),
(246, 'Ofrenda', 61600, '2025-01-19', '2025-09-08 20:34:18', '2025-09-08 20:34:18', 129),
(247, 'Familia Mora Agamez', 240000, '2025-01-26', '2025-09-08 22:38:43', '2025-09-08 22:38:43', 135),
(248, 'Familia Ramos Álvarez', 100000, '2025-01-26', '2025-09-08 22:38:43', '2025-09-08 22:38:43', 135),
(249, 'Fernando Urrutia', 38100, '2025-01-26', '2025-09-08 22:38:43', '2025-09-08 22:38:43', 135),
(250, 'Julio Cesar Passos Barrera', 10000, '2025-01-26', '2025-09-08 22:38:43', '2025-09-08 22:38:43', 135),
(251, 'Ana Cecilia Gómez cordero', 24000, '2025-01-26', '2025-09-08 22:38:43', '2025-09-08 22:38:43', 135),
(252, 'Familia Barrera', 35200, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(253, 'Nelida del Carmen Muñoz Rivas', 90000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(254, 'Eliana Gómez Gómez', 150000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(255, 'Santiago miguel Begambre olivera', 20000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(256, 'Livert Diaz', 18000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(257, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(258, 'Edith del socorro pastrana González', 10000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(259, 'Armando Antonio Conde Díaz', 50000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(260, 'Marta Irene mieles castro', 50500, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(261, 'Diezmo', 6500, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(262, 'Jazmín Valeria Márquez pacheco', 11000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(263, 'Rubí del Carmen Suarez roqueme', 40000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(264, 'Katia Cuello', 20000, '2025-01-26', '2025-09-08 22:38:44', '2025-09-08 22:38:44', 135),
(265, 'Luis Emilio Mosquera Mosquera', 16000, '2025-01-26', '2025-09-08 22:38:45', '2025-09-08 22:38:45', 135),
(266, 'José Ruiz', 298600, '2025-01-26', '2025-09-08 22:38:45', '2025-09-08 22:38:45', 135),
(267, 'Ofrenda', 70400, '2025-01-26', '2025-09-08 22:38:45', '2025-09-08 22:38:45', 135),
(268, 'Diezmo', 50000, '2025-02-28', '2025-09-15 17:20:24', '2025-09-15 17:20:24', 146),
(269, 'Diezmo', 40000, '2025-02-28', '2025-09-15 17:20:24', '2025-09-15 17:20:24', 146),
(270, 'Fernando Urrutia', 75000, '2025-02-28', '2025-09-15 17:20:24', '2025-09-15 17:20:24', 146),
(271, 'Olegario Eugenio Arrieta escorcia', 10000, '2025-02-28', '2025-09-15 17:20:24', '2025-09-15 17:20:24', 146),
(272, 'Familia Passos Velasquez', 300200, '2025-02-28', '2025-09-15 17:20:24', '2025-09-15 17:20:24', 146),
(273, 'Sandra Milena Marquez Pacheco', 12700, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(274, 'Enilecto Antonio Vargas Palmira', 5000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(275, 'Sirley Benítez', 50000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(276, 'Fanny del Carmen De la Ossa feria', 30000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(277, 'Eliana Gómez Gómez', 170000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(278, 'Familia Barrera Losada', 47700, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(279, 'Amparo del Carmen Martínez Polo', 34000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(280, 'Livert Diaz', 22700, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(281, 'Diezmo', 23000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(282, 'Familia Guevara Mora', 272000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(283, 'Diezmo', 6000, '2025-02-28', '2025-09-15 17:20:25', '2025-09-15 17:20:25', 146),
(284, 'Familia Ramos', 150000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(285, 'Nohemí Pérez', 25000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(286, 'Familia Arrieta Estrada', 70000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(287, 'Cenobia Cecilia Orta Álvarez', 20000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(288, 'Familia Viloria Yánez', 810000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(289, 'Familia Carvajal Ibarra', 73000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(290, 'Yesenia Judith Olivera Ibáñez', 40000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(291, 'Héctor Enrique Olivera  Ibáñez', 245500, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(292, 'Osiris del Carmen barrera Martínez', 20000, '2025-02-28', '2025-09-15 17:20:26', '2025-09-15 17:20:26', 146),
(293, 'Ofrenda', 60000, '2025-02-28', '2025-09-15 17:20:27', '2025-09-15 17:20:27', 146),
(294, 'María Martínez', 50000, '2025-02-09', '2025-09-15 22:03:24', '2025-09-15 22:03:24', 151),
(295, 'Luis Emilio Mosquera Mosquera', 14000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(296, 'Jazmín Valeria Márquez pacheco', 26000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(297, 'Amparo del Carmen Martínez Polo', 50000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(298, 'Gregorio Rodríguez conde', 37500, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(299, 'Edith del socorro pastrana González', 30000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(300, 'Diezmo', 24000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(301, 'Diezmo', 4000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(302, 'Diezmo', 590000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(303, 'Fernando Urrutia', 61000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(304, 'Ana Cecilia Gómez cordero', 60000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(305, 'Gloria Elena Valencia molina', 90000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(306, 'Enilecto Antonio Vargas Palmira', 5000, '2025-02-09', '2025-09-15 22:03:25', '2025-09-15 22:03:25', 151),
(307, 'Livert Diaz', 23200, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(308, 'Santiago miguel Begambre olivera', 10000, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(309, 'Sandra Milena Marquez Pacheco', 5000, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(310, 'Familia Ramos', 150000, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(311, 'Linis Liney Herazo Vega', 250000, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(312, 'Nelly Sánchez', 50000, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(313, 'Familia Barrera Losada', 36600, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(314, 'Judith Ibañez', 10000, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(315, 'Ofrenda', 134200, '2025-02-09', '2025-09-15 22:03:26', '2025-09-15 22:03:26', 151),
(316, 'Diezmo', 2000, '2025-02-16', '2025-09-16 04:28:26', '2025-09-16 04:28:26', 156),
(317, 'Sandra Milena Marquez Pacheco', 12000, '2025-02-16', '2025-09-16 04:28:26', '2025-09-16 04:28:26', 156),
(318, 'Luis Emilio Mosquera Mosquera', 12000, '2025-02-16', '2025-09-16 04:28:26', '2025-09-16 04:28:26', 156),
(319, 'Luz Mary Cabrera', 10000, '2025-02-16', '2025-09-16 04:28:26', '2025-09-16 04:28:26', 156),
(320, 'Cenobia Cecilia Orta Álvarez', 20000, '2025-02-16', '2025-09-16 04:28:26', '2025-09-16 04:28:26', 156),
(321, 'Julio Cesar Passos Barrera', 20000, '2025-02-16', '2025-09-16 04:28:26', '2025-09-16 04:28:26', 156),
(322, 'Diezmo', 2000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(323, 'Ana Cecilia Gómez cordero', 26000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(324, 'Fernando Urrutia', 48000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(325, 'Livert Diaz', 30500, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(326, 'Familia Ramos', 100000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(327, 'Familia Cuello Hernández', 20000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(328, 'Jazmín Valeria Márquez pacheco', 23000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(329, 'Fanny del Carmen De la Ossa feria', 10000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(330, 'Nelida del Carmen Muñoz Rivas', 35000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(331, 'Amparo del Carmen Martínez Polo', 38000, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(332, 'Familia Guevara Mora', 41100, '2025-02-16', '2025-09-16 04:28:27', '2025-09-16 04:28:27', 156),
(333, 'Luis Arrieta', 70000, '2025-02-16', '2025-09-16 04:28:28', '2025-09-16 04:28:28', 156),
(334, 'Familia Barrera Losada', 36000, '2025-02-16', '2025-09-16 04:28:28', '2025-09-16 04:28:28', 156),
(335, 'Yesenia Judith Olivera Ibáñez', 40000, '2025-02-16', '2025-09-16 04:28:28', '2025-09-16 04:28:28', 156),
(336, 'Ofrenda', 115000, '2025-02-16', '2025-09-16 04:28:28', '2025-09-16 04:28:28', 156),
(337, 'Familia Ramos', 150000, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(338, 'Familia Viloria Yanez', 22000, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(339, 'Katia Cuello', 20000, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(340, 'Diezmo', 2000, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(341, 'Ana Cecilia Gómez cordero', 24000, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(342, 'Diezmo', 2000, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(343, 'Sandra Milena Marquez Pacheco', 7600, '2025-02-23', '2025-09-16 04:57:54', '2025-09-16 04:57:54', 167),
(344, 'Jazmín Valeria Márquez pacheco', 9000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(345, 'Santiago miguel Begambre olivera', 20000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(346, 'Luis Emilio Mosquera Mosquera', 8000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(347, 'Diezmo', 90000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(348, 'Livert Diaz', 15100, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(349, 'Fernando Urrutia', 38000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(350, 'Familia Barrera Losano', 36000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(351, 'José Ruiz', 200000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(352, 'Osiris del Carmen barrera Martínez', 20000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(353, 'Nelly Sánchez', 50000, '2025-02-23', '2025-09-16 04:57:55', '2025-09-16 04:57:55', 167),
(354, 'Ofrenda', 112900, '2025-02-23', '2025-09-16 04:57:56', '2025-09-16 04:57:56', 167);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `valor` decimal(15,2) NOT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  `concepto` varchar(255) DEFAULT NULL,
  `presupuesto_id` bigint(20) UNSIGNED NOT NULL,
  `movimiento_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id`, `fecha`, `valor`, `detalle`, `concepto`, `presupuesto_id`, `movimiento_id`, `created_at`, `updated_at`) VALUES
(14, '2025-01-08', 64200.00, 'Gregorio Rodriguez', 'Compra Varios. Aseo', 16, 123, '2025-09-08 19:43:52', '2025-09-12 22:33:59'),
(15, '2025-01-09', 178000.00, 'Domingo Martínez', 'Seguridad. Salud Total', 6, 124, '2025-09-08 19:44:54', '2025-09-12 22:35:16'),
(16, '2025-01-17', 24500.00, 'Héctor Olivera S', 'Compra Varios. Tesorería', 8, 125, '2025-09-08 19:51:32', '2025-09-12 22:36:05'),
(17, '2025-01-17', 300000.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 12, 126, '2025-09-08 19:53:28', '2025-09-12 22:36:26'),
(18, '2025-01-17', 200000.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 7, 126, '2025-09-08 19:53:28', '2025-09-12 22:36:26'),
(19, '2025-01-17', 100000.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 18, 126, '2025-09-08 19:53:28', '2025-09-12 22:36:27'),
(20, '2025-01-17', 200000.00, 'Asociación Cristiana', 'Aporte. Servicio P. E dominical', 8, 127, '2025-09-08 19:58:52', '2025-09-12 22:37:13'),
(21, '2025-01-17', 150000.00, 'Asociación Cristiana', 'Aporte. Servicio P. E dominical', 18, 127, '2025-09-08 19:58:52', '2025-09-12 22:37:13'),
(22, '2025-01-18', 7000.00, 'Gregorio Rodriguez', 'Compra Panel  led', 16, 128, '2025-09-08 20:10:48', '2025-09-12 22:37:29'),
(23, '2025-01-21', 550000.00, 'Fernando López Mestra.', 'Arriendo Casa Pastoral', 8, 130, '2025-09-08 21:30:33', '2025-09-12 22:38:10'),
(24, '2025-01-22', 1852000.00, 'Zona # 3 AIEC', 'Aporte mes dic/2024', 10, 131, '2025-09-08 21:31:46', '2025-09-12 22:38:30'),
(25, '2025-01-22', 100000.00, 'Circuito # 1', 'Aporte mes dic/2024', 9, 132, '2025-09-08 21:32:27', '2025-09-12 22:38:47'),
(26, '2025-01-24', 35400.00, 'Veolia', 'Pago servicio de agua', 8, 133, '2025-09-08 21:33:38', '2025-09-12 22:39:18'),
(27, '2025-01-26', 20000.00, 'Julio Passos Ramírez', 'Decoración', 19, 134, '2025-09-08 21:34:53', '2025-09-12 22:39:47'),
(28, '2025-01-28', 900000.00, 'Felix Agamez', 'Compra de sillas y mesas', 22, 136, '2025-09-08 22:54:58', '2025-09-12 22:40:31'),
(29, '2025-01-30', 180000.00, 'Nestor Reyes J', 'Obra de mano. Ester Martinez', 22, 137, '2025-09-08 22:56:11', '2025-09-12 22:40:50'),
(30, '2025-01-31', 1423500.00, 'Domingo Martínez', 'Sueldo del Pastor', 3, 138, '2025-09-08 22:57:17', '2025-09-12 22:41:42'),
(31, '2025-01-31', 1423500.00, 'Augusto Viloria Macias', 'Sueldo del Pastor', 3, 139, '2025-09-08 22:58:12', '2025-09-12 22:42:01'),
(32, '2025-01-30', 232600.00, 'Héctor Olivera S', 'Compra Varios. Ester Martinez', 22, 140, '2025-09-08 22:59:18', '2025-09-12 22:41:14'),
(34, '2025-02-02', 10000.00, 'Tomas Guevara R', 'Compra de Gasolina', 16, 145, '2025-09-15 07:40:40', '2025-09-15 07:40:40'),
(35, '2025-02-03', 405800.00, 'Augusto Viloria Macias', 'Seguridad Social', 6, 148, '2025-09-15 18:30:11', '2025-09-15 18:30:11'),
(36, '2025-02-05', 32000.00, 'Gregorio Rodriguez', 'Copias de llaves', 16, 149, '2025-09-15 20:52:55', '2025-09-15 20:52:55'),
(37, '2025-02-07', 178000.00, 'Domingo Martínez', 'Seguridad. Salud Total', 6, 150, '2025-09-15 20:53:54', '2025-09-15 22:03:52'),
(38, '2025-02-10', 58000.00, 'Gregorio Rodriguez', 'Compra Varios. Aseo', 16, 152, '2025-09-15 22:05:42', '2025-09-15 22:05:42'),
(39, '2025-02-11', 984000.00, 'Zona # 3 AIEC', 'Aporte mes Enero 2025', 10, 153, '2025-09-15 22:07:20', '2025-09-15 22:12:01'),
(40, '2025-02-11', 100000.00, 'Circuito # 1', 'Aporte mes Enero 2025', 9, 154, '2025-09-15 22:11:33', '2025-09-15 22:11:33'),
(41, '2025-02-15', 61800.00, 'Tomas Guevara R', 'Compra de Baquetas', 14, 155, '2025-09-15 22:25:49', '2025-09-15 22:25:49'),
(42, '2025-02-18', 25000.00, 'Sandra Márquez', 'Transporte reunión del Circuito', 11, 157, '2025-09-16 04:30:29', '2025-09-16 04:30:29'),
(43, '2025-02-19', 85000.00, 'Julio Passos Ramírez', 'Compra Varios. Extensión', 19, 158, '2025-09-16 04:31:44', '2025-09-16 04:31:44'),
(44, '2025-02-19', 70000.00, 'Nélida Muñoz', 'Compra de Regalo para Pastora.', 17, 159, '2025-09-16 04:33:18', '2025-09-16 04:33:18'),
(45, '2025-02-20', 550000.00, 'Fernando López Mestra.', 'Arriendo Casa Pastoral', 8, 160, '2025-09-16 04:34:34', '2025-09-16 04:34:34'),
(46, '2025-02-22', 35500.00, 'Veolia', 'Servicios Públicos. Agua', 8, 161, '2025-09-16 04:35:48', '2025-09-16 04:35:48'),
(47, '2025-02-22', 150000.00, 'Gregorio Rodriguez', 'Ofrenda, Predicador Campaña', 19, 162, '2025-09-16 04:37:03', '2025-09-16 04:37:03'),
(48, '2025-02-22', 86000.00, 'Julio Passos Ramírez', 'Compra Varios. campaña', 19, 163, '2025-09-16 04:38:57', '2025-09-16 04:38:57'),
(49, '2025-02-22', 300000.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 12, 164, '2025-09-16 04:40:32', '2025-09-16 04:40:32'),
(50, '2025-02-22', 200000.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 7, 164, '2025-09-16 04:40:32', '2025-09-16 04:40:32'),
(51, '2025-02-22', 100000.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 18, 164, '2025-09-16 04:40:32', '2025-09-16 04:40:32'),
(52, '2025-02-22', 200000.00, 'Asociación Cristiana', 'Aporte. Servicio P. E dominical', 8, 165, '2025-09-16 04:42:01', '2025-09-16 04:42:01'),
(53, '2025-02-22', 150000.00, 'Asociación Cristiana', 'Aporte. Servicio P. E dominical', 18, 165, '2025-09-16 04:42:01', '2025-09-16 04:42:01'),
(54, '2025-02-22', 31900.00, 'Asociación Cristiana', 'Compra Varios, cumpleaños Pastora', 16, 166, '2025-09-16 04:44:12', '2025-09-16 04:44:12'),
(55, '2025-02-25', 66900.00, 'Surtigas', 'Pago servicio. gas', 8, 168, '2025-09-16 04:59:37', '2025-09-16 04:59:37'),
(56, '2025-02-25', 39400.00, 'Gregorio Rodriguez', 'Compra Varios, Aseo', 16, 169, '2025-09-16 06:00:46', '2025-09-16 06:00:46'),
(57, '2025-02-27', 1423500.00, 'Domingo Martínez', 'Bonificación Pastoral', 3, 170, '2025-09-16 06:07:00', '2025-09-16 06:07:00'),
(58, '2025-02-27', 1423500.00, 'Daniel Viloria', 'Sueldo del Pastor', 3, 171, '2025-09-16 06:19:07', '2025-09-16 06:19:07');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` enum('activo','cerrado','aprobado','rechazado') NOT NULL DEFAULT 'activo',
  `saldo_inicial` decimal(15,2) NOT NULL DEFAULT 0.00,
  `saldo_final` decimal(15,2) NOT NULL DEFAULT 0.00,
  `aprobado_pastor` tinyint(1) NOT NULL DEFAULT 0,
  `aprobado_fiscal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `libro_contables`
--

INSERT INTO `libro_contables` (`id`, `nombre`, `mes_libro`, `anio_libro`, `created_at`, `updated_at`, `estado`, `saldo_inicial`, `saldo_final`, `aprobado_pastor`, `aprobado_fiscal`) VALUES
(2, 'Enero 2025', 1, 2025, '2025-08-24 23:24:50', '2025-09-15 07:37:58', 'aprobado', 5060045.00, 4696045.00, 1, 1),
(14, 'Febrero 2025', 2, 2025, '2025-09-15 07:37:58', '2025-09-16 06:32:26', 'aprobado', 4696045.00, 3839245.00, 1, 1),
(15, 'Marzo 2025', 3, 2025, '2025-09-16 06:32:26', '2025-09-16 06:32:26', 'activo', 3839245.00, 0.00, 0, 0);

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
(24, '2025_08_23_163026_create_libro_contables_table', 15),
(25, '2025_09_01_162222_update_libro_contables_add_saldos', 16),
(26, '2025_09_04_015832_add_aprobaciones_to_libro_contables', 17),
(27, '2025_09_05_114902_add_grupo_id_to_movimientos_table', 18),
(28, '2025_09_06_013649_alter_grupo_id_in_movimientos_table', 19),
(29, '2025_09_06_161846_create_egresos_table', 20),
(30, '2025_09_06_163012_add_detalle_concepto_to_egresos_table', 21),
(31, '2025_09_15_023716_update_tipo_enum_in_movimientos', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grupo_id` varchar(50) DEFAULT NULL,
  `presupuesto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `consecutivo` varchar(255) DEFAULT NULL,
  `tipo` enum('ingreso','egreso','saldo_inicial') NOT NULL COMMENT 'Tipo de movimiento: ingreso, egreso o saldo inicial',
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

INSERT INTO `movimientos` (`id`, `grupo_id`, `presupuesto_id`, `fecha`, `consecutivo`, `tipo`, `valor`, `saldo`, `detalle`, `concepto`, `casilla`, `created_at`, `updated_at`, `libro_contable_id`) VALUES
(69, NULL, NULL, '2025-01-01', NULL, '', 0.00, 5060045.00, 'Saldo inicial del mes', NULL, NULL, '2025-09-01 18:58:45', '2025-09-01 18:58:45', 2),
(72, NULL, NULL, '2025-01-05', 'C-334', 'ingreso', 1761500.00, 6821045.00, 'Templo Unido', 'Diezmos 05 enero 2025', NULL, '2025-09-02 00:14:14', '2025-09-12 17:30:39', 2),
(81, NULL, NULL, '2025-01-12', 'C-335', 'ingreso', 1455600.00, 8034445.00, 'Templo Unido', 'Diezmos 12  Enero 2025', NULL, '2025-09-04 07:47:32', '2025-09-12 22:35:37', 2),
(123, '2ca42600-37ae-46a2-8b40-79ac360e65a1', NULL, '2025-01-08', 'D-1812', 'egreso', 64200.00, 7970245.00, 'Gregorio Rodriguez', 'Compra Varios. Aseo', 'Servicio', '2025-09-08 19:43:52', '2025-09-12 22:33:59', 2),
(124, 'd9233f09-82b6-4c93-a041-8b3457e46263', NULL, '2025-01-09', 'D-1813', 'egreso', 178000.00, 7792245.00, 'Domingo Martínez', 'Seguridad. Salud Total', 'Seguridad Social', '2025-09-08 19:44:54', '2025-09-12 22:35:16', 2),
(125, '18a11d00-47e0-4b81-8163-569612ef2d4a', NULL, '2025-01-17', 'D-1814', 'egreso', 24500.00, 7767745.00, 'Héctor Olivera S', 'Compra Varios. Tesorería', 'Arriendo y servicio Públicos', '2025-09-08 19:51:32', '2025-09-12 22:36:05', 2),
(126, '9c33ccb8-ab7c-46e1-a388-c6da2d25304b', NULL, '2025-01-17', 'D-1815', 'egreso', 600000.00, 7167745.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 'Celaduría, Asesorías Constables, Ministerio Infantil', '2025-09-08 19:53:28', '2025-09-12 22:36:27', 2),
(127, '5f8d4b47-f31a-4d86-9e55-7999b98de2f1', NULL, '2025-01-17', 'D-1816', 'egreso', 350000.00, 6817745.00, 'Asociación Cristiana', 'Aporte. Servicio P. E dominical', 'Arriendo y servicio Públicos, Ministerio Infantil', '2025-09-08 19:58:52', '2025-09-12 22:37:13', 2),
(128, '773bffc7-91c5-4103-97e2-5e250514260c', NULL, '2025-01-18', 'D-1817', 'egreso', 7000.00, 6810745.00, 'Gregorio Rodriguez', 'Compra Panel  led', 'Servicio', '2025-09-08 20:10:48', '2025-09-12 22:37:29', 2),
(129, NULL, NULL, '2025-01-19', 'C-336', 'ingreso', 3051300.00, 9862045.00, 'Templo Unido', 'Diezmos 19 enero 2025', NULL, '2025-09-08 20:34:15', '2025-09-12 22:37:48', 2),
(130, '8adcede9-197c-4e5d-be6d-bc151d8b38b1', NULL, '2025-01-21', 'D-1818', 'egreso', 550000.00, 9312045.00, 'Fernando López Mestra.', 'Arriendo Casa Pastoral', 'Arriendo y servicio Públicos', '2025-09-08 21:30:33', '2025-09-12 22:38:10', 2),
(131, '65019db3-6506-4ecf-8a20-e2a48e730e50', NULL, '2025-01-22', 'D-1819', 'egreso', 1852000.00, 7460045.00, 'Zona # 3 AIEC', 'Aporte mes dic/2024', 'Zona 13%', '2025-09-08 21:31:46', '2025-09-12 22:38:30', 2),
(132, 'a4a14007-fba5-4658-936f-37db78f80096', NULL, '2025-01-22', 'D-1820', 'egreso', 100000.00, 7360045.00, 'Circuito # 1', 'Aporte mes dic/2024', 'Circuito', '2025-09-08 21:32:26', '2025-09-12 22:38:47', 2),
(133, '783fed89-3a64-4641-b031-cd1a078e8ffe', NULL, '2025-01-24', 'D-1821', 'egreso', 35400.00, 7324645.00, 'Veolia', 'Pago servicio de agua', 'Arriendo y servicio Públicos', '2025-09-08 21:33:38', '2025-09-12 22:39:18', 2),
(134, 'c90d2a58-bcb0-4c74-996d-2d474e619abf', NULL, '2025-01-26', 'D-1822', 'egreso', 20000.00, 7304645.00, 'Julio Passos Ramírez', 'Decoración', 'Evangelismo', '2025-09-08 21:34:53', '2025-09-12 22:39:47', 2),
(135, NULL, NULL, '2025-01-26', 'C-337', 'ingreso', 1308300.00, 8612945.00, 'Templo Unido', 'Diezmos 26 enero 2025', NULL, '2025-09-08 22:38:42', '2025-09-12 22:40:08', 2),
(136, '3fcbb861-a4c8-4ac5-8769-0f0cc5e147dc', NULL, '2025-01-28', 'D-1823', 'egreso', 900000.00, 7712945.00, 'Felix Agamez', 'Compra de sillas y mesas', 'Desarrollo', '2025-09-08 22:54:58', '2025-09-12 22:40:31', 2),
(137, '5824887e-0b26-4a16-9ba5-9a72f4101526', NULL, '2025-01-30', 'D-1824', 'egreso', 180000.00, 7532945.00, 'Nestor Reyes J', 'Obra de mano. Ester Martinez', 'Desarrollo', '2025-09-08 22:56:11', '2025-09-12 22:40:50', 2),
(138, '1d31b0d0-cc98-4738-b644-c89a7dd1431d', NULL, '2025-01-31', 'D-1826', 'egreso', 1423500.00, 6109445.00, 'Domingo Martínez', 'Sueldo del Pastor', 'Sueldo Pastor', '2025-09-08 22:57:17', '2025-09-12 22:41:42', 2),
(139, 'eb1f1bd4-3063-4ac2-bcee-9665f0f7eea6', NULL, '2025-01-31', 'D-1827', 'egreso', 1423500.00, 4685945.00, 'Augusto Viloria Macias', 'Sueldo del Pastor', 'Sueldo Pastor', '2025-09-08 22:58:12', '2025-09-12 22:42:01', 2),
(140, '7c886861-3630-4bf5-9c7c-74608e8c5013', NULL, '2025-01-30', 'D-1825', 'egreso', 232600.00, 4453345.00, 'Héctor Olivera S', 'Compra Varios. Ester Martinez', 'Desarrollo', '2025-09-08 22:59:18', '2025-09-12 22:41:14', 2),
(144, NULL, NULL, '2025-02-01', NULL, 'saldo_inicial', 0.00, 4696045.00, 'Saldo inicial del mes', NULL, NULL, '2025-09-15 07:37:58', '2025-09-15 07:37:58', 14),
(145, '0fa8e4ac-2646-486d-b25d-2a7904fb5759', NULL, '2025-02-02', 'D-1828', 'egreso', 10000.00, 4686045.00, 'Tomas Guevara R', 'Compra de Gasolina', 'Servicio', '2025-09-15 07:40:40', '2025-09-15 07:40:40', 14),
(146, NULL, NULL, '2025-02-02', 'C-333', 'ingreso', 2661800.00, 7347845.00, 'Templo Unido', 'Escuela Dominical 02 de febrero', NULL, '2025-09-15 17:20:23', '2025-09-15 17:21:54', 14),
(148, '6ed42e0b-c061-40fb-a6c4-04f656ede73e', NULL, '2025-02-03', 'D-1829', 'egreso', 405800.00, 6942045.00, 'Augusto Viloria Macias', 'Seguridad Social', 'Seguridad Social', '2025-09-15 18:30:11', '2025-09-15 18:30:11', 14),
(149, '68573f66-6569-4e3a-a59f-dbd5efbbfdd6', NULL, '2025-02-05', 'D-1830', 'egreso', 32000.00, 6910045.00, 'Gregorio Rodriguez', 'Copias de llaves', 'Servicio', '2025-09-15 20:52:55', '2025-09-15 20:52:55', 14),
(150, '3d2fa688-7e4d-4c78-91dc-7b83f3ebd073', NULL, '2025-02-07', 'D-1831', 'egreso', 178000.00, 6732045.00, 'Domingo Martínez', 'Seguridad. Salud Total', 'Seguridad Social', '2025-09-15 20:53:54', '2025-09-15 22:03:52', 14),
(151, NULL, NULL, '2025-02-09', 'C-339', 'ingreso', 1710500.00, 8442545.00, 'Templo Unido', 'Escuela Dominical 09 de febrero', NULL, '2025-09-15 22:03:24', '2025-09-15 22:04:15', 14),
(152, 'e14cf563-e4b1-49c6-a4b2-6ca9abdd1c2c', NULL, '2025-02-10', 'D-1832', 'egreso', 58000.00, 8384545.00, 'Gregorio Rodriguez', 'Compra Varios. Aseo', 'Servicio', '2025-09-15 22:05:42', '2025-09-15 22:05:42', 14),
(153, '6a54d2dc-bfb8-4dfc-94f0-d6fdc6a77f90', NULL, '2025-02-11', 'D-1833', 'egreso', 984000.00, 7400545.00, 'Zona # 3 AIEC', 'Aporte mes Enero 2025', 'Zona 13%', '2025-09-15 22:07:20', '2025-09-15 22:12:01', 14),
(154, '47c99a4d-acf1-4b7e-8e1b-2e24e973af50', NULL, '2025-02-11', 'D-1834', 'egreso', 100000.00, 7300545.00, 'Circuito # 1', 'Aporte mes Enero 2025', 'Circuito', '2025-09-15 22:11:33', '2025-09-15 22:11:33', 14),
(155, 'c4f08003-a7a0-405d-9250-17c89bc2f993', NULL, '2025-02-15', 'D-1835', 'egreso', 61800.00, 7238745.00, 'Tomas Guevara R', 'Compra de Baquetas', 'Adoración', '2025-09-15 22:25:49', '2025-09-15 22:25:49', 14),
(156, NULL, NULL, '2025-02-16', 'C-340', 'ingreso', 710600.00, 7949345.00, 'Templo Unido', 'Escuela Dominical 16 de febrero', NULL, '2025-09-16 04:28:26', '2025-09-16 04:29:00', 14),
(157, 'cf080c28-d15f-4603-a0eb-9287ac6ea855', NULL, '2025-02-18', 'D-1836', 'egreso', 25000.00, 7924345.00, 'Sandra Márquez', 'Transporte reunión del Circuito', 'Gastos de Representación', '2025-09-16 04:30:29', '2025-09-16 04:30:29', 14),
(158, '43d7a909-1866-4cfb-a74b-2c7b6aa96402', NULL, '2025-02-19', 'D-1837', 'egreso', 85000.00, 7839345.00, 'Julio Passos Ramírez', 'Compra Varios. Extensión', 'Evangelismo', '2025-09-16 04:31:44', '2025-09-16 04:31:44', 14),
(159, '996b7ffe-8c67-4011-b62f-aaec9ad5235e', NULL, '2025-02-19', 'D-1838', 'egreso', 70000.00, 7769345.00, 'Nélida Muñoz', 'Compra de Regalo para Pastora.', 'Compañerismo', '2025-09-16 04:33:18', '2025-09-16 04:33:18', 14),
(160, '655c1a6f-f3d9-4953-a0ab-b4cb567555fb', NULL, '2025-02-20', 'D-1839', 'egreso', 550000.00, 7219345.00, 'Fernando López Mestra.', 'Arriendo Casa Pastoral', 'Arriendo y servicio Públicos', '2025-09-16 04:34:34', '2025-09-16 04:34:34', 14),
(161, 'df508621-f840-4b54-bc42-ce56fb8bdfae', NULL, '2025-02-22', 'D-1840', 'egreso', 35500.00, 7183845.00, 'Veolia', 'Servicios Públicos. Agua', 'Arriendo y servicio Públicos', '2025-09-16 04:35:48', '2025-09-16 04:35:48', 14),
(162, 'c405ae5d-8d92-4331-b9d7-3185ebc9daca', NULL, '2025-02-22', 'D-1841', 'egreso', 150000.00, 7033845.00, 'Gregorio Rodriguez', 'Ofrenda, Predicador Campaña', 'Evangelismo', '2025-09-16 04:37:03', '2025-09-16 04:37:03', 14),
(163, '843bb820-92e1-48ad-984f-2262fdeebfac', NULL, '2025-02-22', 'D-1842', 'egreso', 86000.00, 6947845.00, 'Julio Passos Ramírez', 'Compra Varios. campaña', 'Evangelismo', '2025-09-16 04:38:57', '2025-09-16 04:38:57', 14),
(164, 'cba7a4cf-e429-4260-85d8-301b951f6871', NULL, '2025-02-22', 'D-1843', 'egreso', 600000.00, 6347845.00, 'Asociación Cristiana', 'Aporte. Celaduría, A Contable. CDI', 'Celaduría, Asesorías Constables, Ministerio Infantil', '2025-09-16 04:40:32', '2025-09-16 04:40:32', 14),
(165, 'f1de705a-6aee-4891-86a9-8250ab2ad406', NULL, '2025-02-22', 'D-1844', 'egreso', 350000.00, 5997845.00, 'Asociación Cristiana', 'Aporte. Servicio P. E dominical', 'Arriendo y servicio Públicos, Ministerio Infantil', '2025-09-16 04:42:01', '2025-09-16 04:42:01', 14),
(166, '7357aad2-6e08-4e92-9aac-b77d32a17e54', NULL, '2025-02-22', 'D-1845', 'egreso', 31900.00, 5965945.00, 'Asociación Cristiana', 'Compra Varios, cumpleaños Pastora', 'Servicio', '2025-09-16 04:44:12', '2025-09-16 04:44:12', 14),
(167, NULL, NULL, '2025-02-23', 'C-341', 'ingreso', 826600.00, 6792545.00, 'Templo Unido', 'Escuela Dominical 23 de febrero', NULL, '2025-09-16 04:57:53', '2025-09-16 04:58:36', 14),
(168, '146ec2c7-47da-476f-9e67-a2bffa5e95f2', NULL, '2025-02-25', 'D-1846', 'egreso', 66900.00, 6725645.00, 'Surtigas', 'Pago servicio. gas', 'Arriendo y servicio Públicos', '2025-09-16 04:59:37', '2025-09-16 04:59:37', 14),
(169, 'd0b2a119-e33b-46e3-b179-8f7d7470b9e0', NULL, '2025-02-25', 'D-1847', 'egreso', 39400.00, 6686245.00, 'Gregorio Rodriguez', 'Compra Varios, Aseo', 'Servicio', '2025-09-16 06:00:46', '2025-09-16 06:00:46', 14),
(170, '32764571-fcc3-4b26-b26d-f81c1aeae0ae', NULL, '2025-02-27', 'D-1848', 'egreso', 1423500.00, 5262745.00, 'Domingo Martínez', 'Bonificación Pastoral', 'Sueldo Pastor', '2025-09-16 06:07:00', '2025-09-16 06:07:00', 14),
(171, '1fd5998a-0709-441d-aa63-cc58364fb2a1', NULL, '2025-02-27', 'D-1849', 'egreso', 1423500.00, 3839245.00, 'Daniel Viloria', 'Sueldo del Pastor', 'Sueldo Pastor', '2025-09-16 06:19:07', '2025-09-16 06:19:07', 14),
(172, NULL, NULL, '2025-03-01', NULL, 'saldo_inicial', 0.00, 3839245.00, 'Saldo inicial del mes', NULL, NULL, '2025-09-16 06:32:26', '2025-09-16 06:32:26', 15);

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
('4hHpV1cl3ZTFxn3ywlWjnGMfdp1rH16O8sXZc7wS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieVBIRk9LVG1pZm9kamtlS0Q3enNER0xRMDg3UGV2ZThlN0M2WmM5TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758162650),
('ejW8OqY3fANGNrPHTzZ7VpCuEZ28LnsjDWf21oXk', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVY0WXZFVnpTUmRVRVJjNEExQjljMWY2N1VSZkV5bkMxRlJReDRzQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9saWJyby1jb250YWJsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1757985611),
('Kx7hxGwJitcvauok1elq9q8RgjoyB3wlGBGUlAso', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMEJvdVBlV0Z4R3RrbnM4Z2l4Sk4yNmdPbHF6Uk5VTmh1bnFzamRlaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758162655),
('wOcGoOmDnPsxE1OvnOWFt4WCo1TkxPrCTTXQc297', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYUFZbVZ1eXI4bXdKZ3dSaEhNd2hoQTJDQVdRVWtHYkFqeTNydlBobiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcmVzdXB1ZXN0b3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1757987308);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `egresos_presupuesto_id_foreign` (`presupuesto_id`),
  ADD KEY `egresos_movimiento_id_foreign` (`movimiento_id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `movimientos_presupuesto_id_foreign` (`presupuesto_id`),
  ADD KEY `fk_movimientos_libro_contable` (`libro_contable_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

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
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_movimiento_id_foreign` FOREIGN KEY (`movimiento_id`) REFERENCES `movimientos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `egresos_presupuesto_id_foreign` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuestos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movimientos_libro_contable` FOREIGN KEY (`libro_contable_id`) REFERENCES `libro_contables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_presupuesto_id_foreign` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuestos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
