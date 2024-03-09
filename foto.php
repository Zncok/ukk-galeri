<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>

    <style>
        /* Color of the links BEFORE scroll */
        .navbar-scroll .nav-link,
        .navbar-scroll .navbar-toggler-icon,
        .navbar-scroll .navbar-brand {
            color: #262626;
        }

        /* Color of the navbar BEFORE scroll */
        .navbar-scroll {
            background-color: #FFC017;
        }

        /* Color of the links AFTER scroll */
        .navbar-scrolled .nav-link,
        .navbar-scrolled .navbar-toggler-icon,
        .navbar-scroll .navbar-brand {
            color: #262626;
        }

        /* Color of the navbar AFTER scroll */
        .navbar-scrolled {
            background-color: #fff;
        }

        /* An optional height of the navbar AFTER scroll */
        .navbar.navbar-scroll.navbar-scrolled {
            padding-top: auto;
            padding-bottom: auto;
        }

        .navbar-brand {
            font-size: unset;
            height: 3.5rem;
        }
    </style>

</head>

<body>
    <h1>Halaman Foto</h1>
    <nav class="navbar navbar-expand-lg navbar-scroll fixed-top shadow-0 border-bottom border-dark">
        <div class="container">
            <a class="navbar-brand" href="#!"><i class="fab fa-mdb fa-4x"></i></a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foto.php">Foto</a>
                    </li>
                    <a href="logout.php" class="btn btn-dark ms-3">Logout</a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <div class="d-flex align-items-center justify-content-center text-center" style="height: 100px;">
        <p class="h3"><b>Selamat datang <?= $_SESSION['namalengkap'] ?></b></p>
    </div>

    <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Judul</label>
                <input type="text" name="judulfoto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                <input type="text" name="deskripsifoto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Upload gambar</label>
                <input type="file" name="lokasifile" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Pilih album</label>
                <select id="disabledSelect" name="albumid" class="form-select">
                    <?php
                    include "koneksi.php";
                    $userid = $_SESSION['userid'];
                    $sql = mysqli_query($conn, "select * from album where userid='$userid'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <option value="<?= $data['albumid'] ?>"><?= $data['namaalbum'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        <br>
        <br>
        <br>

    </form>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Tanggal Unggah</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Album</th>
                    <th scope="col">Disukai</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include "koneksi.php";
                $userid = $_SESSION['userid'];
                $sql = mysqli_query($conn, "select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?= $data['fotoid'] ?></td>
                        <td><?= $data['judulfoto'] ?></td>
                        <td><?= $data['deskripsifoto'] ?></td>
                        <td><?= $data['tanggalunggah'] ?></td>
                        <td>
                            <img src="gambar/<?= $data['lokasifile'] ?>" width="200px">
                        </td>
                        <td><?= $data['namaalbum'] ?></td>
                        <td>
                            <?php
                            $fotoid = $data['fotoid'];
                            $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                            ?>
                        </td>
                        <td>
                            <a href="edit_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                </svg></a>
                            <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg></a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>





    <footer class="footer py-2 bg-light fixed-bottom">
        <div class="text-center">
            UKK RPL 2024 | Zidan Al Mahbubi
        </div>
    </footer>
</body>

</html>