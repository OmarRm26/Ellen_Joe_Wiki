CREATE TABLE `categorias` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(60) UNIQUE NOT NULL
);

CREATE TABLE `productos` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT 0,
  `categoria_id` int NOT NULL,
  `imagen` varchar(255) NOT NULL
);

CREATE TABLE `clientes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(120) UNIQUE NOT NULL,
  `contrasena_hash` varchar(255) NOT NULL
);

CREATE TABLE `usuarios` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(120) UNIQUE NOT NULL,
  `contrasena_hash` varchar(255) NOT NULL
);

CREATE TABLE `pedidos` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `estado` ENUM ('pendiente', 'pagado', 'enviado', 'cancelado') NOT NULL DEFAULT 'pendiente'
);

CREATE TABLE `detalles_pedido` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `pedido_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
);

ALTER TABLE `productos` ADD FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

ALTER TABLE `pedidos` ADD FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

ALTER TABLE `detalles_pedido` ADD FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

ALTER TABLE `detalles_pedido` ADD FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
