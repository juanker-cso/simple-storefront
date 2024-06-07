-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3303
-- Generation Time: Jun 07, 2024 at 01:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d02`
--

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) DEFAULT NULL,
  `apellidos` varchar(128) DEFAULT NULL,
  `correo` varchar(120) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `rol` int(1) DEFAULT NULL,
  `archivo_n` varchar(255) DEFAULT NULL,
  `archivo_f` varchar(128) DEFAULT NULL,
  `estado` int(1) DEFAULT 1,
  `eliminado` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo_f`, `estado`, `eliminado`) VALUES
(18, 'Jose', 'Gonzales', 'j.gonzales@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '', '', 1, 0),
(19, 'Joaquin', 'Gonzales Herrera', 'joaquingh@email.org', '827ccb0eea8a706c4c34a16891f84e7b', 2, '', '', 1, 0),
(24, 'Alejandra Mora', 'García Nuñez', 'Alemogarcia@pp.net', '21218cca77804d2ba1922c33e0151105', 2, '', '', 1, 0),
(27, 'Joaquin', 'Contreras', 'contreras6889@correos.org.mx', '8e34cd6bedab9f18eb47b6772d16dc95', 2, 'face-grin.svg', '3d7ded1ecbeebf2c567a5228f8d8e0b1', 1, 0),
(29, 'Enrique', 'Sanchez', 'enrique-s@mail.com', '7694f4a66316e53c8cdd9d9954bd611d', 1, 'face-grin-stars.svg', '875fa44a45f287a47c2cea773bd103c1', 1, 0),
(30, 'Roberto', 'Galindo Mesa', 'rgm@tmn.net', '4c882dcb24bcb1bc225391a602feca7c', 2, 'chess-knight.svg', '891c77e3a97e5c1492f410a582d091ca', 1, 0),
(31, 'Jorge Omar', 'Ortiz', 'jo-2222@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'face-grin-squint.svg', '4f761f1acc3a614f82314cb83799e0b5', 1, 0),
(32, 'Luis Martin', 'Garcia', 'luisgar.999@mail.com', 'dcddb75469b4b4875094e14561e573d8', 1, 'pexels-olly-3771807.jpg', '64ed00a0d1d1681c17e5a659a0bd4fda', 1, 0),
(33, 'Pablo', 'Contreras', 'pablo@pablo.me', 'c4ca4238a0b923820dcc509a6f75849b', 2, 'tumblr_8b97ba6ce84a57c65af76113385b701c_da630227_540.jpg', 'ecce96a072cc57a0295f191e73d34757', 1, 0),
(34, 'Aurora Leticia', 'Alger Torres', 'aurora.lat@correos.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'ai-generated-8649314_1280.jpg', '23e4b31f4b99806b4b4312af32ebf0f0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `listado_pedidos`
--

CREATE TABLE `listado_pedidos` (
  `relacion` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `importe` double DEFAULT NULL,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listado_pedidos`
--

INSERT INTO `listado_pedidos` (`relacion`, `id_pedido`, `id_producto`, `cantidad`, `importe`, `eliminado`) VALUES
(1, 1, 7, 2, 700, 0),
(2, 1, 6, 6, 390, 0),
(3, 2, 1, 2, 41, 0),
(4, 2, 4, 1, 40, 0),
(5, 2, 6, 3, 195, 0),
(6, 3, 11, 2, 49398, 0),
(7, 3, 10, 4, 19556, 0),
(8, 3, 13, 3, 10698, 0),
(9, 3, 17, 1, 6500, 0),
(10, 3, 9, 1, 6604.8, 0),
(11, 4, 12, 1, 12209, 0),
(12, 4, 15, 1, 86999, 0),
(13, 5, 8, 3, 25797, 1),
(14, 5, 16, 2, 5200, 0),
(15, 5, 9, 1, 6604.8, 0),
(16, 6, 17, 5, 32500, 1),
(17, 6, 16, 1, 2600, 0),
(18, 6, 15, 6, 521994, 0),
(19, 6, 17, 1, 6500, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `mview_empleados`
-- (See below for the actual view)
--
CREATE TABLE `mview_empleados` (
`id` int(11)
,`nombre completo` varchar(257)
,`correo` varchar(120)
,`rol` varchar(9)
);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) DEFAULT NULL,
  `correo` varchar(128) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(1) DEFAULT 0,
  `eliminado` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `nombre`, `correo`, `direccion`, `fecha`, `estado`, `eliminado`) VALUES
(1, 'eljo', 'rtsprt@gmail.com', 'España #2343', '2024-05-18 16:11:59', 1, 0),
(2, 'mary_bo', 'marybo_45@hotmail.com', 'Las rosas #42', '2024-05-18 16:11:59', 1, 0),
(3, 'Jorge Omar', 'jo-2222@mail.com', 'España 345', '2024-05-22 12:47:31', 1, 0),
(4, 'Enrique', 'enrique-s@mail.com', 'Lopez Mateos #3424', '2024-05-22 07:10:24', 1, 0),
(5, 'Ornelas', 'contreras6889@correos.org.mx', 'pacifico #34', '2024-05-22 17:22:20', 1, 0),
(6, 'Omar', 'ddd@udg.mx', 'Coronado #34', '2024-05-23 17:08:16', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) DEFAULT NULL,
  `codigo` varchar(32) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `archivo_n` varchar(255) DEFAULT NULL,
  `archivo` varchar(128) DEFAULT NULL,
  `estado` int(1) DEFAULT 1,
  `eliminado` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `estado`, `eliminado`) VALUES
(1, 'Harina', 'harina 1k trigo', 'Bolsa con 1kg de harina de trigo', 20.5, 8, 'flour-791840_1280.jpg', 'd8e01ef44c1c7027d3a4493de899dbce', 1, 1),
(2, 'Pimienta', 'pimienta100', 'Bolsas de pimienta en polvo de 100 g', 8.99, 25, NULL, NULL, 1, 1),
(3, 'Pastel', 'Pastel reb choco mer ', 'Rebanada de pasted de chocolate con mermelada de fresa.', 85, 24, 'pexels-abhinavcoca-291528.jpg', '629050de321f7cda6c792af1bba50dd8', 1, 1),
(4, 'Plátano', 'Platano kg', 'Plátanos en manojo, pesados al momento de venta.', 40, 80, 'pexels-akio-1093038.jpg', '095dddc50f12f22c31b0f7b6da0031ea', 1, 1),
(6, 'Manzana', 'Manzana kg', 'Manzanas por kg', 65, 200, 'apples-8212695_1280.jpg', '77714fcecaa9367bca8f503832d455d0', 1, 1),
(7, 'Lampara de campismo', 'Lampara gas', 'Lampara de gasolina para uso en exterior', 350, 38, 'pexels-prsrafa-943150.jpg', '40efeb7bfa3178ace7be0a92400c2d02', 1, 1),
(8, 'NovaTech Chihuahua modelo 4', 'Nova-PC Chihuahua M4', 'parte de la línea PetCompanion. Este adorable robot chihuahua no solo brinda compañía y entretenimiento, sino que también actúa como un asistente personal inteligente. Equipado con IA avanzada, el ChihuahuaBot puede recordar tus horarios, enviar recordatorios y realizar tareas simples del hogar.', 8599, 15, 'perrijobot.jpg', '2d1f533eb3cc9362b5e5a7aa0a22c724', 1, 0),
(9, 'Toolmaster Basic caja de herramientas basico', 'ElectraC-ToolMaster basico', 'Presentamos la ToolMaster Basic de ElectraCorp, una caja de herramientas de mantenimiento esencial para el hogar y la oficina. Parte de la línea ToolMaster, esta caja ofrece una selección de herramientas de alta calidad, perfectas para reparaciones y ajustes cotidianos. Equipado con destornilladores, llaves, alicates y más, el ToolMaster Basic garantiza que siempre tengas lo necesario para mantener tus dispositivos y robots en perfecto estado. Otros productos de la línea ToolMaster incluyen el ToolMaster Pro y el ToolMaster Elite, cada uno diseñado para satisfacer las necesidades tanto de principiantes como de profesionales.', 6604.8, 44, 'toolbox.jpg', '87d54b93b0613841217b54a2c2aa91e3', 1, 0),
(10, 'Refacción Manos Humanoides Fusion Dynamics', 'FusionD-Ref manos', 'diseñadas específicamente para robots humanoides. Con una alta gamma de compatibilidad en el mercado. Equipadas con sensores táctiles avanzados y una amplia gama de movimientos articulados, permiten a tu robot realizar tareas complejas con facilidad. Venta por pares.\r\nIncluye herramienta de instalación rápida.', 4889, 56, 'repairhands.jpg', '155ee1c9a2ebb74cc33e9d7184208fae', 1, 0),
(11, 'MealMaster Ram-see G012D0171', 'Nova-MM G012D0171', 'El MealMaster Ram-says G012D0171 de NovaTech es el robot de cocina definitivo para los amantes de la gastronomía. Equipado con IA avanzada, este robot puede preparar una amplia variedad de platos con precisión y rapidez. Su interfaz intuitiva permite seleccionar recetas, ajustar ingredientes y personalizar tiempos de cocción con facilidad. El Ram-says G012D0171 no solo cocina, sino que también pica, mezcla y amasa, asegurando resultados perfectos en cada uso.\r\n\r\nEn términos de rendimiento, el MealMaster Ram-says está equipado con motores de alta potencia y precisión, capaces de ejecutar tareas complejas como batir claras de huevo hasta alcanzar picos firmes o amasar masas densas para pan. Además, sus sensores avanzados monitorean continuamente la temperatura y la consistencia de los ingredientes, garantizando una cocción uniforme y perfecta.\r\n\r\nLa seguridad es una prioridad en el diseño del Ram-says G012D0171. Cuenta con múltiples sistemas de seguridad, incluyendo apagado automático en caso de sobrecalentamiento, sensores de bloqueo para evitar accidentes con las cuchillas y materiales resistentes al calor para proteger tanto al usuario como al robot.\r\n\r\nLa línea MealMaster de NovaTech incluye una gama de productos diseñados para satisfacer todas las necesidades culinarias, desde modelos básicos para tareas simples hasta robots de cocina avanzados como el Ram-says G012D0171. Cada producto de la línea MealMaster está diseñado para ofrecer facilidad de uso, seguridad y resultados profesionales en la cocina.', 24699, 6, 'mealmaster.jpg', '0a89754ba2965d414651b5d748590216', 1, 0),
(12, 'MothLight M-1000 de ZenithTech', 'ZenT-RM Mothlight M1000', 'Diseñado para la detección y cambio de luminarias en techos y áreas de difícil acceso. El RepairMate MothLight está equipado con sensores de alta precisión y una cámara de alta resolución, el MothLight M-1000 puede detectar fácilmente luces defectuosas o desgastadas y realizar cambios de forma rápida y eficiente. Su diseño compacto y maniobrabilidad lo hacen ideal para entornos comerciales y residenciales, permitiendo una inspección y mantenimiento de luminarias sin necesidad de andamios o equipos pesados.', 12209, 59, 'ceilingbot.jpg', '53028b1d87e955a0988ba4b80d113d30', 1, 0),
(13, 'ZenithTech ZenithClassic PepperMate', 'ZenT-ZC PepperMate', 'El ZenithClassic PepperMate es un encantador robot de mesa diseñado para facilitar la experiencia gastronómica. Con su diseño vintage y su funcionalidad práctica, el PepperMate se encarga de pasar los condimentos y otros elementos de la mesa durante las comidas, así como de almacenarlos de manera ordenada una vez finalizada la cena. Su tamaño compacto y su elegante estética lo convierten en un complemento ideal para cualquier ocasión.', 3566, 52, 'condimentador.jpg', '94c53eb964b36e4ce20ad22aa0c24adc', 1, 0),
(14, 'Jardin Supreme EX 1.0', 'ZenT-GT ', '¡Descubre el Jardin Supreme EX de ZenithTech, el robot de jardinería más extremo del mercado! Diseñado con una estructura similar a una araña, este robot se mueve con agilidad y precisión gracias a sus múltiples patas, conquistando cualquier terreno con facilidad. Equipado con un par de brazos multifuncionales, el Jardin Supreme EX es la herramienta definitiva para todos tus desafíos de jardinería.\r\n\r\nCaracterísticas Técnicas:\r\n\r\n    Movilidad Extrema: Gracias a sus patas articuladas, el Jardin Supreme EX se desplaza sin problemas sobre césped, grava y terrenos irregulares, llegando a lugares que otros robots no pueden alcanzar.\r\n    Brazos Multifuncionales: Con sus brazos intercambiables, puedes equiparlo con una variedad de herramientas de jardinería, desde cortadoras de césped y arrancadores de malezas hasta aplicadores de fertilizantes y herramientas para instalar pequeñas cercas.\r\n    Precisión y Potencia: Su avanzada tecnología de sensores y motores de alta potencia garantizan que cada tarea se realice con precisión milimétrica y eficiencia máxima.\r\n    Operación Autónoma: Programable a través de una app intuitiva, puedes definir rutas y tareas específicas, permitiendo que el Jardin Supreme EX trabaje de manera autónoma mientras disfrutas de tu tiempo libre.\r\n    Resistente a las Intemperies: Diseñado para soportar condiciones climáticas adversas, asegurando un rendimiento óptimo en cualquier estación del año.\r\n\r\nEl Jardin Supreme EX no es solo una herramienta de jardinería, es la experiencia definitiva para los entusiastas del exterior. Transforma tu jardín en un paraíso con el poder y la precisión del Jardin Supreme EX, ¡el robot de jardinería que lo hace todo!', 196000, 4, 'garden supreme.jpg', 'edb86685bc4ec57feaab32d8c802bc45', 1, 0),
(15, 'HedgeMaster de ElectraCorp', 'ElectraC-HedgeMaster TK600', 'Presentamos el HedgeMaster de ElectraCorp, el robot definitivo para el mantenimiento de árboles y setos. Con su avanzada tecnología de corte, el HedgeMaster recorta y da forma a tus arbustos y árboles con precisión milimétrica. Diseñado para facilitar el trabajo de jardinería, este robot se encarga de las tareas más difíciles, dejando tu jardín impecable y bien cuidado. ¡Confía en HedgeMaster para un jardín siempre perfecto!', 86999, 1, 'podador.jpg', '412680a15d9487bc4cea1483609a6090', 1, 0),
(16, 'Extensor de battería universal Fusion Dynamics', 'FusionD-Ref battería', 'La Extensión de Batería de Fusion Dynamics es una solución avanzada diseñada para prolongar la vida útil de tus dispositivos electrónicos. Con una capacidad de alta densidad y tecnología de carga rápida, esta extensión asegura un rendimiento continuo y eficiente. Compatible con una amplia gama de dispositivos, ofrece una integración sencilla y una mejora notable en la duración de la batería.', 2600, 42, 'extensión de batería.jpg', '6b51ef2c2dee1d87ee9af933f57c835e', 1, 0),
(17, 'Centro de carga empotrable de Fusion Dynamics', 'FusionD-Ref Cargador', 'El Cargador Universal de Robots y Baterías de Fusion Dynamics es una solución integral para la carga de dispositivos robóticos y sus baterías. Diseñado para instalación en pared, este cargador cuenta con un gran puerto de acoplamiento para robots y baterías de gran tamaño, varios puertos más pequeños para dispositivos adicionales y un cable de carga versátil. Con tecnología avanzada de gestión de energía, asegura una carga rápida y eficiente para todos tus dispositivos robóticos.', 6500, 57, 'centro de carga pared.jpg', '77bb1426ebdb00f83d8729d0d62d41b4', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) DEFAULT NULL,
  `archivo` varchar(64) DEFAULT NULL,
  `estado` int(1) DEFAULT 1,
  `eliminado` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `archivo`, `estado`, `eliminado`) VALUES
(1, 'cosas de niños', NULL, 1, 1),
(2, 'Vuelve el verano', 'f2a4c9b8b013b49c6b84f39b60686a0d.jpg', 1, 1),
(3, 'Enlatados al 3x2', '5c113be76f1252d199ee8bf09e3f2547.jpg', 1, 1),
(4, 'Venta navideña', '546b799579f932709bfedee614010786.jpg', 1, 1),
(5, 'Megaventa ElectraCorp', 'd19e411aa6825386b97bc93d66b6ec32.jpg', 1, 0),
(6, 'Venta flash ', '8e99a8959c1ed881ceaf00c6bda9bb03.jpg', 1, 0),
(7, 'Venta de verano', '05e1fefa50d63a86faef29695ed9e01d.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Structure for view `mview_empleados`
--
DROP TABLE IF EXISTS `mview_empleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mview_empleados`  AS SELECT `empleados`.`id` AS `id`, concat(`empleados`.`nombre`,' ',`empleados`.`apellidos`) AS `nombre completo`, `empleados`.`correo` AS `correo`, CASE `empleados`.`rol` WHEN 1 THEN 'Gerente' WHEN 2 THEN 'Ejecutivo' ELSE 'Empleado' END AS `rol` FROM `empleados` WHERE `empleados`.`estado` = 1 AND `empleados`.`eliminado` = 00  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listado_pedidos`
--
ALTER TABLE `listado_pedidos`
  ADD PRIMARY KEY (`relacion`),
  ADD KEY `el_pedido` (`id_pedido`),
  ADD KEY `el_producto` (`id_producto`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `listado_pedidos`
--
ALTER TABLE `listado_pedidos`
  MODIFY `relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listado_pedidos`
--
ALTER TABLE `listado_pedidos`
  ADD CONSTRAINT `el_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `el_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
