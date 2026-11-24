<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/datos/conectar.php';
require_once __DIR__ . '/../src/modelos/Producto.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

// El JOIN devuelve la categoría como texto, con los mismos campos que tenía datos.json.
$consulta = 'SELECT p.id, p.nombre, c.nombre AS categoria, p.precio, p.descripcion, p.stock, p.imagen
             FROM productos p
             INNER JOIN categorias c ON c.id = p.categoria_id
             ORDER BY p.id';

$registros = conectar()->query($consulta)->fetchAll();
$productos = array_map(fn (array $registro) => Producto::desdeArreglo($registro), $registros);
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
                        <section class="tarjetas-productos">
                <?php foreach ($productos as $producto): ?>
                <?php mostrarTarjetaProducto($producto, 3); ?>
            <?php endforeach; ?>
            </section>
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. todos los derechos reservados </p>
        </footer>

    </body>
</html>