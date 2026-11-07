<?php
declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';

function escapar(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function mostrarTarjetaProducto(Producto $producto, int $nivelTitulo = 3): void
{
    $titulo = 'h' . $nivelTitulo;
    $nombre = escapar($producto->obtenerNombre());
    $categoria = escapar($producto->obtenerCategoria()->obtenerNombre());
    ?>
    <article>
        <img src="https://placehold.co/200x150" alt="Foto de <?= $nombre ?>">
        <div class="tajerjeta-producto-info">
            <<?= $titulo ?>><?= $nombre ?></<?= $titulo ?>>
            <p class="etiqueta-categoria">Categoria: <?= $categoria ?></p>
            <p class="texto-secundario"><?= escapar($producto->obtenerDescripcion()) ?></p>
            <p class="tarjeta-producto-precio">Precio: <?= $producto->obtenerPrecioFormateado() ?></p>
            <a class="enlace-detalle" href="producto-detalle.php?id=<?= $producto->obtenerId() ?>">Ver detalle</a>
        </div>
    </article>
    <?php
}