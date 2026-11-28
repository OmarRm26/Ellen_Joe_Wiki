<?php
declare(strict_types=1);

// Copia este archivo como src/config/conexion.php (ese archivo no se sube a GitHub).
// Estos valores son los del entorno de desarrollo que crea .devcontainer.
// En el hosting (S15) tendrás otros, y nunca se escriben en el repositorio.

return [
    'host'    => '127.0.0.1',
    'puerto'  => 3306,
    'base'    => 'proyecto',
    'usuario' => 'app',
    'clave'   => 'app123',
];