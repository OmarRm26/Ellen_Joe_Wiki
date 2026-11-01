<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenido a Ellen Joe wiki</title>
        <!-- Hoja de estilos vinculada -->
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>
    <body>
        <header> 
            <h1>Bienvenido a mi tienda Tec</h1>
            <nav>
                <a href="index.php">Inicio</a>
                <a href="productos.php">Catalogo</a>
                <a href="contacto.php">contacto</a>
            </nav>
        </header>

        <main>
            <section>
                <h2>Agregar producto</h2>
                <form action="#" method="post">
                    <div class="campo">
                        <label for="nombre">Nombre del producto</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <br>
                    <div class="campo">
                        <label for="categoria">Categoria</label>
                        <input type="text" name="categoria" id="categoria" required>
                    </div>
                    <br>
                    <div class="campo">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" step="0.01" min="0" required>
                    </div>
                    <br>
                    <div class="campo">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" min="0" required>
                        <p classs="ayuda-campo" id="ayudaStock">Piezas disponibles, entre 0 a 999</p>
                        <p class="error-campo" id="errorStock">Escribe un numero entero entre el 0 y el 999. </p> 
                    </div>
                    <br>
                    <button type="submit" class="botton-agregar">Agregar producto</button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. todos los derechos reservados </p>
        </footer>

    </body>
</html>