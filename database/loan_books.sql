-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2022 a las 03:19:27
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

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
-- Estructura de tabla para la tabla `t_courses`
--

CREATE TABLE `t_courses` (
  `id_courses` int(11) NOT NULL,
  `courses` varchar(5) NOT NULL,
  `modalities` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_librarian`
--

CREATE TABLE `t_librarian` (
  `id_librarian` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `DNI` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_order`
--

CREATE TABLE `t_order` (
  `id_order` int(11) NOT NULL,
  `id_students` int(11) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `id_librarian` int(11) NOT NULL,
  `book` text NOT NULL,
  `subject` text NOT NULL,
  `total` int(2) NOT NULL,
  `start_order` datetime NOT NULL,
  `end_order` datetime NOT NULL,
  `returned` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_professor`
--

CREATE TABLE `t_professor` (
  `id_professor` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `DNI` int(10) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_students`
--

CREATE TABLE `t_students` (
  `id_students` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `DNI` int(10) NOT NULL,
  `NroCom` int(9) NOT NULL,
  `id_courses` int(11) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_courses`
--
ALTER TABLE `t_courses`
  ADD PRIMARY KEY (`id_courses`);

--
-- Indices de la tabla `t_librarian`
--
ALTER TABLE `t_librarian`
  ADD PRIMARY KEY (`id_librarian`);

--
-- Indices de la tabla `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_students`,`id_librarian`),
  ADD KEY `id_librarian` (`id_librarian`),
  ADD KEY `id_user_2` (`id_students`),
  ADD KEY `id_user_3` (`id_students`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Indices de la tabla `t_professor`
--
ALTER TABLE `t_professor`
  ADD PRIMARY KEY (`id_professor`);

--
-- Indices de la tabla `t_students`
--
ALTER TABLE `t_students`
  ADD PRIMARY KEY (`id_students`),
  ADD KEY `id_courses` (`id_courses`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_courses`
--
ALTER TABLE `t_courses`
  MODIFY `id_courses` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_librarian`
--
ALTER TABLE `t_librarian`
  MODIFY `id_librarian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_order`
--
ALTER TABLE `t_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_professor`
--
ALTER TABLE `t_professor`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_students`
--
ALTER TABLE `t_students`
  MODIFY `id_students` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_order`
--
ALTER TABLE `t_order`
  ADD CONSTRAINT `t_order_ibfk_1` FOREIGN KEY (`id_students`) REFERENCES `t_students` (`id_students`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_order_ibfk_2` FOREIGN KEY (`id_librarian`) REFERENCES `t_librarian` (`id_librarian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_order_ibfk_3` FOREIGN KEY (`id_professor`) REFERENCES `t_professor` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_students`
--
ALTER TABLE `t_students`
  ADD CONSTRAINT `t_students_ibfk_1` FOREIGN KEY (`id_courses`) REFERENCES `t_courses` (`id_courses`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
