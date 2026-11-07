# proyecto-DOMINIO

Catálogo de {{qué catalogas}} con {{qué transacción}}. Proyecto de la asignatura Aplicaciones Web (E-APW-2), grupo 401.

## Vista previa

https://OmarRm26/proyecto_tiendatec

## Dominio y entidades

| Entidad del curso | Equivalente en mi proyecto |
|---|---|
| Categoria | {{Wiki_Ellen}} |
| Producto | {{Figuras}} |
| Cliente / Usuario | {{Fans}} |
| Pedido + DetallePedido | {{1_paypal}} |

## Estructura

    proyecto-DOMINIO/
    ├── datos/datos.json
    ├── public/assests/css
    ├── docs/checklist-ux.md
    └── README.md

## Estado

Unidad II (front end) completa. Siguiente: Unidad III (back end en PHP).

## Bitácora U2S06

1. {{respuesta a la pregunta 1}}
2. {{respuesta a la pregunta 2}}
3. {{respuesta a la pregunta 3}}

## Cómo ejecutarlo

Para iniciar el servidor local de desarrollo, ejecuta en la terminal:

```bash
php -S localhost:8000 -t public

Si el precio de un ítem cambia, ¿qué archivo editas hoy y qué habría pasado antes de esta sesión?

Hoy únicamente edito el archivo datos/datos.json en la propiedad correspondiente. Antes de esta sesión, habría tenido que modificar manualmente cada archivo PHP donde el precio estuviera duplicado en el HTML (como en index.php, productos.php y producto-detalle.php), lo que aumentaba el riesgo de inconsistencias.

¿Por qué tu clase usa propiedades privadas y métodos en lugar de pasar el arreglo del JSON directo a la vista?

Usar propiedades privadas con métodos (encapsulamiento) asegura que los datos sean válidos, de solo lectura desde el exterior y no puedan ser modificados accidentalmente por la vista. Además, permite centralizar lógica como formatear precios o validar disponibilidad en la clase en lugar de duplicarla en el HTML.

En tu datos.json, el nombre de la categoría se repite como texto en cada ítem. ¿Qué problemas puede causar esa repetición cuando haya cientos de ítems?

Genera duplicidad de datos e ineficiencia de espacio. Si se decide cambiar o corregir el nombre de una categoría, habría que modificar cientos de registros individualmente, aumentando el riesgo de errores tipográficos e inconsistencias de filtrado.