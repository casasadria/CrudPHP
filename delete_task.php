<?php
include('db.php');

if (isset($_GET['id'])) {
    // Obtener el ID de forma segura (utilizando validación y saneamiento)
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    // Verificar si el ID es válido
    if ($id === false || $id <= 0) {
        // Manejo de errores
        $_SESSION['message'] = "ID de tarea no válido";
        $_SESSION['message_type'] = "danger";
        header("Location: index.php");
        exit; // Salir del script
    }

    // Preparar la consulta utilizando consultas preparadas
    $query = "DELETE FROM task WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Vincular el parámetro y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Tarea eliminada exitosamente";
            $_SESSION['message_type'] = "success";
            header("Location: index.php");
        } else {
            // Manejo de errores
            $_SESSION['message'] = "Error al eliminar la tarea";
            $_SESSION['message_type'] = "danger";
            header("Location: index.php");
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
    } else {
        // Manejo de errores
        $_SESSION['message'] = "Error en la consulta preparada";
        $_SESSION['message_type'] = "danger";
        header("Location: index.php");
    }
}
?>
