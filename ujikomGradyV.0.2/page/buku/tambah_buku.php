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

    // cek apakah id sudah digunakan
    $query = "SELECT * FROM buku WHERE id_buku = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('ID sudah digunakan!')</script>";
        echo "<script>window.location.href = 'kelola_buku.php';</script>";
        exit;
    }
    
    // Query untuk menambahkan buku ke database
    $insert = mysqli_query($conn, "INSERT INTO buku (id_buku, judul, penulis, penerbit, tahun_terbit, deskripsi, isi) VALUES ('$id', '$judul', '$penulis', '$penerbit', '$tahunTerbit', '$deskripsi', '$isi')");

    if ($insert) {
        echo "<script>alert('Buku berhasil ditambahkan!');</script>";
        echo "<script>window.location.href = '../admin/';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku! " . mysqli_error($conn) . "');</script>";
        echo "<script>window.location.href = '../admin/';</script>";
    }
    mysqli_close($conn);
}
