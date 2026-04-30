<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda belum login!')</script>";
    echo "<script>window.location.href = '../log_reg/login.php';</script>";
    exit;
}

include('../dll/koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus data yang sesuai dengan id
    $query = "DELETE FROM buku WHERE id_buku = '$id'";
    $hapus = mysqli_query($conn, $query);

    if ($hapus) {
        echo "<script>alert('Buku berhasil dihapus');</script>";
        mysqli_close($conn);
    } else {
        echo "Gagal menghapus buku: " . mysqli_error($koneksi);
    }
}
?>

<script>
    window.location.href = "../<?php echo $_SESSION['user']['level']; ?>/";
</script>