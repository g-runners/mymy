<?php session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda belum login!')</script>";
    echo "<script>window.location.href = '../log_reg/login.php';</script>";
    exit;
}

include('../dll/koneksi.php');

$back = '';
$readonly = "";
$isi = '';
$proses = 'tambah_buku.php';
$btn = '<button type="submit" class="btnKelola">Tambah Buku</button>';
$value1 = '';
$value2 = '';
$value3 = '';
$value4 = '';
$value5 = '';
$value6 = '';
$value7 = '';

if (isset($_GET['idKhusus'])) {

    $id = $_GET['idKhusus'];
    $query = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
    $data = mysqli_fetch_row($query);

    $proses = 'edit_buku.php';
    $btn = '<button type="submit" class="btnKelola">Edit Buku</button>';
    $value1 = $data[0];
    $value2 = $data[2];
    $value3 = $data[3];
    $value4 = $data[4];
    $value5 = $data[5];
    $value6 = $data[6];
    $value7 = $data[7];

    if (isset($_SESSION['user']) && $_SESSION['user']['level'] == 'anggota') {
        $readonly = " readonly ";
        $isi = 'style="display:none;">';
        $btn = '<a href="../anggota/pinjam.php?id_buku= ' . $data[0] . '" class="btnKelola">Pinjam Buku</a>';
        $back = '
            <a href="../anggota/koleksi.php">Koleksi</a>
            <a href="../anggota/history.php">History</a>
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../dll/navbar.css" />

    <link rel="stylesheet" href="../../fontawesome/css/all.css" />

    <link rel="icon" href="img/icon.png" />
    <title>PERPUS - Buku</title>
</head>

<body>
    <!-- navbar -->
    <div class="nb">
        <div class="nbJud fa fa-sm">Perpus Online</div>
        <div class="nbUserLogin">
            <div class="dropdown">
                <div class="dropbtn">
                    <i class="fa fa-user fa-sm">&nbsp;&nbsp;<?php echo $_SESSION['user']['username']; ?></i>
                </div>
                <div class=" ddContent">
                    <?php echo $back; ?>
                    <a href="../<?php if ($_SESSION['user']['level'] == 'anggota') {echo 'anggota';}else{echo 'admin';} ?>/">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="content">
        <form class="form" method="post" action="<?php echo $proses; ?>"">
            <!-- isi form -->
            <div class=" box">
            <div class="lab">
                <label for="id">Id</label>
            </div>

            <div class="inp">
                <input type="text" id="id" name="id" maxlength="11" value="<?php echo $value1; ?>" <?php echo $readonly; ?> required />
            </div>
    </div>

    <div class="box">
        <div class="lab">
            <label for="judul">Judul</label>
        </div>

        <div class="inp">
            <input type="text" id="judul" name="judul" maxlength="255" value="<?php echo $value2; ?>" <?php echo $readonly; ?> required />
        </div>
    </div>

    <div class="box">
        <div class="lab">
            <label for="penulis">Penulis</label>
        </div>

        <div class="inp">
            <input type="text" id="penulis" name="penulis" maxlength="255" value="<?php echo $value3; ?>" <?php echo $readonly; ?> required />
        </div>
    </div>

    <div class="box">
        <div class="lab">
            <label for="penerbit">Penerbit</label>
        </div>

        <div class="inp">
            <input type="text" id="penerbit" name="penerbit" maxlength="255" value="<?php echo $value4; ?>" <?php echo $readonly; ?> required />
        </div>
    </div>

    <div class="box">
        <div class="lab">
            <label for="tahunTerbit">Tahun Terbit</label>
        </div>

        <div class="inp">
            <input type="number" id="tahunTerbit" name="tahunTerbit" value="<?php echo $value5; ?>" <?php echo $readonly; ?> required />
        </div>
    </div>

    <div class="box">
        <div class="lab">
            <label for="deskripsi">Deskripsi</label>
        </div>

        <div class="inp">
            <textarea name="deskripsi" id="deskripsi" <?php echo $readonly; ?> required><?php echo $value6; ?></textarea>
        </div>
    </div>

    <div class="box" <?php echo $isi; ?> style="margin-top: 30px;">
        <div class="lab">
            <label for="isi">Isi Buku</label>
        </div>

        <div class="inp">
            <textarea name="isi" id="isi" <?php echo $readonly; ?> required><?php echo $value7; ?></textarea>
        </div>
    </div>

    <div class="coBtnKelola">
        <?php echo $btn ?>
    </div>

    </form>
    </div>
</body>

</html>