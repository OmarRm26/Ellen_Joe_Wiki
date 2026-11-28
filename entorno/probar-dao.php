<?php
declare(strict_types=1);

// Uso, desde la raíz del repositorio:  php entorno/probar-dao.php
// Comprueba el ProductoDAO sin abrir el navegador. Adáptalo a los nombres de tu dominio.

require_once __DIR__ . '/../src/datos/conectar.php';
require_once __DIR__ . '/../src/datos/ProductoDAO.php';

$fallos = 0;

function comprobar(string $descripcion, bool $cumplida): void
{
    global $fallos;

    echo sprintf("[%-5s] %s\n", $cumplida ? 'OK' : 'FALLO', $descripcion);
    if (!$cumplida) {
        $fallos++;
    }
}

function lanza(callable $operacion, string $claseEsperada): bool
{
    try {
        $operacion();
    } catch (Throwable $error) {
        return $error instanceof $claseEsperada;
    }

    return false;
}

echo "Prueba del ProductoDAO\n\n";

$conexion = conectar();
$dao = new ProductoDAO($conexion);

$todos = $dao->obtenerTodos();
comprobar('obtenerTodos() devuelve al menos un producto', count($todos) > 0);
comprobar('obtenerTodos() devuelve objetos Producto', $todos[0] instanceof Producto);

$primero = $todos[0];
comprobar('buscarPorId() encuentra un producto que existe', $dao->buscarPorId($primero->obtenerId())->obtenerNombre() === $primero->obtenerNombre());
comprobar('buscarPorId() lanza OutOfBoundsException si no existe', lanza(fn () => $dao->buscarPorId(999999), OutOfBoundsException::class));

$fragmento = substr($primero->obtenerNombre(), 0, 4);
comprobar("buscarPorNombre('$fragmento') encuentra el primer producto", count($dao->buscarPorNombre($fragmento)) >= 1);
comprobar("buscarPorNombre(\"' OR '1'='1\") se trata como texto, no como SQL", count($dao->buscarPorNombre("' OR '1'='1")) === 0);

// Con otra base seleccionada, la tabla productos no existe: el DAO debe avisar con su propia excepción.
$conexion->exec('USE information_schema');
comprobar('una falla de la base se convierte en AccesoDatosException', lanza(fn () => $dao->obtenerTodos(), AccesoDatosException::class));

echo $fallos === 0 ? "\nResultado: el DAO funciona como se espera.\n" : "\nResultado: hay $fallos prueba(s) con FALLO.\n";
exit($fallos === 0 ? 0 : 1);