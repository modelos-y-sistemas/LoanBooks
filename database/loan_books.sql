-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2022 a las 21:45:37
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
-- Estructura de tabla para la tabla `courses_t`
--

CREATE TABLE `courses_t` (
  `id_course` int(11) NOT NULL,
  `year` int(1) NOT NULL,
  `division` int(1) NOT NULL,
  `modality` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `courses_t`
--

INSERT INTO `courses_t` (`id_course`, `year`, `division`, `modality`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 2, 1, 0),
(6, 2, 2, 0),
(7, 3, 1, 0),
(8, 3, 2, 0),
(9, 4, 1, 1),
(11, 4, 1, 2),
(12, 4, 1, 3),
(13, 4, 2, 1),
(14, 5, 1, 1),
(16, 5, 1, 2),
(15, 5, 2, 1),
(18, 6, 1, 1),
(20, 6, 1, 2),
(21, 6, 1, 3),
(19, 6, 2, 1),
(22, 7, 1, 1),
(23, 7, 1, 2),
(24, 7, 1, 3),
(25, 7, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librarianes_t`
--

CREATE TABLE `librarianes_t` (
  `id_librarian` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `dni` int(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `librarianes_t`
--

INSERT INTO `librarianes_t` (`id_librarian`, `name`, `surname`, `dni`, `email`, `password`) VALUES
(1, 'Edith', 'Gomez', NULL, 'edith@gmail.com', 'edith1234'),
(2, 'la_rubia', 'Gonzalez', 45525488, 'la_rubia@gmail.com', 'la_rubia1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderes_t`
--

CREATE TABLE `orderes_t` (
  `id_order` int(11) NOT NULL,
  `book` text NOT NULL,
  `subject` text NOT NULL,
  `total` int(2) NOT NULL,
  `start_order` datetime NOT NULL DEFAULT current_timestamp(),
  `end_order` datetime NOT NULL,
  `returned` int(2) NOT NULL,
  `id_student` int(11) DEFAULT NULL CHECK (`id_student` is not null and `id_professor` is null or `id_student` is null and `id_professor` is not null),
  `id_professor` int(11) DEFAULT NULL CHECK (`id_student` is not null and `id_professor` is null or `id_student` is null and `id_professor` is not null),
  `id_librarian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orderes_t`
--

INSERT INTO `orderes_t` (`id_order`, `book`, `subject`, `total`, `start_order`, `end_order`, `returned`, `id_student`, `id_professor`, `id_librarian`) VALUES
(1, 'El Sur', 'literatura', 1, '2022-10-26 01:17:46', '2022-10-26 00:00:00', 0, 1, NULL, 1),
(2, 'El Aleph', 'literatura', 20, '2022-10-26 01:18:15', '2022-10-27 00:00:00', 0, NULL, 1, 2),
(3, 'Programacion', 'informatica', 1, '2022-10-26 01:19:13', '2022-10-28 00:00:00', 0, 1, NULL, 2),
(4, 'Atomos', 'Quimica', 2, '2022-10-26 01:22:46', '2022-10-30 00:00:00', 0, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professores_t`
--

CREATE TABLE `professores_t` (
  `id_professor` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `dni` int(10) DEFAULT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professores_t`
--

INSERT INTO `professores_t` (`id_professor`, `name`, `surname`, `dni`, `phone`) VALUES
(1, 'Carlos', 'Acuña', NULL, 1132266763),
(2, 'Pablo', 'Pereyra', 45525489, 1132266764),
(3, 'Dario', 'Martinez', NULL, 1132266765);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students_t`
--

CREATE TABLE `students_t` (
  `id_student` int(11) NOT NULL,
  `number` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `dni` int(10) DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `id_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `students_t`
--

INSERT INTO `students_t` (`id_student`, `number`, `name`, `surname`, `dni`, `phone`, `id_course`) VALUES
(1, 1, 'Jeremias', 'Cuello', 45525488, 1132266763, 21),
(2, 2, 'Jesus', 'Zerda', NULL, 1132266765, 22);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses_t`
--
ALTER TABLE `courses_t`
  ADD PRIMARY KEY (`id_course`),
  ADD UNIQUE KEY `course` (`year`,`division`,`modality`) USING BTREE;

--
-- Indices de la tabla `librarianes_t`
--
ALTER TABLE `librarianes_t`
  ADD PRIMARY KEY (`id_librarian`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `orderes_t`
--
ALTER TABLE `orderes_t`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `rl_orderes_librarianes` (`id_librarian`),
  ADD KEY `rl_orderes_professores` (`id_professor`),
  ADD KEY `rl_orderes_students` (`id_student`);

--
-- Indices de la tabla `professores_t`
--
ALTER TABLE `professores_t`
  ADD PRIMARY KEY (`id_professor`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indices de la tabla `students_t`
--
ALTER TABLE `students_t`
  ADD PRIMARY KEY (`id_student`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `id_courses` (`id_course`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses_t`
--
ALTER TABLE `courses_t`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `librarianes_t`
--
ALTER TABLE `librarianes_t`
  MODIFY `id_librarian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orderes_t`
--
ALTER TABLE `orderes_t`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `professores_t`
--
ALTER TABLE `professores_t`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `students_t`
--
ALTER TABLE `students_t`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orderes_t`
--
ALTER TABLE `orderes_t`
  ADD CONSTRAINT `rl_orderes_librarianes` FOREIGN KEY (`id_librarian`) REFERENCES `librarianes_t` (`id_librarian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rl_orderes_professores` FOREIGN KEY (`id_professor`) REFERENCES `professores_t` (`id_professor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rl_orderes_students` FOREIGN KEY (`id_student`) REFERENCES `students_t` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `students_t`
--
ALTER TABLE `students_t`
  ADD CONSTRAINT `rl_students_courses` FOREIGN KEY (`id_course`) REFERENCES `courses_t` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
