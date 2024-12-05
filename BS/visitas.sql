-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 08:18:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `visitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `documento` varchar(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `correo_institucional` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `tipo_contrato` enum('VINCULO LABORAL','PASANTÍA','PROYECTO PRODUCTIVO','Unidad Productiva Familiar','MONITORÍA') NOT NULL,
  `num_visita` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `visita_agendada` int(11) DEFAULT NULL,
  `ficha_id` int(11) NOT NULL,
  `arl` varchar(100) NOT NULL,
  `Observaciones` varchar(500) NOT NULL,
  `pqr_id` int(11) DEFAULT NULL,
  `Cod_visitas` int(11) DEFAULT NULL,
  `cod_empresa` int(11) DEFAULT NULL,
  `cod_jefe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`documento`, `nombres`, `apellidos`, `correo`, `correo_institucional`, `direccion`, `telefono`, `tipo_contrato`, `num_visita`, `fecha_inicio`, `visita_agendada`, `ficha_id`, `arl`, `Observaciones`, `pqr_id`, `Cod_visitas`, `cod_empresa`, `cod_jefe`) VALUES
('100000001', 'Juan', 'Perez', 'william_saavedra@yahoo.com', 'GEGE@SENA.CO', 'CLL ', '3172883517', 'VINCULO LABORAL', 0, '0000-00-00', NULL, 1, '', '', NULL, NULL, NULL, NULL),
('100000002', 'GERSON', 'Perez', 'gege@gmail.com', 'GEGE@SENA.CO', 'CLL 55', '3172883517', 'VINCULO LABORAL', 0, '0000-00-00', NULL, 1, '', '', NULL, NULL, NULL, NULL),
('100000007', 'DAVID', 'sanchez', 'william_saavedra@yahoo.com', 'GEGE@SENA.CO', 'CLL 55', '3172883517', 'VINCULO LABORAL', 0, '0000-00-00', NULL, 12, '', '', NULL, NULL, NULL, NULL),
('100000009', 'JOSE', 'CASTRO', 'william_saavedra@yahoo.com', 'juan.perez@sena.co', 'CLL ', '3172883517', 'VINCULO LABORAL', 0, '0000-00-00', NULL, 12, '', '', NULL, NULL, NULL, NULL),
('100000010', 'VERONICA', 'VASQUEZ', 'veronica.vasquez@sena.co', 'veronica.vasquez@sena.co', 'CLL 55', '3172883517', 'VINCULO LABORAL', 0, '0000-00-00', NULL, 12, '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz_instructor_visita`
--

CREATE TABLE `aprendiz_instructor_visita` (
  `id` int(11) NOT NULL,
  `aprendiz_documento` varchar(20) NOT NULL,
  `instructor_documento` varchar(20) NOT NULL,
  `visita_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `nom_empresa` varchar(255) DEFAULT NULL,
  `NIT` varchar(50) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `Encargado1` varchar(100) DEFAULT NULL,
  `Correo_Encargado1` varchar(100) DEFAULT NULL,
  `Telefono_Encargado1` varchar(20) DEFAULT NULL,
  `Encargado2` varchar(100) DEFAULT NULL,
  `Correo_Encargado2` varchar(100) DEFAULT NULL,
  `Telefono_Encargado2` varchar(20) DEFAULT NULL,
  `Cod_empresa` int(11) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`nom_empresa`, `NIT`, `Direccion`, `correo`, `Encargado1`, `Correo_Encargado1`, `Telefono_Encargado1`, `Encargado2`, `Correo_Encargado2`, `Telefono_Encargado2`, `Cod_empresa`, `telefono`) VALUES
('EMPRESA1', '1026307678-3', 'CLL 80', 'EMPRESA2@emp.co', 'juan', 'juan@gmai.com', '15426', 'juan', 'DAVID@GMAI.COM', '23423523', 3, '3172883519'),
('EMPRESA2', '1026307678-2', 'CLL 80', 'EMPRESA2@emp.co', NULL, NULL, NULL, NULL, NULL, NULL, 4, '3172883519'),
('EMPRESA3', '1026307678-4', 'CLL 80', 'EMPRESA3@emp.co', NULL, NULL, NULL, NULL, NULL, NULL, 5, '3172883519'),
('Empresa4', '1026307678-14', 'CLL 80', 'EMPRESA4@emp.co', NULL, NULL, NULL, NULL, NULL, NULL, 6, '3172883519');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `num_ficha` int(11) NOT NULL,
  `nombre_programa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`num_ficha`, `nombre_programa`) VALUES
(1, 'ADSO1'),
(161646542, 'ADSO12'),
(453453453, 'ADSO12'),
(123, 'ADSO2'),
(12, 'ADSO3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `documento` varchar(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `correo_institucional` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `visita` int(11) DEFAULT NULL,
  `fecha_visita` date DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`documento`, `nombres`, `apellidos`, `correo`, `correo_institucional`, `direccion`, `telefono`, `visita`, `fecha_visita`, `observaciones`) VALUES
('10263076900', 'DAVID', 'MARTINEZ', 'egelvesa@sena.edu.co', 'david@sena.co', 'CLL 55', '3172883519', NULL, NULL, 'ss'),
('200000001', 'pedro ', 'moreno', 'pedro.moreno@sena.co', 'pedro@sena.co', 'CLL 55', '3172883517', NULL, NULL, NULL),
('200000002', 'cara', 'rivera', 'carla.rivera@sena.co', 'carla.rivera@sena.co', 'CLL 55', '3172883517', NULL, NULL, 'null');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefes`
--

CREATE TABLE `jefes` (
  `cod_jefe` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqr`
--

CREATE TABLE `pqr` (
  `num_caso` int(11) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `resuelto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `nombre_programa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`nombre_programa`) VALUES
('ADSO1'),
('ADSO12'),
('ADSO2'),
('ADSO3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `Nit` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `cod_empresa` int(11) DEFAULT NULL,
  `Encargado1` varchar(100) DEFAULT NULL,
  `correo_encargado1` varchar(100) DEFAULT NULL,
  `telefono_encargado1` varchar(20) DEFAULT NULL,
  `cargo_encargado1` varchar(100) DEFAULT NULL,
  `Encargado2` varchar(100) DEFAULT NULL,
  `correo_encargado2` varchar(100) DEFAULT NULL,
  `telefono_encargado2` varchar(20) DEFAULT NULL,
  `cargo_encargado2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`nombre`, `direccion`, `Nit`, `correo`, `telefono`, `cod_empresa`, `Encargado1`, `correo_encargado1`, `telefono_encargado1`, `cargo_encargado1`, `Encargado2`, `correo_encargado2`, `telefono_encargado2`, `cargo_encargado2`) VALUES
('dsadas', 'cll 81', NULL, 'Sede12@emo.co', '2122124121', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('sede1', 'cll 81', NULL, 'Sede1@emo.co', '2122124', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('sede3', 'cll 81', NULL, 'Sede21@emo.co', '2122124232', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('VIRREY', 'cll 81', NULL, 'Sede21@emo.co', '2122124232', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` text NOT NULL,
  `confirmar_contraseña` text NOT NULL,
  `nombre` text NOT NULL,
  `rol` enum('Administrador','Instructor','Aprendiz') DEFAULT NULL,
  `tip_documento` enum('CC','TI','NIT','Pasaporte') DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`documento`, `correo`, `contraseña`, `confirmar_contraseña`, `nombre`, `rol`, `tip_documento`, `activo`) VALUES
('100000001', 'juan.perez@sena.co', '$2y$10$IToZoE8i8ZuoB.EsfeXO6u7bHadWHRc.t3RTuCP5GzOZeququ9GkK', 'contraseña123', 'Juan Pérez', 'Aprendiz', 'CC', 1),
('100000002', 'maria.gonzalez@sena.co', '$2y$10$YFUP3WcQ5TGjXEd44JT4ce2YePrPoTu9bIFSssadVpdjox4W4/8Si', 'contraseña123', 'María González', 'Aprendiz', 'CC', 1),
('100000003', 'carlos.lopez@sena.co', '$2y$10$Fpm7bweSA6TpHHU37UZ.bu0/OqrvvVGyXPham41tpMX0s7PhIRx5y', 'contraseña123', 'Carlos López', 'Aprendiz', 'CC', 1),
('100000004', 'lucia.martinez@sena.co', '$2y$10$2j5SVWsBcmsKV.ijaV29T.ekZmSobrUvK4uLr/dQ/EgB2dnRTjjQO', 'contraseña123', 'Lucía Martínez', 'Aprendiz', 'CC', 1),
('100000005', 'andres.jimenez@sena.co', '$2y$10$XP6zJ466oaDxiZtWXWXfVuTgxJSIHezmuOdJZvVXVAoK0bfZLqGjK', 'contraseña123', 'Andrés Jiménez', 'Aprendiz', 'CC', 1),
('100000006', 'sofia.rodriguez@sena.co', '$2y$10$PXt3e0hGQiZBY5OF1tW4huxcn1wKctxdiToQ4MDPYZkaemsiFWgdu', 'contraseña123', 'Sofía Rodríguez', 'Aprendiz', 'CC', 1),
('100000007', 'david.sanchez@sena.co', '$2y$10$FaJBU.mBkQMlRq4c.u1ziuGUrtw.euHGDjG8.mXkhAgTCc8tX1w4y', 'contraseña123', 'David Sánchez', 'Aprendiz', 'CC', 1),
('100000008', 'laura.hernandez@sena.co', '$2y$10$YqQL4IYDimyik.RwCLNGZeOJ3oSqdX/i89fo68O1DTZGvk4DNb4YS', 'contraseña123', 'Laura Hernández', 'Aprendiz', 'CC', 1),
('100000009', 'jose.castro@sena.co', '$2y$10$3na7OApuHiRKHV8XUW9PcuMV48WMJms5HWvfs4xEVSDpsyhuTply.', 'contraseña123', 'José Castro', 'Aprendiz', 'CC', 1),
('100000010', 'veronica.vasquez@sena.co', '$2y$10$49EJI4HFJ4MheL2XiQavRuF7L7MFEFrcgGZMYSU54DxavCl82Aep.', 'contraseña123', 'Verónica Vásquez', 'Aprendiz', 'CC', 1),
('1026307678', 'william_saavedra@yahoo.com', '$2y$10$jYR3ANCh0BUnL1.9f/F96Ogdnbl.o/tjEqVWcp92gpRnDj19DCkbO', '', 'William Saavedra', 'Administrador', 'CC', 1),
('1026307681', 'gege@gmail.com', '$2y$10$dnNQQNLdXWTTl5zJS2vwoORqgtpI.mYeVlw7upJxYqGTlPoAf7Ble', '', 'Gerson Pineda', 'Instructor', 'CC', 1),
('10263076900', 'egelvesa@sena.edu.co', '$2y$10$FumjNWcx7JG0i1F.hdb.2eosLYA2pJH68l.ZLjm9OQ4mhkG9wXlaG', '', 'DAVID MARIN', 'Instructor', 'CC', 0),
('200000001', 'pedro.moreno@sena.co', '$2y$10$24fppwxPNxz90OcNLdbmwOcY1dXMSH4IqbTpP2Qq6Ob4.i9vxWlBu', 'contraseña456', 'Pedro Moreno', 'Instructor', 'CC', 1),
('200000002', 'carla.rivera@sena.co', '$2y$10$DNYEtqJYlD5/F6OEBNkJcu6Do4pC7QDYh7KYzECxYsj/7FZQ8dEPi', 'contraseña456', 'Carla Rivera', 'Instructor', 'CC', 1),
('200000003', 'javier.munoz@sena.co', '$2y$10$onAWTqixsLb9opm.FO88SOWupNXEJMY.lTsZ/pakeLJRtJGkYU4jO', 'contraseña456', 'Javier Muñoz', 'Instructor', 'CC', 1),
('200000004', 'mariana.soto@sena.co', '$2y$10$9ziwub/75lvuzbPivDze4.pFi0WHRWNBkGMpoxKpb8uWN.Vmppl0u', 'contraseña456', 'Mariana Soto', 'Instructor', 'CC', 1),
('200000005', 'gustavo.melendez@sena.co', '$2y$10$h08M7jqqfTUZ2g2QAeHPv.A3Z8f5SzYM8NOclKIggE4b03IcVte7e', 'contraseña456', 'Gustavo Meléndez', 'Instructor', 'CC', 1),
('200000006', 'daniela.ortiz@sena.co', '$2y$10$ILHIMeOYQqnI5ji26iukY.4vhfm2WLfMZB0JsTb5kE7Rw.EpH/kCC', 'contraseña456', 'Daniela Ortiz', 'Instructor', 'CC', 1),
('200000007', 'francisco.alejandro@sena.co', '$2y$10$FNwdISnQd5N0Qhg2t0Q3JuQi35xO0mSHWSQy5fFUHOh84ojDWc4EK', 'contraseña456', 'Francisco Alejandro', 'Instructor', 'CC', 1),
('200000008', 'patricia.carrillo@sena.co', '$2y$10$1jgMWnkqCS7RDkAkdmboJ.2GZU6N8jBxOQ4FocyMc90CwrwZx78yK', 'contraseña456', 'Patricia Carrillo', 'Instructor', 'CC', 1),
('200000009', 'oscar.salazar@sena.co', '$2y$10$zbD22Cui8IoZmadyunuS1.NAoeK2pd4Od6GAGggtFwbikXceKUA26', 'contraseña456', 'Óscar Salazar', 'Instructor', 'CC', 1),
('200000010', 'isabel.mendoza@sena.co', '$2y$10$XABkCNJgWMx6jiYGUQ.NpuVzZvGnqjiGPhMzY6C.ID7gTSp2U1otS', 'contraseña456', 'Isabel Mendoza', 'Instructor', 'CC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `Cod_visitas` int(11) NOT NULL,
  `fecha_visita` date NOT NULL,
  `hora_visita` time NOT NULL,
  `num_visita` int(11) NOT NULL,
  `visita_grupal` tinyint(1) NOT NULL DEFAULT 0,
  `link_visita` varchar(255) DEFAULT NULL,
  `Observaciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `visita`
--

INSERT INTO `visita` (`Cod_visitas`, `fecha_visita`, `hora_visita`, `num_visita`, `visita_grupal`, `link_visita`, `Observaciones`) VALUES
(1, '2024-10-07', '04:16:00', 1, 0, NULL, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `ficha_id` (`ficha_id`),
  ADD KEY `pqr_id` (`pqr_id`),
  ADD KEY `Cod_visitas` (`Cod_visitas`),
  ADD KEY `fk_cod_jefe` (`cod_jefe`),
  ADD KEY `cod_empresa` (`cod_empresa`);

--
-- Indices de la tabla `aprendiz_instructor_visita`
--
ALTER TABLE `aprendiz_instructor_visita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aprendiz_documento` (`aprendiz_documento`),
  ADD KEY `instructor_documento` (`instructor_documento`),
  ADD KEY `visita_cod` (`visita_cod`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`Cod_empresa`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`num_ficha`),
  ADD KEY `nombre_programa` (`nombre_programa`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `visita` (`visita`),
  ADD KEY `fecha_visita` (`fecha_visita`);

--
-- Indices de la tabla `jefes`
--
ALTER TABLE `jefes`
  ADD PRIMARY KEY (`cod_jefe`);

--
-- Indices de la tabla `pqr`
--
ALTER TABLE `pqr`
  ADD PRIMARY KEY (`num_caso`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`nombre_programa`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`nombre`),
  ADD KEY `cod_empresa` (`cod_empresa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`Cod_visitas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprendiz_instructor_visita`
--
ALTER TABLE `aprendiz_instructor_visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `Cod_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pqr`
--
ALTER TABLE `pqr`
  MODIFY `num_caso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `Cod_visitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `aprendiz_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `usuarios` (`documento`),
  ADD CONSTRAINT `aprendiz_ibfk_2` FOREIGN KEY (`ficha_id`) REFERENCES `ficha` (`num_ficha`),
  ADD CONSTRAINT `aprendiz_ibfk_3` FOREIGN KEY (`pqr_id`) REFERENCES `pqr` (`num_caso`),
  ADD CONSTRAINT `aprendiz_ibfk_4` FOREIGN KEY (`Cod_visitas`) REFERENCES `visita` (`Cod_visitas`),
  ADD CONSTRAINT `cod_empresa` FOREIGN KEY (`cod_empresa`) REFERENCES `empresas` (`Cod_empresa`),
  ADD CONSTRAINT `fk_cod_empresa` FOREIGN KEY (`cod_empresa`) REFERENCES `empresas` (`Cod_empresa`),
  ADD CONSTRAINT `fk_cod_jefe` FOREIGN KEY (`cod_jefe`) REFERENCES `jefes` (`cod_jefe`);

--
-- Filtros para la tabla `aprendiz_instructor_visita`
--
ALTER TABLE `aprendiz_instructor_visita`
  ADD CONSTRAINT `aprendiz_instructor_visita_ibfk_1` FOREIGN KEY (`aprendiz_documento`) REFERENCES `aprendiz` (`documento`),
  ADD CONSTRAINT `aprendiz_instructor_visita_ibfk_2` FOREIGN KEY (`instructor_documento`) REFERENCES `instructor` (`documento`),
  ADD CONSTRAINT `aprendiz_instructor_visita_ibfk_3` FOREIGN KEY (`visita_cod`) REFERENCES `visita` (`Cod_visitas`);

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`nombre_programa`) REFERENCES `programa` (`nombre_programa`);

--
-- Filtros para la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `usuarios` (`documento`),
  ADD CONSTRAINT `instructor_ibfk_2` FOREIGN KEY (`visita`) REFERENCES `visita` (`Cod_visitas`),
  ADD CONSTRAINT `instructor_ibfk_3` FOREIGN KEY (`fecha_visita`) REFERENCES `visitas_instructor` (`fecha_visitas`);

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `sede_ibfk_1` FOREIGN KEY (`cod_empresa`) REFERENCES `empresas` (`Cod_empresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
