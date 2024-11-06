-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 22:14:30
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
-- Base de datos: `g84_db_tiendaropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `ID_articulo` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `valor` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `ID_categoria` int(11) NOT NULL,
  `Imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`ID_articulo`, `nombre`, `valor`, `descripcion`, `ID_categoria`, `Imagen`) VALUES
(2, 'Remera gris', 15000, 'Remera color gris manga corta', 1, 'https://www.segutecnica.com/thumb/000000000001756537023remera-gris-segutecnica_800x800.png'),
(3, 'Buzo negro largo', 30000, 'Buzo color negro oversize hombre-mujer', 4, 'https://http2.mlstatic.com/D_NQ_NP_628470-MLA47818791473_102021-O.webp'),
(4, 'Pantalon rojo', 20000, 'Pantalon largo color rojo con detalles azules', 2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoPp06GH0Yaw35t8eOHh-0mk0ij-u690iQ0g&s'),
(5, 'Campera con capucha', 40000, 'Campera tipo rompevientos con capucha para invierno', 3, 'https://www.nakaoutdoors.com.ar/img/articulos/2022/12/epic_jannu_campera_rompeviento_imagen1.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`ID_articulo`),
  ADD KEY `ID_categoria` (`ID_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `ID_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`ID_categoria`) REFERENCES `categoria` (`ID_categoria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
