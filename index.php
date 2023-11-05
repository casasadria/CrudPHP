<?php include("db.php"); ?>

<?php include("includes/header.php"); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();
            } ?>
            <div class="card card-body">
                <form action="save_task.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control mb-2" placeholder="Task Title"
                               autofocus>
                    </div>
                    <div class="form-group">
                            <textarea name="description" rows="2" class="form-control mb-2"
                                      placeholder="Task Description"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success w-100" name="save_task" value="Save Task">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM task";
                $result_tasks = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result_tasks)) { ?>
                    <tr>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['created_add'] ?></td>
                        <td style="display: flex;" class="mb-2">
                            <form action="edit.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <button type="button" class="btn btn-secondary" onclick="editDelRegistro(<?php echo $row['id']; ?>)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </form>
                            <form action="delete_task.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <button type="button" class="btn btn-danger" onclick="fntDelRegistro(<?php echo $row['id']; ?>)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
