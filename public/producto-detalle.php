<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');
$idSolicitado = (int) filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

$productoEncontrado = false;
$producto = null;

try {
    $producto = $repositorio->buscarPorId($idSolicitado);
    $productoEncontrado = true;
} catch (OutOfBoundsException $error) {
    $productoEncontrado = false;
    http_response_code(404);
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
        <?php if ($productoEncontrado): ?>
            <article class="detalle-producto">
                <h2><?= escapar($producto->obtenerNombre()) ?></h2>
                <img src="https://placehold.co/300x200" alt="Foto de <?= escapar($producto->obtenerNombre()) ?>">
                <p class="etiqueta-categoria">Categoría: <?= escapar($producto->obtenerCategoria()->obtenerNombre()) ?></p>
                <p class="texto-secundario"><?= escapar($producto->obtenerDescripcion()) ?></p>
                <p class="tarjeta-producto-precio">Precio: <?= $producto->obtenerPrecioFormateado() ?></p>
                <?php mostrarDisponibilidad($producto); ?>
            </article>
        <?php else: ?>
            <h2>Producto no encontrado</h2>
            <p>El producto que buscas no existe o ya no está disponible.</p>
        <?php endif; ?>
        
        <p><a href="productos.php">Volver al catálogo</a></p>
    </main>

    <footer>
        <p>&copy; 2026 Tienda Tec. todos los derechos reservados</p>
    </footer>
</body>
</html>