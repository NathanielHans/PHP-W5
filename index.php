<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login/login.php");
    exit;
}
require 'database.php';
require 'create-to-do.php';
require 'display-to-do.php';
require 'delete-to-do.php';
require 'done-to-do.php';
//cek button submit sudah ditekan atau belum
$idUser = $_SESSION["id"];
if (isset($_POST["submit"])) {
    if (createTask($_POST, $idUser) > 0) {
        echo "data berhasil ditambakan";
    } else {
        echo "data gagal ditambahkan";
    }
}
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    if (delete($id) > 0) {
        echo "data berhasil dihapus";
    } else {
        echo "data gagal dihapus";
    }
    header("Location: index.php");
}
if (isset($_GET["done"])) {
    $id = $_GET["done"];
    if (done($id) > 0) {
        echo "Tugas Telah Selesai";
    } else {
        echo "Tugas gagal diganti";
    }
    header("Location: index.php");
}
$query = "SELECT * FROM todo where id_user = $idUser";
$todo = display($query);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            <h4 class="text-center my-3 pb-3">To Do App</h4>

                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" action="" method="post">
                                <div class="row mb-1">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" name="task" id="task" class="form-control" placeholder="Enter a task here" required>
                                        <!-- <label class="form-label" for="task">Enter a task here</label> -->
                                    </div>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-warning" name="submit">Tambah</button>
                                </div>
                                </div>
                            </form>

                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($todo as $item) : ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $item["task"] ?></td>
                                            <td><?= $item["status"] ?></td>
                                            <td>
                                                <button type="submit" class="btn btn-success ms-1"><a href="index.php?done=<?= $item["id"] ?>" style="color : white;text-decoration: none;">Selesai</a></button>
                                                <button type="submit" class="btn btn-danger"><a href="index.php?delete=<?= $item["id"] ?>" style="color : white;text-decoration: none;">Hapus</a></button>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-danger"><a href="login/logout.php" style="color : white;text-decoration: none;">Logout!</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- beda -->
    <!-- <form action="" method="post">
        <input type="text" name="task" id="task" placeholder="Masukkan To-Do" required>
        <button type="submit" name="submit">Tambah</button>
    </form>
    <table border="1px solid black">
        <tr>
            <th>No</th>
            <th>Task</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($todo as $item) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $item["task"] ?></td>
                <td><?= $item["status"] ?></td>
                <td>
                    <a href="index.php?done=<?= $item["id"] ?>">Selesai</a>
                    <a href="index.php?delete=<?= $item["id"] ?>">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    <a href="login/logout.php">Logout!</a> -->
</body>

</html>