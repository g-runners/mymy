<?php session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda belum login!')</script>";
    echo "<script>window.location.href = '../log_reg/login.php';</script>";
    exit;
}

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
                    <a href="history.php">History</a>
                    <a href="../dll/logout.php">Log out</a>

                </div>
            </div>
        </div>
    </div>

    <!-- judul -->
    <div class="coJdl">
        <p class="fa">Daftar&nbsp;&nbsp;Buku</p>
    </div>

    <!-- table -->
    <div class="container" style="overflow-x: auto">
        <table class="tbBuku">
            <thead>
                <tr>
                    <th style="width: 3ch;">No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit / Tahun</th>
                    <th>Pinjam</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $databuku = mysqli_query($conn, "SELECT * FROM buku");
                $no = 0;

                while ($hasil = mysqli_fetch_row($databuku)) {
                ?>
                    <tr>
                        <td>
                            <p><?php echo $no = ++$no; ?></p>
                        </td>
                        <td>
                            <p><?php echo $hasil[2]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $hasil[3]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $hasil[4]; ?>, <?php echo $hasil[5]; ?></p>
                        </td>
                        <td>
                            <div class="aksi">
                                <a href="../buku/kelola_buku.php?idKhusus=<?php echo $hasil[0]; ?>">
                                    <button class="i iinfo">
                                        <i class="fa fa-info"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="desc">
        <p>Ini adalah Perpustakaan Digital yang menyediakan layanan peminjaman buku secara daring.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam fugiat repellat earum excepturi odit ad explicabo praesentium consectetur, cum molestiae dolor quod inventore adipisci, impedit vitae cumque sit similique vero corrupti illum commodi quaerat? Error, beatae doloribus vero eaque possimus illum quasi esse. Neque est praesentium expedita reiciendis? A ratione temporibus ducimus soluta expedita ut, molestias ad culpa ipsam porro ea mollitia aliquid accusamus unde? Ratione dicta commodi perferendis sequi! Tempora, aperiam asperiores? Amet aut voluptatum aspernatur accusamus? Illo veniam a ducimus molestiae odit dicta rem facilis vel pariatur possimus? Accusantium aperiam enim assumenda dolorem nostrum quod vitae, non impedit!</p>
    </div>
</body>

</html>