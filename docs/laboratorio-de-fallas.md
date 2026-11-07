# Laboratorio de fallas – U3S07

| # | Qué rompí | Lo que predije | Excepción y mensaje real | ¿El mensaje me orienta? |
|---|---|---|---|---|
| 1 | La ruta del archivo | Lanzará un error de archivo no encontrado | `RuntimeException`: No se encontró el archivo de datos: .../datos/dato.json | Sí, indica claramente la ruta del archivo inexistente |
| 2 | El JSON | Fallará al decodificar el JSON por error de sintaxis | `JsonException`: Syntax error | Sí, señala que hay un problema de sintaxis en el archivo JSON |
| 3 | Un campo | Marcará que falta una clave requerida en el registro | `InvalidArgumentException`: El producto no tiene el campostock | Sí, menciona exactamente el campo faltante |
| 4 | La búsqueda | Se detendrá la ejecución por una excepción no capturada | `Fatal error: Uncaught OutOfBoundsException`: No existe un producto con id 9999. | Sí, indica explícitamente qué id falló y la falta de try/catch |
| 5 | Un tipo de dato | Fallará por incompatibilidad de tipos (String a Float) | `TypeError`: Producto::__construct(): Argument #4 ($precio) must be of type float, string given | Sí, explica que se esperaba un tipo float y se recibió string |

# Laboratorio de fallas — U3S07

### ¿Por qué el experimento 5 es el más peligroso?
Es el más peligroso porque involucra tipos de datos inconsistentes (ingresar texto donde se espera un valor numérico/float). Si no se usa el modo estricto (`declare(strict_types=1)`), PHP intentará convertir implícitamente el tipo de dato, lo que puede causar errores silenciosos en cálculos financieros o de stock sin lanzar una excepción inmediata.