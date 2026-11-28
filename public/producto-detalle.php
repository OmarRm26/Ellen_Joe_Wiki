<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/conectar.php';
require_once __DIR__ . '/../src/datos/ProductoDAO.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$idSolicitado = (int) filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

$productoEncontrado = true;
$servicioDisponible = true;
try {
    $producto = (new ProductoDAO(conectar()))->buscarPorId($idSolicitado);
} catch (OutOfBoundsException $error) {
    $productoEncontrado = false;
    http_response_code(404);
} catch (AccesoDatosException $error) {
    $servicioDisponible = false;
    marcarServicioNoDisponible();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $productoEncontrado ? escapar($producto->obtenerNombre()) : 'Producto no encontrado' ?></title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header> 
        <h1>Detalle de Producto</h1>
        <nav aria-label="Principal">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Catálogo</a></li>
                <li><a href="contacto.php">Preguntas</a></li>
            </ul>
        </nav>  
    </header>

    <main>
        <?php if (!$servicioDisponible): ?>
            <h1>Catálogo no disponible</h1>
            <?php mostrarAvisoServicio(); ?>
        <?php elseif ($productoEncontrado): ?>
            <h1><?= escapar($producto->obtenerNombre()) ?></h1>
            <!-- Aquí va el HTML de tu ficha, con los métodos de $producto -->
            <p>Precio: <?= $producto->obtenerPrecioFormateado() ?></p>
            <?php mostrarDisponibilidad($producto); ?>
        <?php else: ?>
            <h1>Producto no encontrado</h1>
            <p>El producto que buscas no existe o ya no está disponible.</p>
            <a href="productos.php">Volver al catálogo</a>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. todos los derechos reservados</p>
    </footer>
</body>
</html>