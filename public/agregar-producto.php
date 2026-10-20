<html>
    <head>
        <title>Bienvenido a Ellen Joe wiki</title>
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
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" name ="nombre" id="nombre" required>
                    <br>
                    <label for="categoria">Categoria</label>
                    <input type="text" name ="categoria" id="categoria" required>
                    <br>
                    <label for="precio">Precio</label>
                    <input type="number" name ="precio" id="precio" step="0.01" min="0">
                    <br>
                    <label for="stock">Stock</label>
                    <input type="text" name ="stock" id="stock" step="0.01" min="0">

                    <button type="submit">Agregar producto</button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2026 Tienda Tec. todos los derechos reservados </p>
        </footer>

    </body>
</html>