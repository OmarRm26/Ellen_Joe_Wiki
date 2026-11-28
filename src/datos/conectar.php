<?php
declare(strict_types=1);

require_once __DIR__ . '/AccesoDatosException.php';

// Abre la conexión con la base de datos. Las vistas no deben conocer estos datos.
function conectar(): PDO
{
    $ruta = __DIR__ . '/../config/conexion.php';

    if (!is_file($ruta)) {
        throw new RuntimeException('Falta src/config/conexion.php: copia conexion.ejemplo.php con ese nombre.');
    }

    $config = require $ruta;
    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['puerto'],
        $config['base']
    );

    try {
        return new PDO($dsn, $config['usuario'], $config['clave'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $error) {
        error_log('conectar: ' . $error->getMessage());
        throw new AccesoDatosException('No se pudo conectar con la base de datos.', 0, $error);
    }
}