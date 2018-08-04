-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-08-2018 a las 18:57:13
-- Versión del servidor: 5.6.39-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sibcatie`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `idClase` int(11) NOT NULL,
  `nombre_clase` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `idColor` int(11) NOT NULL,
  `nombre_color` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `idConsulta` int(11) NOT NULL,
  `consulta` text,
  `fecha_consulta` datetime NOT NULL,
  `url_foto` varchar(255) NOT NULL,
  `latitud` decimal(10,0) DEFAULT NULL,
  `longitud` decimal(10,0) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `continente`
--

CREATE TABLE `continente` (
  `idContinente` int(11) NOT NULL,
  `nombre_continente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `determinadapor`
--

CREATE TABLE `determinadapor` (
  `idDeterminadaPor` int(11) NOT NULL,
  `nombre_determinado` varchar(45) NOT NULL,
  `fecha_determinado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `division`
--

CREATE TABLE `division` (
  `idDivision` int(11) NOT NULL,
  `nombre_division` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epiteto`
--

CREATE TABLE `epiteto` (
  `idEpiteto` int(11) NOT NULL,
  `nombre_epiteto` varchar(45) NOT NULL,
  `referencia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosalud`
--

CREATE TABLE `estadosalud` (
  `idEstadoSalud` int(11) NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exportar`
--

CREATE TABLE `exportar` (
  `Planta_idPlanta` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `idFamilia` int(11) NOT NULL,
  `nombre_familia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `Planta_idPlanta` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma`
--

CREATE TABLE `forma` (
  `idForma` int(11) NOT NULL,
  `nombre_forma` varchar(45) NOT NULL,
  `caracteristicas` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `idFoto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Planta_idPlanta` int(45) NOT NULL,
  `url` varchar(255) NOT NULL,
  `EstadoSalud_idEstadoSalud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `idGenero` int(11) NOT NULL,
  `nombre_genero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idActividad` int(11) NOT NULL,
  `fecha_historial` datetime NOT NULL,
  `accion` varchar(45) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `registro` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL,
  `planta_idPlanta` int(11) NOT NULL,
  `cretido` varchar(45) NOT NULL,
  `url` varchar(255) NOT NULL,
  `estado_idEstado` int(11) DEFAULT NULL,
  `fecha_imagen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombrecomun`
--

CREATE TABLE `nombrecomun` (
  `idNombreComun` int(11) NOT NULL,
  `nombre_nombre_comun` varchar(45) NOT NULL,
  `lengua` varchar(45) DEFAULT NULL,
  `Planta_idPlanta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `idOrden` int(11) NOT NULL,
  `nombre_orden` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planta`
--

CREATE TABLE `planta` (
  `idPlanta` int(11) NOT NULL,
  `idMascara` varchar(25) DEFAULT NULL,
  `Familia_idFamilia` int(11) DEFAULT NULL,
  `Genero_idGenero` int(11) DEFAULT NULL,
  `Epiteto_idEpiteto` int(11) DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `fuente_informacion` varchar(45) DEFAULT NULL,
  `altura` decimal(10,0) DEFAULT NULL,
  `autor` varchar(45) DEFAULT NULL,
  `Forma_idForma` int(11) DEFAULT NULL,
  `Color_idColor` int(11) DEFAULT NULL,
  `TipoHoja_idTipoHoja` int(11) DEFAULT NULL,
  `Continente_idContinente` int(11) DEFAULT NULL,
  `ZonaCardinal_idZonaCardinal` int(11) DEFAULT NULL,
  `reproduccion` tinyint(4) DEFAULT NULL,
  `DeterminadaPor_idDeterminadaPor` int(11) DEFAULT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `revision` tinyint(4) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `excel` tinyint(4) DEFAULT NULL,
  `orden_idOrden` int(11) DEFAULT NULL,
  `clase_idClase` int(11) DEFAULT NULL,
  `reino_idReino` int(11) DEFAULT NULL,
  `division_idDivision` int(11) DEFAULT NULL,
  `url_img` varchar(255) DEFAULT NULL,
  `nombre_cientifico` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planta_has_uso`
--

CREATE TABLE `planta_has_uso` (
  `Planta_idPlanta` int(11) NOT NULL,
  `Uso_idUso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reino`
--

CREATE TABLE `reino` (
  `idReino` int(11) NOT NULL,
  `nombre_reino` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre_rol`) VALUES
(0, 'Admin'),
(1, 'Ayudante'),
(2, 'Publico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `idseccion` int(11) NOT NULL,
  `nombre_seccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`idseccion`, `nombre_seccion`) VALUES
(1, 'Cultivos'),
(2, 'Flora nativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohoja`
--

CREATE TABLE `tipohoja` (
  `idTipoHoja` int(11) NOT NULL,
  `nombre_hoja` varchar(45) NOT NULL,
  `forma` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso`
--

CREATE TABLE `uso` (
  `idUso` int(11) NOT NULL,
  `nombre_uso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` date NOT NULL,
  `activo` tinyint(4) DEFAULT '1',
  `telefono` varchar(15) DEFAULT NULL,
  `rol_idrol` int(11) DEFAULT NULL,
  `seccion_idseccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonacardinal`
--

CREATE TABLE `zonacardinal` (
  `idZonaCardinal` int(11) NOT NULL,
  `nombre_cardinal` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`idClase`),
  ADD UNIQUE KEY `nombre_clase_UNIQUE` (`nombre_clase`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`idColor`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`idConsulta`),
  ADD KEY `fk_Consulta_Visitante1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `continente`
--
ALTER TABLE `continente`
  ADD PRIMARY KEY (`idContinente`);

--
-- Indices de la tabla `determinadapor`
--
ALTER TABLE `determinadapor`
  ADD PRIMARY KEY (`idDeterminadaPor`);

--
-- Indices de la tabla `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`idDivision`),
  ADD UNIQUE KEY `nombre_division_UNIQUE` (`nombre_division`);

--
-- Indices de la tabla `epiteto`
--
ALTER TABLE `epiteto`
  ADD PRIMARY KEY (`idEpiteto`);

--
-- Indices de la tabla `estadosalud`
--
ALTER TABLE `estadosalud`
  ADD PRIMARY KEY (`idEstadoSalud`);

--
-- Indices de la tabla `exportar`
--
ALTER TABLE `exportar`
  ADD PRIMARY KEY (`Planta_idPlanta`,`Usuario_idUsuario`),
  ADD KEY `fk_Exportar_Planta1_idx` (`Planta_idPlanta`),
  ADD KEY `fk_Exportar_Usuario2_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`idFamilia`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`Planta_idPlanta`,`Usuario_idUsuario`),
  ADD KEY `fk_Favorito_Planta1_idx` (`Planta_idPlanta`),
  ADD KEY `fk_Favorito_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `forma`
--
ALTER TABLE `forma`
  ADD PRIMARY KEY (`idForma`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`idFoto`),
  ADD KEY `fk_Foto_Planta_idx` (`Planta_idPlanta`),
  ADD KEY `fk_Foto_idEstadoSalud_idx` (`EstadoSalud_idEstadoSalud`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idActividad`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nombrecomun`
--
ALTER TABLE `nombrecomun`
  ADD PRIMARY KEY (`idNombreComun`),
  ADD KEY `fk_NombreComun_idPlanta_idx` (`Planta_idPlanta`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`idOrden`),
  ADD UNIQUE KEY `nombre_orden_UNIQUE` (`nombre_orden`);

--
-- Indices de la tabla `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`idPlanta`);

--
-- Indices de la tabla `planta_has_uso`
--
ALTER TABLE `planta_has_uso`
  ADD PRIMARY KEY (`Planta_idPlanta`,`Uso_idUso`),
  ADD KEY `fk_Planta_has_Uso_Planta1_idx` (`Planta_idPlanta`),
  ADD KEY `fk_Planta_has_Uso_Uso1_idx` (`Uso_idUso`);

--
-- Indices de la tabla `reino`
--
ALTER TABLE `reino`
  ADD PRIMARY KEY (`idReino`),
  ADD UNIQUE KEY `nombre_reino_UNIQUE` (`nombre_reino`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`idseccion`);

--
-- Indices de la tabla `tipohoja`
--
ALTER TABLE `tipohoja`
  ADD PRIMARY KEY (`idTipoHoja`);

--
-- Indices de la tabla `uso`
--
ALTER TABLE `uso`
  ADD PRIMARY KEY (`idUso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_usuario_rol1_idx` (`rol_idrol`),
  ADD KEY `fk_usuario_seccion1_idx` (`seccion_idseccion`);

--
-- Indices de la tabla `zonacardinal`
--
ALTER TABLE `zonacardinal`
  ADD PRIMARY KEY (`idZonaCardinal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `idColor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `idConsulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `continente`
--
ALTER TABLE `continente`
  MODIFY `idContinente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `determinadapor`
--
ALTER TABLE `determinadapor`
  MODIFY `idDeterminadaPor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `division`
--
ALTER TABLE `division`
  MODIFY `idDivision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `epiteto`
--
ALTER TABLE `epiteto`
  MODIFY `idEpiteto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadosalud`
--
ALTER TABLE `estadosalud`
  MODIFY `idEstadoSalud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `idFamilia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `forma`
--
ALTER TABLE `forma`
  MODIFY `idForma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `idGenero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nombrecomun`
--
ALTER TABLE `nombrecomun`
  MODIFY `idNombreComun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `idOrden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planta`
--
ALTER TABLE `planta`
  MODIFY `idPlanta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planta_has_uso`
--
ALTER TABLE `planta_has_uso`
  MODIFY `Planta_idPlanta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reino`
--
ALTER TABLE `reino`
  MODIFY `idReino` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipohoja`
--
ALTER TABLE `tipohoja`
  MODIFY `idTipoHoja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `uso`
--
ALTER TABLE `uso`
  MODIFY `idUso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `zonacardinal`
--
ALTER TABLE `zonacardinal`
  MODIFY `idZonaCardinal` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `fk_Consulta_idUsuario` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `exportar`
--
ALTER TABLE `exportar`
  ADD CONSTRAINT `fk_Exportar_idPlanta` FOREIGN KEY (`Planta_idPlanta`) REFERENCES `planta` (`idPlanta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Exportar_idUsuario` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `fk_Favorito_idPlanta` FOREIGN KEY (`Planta_idPlanta`) REFERENCES `planta` (`idPlanta`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Favorito_idUsuario` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `fk_Foto_idEstadoSalud` FOREIGN KEY (`EstadoSalud_idEstadoSalud`) REFERENCES `estadosalud` (`idEstadoSalud`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Foto_idPlanta` FOREIGN KEY (`Planta_idPlanta`) REFERENCES `planta` (`idPlanta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nombrecomun`
--
ALTER TABLE `nombrecomun`
  ADD CONSTRAINT `fk_NombreComun_idPlanta` FOREIGN KEY (`Planta_idPlanta`) REFERENCES `planta` (`idPlanta`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `planta_has_uso`
--
ALTER TABLE `planta_has_uso`
  ADD CONSTRAINT `fk_Planta_has_Uso_idPlanta` FOREIGN KEY (`Planta_idPlanta`) REFERENCES `planta` (`idPlanta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Planta_has_Uso_idUso` FOREIGN KEY (`Uso_idUso`) REFERENCES `uso` (`idUso`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
