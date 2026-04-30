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
    
    <style>
        @media print {
            .noPrint {
                display: none !important;
            }

            .print {
                display: block !important;
                text-align: center;
                font-size: 10px !important;
                font-weight: bold;
                padding-bottom: 10px;
            }

            table th {
                word-wrap: break-word;
                white-space: normal;
                overflow-wrap: break-word;
            }

            .tgl {
                width: 35px;
            }

            .idd {
                width: 10px;
            }
        }
    </style>

    <title>PERPUS</title>
</head>

<body>
    <!-- navbar -->
    <div class="nb noPrint">
        <div class="nbJud fa fa-sm ">Perpus Online</div>
        <div class="nbUserLogin">
            <div class="dropdown noPrint">
                <div class="dropbtn">
                    <i class="fa fa-user fa-sm">&nbsp;&nbsp;<?php echo $_SESSION['user']['username']; ?></p></i>
                </div>

                <div class="ddContent">
                    <a href="index.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- judul -->
    <div class="coJdl print">
        <p class="fa">Laporan&nbsp;&nbsp;peminjaman</p>
    </div>

    <!-- print laporan -->
    <div class="coTmbhBuku noPrint">
        <button class="fa btnTmbhBuku" onclick="printLaporan()">Print Laporan</button>
    </div>

    <!-- table -->
    <div class="container" style="overflow-x: auto">
        <table class="tbBuku">
            <thead>
                <tr>
                    <th style="width: 80px;" class="idd">ID Pinjam</th>
                    <th class="idd">ID User</th>
                    <th>Buku</th>
                    <th style="width: 140px;" class="tgl">Tanggal Pinjam</th>
                    <th style="width: 140px;" class="tgl">Tenggat</th>
                    <th style="width: 140px;" class="tgl">Tanggal Kembali</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datapeminjaman = mysqli_query($conn, "SELECT * FROM peminjaman");
                if (mysqli_num_rows($datapeminjaman) == 0) {
                    echo "<tr><td colspan='6' style='text-align: center;'>Tidak ada data peminjaman</td></tr>";
                }

                while ($data_pinjam = mysqli_fetch_row($datapeminjaman)) {
                    $databuku = mysqli_query($conn, "SELECT * FROM buku where id_buku = '" . $data_pinjam[2] . "'");
                    $data_buku = mysqli_fetch_row($databuku);
                ?>
                    <tr>
                        <td>
                            <p><?php echo $data_pinjam[0]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data_pinjam[1]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data_buku[0]; ?>&nbsp;|&nbsp;<?php echo $data_buku[2]; ?>,&nbsp;<?php echo $data_buku[3]; ?> </p>
                        </td>
                        <td>
                            <p><?php echo $data_pinjam[3]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data_pinjam[4]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data_pinjam[5]; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data_pinjam[6]; ?></p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    function printLaporan() {
        window.print();
    }
</script>

</html>