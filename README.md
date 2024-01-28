
- **`assets/`:** Carpeta que contiene la imagen `1.png`.
- **`includes/`:** Carpeta que contiene archivos PHP incluidos en otros scripts.
- **`delete_task.php`:** Script PHP para eliminar una tarea existente de la base de datos.
- **`db.php`:** Script PHP para manejar la conexión a la base de datos.
- **`edit.php`:** Script PHP para editar una tarea existente en la base de datos.
- **`index.php`:** Página principal que muestra todas las tareas almacenadas.
- **`save_task.php`:** Script PHP para guardar una nueva tarea en la base de datos.
- **`.idea/`:** Carpeta que contiene archivos relacionados con el entorno de desarrollo (p. ej., configuraciones de PhpStorm).

## Uso

1. Clona este repositorio en tu servidor web.
2. Crea la base de datos MySQL y la tabla `tareas` con las columnas necesarias (`id`, `nombre`, `descripcion`, `imagen`, `video`).
3. Configura la conexión a la base de datos en el archivo `db.php`.
4. Accede a `index.php` para ver todas las tareas almacenadas.
5. Utiliza `save_task.php` para agregar nuevas tareas, `edit.php` para editar tareas existentes y `delete_task.php` para eliminar tareas existentes.

## Notas

- Asegúrate de tener los permisos adecuados para acceder al video `2.mp4` desde el repositorio.
- La seguridad y la validación de datos no se abordan en este proyecto básico y deben implementarse según sea necesario para un entorno de producción.

¡Disfruta del proyecto!
