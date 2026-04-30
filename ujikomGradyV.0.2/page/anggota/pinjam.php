<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda belum login!')</script>";
    echo "<script>window.location.href = '../log_reg/login.php';</script>";
    exit;
}

include('../dll/koneksi.php');

$id_buku = $_GET['id_buku'];
$id_user = $_SESSION['user']['id_user'];

$query = "SELECT * FROM peminjaman WHERE id_user = $id_user AND id_buku = $id_buku AND status_peminjaman = 'dipinjam'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Anda sudah meminjam buku ini!')</script>";
    echo "<script>window.location.href = 'index.php';</script>";
} else {
    $tanggal_peminjaman = date('Y-m-d');
    $tenggat = date('Y-m-d', strtotime('+7 days'));

    $query = "INSERT INTO peminjaman (id_user, id_buku, tanggal_peminjaman, tenggat, status_peminjaman) 
              VALUES ($id_user, $id_buku, '$tanggal_peminjaman', '$tenggat', 'Dipinjam')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Peminjaman buku berhasil. Jangan lupa balikin sebelum $tenggat yaaa~')</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Peminjaman buku gagal!'" . mysqli_error($conn) . ")</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }
}
mysqli_close($conn);
exit;
