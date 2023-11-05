<?php
include('db.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM task WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    // Obtener el ID de forma segura (utilizando validación y saneamiento)
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si el ID es válido
    if ($id === false || $id <= 0) {
        // Manejo de errores
        $_SESSION['message'] = "ID de tarea no válido";
        $_SESSION['message_type'] = "danger";
        header("Location: index.php");
        exit; // Salir del script
    }

    // Obtener y sanear los datos del formulario
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    // Verificar si los datos son válidos
    if (empty($title) || empty($description)) {
        // Manejo de errores
        $_SESSION['message'] = "Los campos de título y descripción son obligatorios";
        $_SESSION['message_type'] = "danger";
        header("Location: index.php");
        exit; // Salir del script
    }

    // Preparar la consulta utilizando consultas preparadas
    $query = "UPDATE task SET title = ?, description = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Vincular los parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Tarea actualizada exitosamente";
            $_SESSION['message_type'] = "success";
            header("Location: index.php");
        } else {
            // Manejo de errores
            $_SESSION['message'] = "Error al actualizar la tarea";
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

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group mb-2">
                        <input type="text" name="title" value="<?php echo $title ?>" class="form-control" placeholder="Update Title">
                    </div>
                    <div class="form-group mb-2">
                        <textarea name="description" rows="2" class="form-control" placeholder="Update Description"><?php echo $description ?></textarea>
                    </div>
                    <button class="btn btn-success w-100" name="update">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>
