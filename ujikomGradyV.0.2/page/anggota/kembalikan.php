<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda belum login!')</script>";
    echo "<script>window.location.href = '../log_reg/login.php';</script>";
    exit;
}

include('../dll/koneksi.php');

$id = $_GET['id'];

$query = "SELECT * FROM peminjaman WHERE id_peminjaman = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Pengembalian buku gagal!')</script>";
    echo "<script>window.location.href = 'koleksi.php';</script>";
} else {
    $data = mysqli_fetch_assoc($result);

    $id_peminjaman = $data['id_peminjaman'];
    $tanggal_pengembalian = date('Y-m-d');

    $query = "UPDATE `peminjaman` SET `tanggal_pengembalian` = '$tanggal_pengembalian', `status_peminjaman` = 'Dikembalikan' WHERE `peminjaman`.`id_peminjaman` = $id_peminjaman";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pengembalian buku berhasil.')</script>";
        echo "<script>window.location.href = 'koleksi.php';</script>";
    } else {
        echo "<script>alert('Peminjaman buku gagal!'" . mysqli_error($conn) . ")</script>";
        echo "<script>window.location.href = 'koleksi.php';</script>";
    }
}
mysqli_close($conn);
