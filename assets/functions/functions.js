function fntDelRegistro(id) {
    swal({
        title: "¿Estás seguro de eliminar el registro?",
        text: "Una vez suprimido, no se podrá recuperar.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            // Si el usuario confirma, envía una solicitud POST para eliminar el registro
            const formData = new FormData();
            formData.append("id", id);

            fetch("delete_task.php", {
                method: "POST",
                body: formData
            }).then(response => {
                if (response.ok) {
                    swal("Registro eliminado con éxito.", {
                        icon: "success",
                    }).then(() => {
                        // Recarga la página o realiza cualquier acción adicional necesaria
                        location.reload();
                    });
                } else {
                    swal("Error al eliminar el registro.", {
                        icon: "error",
                    });
                }
            });
        } else {
            swal("No se ha eliminado ningún registro.");
        }
    });
}

function editDelRegistro(id) {
    swal({
        title: "¿Estás seguro de editar el registro?",
        icon: "info",
        buttons: true,
        dangerMode: true,
    }).then((willEdit) => {
        if (willEdit) {
            // Si el usuario confirma, puedes redirigir a la página de edición con el ID
            window.location.href = "edit.php?id=" + id;
        } else {
            swal("No se ha editado ningún registro.");
        }
    });
}
