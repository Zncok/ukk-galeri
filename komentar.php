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
    <title>Halaman Komentar</title>
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
    <h1>Halaman Komentar</h1>
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
        <p class="h3">Komentar</p>
    </div>

    <form action="tambah_komentar.php" method="post">
        <?php
        include "koneksi.php";
        $fotoid = $_GET['fotoid'];
        $sql = mysqli_query($conn, "select * from foto where fotoid='$fotoid'");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
        <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
            <table>
                <tr>
                    <td>Judul</td>
                    <td><input type="text" name="judulfoto" value="<?= $data['judulfoto'] ?>"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsifoto" value="<?= $data['deskripsifoto'] ?>"></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td><img src="gambar/<?= $data['lokasifile'] ?>" width="200px"></td>
                </tr>
                <tr>
                    <td>Komentar</td>
                    <td><input type="text" name="isikomentar"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tambah"></td>
                </tr>
            </table>
        <?php
        }
        ?>
    </form>

    <table width="100%" border="1" cellpadding=5 cellspacing=0>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Komentar</th>
            <th>Tanggal</th>
        </tr>
        <?php
        include "koneksi.php";
        $userid = $_SESSION['userid'];
        $sql = mysqli_query($conn, "select * from komentarfoto,user where komentarfoto.
        userid=user.userid");
        while ($data = mysqli_fetch_array($sql)) {
        ?>

        <tr>
            <td><?=$data['komentarid']?></td>
            <td><?=$data['namalengkap']?></td>
            <td><?=$data['isikomentar']?></td>
            <td><?=$data['tanggalkomentar']?></td>
        </tr>

        <?php
        }
        ?>
    </table>

    <footer class="footer py-2 bg-light fixed-bottom">
        <div class="text-center">
            UKK RPL 2024 | Zidan Al Mahbubi
        </div>
    </footer>

</body>

</html>