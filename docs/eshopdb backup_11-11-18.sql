-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2018 a las 23:33:04
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
-- Base de datos: `eshopdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `id_supercategory` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `description`, `id_supercategory`, `state`) VALUES
(1, 'Computadora', 0, 1),
(2, 'Laptop', 1, 1),
(3, 'Desktop', 1, 1),
(4, 'Accesorios', 0, 1),
(5, 'All in One', 1, 1),
(7, 'Almacenamiento', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `user` varchar(12) NOT NULL,
  `name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `phone` int(8) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`user`, `name`, `last_name`, `phone`, `email`) VALUES
('bajd', 'Andres', 'Jimenez', 89621230, 'kajimenezq@est.utn.ac.cr'),
('kajq', 'Keilor', 'Jimenez', 89621230, 'keilorjimenez95@gmail.com'),
('kldc', 'Katherine', 'Diaz', 85521412, 'keilorjimenez95@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(15) NOT NULL,
  `description` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `in_stock` int(11) NOT NULL,
  `image_file` varchar(100) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `sku`, `description`, `price`, `in_stock`, `image_file`, `id_category`) VALUES
(1, 'SKU-LAPT-1', 'Dell P66 F', 350000, 8, 'dell Vostro 5568.jpg', 2),
(2, 'SKU-ACCE-2', 'Disco Duro 1 TB', 28500, 6, 'Disco duro Toshiba.jpg', 7),
(3, 'SKU-DESK-3', 'HP Desktop', 300000, 2, 'WD PC Desktop.jpg', 3),
(4, 'SKU-ALL -4', 'Toshiba All in One', 280000, 1, 'toshiba all in one.jpg', 5),
(5, 'SKU-COMP-5', 'Xiomi Notebook', 500000, 0, 'xiomi Mi notebook.jpg', 2),
(6, 'SKU-LAPT-6', 'Vinillo para Laptop Come Galle', 8000, 0, 'Cobertor come galletas.jpg', 4),
(7, 'SKU-COMP-7', 'Laptop-Tablet Hp', 700000, 0, 'Portatil - Tablet.jpg', 1),
(8, 'SKU-LAPT-8', 'Portatil Ejecutiva', 400000, 1, 'portatil hp 15.jpg', 2),
(9, 'SKU-ACCE-9', 'Aufonos Bits', 45000, 0, 'audifonos.jpg', 4),
(10, 'SKU-ACCE-10', 'Vinilo para laptop Spiderman', 9000, 0, 'Vinilo Spiderman para portatil.jpg', 4),
(11, 'SKU-LAPT-11', 'Laptop Dell 1520', 800000, 0, 'portatil hp 15.jpg', 2),
(12, 'SKU-ACCE-12', 'Escaner portatil', 120000, 0, 'escan.jpg', 4),
(13, 'SKU-COMP-13', 'Asus mini', 290000, 0, 'af16bec4f0981d5f6b18a21152d7049b-product.jpg', 2),
(14, 'SKU-LAPT-14', 'Gaming Dell', 800000, 0, 'blk_220.png', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id_sale` int(11) NOT NULL,
  `user` varchar(12) NOT NULL,
  `sale_date` date NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sold_products`
--

CREATE TABLE `sold_products` (
  `id` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  `sku_product` varchar(12) NOT NULL,
  `price` double NOT NULL,
  `sum` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user` varchar(12) NOT NULL,
  `password` varchar(15) NOT NULL,
  `rol` tinyint(1) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user`, `password`, `rol`, `state`) VALUES
('bajd', '123', 0, 0),
('kajq', '123', 1, 0),
('kldc', '123', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcategory` (`id_supercategory`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`user`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sale`),
  ADD KEY `fk_user` (`user`);

--
-- Indices de la tabla `sold_products`
--
ALTER TABLE `sold_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_sale` (`id_sale`),
  ADD KEY `fk_sku_product` (`sku_product`),
  ADD KEY `id_sale` (`id_sale`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sale` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sold_products`
--
ALTER TABLE `sold_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `sold_products`
--
ALTER TABLE `sold_products`
  ADD CONSTRAINT `sold_products_ibfk_1` FOREIGN KEY (`id_sale`) REFERENCES `sales` (`id_sale`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user`) REFERENCES `person` (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
