<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/conectar.php';
require_once __DIR__ . '/../src/datos/ProductoDAO.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$busqueda = trim((string) ($_GET['q'] ?? ''));
$productos = [];
$servicioDisponible = true;

try {
    $dao = new ProductoDAO(conectar());
    $productos = $busqueda === '' ? $dao->obtenerTodos() : $dao->buscarPorNombre($busqueda);
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
        <title>Pagina Ellen Joe</title>
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>
    <body>
        <header> 
            <h1>Productos</h1>
            <nav aria-label="Principal">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php" aria-current="page">Catalogo</a></li>
                    <li><a href="contacto.php">Preguntas</a></li>
                </ul>
            </nav>  
        </header>
        
        <main>
            <h2>Catalogo</h2>
                <a href="agregar-producto.php" class="botton-agregar">agregar producto</a>
            <form class="busqueda" method="get" action="productos.php" role="search">
                <label for="q">Buscar por nombre:</label>
                <input type="search" name="q" id="q" value="<?= escapar($busqueda) ?>">
                <button type="submit">Buscar</button>
            </form>

            <?php if (!$servicioDisponible): ?>
                <?php mostrarAvisoServicio(); ?>
            <?php elseif ($productos === []): ?>
                <p>No encontramos productos con ese nombre.</p>
            <?php else: ?>
            <section class="tarjetas-productos">
                <?php foreach ($productos as $producto): ?>
                <?php mostrarTarjetaProducto($producto, 3); ?>
                <?php endforeach; ?>
            </section>
            <?php endif; ?>
            
                       
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. todos los derechos reservados </p>
        </footer>

    </body>
</html>