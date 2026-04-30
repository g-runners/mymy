<?php session_start();

// if (!isset($_SESSION['user'])) {
//     echo "<script>alert('Anda belum login!')</script>";
//     echo "<script>window.location.href = '../log_reg/login.php';</script>";
//     exit;
// }

include('../dll/koneksi.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../dll/navbar.css" />

    <link rel="stylesheet" href="../../fontawesome/css/all.min.css" />

    <title>PERPUS</title>
</head>

<body>
    <!-- navbar -->
    <div class="nb">
        <div class="nbJud fa fa-sm">Perpus Online</div>
        <div class="nbUserLogin">
            <div class="dropdown">
                <div class="dropbtn">
                    <i class="fa fa-user fa-sm">&nbsp;&nbsp;<?php echo $_SESSION['user']['username']; ?></p></i>
                </div>

                <div class="ddContent">
                    <a href="koleksi.php">Koleksi</a>
                    <a href="index.php">Home</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $id = $_GET['id'];
    $baca = mysqli_query($conn, "SELECT isi FROM buku WHERE id_buku = $id");
    $hasil = mysqli_fetch_row($baca);

    if (isset($hasil)) {
        echo $hasil[0];
        echo "BUKU MUNCUL DI SINIB!";
    } else {
        echo "<script>alert('File tidak ditemukan!')</script>";
        echo "<script>window.location.href = 'koleksi.php';</script>";
        exit;
    }

    mysqli_close($conn);

    ?>
</body>

</html>