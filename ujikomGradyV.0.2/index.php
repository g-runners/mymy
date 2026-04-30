<?php include 'page/dll/koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="page/dll/navbar.css" />

    <link rel="stylesheet" href="fontawesome/css/all.min.css" />

    <link rel="icon" href="img/icon.png" />
    <title>PERPUS</title>
</head>

<body>

    <!-- navbar -->
    <div class="nb">
        <div class="nbJud fa fa-sm">Perpus Online</div>
        <div class="nbLink">
            <p class="fa fa-xs">
                <a href="page/log_reg/login.php">Login</a>
            </p>
        </div>
    </div>

    <!-- Isi -->
    <div class="content1">

        <div class="cont">
            <div class="box" style="background-color: rgb(177, 192, 135);">
                <p class="fa">
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM user WHERE level = 'anggota'");
                    echo $_SESSION['user'] = mysqli_num_rows($data)
                    ?>
                    Pengguna
                </p>
            </div>
        </div>
        <div class="cont">
            <div class="box" style="background-color: rgb(188, 192, 135);">
                <p class="fa">
                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM buku");
                    echo $_SESSION['buku'] = mysqli_num_rows($data)
                    ?>
                    Buku
                </p>
            </div>
        </div>

    </div>

    <div class="desc">
        <p>Ini adalah Perpustakaan Digital yang menyediakan layanan peminjaman buku secara daring.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam fugiat repellat earum excepturi odit ad explicabo praesentium consectetur, cum molestiae dolor quod inventore adipisci, impedit vitae cumque sit similique vero corrupti illum commodi quaerat? Error, beatae doloribus vero eaque possimus illum quasi esse. Neque est praesentium expedita reiciendis? A ratione temporibus ducimus soluta expedita ut, molestias ad culpa ipsam porro ea mollitia aliquid accusamus unde? Ratione dicta commodi perferendis sequi! Tempora, aperiam asperiores? Amet aut voluptatum aspernatur accusamus? Illo veniam a ducimus molestiae odit dicta rem facilis vel pariatur possimus? Accusantium aperiam enim assumenda dolorem nostrum quod vitae, non impedit!</p>
    </div>
</body>

</html>