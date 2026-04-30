<?php
session_start();

// Hapus semua variabel session
$_SESSION = [];

// Hapus cookie session dari browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redirect ke halaman utama
echo "<script>alert('Logout berhasil!')</script>";
echo "<script>location.href='../../';</script>";
exit;
