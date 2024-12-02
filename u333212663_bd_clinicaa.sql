-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-12-2024 a las 23:32:35
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u333212663_bd_clinicaa`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `ActualizarMedicamento` (IN `p_id_medicamento` INT, IN `p_nombre` VARCHAR(100), IN `p_descripcion` TEXT, IN `p_tipo` VARCHAR(50), IN `p_precio` DECIMAL(10,2), IN `p_cantidad` INT)   BEGIN
    UPDATE medicamentos
    SET nombre = p_nombre,
        descripcion = p_descripcion,
        tipo = p_tipo,
        precio = p_precio,
        cantidad = p_cantidad
    WHERE id_medicamento = p_id_medicamento;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `ActualizarMedico` (IN `id` INT, IN `nombre` TEXT, IN `especialidad` TEXT, IN `telefono` TEXT)   BEGIN
    UPDATE medicos SET nombre_medico = nombre, especialidad = especialidad, telefono_contacto = telefono WHERE id_medico = id;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `actualizar_turno_cita` (IN `id_cita_u` INT, IN `nuevo_turno` VARCHAR(10))   BEGIN
    UPDATE citas
    SET turno = nuevo_turno
    WHERE id_cita = id_cita_u;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `agregar_medico` (IN `nombre_m` VARCHAR(100), IN `especialidad_m` VARCHAR(100), IN `telefono_contacto_m` VARCHAR(15))   BEGIN
    INSERT INTO medicos (nombre_medico, especialidad, telefono_contacto)
    VALUES (nombre_m, especialidad_m, telefono_contacto_m);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `agregar_paciente` (IN `nombre_p` VARCHAR(100), IN `fecha_nac` DATE, IN `direccion_p` VARCHAR(255), IN `telefono_p` VARCHAR(15), IN `email_p` VARCHAR(100))   BEGIN
    INSERT INTO pacientes (nombre, fecha_nacimiento, direccion, telefono, email)
    VALUES (nombre_p, fecha_nac, direccion_p, telefono_p, email_p);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `CrearMedico` (IN `nombre` TEXT, IN `especialidad` TEXT, IN `telefono` TEXT)   BEGIN
    INSERT INTO medicos (nombre_medico, especialidad, telefono_contacto) VALUES (nombre, especialidad, telefono);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `crearPaciente` (IN `nombre` VARCHAR(100), IN `fecha_nacimiento` DATE, IN `direccion` VARCHAR(100), IN `telefono` VARCHAR(15), IN `email` VARCHAR(100))   BEGIN
    INSERT INTO pacientes (nombre, fecha_nacimiento, direccion, telefono, gmail)
    VALUES (nombre, fecha_nacimiento, direccion, telefono, email);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `EliminarMedicamento` (IN `p_id_medicamento` INT)   BEGIN
    DELETE FROM medicamentos WHERE id_medicamento = p_id_medicamento;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `EliminarMedico` (IN `id` INT)   BEGIN
    DELETE FROM medicos WHERE id_medico = id;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `EliminarPaciente` (IN `id` INT)   BEGIN
    DELETE FROM pacientes WHERE id_paciente = id;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `GetHistorialByPacienteOrFecha` (IN `pacienteNombre` VARCHAR(100), IN `visitaFecha` DATE)   BEGIN
    SELECT hm.id_historial, hm.fecha_visita, hm.descripcion, hm.diagnostico, hm.tratamiento,
           p.nombre AS paciente_nombre, p.fecha_nacimiento, p.direccion, p.telefono, p.email
    FROM historial_medico hm
    INNER JOIN pacientes p ON hm.id_paciente = p.id_paciente
    WHERE (p.nombre COLLATE utf8mb4_unicode_ci LIKE CONCAT('%', pacienteNombre, '%') COLLATE utf8mb4_unicode_ci OR pacienteNombre IS NULL)
      AND (hm.fecha_visita = visitaFecha OR visitaFecha IS NULL);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `InsertarMedicamento` (IN `p_nombre` VARCHAR(100), IN `p_descripcion` TEXT, IN `p_tipo` VARCHAR(50), IN `p_precio` DECIMAL(10,2), IN `p_cantidad` INT)   BEGIN
    INSERT INTO medicamentos (nombre, descripcion, tipo, precio, cantidad)
    VALUES (p_nombre, p_descripcion, p_tipo, p_precio, p_cantidad);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `ObtenerMedicoPorID` (IN `id` INT)   BEGIN
    SELECT * FROM medicos WHERE id_medico = id;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `ObtenerMedicos` ()   BEGIN
    SELECT * FROM medicos;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `ObtenerPacientePorID` (IN `id` INT)   BEGIN
    SELECT * FROM pacientes WHERE id_paciente = id;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `obtenerPacientes` ()   BEGIN
    SELECT * FROM pacientes;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `obtener_citas_por_fecha` (IN `fecha_cita` DATE)   BEGIN
    SELECT * FROM citas
    WHERE fecha_cita = fecha_cita;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `obtener_citas_por_paciente` (IN `id_paciente_c` INT)   BEGIN
    SELECT * FROM citas
    WHERE id_paciente = id_paciente_c;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `obtener_historial_por_paciente` (IN `id_paciente_h` INT)   BEGIN
    SELECT * FROM historial_medico
    WHERE id_paciente = id_paciente_h;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `obtener_lista_citas` (IN `fechaCita` DATE)   BEGIN
    SELECT 
        c.id_cita,
        c.fecha_cita,
        c.hora_cita,
        c.turno,
        p.nombre AS paciente_nombre,
        m.nombre_medico AS medico_nombre
    FROM 
        citas c
    INNER JOIN 
        pacientes p ON c.id_paciente = p.id_paciente
    INNER JOIN 
        medicos m ON c.id_medico = m.id_medico
    WHERE 
        (c.fecha_cita = fechaCita OR fechaCita IS NULL);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `RegistrarHistorialPaciente` (IN `p_id_paciente` INT, IN `p_id_medico` INT, IN `p_fecha_visita` DATE, IN `p_descripcion` TEXT, IN `p_diagnostico` TEXT, IN `p_tratamiento` TEXT)   BEGIN
    -- Verificar si el paciente existe
    IF EXISTS (SELECT 1 FROM pacientes WHERE id_paciente = p_id_paciente) THEN
        INSERT INTO historial_medico (id_paciente, id_medico, fecha_visita, descripcion, diagnostico, tratamiento)
        VALUES (p_id_paciente, p_id_medico, p_fecha_visita, p_descripcion, p_diagnostico, p_tratamiento);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El paciente no existe.';
    END IF;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `RegistrarPacienteEnDistrito` (IN `p_nombre` VARCHAR(100), IN `p_fecha_nacimiento` DATE, IN `p_direccion` VARCHAR(255), IN `p_telefono` VARCHAR(15), IN `p_email` VARCHAR(100), IN `p_id_distrito` INT)   BEGIN
    DECLARE paciente_id INT;
    DECLARE distrito_count INT;

    -- Verificar si el distrito existe
    SELECT COUNT(*) INTO distrito_count
    FROM distrito
    WHERE id_distrito = p_id_distrito;

    IF distrito_count > 0 THEN
        -- Insertar nuevo paciente
        INSERT INTO pacientes (nombre, fecha_nacimiento, direccion, telefono, email)
        VALUES (p_nombre, p_fecha_nacimiento, p_direccion, p_telefono, p_email);

        -- Obtener el id del paciente recién creado
        SET paciente_id = LAST_INSERT_ID();

        -- Insertar en la tabla intermedia Paciente_Distrito
        INSERT INTO Paciente_Distrito (id_paciente, id_distrito)
        VALUES (paciente_id, p_id_distrito);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El distrito especificado no existe';
    END IF;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `registrar_cita` (IN `fecha_c` DATE, IN `hora_c` TIME, IN `id_paciente_c` INT, IN `id_medico_c` INT, IN `turno_c` VARCHAR(10))   BEGIN
    INSERT INTO citas (fecha_cita, hora_cita, id_paciente, id_medico, turno)
    VALUES (fecha_c, hora_c, id_paciente_c, id_medico_c, turno_c);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `registrar_historial` (IN `id_paciente_h` INT, IN `id_medico_h` INT, IN `fecha_visita_h` DATE, IN `descripcion_h` TEXT, IN `diagnostico_h` TEXT, IN `tratamiento_h` TEXT)   BEGIN
    INSERT INTO historial_medico (id_paciente, id_medico, fecha_visita, descripcion, diagnostico, tratamiento)
    VALUES (id_paciente_h, id_medico_h, fecha_visita_h, descripcion_h, diagnostico_h, tratamiento_h);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_actualizarDistrito` (IN `p_id_distrito` INT, IN `p_nombre_distrito` VARCHAR(100), IN `p_descripcion` VARCHAR(255))   BEGIN
    UPDATE distrito
    SET nombre_distrito = p_nombre_distrito,
        descripcion = p_descripcion
    WHERE id_distrito = p_id_distrito;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_actualizarPaciente` (IN `p_id_paciente` INT, IN `nombre` VARCHAR(100), IN `p_direccion` VARCHAR(255), IN `p_fecha_nacimiento` DATE, IN `p_codigo_distrito` INT, IN `p_email` VARCHAR(100))   BEGIN
    UPDATE pacientes
    SET nombre = nombre,
        direccion = p_direccion,
        fecha_nacimiento = p_fecha_nacimiento,
        codigo_distrito = p_codigo_distrito,
        email = p_email
    WHERE id_paciente = p_id_paciente;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_eliminarDistrito` (IN `p_id_distrito` INT)   BEGIN
    DELETE FROM distrito WHERE id_distrito = p_id_distrito;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_eliminarPaciente` (IN `p_codigo_paciente` INT)   BEGIN
    DELETE FROM pacientes WHERE id_paciente = p_codigo_paciente;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_filtrarPaciente` (IN `p_codigo_paciente` INT, IN `p_nombre_paciente` VARCHAR(100), IN `p_codigo_distrito` INT)   BEGIN
    SELECT p.id_paciente, 
           p.nombre, 
           p.direccion, 
           p.fecha_nacimiento, 
           p.email, 
           d.nombre_distrito
    FROM pacientes p
    LEFT JOIN distrito d ON p.codigo_distrito = d.id_distrito
    WHERE (p.id_paciente = p_codigo_paciente OR p_codigo_paciente IS NULL)
      AND (p.nombre LIKE CONCAT('%', p_nombre_paciente, '%') OR p_nombre_paciente IS NULL)
      AND (p.codigo_distrito = p_codigo_distrito OR p_codigo_distrito IS NULL);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_insertarDistrito` (IN `p_nombre_distrito` VARCHAR(100), IN `p_descripcion` VARCHAR(255))   BEGIN
    INSERT INTO distrito (nombre_distrito, descripcion)
    VALUES (p_nombre_distrito, p_descripcion);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_insertarPaciente` (IN `p_nombre_paciente` VARCHAR(100), IN `p_direccion` VARCHAR(255), IN `p_fecha_nacimiento` DATE, IN `p_codigo_distrito` INT, IN `p_email` VARCHAR(100))   BEGIN
    INSERT INTO pacientes (nombre, direccion, fecha_nacimiento, codigo_distrito, email)
    VALUES (p_nombre_paciente, p_direccion, p_fecha_nacimiento, p_codigo_distrito, p_email);
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_listar_paciente` ()   BEGIN
    SELECT p.id_paciente, 
           p.nombre, 
           p.direccion, 
           p.fecha_nacimiento, 
           d.nombre_distrito, 
           p.email
    FROM pacientes p
    LEFT JOIN distrito d ON p.codigo_distrito = d.id_distrito;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_obtenerDistritos` ()   BEGIN
    SELECT id_distrito, nombre_distrito FROM distrito;
END$$

CREATE DEFINER=`u333212663_root`@`127.0.0.1` PROCEDURE `sp_obtenerPacientePorId` (IN `paciente_id` INT)   BEGIN
    SELECT p.id_paciente, 
           p.nombre, 
           p.direccion, 
           p.fecha_nacimiento, 
           p.email, 
           d.nombre_distrito
    FROM pacientes p
    LEFT JOIN distrito d ON p.codigo_distrito = d.id_distrito
    WHERE p.id_paciente = paciente_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  `hora_cita` time DEFAULT NULL,
  `turno` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_paciente`, `id_medico`, `fecha_cita`, `hora_cita`, `turno`) VALUES
(1, 1, 1, '2024-11-18', '10:10:00', 'noche'),
(2, 2, 1, '2024-11-30', '03:34:00', 'mañana'),
(3, 2, 1, '2024-11-12', '09:00:00', 'Noche'),
(4, 2, 2, '2024-11-25', '19:22:00', 'Noche'),
(5, 2, 2, '2003-10-23', '10:00:00', 'TARDE'),
(6, 2, 2, '2003-10-23', '10:00:00', 'TARDE'),
(7, 2, 2, '2024-12-02', '13:00:00', 'TARDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `nombre_distrito` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`id_distrito`, `nombre_distrito`, `descripcion`, `fecha_creacion`) VALUES
(1, 'Lima', 'Distrito capital del Perú', '2024-11-16 07:50:15'),
(2, 'Callao', 'Puerto principal del Perú', '2024-11-16 07:50:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medico`
--

CREATE TABLE `historial_medico` (
  `id_historial` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `fecha_visita` date DEFAULT NULL,
  `descripcion` text NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_medico`
--

INSERT INTO `historial_medico` (`id_historial`, `id_paciente`, `id_medico`, `fecha_visita`, `descripcion`, `diagnostico`, `tratamiento`) VALUES
(2, 1, 1, '2024-11-26', 'cancer terminal', 'muerte', 'vivir la vida que le queda'),
(3, 1, 1, '2024-11-26', 'tumor', 'cancer terminal', 'vivir la vida'),
(6, 1, 1, '2024-12-02', 'Cancer terminal tipo 2', '12 meses de vida', 'Quimioterapia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_medicamentos`
--

CREATE TABLE `inventario_medicamentos` (
  `id_medicamento` int(11) NOT NULL,
  `nombre_medicamento` varchar(100) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_medicamento` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id_medicamento`, `nombre`, `descripcion`, `tipo`, `precio`, `cantidad`) VALUES
(2, 'Naproxeno ', 'Pastilla', 'Analgésico ', 7.50, 28),
(4, 'Salvutamol', 'Jarabe', 'Analgésico	', 5.50, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_medico` int(11) NOT NULL,
  `nombre_medico` varchar(100) NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `telefono_contacto` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `nombre_medico`, `especialidad`, `telefono_contacto`) VALUES
(1, 'Jhon keaths Sebastian Livias', 'Ginecologo ', '935417822'),
(2, 'Edwin Torres Perales', 'Transgenero', '916728995'),
(3, 'Dr. Juan Pérez', 'Cardiología', '555-1234'),
(4, 'Dra. María López', 'Pediatría', '555-5678'),
(5, 'Dr. Carlos García', 'Dermatología', '555-8765'),
(6, 'Dra. Ana Torres Borbón ', 'Ginecología', '555-4321'),
(7, 'Dr. Luis Fernández', 'Ortopedia', '555-1357'),
(14, 'Jorge Medrano Medina', 'Odontología', '97543678'),
(15, 'Luis Alberto  Castro', 'Neurólogo ', '934542034'),
(16, 'Dra. Juanita Melendez Sanchez', 'Oftamologia', '802853941');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `codigo_distrito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `fecha_nacimiento`, `direccion`, `telefono`, `email`, `codigo_distrito`) VALUES
(1, 'Juan', '1990-05-12', 'Calle Falsa 123', '123456789', 'juanli@example.com', 2),
(2, 'Laura Martínez', '1985-06-15', 'Av. Siempre Viva 123', '555-9876', 'laura.martinez@example.com', 2),
(3, 'Miguel Torres', '1990-03-22', 'Calle Falsa 456', '555-5432', 'miguel.torres@example.com', 1),
(4, 'Sofía González', '1978-11-01', 'Boulevard de los Sueños 789', '555-6789', 'sofia.gonzalez@example.com', 1),
(5, 'Andrés Rodríguez', '1982-08-30', 'Plaza Central 321', '555-2468', 'andres.rodriguez@example.com', 2),
(6, 'Claudia Ramírez', '1995-01-10', 'Calle de la Libertad 654', '555-1358', 'claudia.ramirez@example.com', 2),
(7, 'Juan Pérez', '1990-05-10', 'Av. Siempre Viva 123', '987654321', 'juan.perez@example.com', 1),
(8, 'María López', '1985-03-15', 'Av. Las Flores 456', '987654322', 'maria.lopez@example.com', 2),
(9, 'Miguel ahhhhhhh', '2024-11-11', 'Av. Alfredo Mendiola 6232', '', 'jhon_livias_@hotmail.com', 2),
(10, 'luis manuel', '2024-07-20', 'los olivos de pro', '', 'jhon_livias_@hotmail.com', 1),
(11, 'Luisa', '2000-02-23', 'Central 234', '', 'laurita@gmail.com', 2),
(12, 'Mirella ', '2005-10-23', 'Av.Ricardo Palma', '', 'mirella.olivares@gmail.com', 1),
(13, 'Rosita', '1991-09-10', 'Olivos ', '', 'rositafresita@gmail.com', 2),
(14, 'Amelia Reyes', '2002-10-23', 'av.Larco Herrera', '', 'bootyshac@stockpe.xyz', 2),
(15, 'Sophia Anicama', '2000-10-23', 'Jr.Pumacahua 523', '', 'zdenek-kincl.cz@hdxprime.xyz', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_administrativo`
--

CREATE TABLE `personal_administrativo` (
  `id_personal` int(11) NOT NULL,
  `nombre_personal` varchar(100) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `telefono_contacto` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `medicamentos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `id_paciente`, `id_medico`, `fecha_emision`, `medicamentos`) VALUES
(1, 3, 2, '2024-11-25', 'sfdg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'JHON KEATHS', 'jhonlivias293@gmail', '$2y$10$EJZH9VJFm8faAs/zVwKYB.MUki6trLc68w9DUjNZD6DyDlA/YirGm'),
(2, 'JHON KEATHS', 'jhonlivias293@gmail', '$2y$10$WgqrAB2lReII8mLghqTb8.XqgnirQTPDagtHySyYCQhyyZt9l27hm'),
(3, 'JHON KEATHS', 'jhonlivias292@gmail.com', '$2y$10$IG/kj.iEaNMXbTcmH0VPreqMqnOCN1tkzC4l7gFv2dR.T4bWR6jdi'),
(4, 'JHON KEATHS', 'jhonlivias292@gmail.com', '$2y$10$q1CGRBO7b9OZ5Ald6hju2OFHz5L6.Eo8dDvlEyhFKMf/VppfFO2kG'),
(5, 'JHON KEATHS', 'jhonlivias292@gmail.com', '$2y$10$8V/dfB/HrOpmzFnUeEfY5.kgyleLyJshh.V4kH4EFfaswLhWbLeWq'),
(6, 'JHON KEATHS', 'jhonlivias292@gmail.com', '$2y$10$X4zxB/A4Aw0iTtOFqA79R.to.a9M9PzD4z8p36/XbfhXeqmqayQzW'),
(7, 'Jade', 'jade@gmail.com', '$2y$10$QfqGDoRT/OWX98J5WzlGtesSNzOoEnPkhgfrB.ldgT7a2FvrhgRD2'),
(8, 'Nombre1', 'nombre@correo.com', '$2y$10$DrngpJYh0c5yFMCk1nXYauH0cAKkvVPCfTDvysfPv7VA7Ai8E3JiW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_distrito`);

--
-- Indices de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `inventario_medicamentos`
--
ALTER TABLE `inventario_medicamentos`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `fk_codigo_distrito` (`codigo_distrito`);

--
-- Indices de la tabla `personal_administrativo`
--
ALTER TABLE `personal_administrativo`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inventario_medicamentos`
--
ALTER TABLE `inventario_medicamentos`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personal_administrativo`
--
ALTER TABLE `personal_administrativo`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD CONSTRAINT `historial_medico_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `historial_medico_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_codigo_distrito` FOREIGN KEY (`codigo_distrito`) REFERENCES `distrito` (`id_distrito`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `recetas_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
