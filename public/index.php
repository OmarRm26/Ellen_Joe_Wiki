<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

require_once __DIR__ . '/../src/datos/conectar.php';
require_once __DIR__ . '/../src/datos/ProductoDAO.php';

$destacados = [];
$servicioDisponible = true;

try {
    $destacados = array_slice((new ProductoDAO(conectar()))->obtenerTodos(), 0, 3);
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
    <title>Página Ellen Joe - Inicio</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header> 
        <h1>Productos</h1>
        <nav aria-label="Principal">
            <ul>
                <li><a href="index.php" aria-current="page">Inicio</a></li>
                <li><a href="productos.php">Catálogo</a></li>
                <li><a href="contacto.php">Preguntas</a></li>
            </ul>
        </nav>  
    </header>

    <main>
        <?php if ($servicioDisponible): ?>
        <section class="tarjetas-productos">
            <?php foreach ($destacados as $producto): ?>
                <?php mostrarTarjetaProducto($producto, 3); ?>
            <?php endforeach; ?>
        </section>
        <?php else: ?>
            <?php mostrarAvisoServicio(); ?>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. todos los derechos reservados</p>
    </footer>
</body>
</html>