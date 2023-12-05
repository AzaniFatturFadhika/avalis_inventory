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

$setb_barcode = $_GET['b-barcode'];

$sql = "SELECT * FROM barang
        JOIN kategori ON kategori.k_id = barang.k_id
        JOIN supplier ON supplier.s_kode = barang.s_kode
        JOIN satuan ON satuan.sa_id = barang.sa_id
        WHERE b_barcode = '$setb_barcode'";
$query = mysqli_query($conn, $sql);
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

    <title>Afalis Inventory - Edit Barang</title>

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

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="barang.php">
                            <i class="align-middle" data-feather="package"></i> <span class="align-middle">Data
                                Barang</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
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
                    <h1 class="h3 mb-3"><strong>Edit</strong> Barang</h1>
                    <div class="row">
                        <div class="d-flex">

                            <?php
                            while ($barang = mysqli_fetch_array($query)): {
                                    ?>

                                    <div class="card flex-fill">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6 text-start">
                                                    <h5 class="card-title mb-0">
                                                        <?= $barang['b_nama']; ?>
                                                    </h5>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <a class="btn btn-lg btn-info" href="barang.php">Batal Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <!-- form edit batrang -->
                                            <form method="POST">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label>Kode Barang</label>
                                                        <input type="number" class="form-control" name="b_barcode"
                                                            value="<?= $barang['b_barcode']; ?>" required autofocus>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nama Barang</label>
                                                        <input type="text" class="form-control" name="b_nama"
                                                            value="<?= $barang['b_nama']; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Kategori</label>
                                                        <select class="form-select" name="k_nama" id="k_nama" required>
                                                            <option value="<?= $barang['k_id']; ?>">
                                                                <?= $barang['k_nama']; ?>
                                                            </option>

                                                            <?php
                                                            // mengambil data pelanggan dari database
                                                            $k = "SELECT * FROM kategori ORDER BY k_nama ASC";
                                                            $kq = mysqli_query($conn, $k);
                                                            // mengubah data ke array dan menampilkannya dengan perulangan while
                                                            while ($row = mysqli_fetch_array($kq)) {
                                                                ?>

                                                                <option value="<?= $row['k_id']; ?>">
                                                                    <?= $row['k_nama']; ?>
                                                                </option>

                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Penyuplai</label>
                                                        <select class="form-select" name="s_nama" id="s_nama" required>
                                                            <option value="<?= $barang['s_kode']; ?>">
                                                                <?= $barang['s_nama']; ?>
                                                            </option>
                                                            <?php
                                                            // mengambil data pelanggan dari database
                                                            $su = "SELECT * FROM supplier ORDER BY s_nama ASC";
                                                            $suq = mysqli_query($conn, $su);
                                                            // mengubah data ke array dan menampilkannya dengan perulangan while
                                                            while ($row = mysqli_fetch_array($suq)) {
                                                                ?>

                                                                <option value="<?= $row['s_kode']; ?>">
                                                                    <?= $row['s_nama']; ?>
                                                                </option>

                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Harga</label>
                                                        <input type="number" class="form-control" name="b_harga"
                                                            value="<?= $barang['b_harga']; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Satuan</label>
                                                        <select class="form-select" name="sa_nama" id="sa_nama" required>
                                                            <option value="<?= $barang['sa_id']; ?>">
                                                                <?= $barang['sa_nama']; ?>
                                                            </option>
                                                            <?php
                                                            // mengambil data pelanggan dari database
                                                            $sql = "SELECT * FROM satuan ORDER BY sa_nama ASC";
                                                            $query = mysqli_query($conn, $sql);
                                                            // mengubah data ke array dan menampilkannya dengan perulangan while
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                ?>

                                                                <option value="<?= $row['sa_id']; ?>">
                                                                    <?= $row['sa_nama']; ?>
                                                                </option>

                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                </div>

                                                <input type="submit" class="btn btn-primary" name="Simpan" value="Simpan">
                                            </form>

                                            <?php
                                }
                                ?>
                                    </div>

                                </div>
                            <?php endwhile; ?>
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

</html>

<!-- proses edit barang -->
<?php
// mengambil inputan dari form
if (isset($_POST['Simpan'])) {
    $b_barcode = $_POST['b_barcode'];
    $b_nama = $_POST['b_nama'];
    $k_nama = $_POST['k_nama'];
    $s_nama = $_POST['s_nama'];
    $b_harga = $_POST['b_harga'];
    $sa_nama = $_POST['sa_nama'];

    // jika kode barang diubah
    if ($setb_barcode != $b_barcode) {

        // cek kode barang
        $cek = mysqli_query($conn, "SELECT*FROM barang WHERE b_barcode = '$b_barcode'");
        if (mysqli_num_rows($cek) > 0) {
            ?>
            <script>
                alert('Edit Gagal! Kode barang <?= $b_barcode ?> sudah ada ...');
            </script>
            <?php
            die();
        }
    }

    // query update barang
    $sql = "UPDATE  barang
        SET     b_barcode   = '$b_barcode',
                b_nama      = '$b_nama', 
                k_id        = '$k_nama', 
                s_kode      = '$s_nama', 
                b_harga     = '$b_harga', 
                sa_id       = '$sa_nama'
        WHERE   b_barcode   = '$setb_barcode'";
    $update = mysqli_query($conn, $sql);

    if ($update) {

        ?>
        <script>
            alert('Selamat! Barang <?= $b_nama ?> berhasil di edit ...');
            document.location = "barang.php";
        </script>
        <?php
    }




}
?>