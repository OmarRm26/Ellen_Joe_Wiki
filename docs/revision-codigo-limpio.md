# Revisión de Código Limpio – U3S07

| # | Principio | Qué encontré (archivo y método) | Qué cambié | Commit |
|---|---|---|---|---|
| 1 | Objetos (cap. 6) | `src/utilidades/vistas.php` en `mostrarDisponibilidad()` comprobaba directamente `$producto->obtenerStock() <= 0`. | Agregué el método `$producto->estaDisponible()` en `Producto.php` y delegué la responsabilidad al objeto. | `refactor: delega validación de disponibilidad al objeto Producto` |
| 2 | Nombres (cap. 2) | `public/producto-detalle.php` usaba la variable `$idSolicitado`. | Renombré la variable a `$productoId` para dar un contexto más claro y alineado al dominio. | `refactor: renombra idSolicitado a productoId para mayor claridad` |
| 3 | Repetición | `src/utilidades/vistas.php` tenía un error de escritura en el HTML (`tajerjeta-producto-info`). | Corregí el nombre de la clase CSS a `tarjeta-producto-info` asegurando consistencia con los estilos. | `refactor: corrige typo de clase CSS en tarjeta de producto` |