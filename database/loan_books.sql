-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2022 a las 09:16:41
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
-- Base de datos: `loan_books`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_t`
--

CREATE TABLE `orders_t` (
  `id_order` int(11) NOT NULL,
  `book` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `total` int(2) NOT NULL,
  `start_order` datetime NOT NULL DEFAULT current_timestamp(),
  `end_order` datetime DEFAULT NULL,
  `returned` int(2) NOT NULL,
  `id_student` int(11) DEFAULT NULL CHECK (`id_student` is not null and `id_professor` is null or `id_student` is null and `id_professor` is not null),
  `id_professor` int(11) DEFAULT NULL CHECK (`id_student` is not null and `id_professor` is null or `id_student` is null and `id_professor` is not null),
  `id_librarian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders_t`
--

INSERT INTO `orders_t` (`id_order`, `book`, `category`, `total`, `start_order`, `end_order`, `returned`, `id_student`, `id_professor`, `id_librarian`) VALUES
(1, 'El Sur', 'literatura', 1, '2022-10-26 01:17:46', NULL, 0, 1, NULL, 1),
(2, 'El Aleph', 'literatura', 20, '2022-10-26 01:18:15', NULL, 0, NULL, 1, 2),
(3, 'Programacion', 'informatica', 1, '2022-10-26 01:19:13', NULL, 0, 1, NULL, 2),
(4, 'Atomos', 'Quimica', 2, '2022-10-26 01:22:46', NULL, 0, 2, NULL, 1),
(5, 'Programacion Nivel 2', 'Programacion', 10, '2022-10-26 16:58:27', NULL, 0, NULL, 1, 1),
(6, 'Blanca Nieves', 'literatura', 15, '2022-10-29 15:51:54', NULL, 0, NULL, 1, 2),
(7, 'La princesa y el Sapo', 'literatura', 20, '2022-10-29 15:52:54', NULL, 0, NULL, 4, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders_t`
--
ALTER TABLE `orders_t`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `rl_orders_librarians` (`id_librarian`),
  ADD KEY `rl_orders_professors` (`id_professor`),
  ADD KEY `rl_orders_students` (`id_student`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders_t`
--
ALTER TABLE `orders_t`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders_t`
--
ALTER TABLE `orders_t`
  ADD CONSTRAINT `rl_orders_librarianes` FOREIGN KEY (`id_librarian`) REFERENCES `librarians_t` (`id_librarian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rl_orders_professors` FOREIGN KEY (`id_professor`) REFERENCES `professors_t` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rl_orders_students` FOREIGN KEY (`id_student`) REFERENCES `students_t` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
