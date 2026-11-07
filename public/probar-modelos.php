<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../src/datos/RepositorioProductos.php';

// Instanciamos el repositorio antes de invocar sus métodos
$repositorio = new RepositorioProductos(__DIR__ . '/../datos/datos.json');

echo '<pre>';
foreach ($repositorio->obtenerTodos() as $producto) {
    echo $producto->obtenerId() . ' | '
        . $producto->obtenerNombre() . ' | '
        . $producto->obtenerPrecioFormateado() . "\n";
}
echo '</pre>';