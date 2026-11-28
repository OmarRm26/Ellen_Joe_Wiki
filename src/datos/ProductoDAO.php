<?php
declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';
require_once __DIR__ . '/AccesoDatosException.php';

// Único lugar que sabe cómo se leen los productos de la base de datos.
// Tiene los mismos métodos que RepositorioProductos (S7): las vistas casi no se enteran del cambio.
class ProductoDAO
{
    // El JOIN devuelve la categoría como texto, con los mismos campos que tenía datos.json.
    private const CONSULTA_BASE = 'SELECT p.id, p.nombre, c.nombre AS categoria, p.precio, p.descripcion, p.stock, p.imagen
                                   FROM productos p
                                   INNER JOIN categorias c ON c.id = p.categoria_id';

    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerTodos(): array
    {
        $registros = $this->leerRegistros(self::CONSULTA_BASE . ' ORDER BY p.id');

        return $this->convertirAProductos($registros);
    }

        public function buscarPorId(int $id): Producto
    {
        $registros = $this->leerRegistros(self::CONSULTA_BASE . ' WHERE p.id = :id', ['id' => $id]);

        if ($registros === []) {
            throw new OutOfBoundsException("No existe un producto con id $id.");
        }

        return Producto::desdeArreglo($registros[0]);
    }

        public function buscarPorNombre(string $texto): array
    {
        $registros = $this->leerRegistros(
            self::CONSULTA_BASE . ' WHERE p.nombre LIKE :texto ORDER BY p.id',
            ['texto' => '%' . $texto . '%']
        );

        return $this->convertirAProductos($registros);
    }

    private function leerRegistros(string $consulta, array $parametros = []): array
    {
        try {
            $sentencia = $this->conexion->prepare($consulta);
            $sentencia->execute($parametros);

            return $sentencia->fetchAll();
        } catch (PDOException $error) {
            // El detalle técnico va al registro del servidor; el visitante recibe un mensaje general.
            error_log('ProductoDAO: ' . $error->getMessage());
            throw new AccesoDatosException('No se pudo consultar el catálogo.', 0, $error);
        }
    }

    private function convertirAProductos(array $registros): array
    {
        return array_map(
            fn (array $registro) => Producto::desdeArreglo($registro),
            $registros
        );
    }
}