<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda belum login!')</script>";
    echo "<script>window.location.href = '../log_reg/login.php';</script>";
    exit;
}

include('../dll/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahunTerbit = $_POST['tahunTerbit'];
    $deskripsi = $_POST['deskripsi'];
    $isi = $_POST['isi'];

    // Query untuk update buku ke database
    $update = mysqli_query($conn, "UPDATE buku SET id_buku = '$id', judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun_terbit = '$tahunTerbit', deskripsi = '$deskripsi', isi = '$isi' WHERE buku.id_buku = '$id';");

    if ($update) {
        echo "<script>alert('Buku berhasil diedit!');</script>";
        echo "<script>window.location.href = '../admin/';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku! " . mysqli_error($conn) . "');</script>";
        echo "<script>window.location.href = '../admin/';</script>";
    }
    mysqli_close($conn);
    exit;
}
