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

    private function leerRegistros(): array
    {
        if (!file_exists($this->rutaArchivo)) {
            return [];
        }
        $contenido = file_get_contents($this->rutaArchivo);
        return json_decode($contenido, true) ?? [];
    }

    private function convertirAProductos(array $registros): array
    {
        $productos = [];
        foreach ($registros as $registro) {
            $productos[] = new Producto(
                $registro['id'],
                $registro['nombre'],
                $registro['descripcion'],
                $registro['precio'],
                $registro['categoria_id'],
                $registro['imagen']
            );
        }
        return $productos;
    }

    public function obtenerTodos(): array
    {
        $registros = $this->leerRegistros();
        return $this->convertirAProductos($registros);
    }
}