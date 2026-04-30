<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../dll/navbar.css" />

    <link rel="stylesheet" href="../../fontawesome/css/all.min.css" />

    <title>PERPUS - Login</title>

    <?php
    session_start();

    if (isset($_SESSION['user'])) {
        echo "<script>alert('Anda sudah login!')</script>";
        $level = $_SESSION['user']['level'];
        switch ($level) {
            case 'admin':
            case 'petugas':
                echo "<script>location.href='../admin/';</script>";
                exit;
            case 'anggota':
                echo "<script>location.href='../anggota/';</script>";
                exit;
        }
    }
    ?>

</head>

<body>
    <!-- navbar -->
    <div class="nb">
        <div class="nbJud fa fa-sm">Perpus Online</div>
        <div class="nbLink fa fa-sm">
            <a href="../../">Home</a>
        </div>
    </div>

    <!-- login box -->
    <div class="cont-form">
        <form class="form" method="post">
            
            <h1 class="fa">login</h1>

            <div class="box">
                <div class="icon">
                    <label for="user">
                        <i class="fa fa-user fa-xl fa-flip"></i>
                    </label>
                </div>
                <div class="inp">
                    <input type="text" id="user" name="username" placeholder="Username" maxlength="8" />
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <label for="pass"><i class="fa fa-key fa-xl fa-flip"></i>
                    </label>
                </div>
                <div class="inp">
                    <input type="password" id="pass" name="password" placeholder="Password" />
                </div>
            </div>

            <div class="box btn">
                <button class="fa fa-xs" name="login">login</button>
            </div>

            <?php
            include '../dll/koneksi.php';

            if (isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = md5($_POST['password']);

                $data = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");

                $cek = mysqli_num_rows($data);
                mysqli_close($conn);

                if ($cek > 0) {
                    $_SESSION['user'] = mysqli_fetch_assoc($data);
                    $level = $_SESSION['user']['level'];
                    switch ($level) {
                        case 'admin':
                        case 'petugas':
                            echo "<script>location.href='../admin/';</script>";
                            exit;
                        case 'anggota':
                            echo "<script>location.href='../anggota/';</script>";
                            exit;
                        default:
                            echo "<script>alert('Level tidak dikenali!')</script>";
                            exit;
                    }
                } else {
                    echo "<script>alert('Login Gagal!')</script>";
                    echo "<script>location.href='login.php';</script>";
                    exit;
                }
            }
            ?>

            <div class="box">
                <span class="fa fa-sm account">Belum punya akun?<a href="daftar.php">&nbsp;Daftar</a></span>
            </div>
        </form>
    </div>
</body>

</html>