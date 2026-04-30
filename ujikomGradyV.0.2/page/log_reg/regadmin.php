<?php session_start();

if (isset($_SESSION['user']) && $_SESSION['user']['level'] == 'admin') {
    $user = $_SESSION['user']['username'];
    $navbar = '
    <div class="nb">
        <div class="nbJud fa fa-sm">Perpus Online</div>
        <div class="nbUserLogin">
            <div class="dropdown">
                <div class="dropbtn">
                    <i class="fa fa-user fa-sm">&nbsp;&nbsp;' . $user . '</p></i>
                </div>

                <div class="ddContent">
                    <a class="nohover" href="../admin">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    ';
    $plcid = "Petugas";
    $verif = "";
} else {
    $navbar = '
    <div class="nb">
        <div class="nbJud fa fa-sm">Perpus Online</div>
        <div class="nbLink fa fa-sm">
            <a href="../../">
                <?php mysqli_close($conn); ?>Home
            </a>
        </div>
    </div>
    ';
    $plcid = "Admin";
    $verif = '
    <div class="box">
        <div class="icon">
            <label for="verif">
                <i class="fa-brands fa-get-pocket fa-xl fa-flip"></i>
            </label>
        </div>

        <div class="inp">
            <input type="password" id="verif" name="verif" placeholder="Kode Verifikasi" required />
        </div>
    </div>
    ';
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
    <?php echo $navbar; ?>
    <!-- reg box -->
    <div class="cont-form">

        <form class="form" method="post">
            <h1 class="fa">daftar</h1>

            <div class="box">
                <div class="icon">
                    <label for="id_user">
                        <i class="fa fa-id-card-clip fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <input type="text" id="id_user" name="id_user" placeholder="ID <?php echo $plcid; ?>" maxlength="11" required />
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <label for="user">
                        <i class="fa fa-user fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <input type="text" id="user" name="username" placeholder="Username" maxlength="8" required />
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <label for="pass"><i class="fa fa-key fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <input type="password" id="pass" name="password" placeholder="Password" required />
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <label for="email">
                        <i class="fa fa-envelope fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <input type="email" id="email" name="email" placeholder="Email" required />
                </div>\
            </div>

            <div class="box">
                <div class="icon">
                    <label for="nama">
                        <i class="fa fa-address-card fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required />
                </div>
            </div>

            <?php echo $verif; ?>

            <div class="box btn">
                <button type="submit" class="fa fa-xs" name="daftar">Daftarkan&nbsp;&nbsp;<?php echo $plcid; ?></button>
            </div>
            <?php

            if (isset($_POST['daftar'])) {

                $id_user = $_POST['id_user'];
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $email = $_POST['email'];
                $nama = $_POST['nama'];

                $query = "SELECT * FROM user WHERE username = '$username' OR id_user = '$id_user'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {

                    echo "<script>alert('Username atau ID sudah digunakan!')</script>";
                    exit;
                } else {

                    if ($plcid == "Admin") {
                        $verif = md5($_POST['verif']);
                        if ($verif != md5('arsalizah')) {
                            echo "<script>alert('Kode Verifikasi Salah!')</script>";
                            exit;
                        }

                        $insert = mysqli_query($conn, "INSERT INTO user (id_user, username, password, email, nama_lengkap, no_telepon, level) VALUES ('$id_user','$username', '$password', '$email', '$nama', '0', 'admin')");

                        if ($insert) {
                            echo "<script>alert('Daftar Berhasil!')</script>";
                            mysqli_close($conn);
                            echo "<script>location.href='../page/log_reg/login.php'</script>";
                            exit;
                        } else {
                            echo "<script>alert('Daftar Gagal! " . mysqli_error($conn) . "')</script>";
                        }
                    } else {
                        $insert = mysqli_query($conn, "INSERT INTO user (id_user, username, password, email, nama_lengkap, no_telepon, level) VALUES ('$id_user','$username', '$password', '$email', '$nama', '0', 'petugas')");

                        if ($insert) {
                            echo "<script>alert('Daftar Berhasil!')</script>";
                            mysqli_close($conn);
                            echo "<script>location.href='../admin/'</script>";
                            exit;
                        } else {
                            echo "<script>alert('Daftar Gagal! " . mysqli_error($conn) . "')</script>";
                        }
                    }
                }
            }
            ?>
        </form>
    </div>
</body>

</html>