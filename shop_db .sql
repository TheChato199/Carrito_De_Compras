-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 28-12-2023 a las 15:24:40
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
-- Base de datos: `shop_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `cantidad` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`id`, `nombre`, `precio`, `imagen`, `cantidad`) VALUES
(8, 'Pizza M', '15', 'Pizza_1.png', 1),
(9, 'Lasaña', '6', 'lasaña.png', 1),
(10, 'Spaghetti', '5', 'Spaghetti.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `numero` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `metodo` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `pin_code` int(10) NOT NULL,
  `total_products` varchar(225) NOT NULL,
  `total_precio` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id`, `nombre`, `numero`, `email`, `metodo`, `flat`, `calle`, `ciudad`, `pais`, `pin_code`, `total_products`, `total_precio`) VALUES
(1, 'Wilton Huiracocha', '0991104260', 'alexanderhuiracocha1975@gmail.com', 'efectivo o delivery', 'El valle', 'Santiago de las montañas', 'Loja', 'Ecuador', 123456789, 'Pizza M (1) , Lasaña (1) , Spaghetti (1) ', '26'),
(2, 'Wilton Huiracocha', '0991104260', 'alexanderhuiracocha1975@gmail.com', 'efectivo o delivery', 'El valle', 'Santiago de las montañas', 'Loja', 'Ecuador', 123456789, 'Pizza M (1) , Lasaña (1) , Spaghetti (1) ', '26'),
(3, 'Wilton Huiracocha', '0991104260', 'alexanderhuiracocha1975@gmail.com', 'efectivo o delivery', 'El valle', 'Santiago de las montañas', 'Loja', 'Ecuador', 123456789, 'Pizza M (1) , Lasaña (1) , Spaghetti (1) ', '26'),
(4, 'Wilton Huiracocha', '0991104260', 'alexanderhuiracocha1975@gmail.com', 'efectivo o delivery', 'El valle', 'Santiago de las montañas', 'Loja', 'Ecuador', 123456789, 'Pizza M (1) , Lasaña (1) , Spaghetti (1) ', '26'),
(5, 'Wilton Huiracocha', '0991104260', 'alexanderhuiracocha1975@gmail.com', 'efectivo o delivery', 'El valle', 'Santiago de las montañas', 'Loja', 'Ecuador', 123456789, 'Pizza M (1) , Lasaña (1) , Spaghetti (1) ', '26'),
(6, 'Wilton Huiracocha', '0991104260', 'alexanderhuiracocha1975@gmail.com', 'efectivo o delivery', 'El valle', 'Santiago de las montañas', 'Loja', 'Ecuador', 123456789, 'Pizza M (1) , Lasaña (1) , Spaghetti (1) ', '26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `nombre`, `precio`, `imagen`) VALUES
('', 'Pizza M', '15', 'Pizza_1.png'),
('', 'Lasaña', '6', 'lasaña.png'),
('', 'Spaghetti', '5', 'Spaghetti.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
