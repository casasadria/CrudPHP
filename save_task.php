<?php
include('db.php');

if(isset($_POST['save_task'])){
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Utiliza consultas preparadas para mayor seguridad
    $query = "INSERT INTO task (title, description) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Enlazar los parámetros, 'ss' significa que se añaden dos valores de tipo cadena (strigs)
        mysqli_stmt_bind_param($stmt, 'ss', $title, $description);

        // Ejecutar la consulta preparada
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Task Saved succsefully";
            $_SESSION['message_type'] = "success";
            header("Location: index.php");

        } else {
            $_SESSION['message'] = mysqli_error($conn);;
            $_SESSION['message_type'] = "danger";
            header("Location: index.php");
        }

        // Cerrar la declaración preparada
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = mysqli_error($conn);;
        $_SESSION['message_type'] = "danger";
        header("Location: index.php");
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
