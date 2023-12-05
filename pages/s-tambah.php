<?php
session_start();
include "../koneksi.php";

if (empty($_SESSION['level'])) {
    ?>
    <script>
        alert('Oops anda belum masuk ...');
        document.location = "../index.php";
    </script>
    <?php
}

$profil = mysqli_fetch_array(mysqli_query($conn, "SELECT*FROM users WHERE nik = '$_SESSION[nik]'"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="shortcut icon" href="img/icons/logo.png" />

    <title>Afalis Inventory - Tambah Penyuplai</title>

    <!-- jQuery -->
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/jquery.idle.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="datatables/datatables.min.css">
    <script src="datatables/datatables.min.js"></script>

    <!-- css template -->
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>

    <!-- font -->
    <link rel="stylesheet" href="fonts/InterWeb/inter.css">


</head>

<body>
    <div class="wrapper">

        <!-- sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="dashboard.php">
                    <img src="img/icons/logo.png" class="avatar img-fluid rounded me-1" />
                    <span class="align-middle">Afalis Inventory</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Data Master
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="barang.php">
                            <i class="align-middle" data-feather="package"></i> <span class="align-middle">Data
                                Barang</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="supplier.php">
                            <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Data
                                Penyuplai</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Transaksi
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="t-masuk.php">
                            <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Barang
                                Masuk</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="t-keluar.php">
                            <i class="align-middle" data-feather="minus-square"></i> <span class="align-middle">Barang
                                Keluar</span>
                        </a>
                    </li>

                    <?php $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link"
                            href="laporan.php?tgl_dari=<?= date('Y-m-1'); ?>&tgl_sampai=<?= date('Y-m-' . $jumHari); ?>">
                            <i class="align-middle" data-feather="printer"></i> <span
                                class="align-middle">Laporan</span>
                        </a>
                    </li>

                    <?php
                    if ($_SESSION['level'] == 'superadmin'):
                        ?>

                        <li class="sidebar-header">
                            Pengguna
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="pengguna.php">
                                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Pengguna</span>
                            </a>
                        </li>

                        <?php
                    endif;

                    if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'):
                        ?>

                        <li class="sidebar-header">
                            Pengaturan Barang
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="satuan.php">
                                <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                    class="align-middle">Satuan</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="kategori.php">
                                <i class="align-middle" data-feather="map"></i> <span class="align-middle">Kategori</span>
                            </a>
                        </li>

                    <?php endif; ?>
                </ul>

            </div>
        </nav>
        <!-- akhir sidebar -->

        <!-- konten -->
        <div class="main">

            <!-- topbar -->
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="img/profil/<?= $profil['foto']; ?>" class="avatar img-fluid rounded me-1"
                                    alt="<?= $profil['nama']; ?>" /> <span class="text-dark">
                                    <?= $profil['nama']; ?>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="p-info.php?nik=<?= $profil['nik']; ?>"><i
                                        class="align-middle me-1" data-feather="user"></i> Pengguna</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- akhir topbar -->

            <!-- konten utama -->
            <main class="content">


                <div class="container">
                    <h1 class="h3 mb-3"><strong>Tambah</strong> Data Penyuplai</h1>
                    <div class="row">
                        <div class="d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <div class="row">
                                            <div class="col-6 text-start">
                                                <buton class="btn btn-lg btn-info add-more" type="button" name="add">
                                                    Tambah Penyuplai Lain</button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a class="btn btn-lg btn-info" href="supplier.php">Kembali</a>
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <form method="POST">
                                        <div class="control-group after-add-more">
                                            <div class="mb-3">
                                                <label for="s_kode">Kode Perusahaan</label>
                                                <input class="form-control" type="number" name="s_kode[]"
                                                    placeholder="Masukkan Kode Perusahaan" required autofocus>
                                            </div>
                                            <div class="mb-3">
                                                <label for="s_nama">Nama Perusahaan</label>
                                                <input class="form-control" type="text" name="s_nama[]"
                                                    placeholder="Masukkan Nama Perusahaan" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="s_rek">No. Rekening</label>
                                                <input class="form-control" type="number" name="s_rek[]"
                                                    placeholder="Masukkan Telepon Perusahaan" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="s_telp">Telepon</label>
                                                <input class="form-control" type="number" name="s_telp[]"
                                                    placeholder="Masukkan Telepon Perusahaan" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="s_alamat">Alamat</label>
                                                <textarea class="form-control" name="s_alamat[]"
                                                    placeholder="Masukkan Alamat Perusahaan" required></textarea>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" name="Tambah" value="Tambah">
                                    </form>


                                </div>

                            </div>
                        </div>


                        <div class="copy invisible">
                            <div class="control-group mt-3">
                                <hr>
                                <button class="btn btn-danger remove mb-3" type="button" name="remove">Hapus</button>
                                <div class="mb-3">
                                    <label for="s_kode">Kode Perusahaan</label>
                                    <input class="form-control" type="number" name="s_kode[]"
                                        placeholder="Masukkan Kode Perusahaan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="s_nama">Nama Perusahaan</label>
                                    <input class="form-control" type="text" name="s_nama[]"
                                        placeholder="Masukkan Nama Perusahaan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="s_rek">No. Rekening</label>
                                    <input class="form-control" type="number" name="s_rek[]"
                                        placeholder="Masukkan Telepon Perusahaan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="s_telp">Telepon</label>
                                    <input class="form-control" type="number" name="s_telp[]"
                                        placeholder="Masukkan Telepon Perusahaan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="s_alamat">Alamat</label>
                                    <textarea class="form-control" name="s_alamat[]"
                                        placeholder="Masukkan Alamat Perusahaan" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <!-- akhir konten utama -->

            <!-- footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <p class="mb-0">
                        &copy; <strong>2023 Afalis-AdminKit</strong>
                    </p>
                </div>
            </footer>
            <!-- akhir footer -->

        </div>
    </div>


    <!-- Jika tidak ada aktivitas dalam 10 menit maka akan logout -->
    <script>
        $(document).idle({
            onIdle: function () {
                window.location = "../logout.php?waktuhabis";
            },
            idle: 600000
        });
    </script>
</body>

<!-- fungsi javascript untuk menampilkan form dinamis  -->
<!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
<script type="text/javascript">
    $(document).ready(function () {
        $(".add-more").click(function () {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });
    });
</script>

</html>

<!-- proses tambah penyuplai -->
<?php
if (isset($_POST['Tambah'])) {
    $s_kode = $_POST['s_kode'];
    $s_nama = $_POST['s_nama'];
    $s_rek = $_POST['s_rek'];
    $s_alamat = $_POST['s_alamat'];
    $s_telp = $_POST['s_telp'];

    $jml = count($s_kode);

    // query tambah penyuplai
    for ($i = 0; $i < $jml; $i++) {
        $querycek = mysqli_query($conn, "SELECT*FROM supplier WHERE s_kode = '$s_kode[$i]'");
        $cekentry = mysqli_num_rows($querycek);
        if ($cekentry > 0) {
            ?>
            <script>
                alert('Maaf!, Kode Penyuplai <?= $s_nama[$i]; ?> Sudah Ada ...');
                document.location = 'b-tambah.php';
            </script>
            <?php
        } else {
            $sql = "INSERT INTO supplier (s_kode, s_nama, s_rek, s_alamat, s_telp)
  	            VALUES ('$s_kode[$i]', '$s_nama[$i]','$s_rek[$i]','$s_alamat[$i]', '$s_telp[$i]')";
            $insert = mysqli_query($conn, $sql);
        }
    }

    if ($insert) {

        ?>
        <script>
            alert('Selamat, Tambah Penyuplai Berhasil ...');
            document.location = "supplier.php";
        </script>
        <?php
    }
}
?>