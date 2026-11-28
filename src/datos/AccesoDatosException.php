<?php
declare(strict_types=1);

// Error al hablar con la base de datos. Envuelve la excepción original de PDO:
// las vistas no dependen de PDO ni muestran detalles internos al visitante.
class AccesoDatosException extends RuntimeException
{
}