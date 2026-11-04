<?php   
declare(strict_types=1);

require_once __DIR__ . '/../src/modelos/Categoria.php';
require_once __DIR__ . '/../src/modelos/Producto.php';

$Accsesorios = new Categoria("Accesorios");
$Pines = new Categoria("Pines");

echo $Accsesorios->obtenerNombre(). '<br>';
echo $Pines->obtenerNombre(). '<br> --------<br>';

#$intento = new Producto(1, "Figura de Ellen Joe maid", new Categoria("Accesorios"), 899.00, "Texto", 10, "https://placehold.co/200x150");

$traje = Producto::desdeArreglo([
    'id' => 1,
    'nombre' => "Figura de Ellen Joe maid",
    'categoria' => "Accesorios",
    'precio' => 899.00,
    'descripcion' => "Texto",
    'stock' => 10,
    'imagen' => "https://placehold.co/200x150?text=Ellen+Joe+maid"
]);

echo $traje->obtenerNombre().'('.$traje->obtenerCategoria()->obtenerNombre().') y cuesta '.$traje->obtenerPrecioFormateado().' y es de la categoria '.$traje->obtenerCategoria()->obtenerNombre().'<br>';
echo $traje->estadoDisponible() ? 'Existe producto' : 'Agotado';
?>