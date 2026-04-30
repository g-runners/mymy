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
        <div class="nbLink fa fa-sm">
            <a href="../../">Home</a>
        </div>
    </div>

    <!-- reg box -->
    <div class="cont-form">

        <form class="form" method="post">
            <h1 class="fa">daftar</h1>

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
                </div>
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

            <div class="box">
                <div class="icon">
                    <label for="alamat">
                        <i class="fa fa-map-location-dot fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <textarea id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <label for="no_telp">
                        <i class="fa fa-phone fa-xl fa-flip"></i>
                    </label>
                </div>

                <div class="inp">
                    <input type="number" id="no_telp" name="no_telp" placeholder="Nomor Telepon" required />
                </div>
            </div>

            <div class="box btn">
                <button type="submit" class="fa fa-xs" name="daftar">Daftar</button>
            </div>
            <?php
            session_start();
            include '../dll/koneksi.php';

            if (isset($_POST['daftar'])) {

                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $email = $_POST['email'];
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                $no_telp = $_POST['no_telp'];

                $query = "SELECT * FROM user WHERE username = '$username'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo "<script>alert('Username sudah digunakan!')</script>";
                    mysqli_close($conn);
                    echo "<script>location.href='daftar.php'</script>";
                    exit;
                } else {
                    $insert = mysqli_query($conn, "INSERT INTO user (username, password, email, nama_lengkap, alamat, no_telepon, level) VALUES ('$username', '$password', '$email', '$nama', '$alamat', '$no_telp', 'anggota')");

                    if ($insert) {
                        echo "<script>alert('Daftar Berhasil! Silakan Login')</script>";
                        mysqli_close($conn);
                        echo "<script>location.href='login.php'</script>";
                    } else {
                        echo "<script>alert('Daftar Gagal! " . mysqli_error($conn) . "')</script>";
                    }
                }
            }
            ?>

            <div class="box">
                <span class="fa fa-sm account">Sudah punya akun? <a href="login.php">&nbsp;Masuk</a></span>
            </div>
            <div class="box" style="position: relative; top: -50px; font-size: 10px;">
                <span class="fa fa-sm account">Daftar sebagai <a href="regadmin.php">&nbsp;Admin</a></span>
            </div>
        </form>
    </div>
</body>

</html>