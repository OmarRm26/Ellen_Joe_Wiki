<?php
declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';

class RepositorioProductos
{
    private string $rutaArchivo;

    public function __construct(string $rutaArchivo)
    {
        $this->rutaArchivo = $rutaArchivo;
    }

    /** @return Producto[] */
    public function obtenerTodos(): array
    {
        return $this->convertirAProductos($this->leerRegistros());
    }

    private function leerRegistros(): array
    {
        if (!is_file($this->rutaArchivo)) {
            throw new RuntimeException("No se encontró el archivo de datos: {$this->rutaArchivo}");
        }

        $contenido = file_get_contents($this->rutaArchivo);
        $registros = json_decode($contenido, true, 512, JSON_THROW_ON_ERROR);

        if (!is_array($registros)) {
            throw new RuntimeException('El archivo de datos debe contener un arreglo de registros.');
        }

        return $registros;
    }

    /** @return Producto[] */
    private function convertirAProductos(array $registros): array
    {
        return array_map(
            fn (array $registro) => Producto::desdeArreglo($registro),
            $registros
        );
    }
}