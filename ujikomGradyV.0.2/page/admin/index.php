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

    <link rel="stylesheet" href="../../fontawesome/css/all.css" />

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
                    <a href="laporan.php">Laporan</a>
                    <a href="../dll/logout.php">Log out</a>
                </div>
            </div>
        </div>

    </div>

    <!-- content -->

    <!-- tambah buku / daftar petugas -->
    <div class="coTmbhBuku">
        <a href="../buku/kelola_buku.php">
            <div class="btnTmbhBuku">
                <i class="fa fa-plus fa-sm tmbhBuku"> Buku</i>
            </div>
        </a>
        <?php
        if ($_SESSION['user']['level'] == 'admin') {
            echo '
            <a href="../log_reg/regadmin.php">
                <div class="btnTmbhBuku">
                    <i class="fa fa-plus fa-sm tmbhBuku"> Petugas</i>
                </div>
            </a>
            ';
        }
        ?>
    </div>

    <!-- table buku -->
    <div class="container" style="overflow-x: auto">
        <table class="tbBuku">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
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
                            <p><?php echo $hasil[4]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $hasil[5]; ?></p>
                        </td>
                        <td>
                            <div class="aksi">
                                <a href="../buku/kelola_buku.php?idKhusus=<?php echo $hasil[0]; ?>">
                                    <button class="i ipencil">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </a>

                                <a href="../buku/hapus_buku.php?id=<?php echo $hasil[0]; ?>" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                    <button class="i itrash">
                                        <i class="fa fa-trash"></i>
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
</body>

</html>