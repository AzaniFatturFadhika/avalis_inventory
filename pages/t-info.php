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

$t_inv = $_GET['t_inv'];

$sql = "SELECT * FROM transaksi
 				JOIN users ON users.nik = transaksi.nik
 				JOIN barang ON barang.b_barcode = transaksi.b_barcode
        JOIN satuan ON satuan.sa_id = barang.sa_id
        JOIN kategori ON kategori.k_id = barang.k_id
 				JOIN supplier ON supplier.s_kode = barang.s_kode
				WHERE t_inv = '$t_inv'
 				ORDER BY t_tgl ASC";
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

    <title>Afalis Inventory - Laporan</title>

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
                    <li class="sidebar-item active">
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
                    <h1 class="h3 mb-3"><strong>Informasi</strong> Transaksi</h1>
                    <div class="row">
                        <div class="d-flex">
                            <div class="card flex-fill">
                                <?php while ($transaksi = mysqli_fetch_array($query)): ?>
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6 text-start">
                                                <h5 class="card-title mb-0">
                                                    <?= $transaksi['t_inv']; ?>
                                                </h5>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a class="btn btn-lg btn-info"
                                                    href="laporan.php?tgl_dari=<?= date('Y-m-1'); ?>&tgl_sampai=<?= date('Y-m-' . $jumHari); ?>">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="control-group">
                                            <div class="mb-3">
                                                <label for="t_inv">No. Faktur</label>
                                                <input class="form-control" value="<?= $transaksi['t_inv']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="b_barcode">Kode Barang</label>
                                                <input class="form-control" value="<?= $transaksi['b_barcode']; ?>"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="b_nama">Nama Barang</label>
                                                <input class="form-control" value="<?= $transaksi['b_nama']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="k_nama">Kategori</label>
                                                <input class="form-control" value="<?= $transaksi['k_nama']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="s_nama">Nama Penyuplai</label>
                                                <input class="form-control" value="<?= $transaksi['s_nama']; ?>" readonly>
                                            </div>
                                            <?php
                                            if ($transaksi['t_jenis'] == 'masuk') {
                                                $ket = 'Masuk';
                                            } else {
                                                $ket = 'Keluar';
                                            } ?>
                                            <div class="mb-3">
                                                <label for="sa_nama">Jumlah
                                                    <?= $ket ?>
                                                </label>
                                                <input class="form-control"
                                                    value="<?= $transaksi['t_jumlah'] . "  " . $transaksi['sa_nama']; ?>"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="t_nama">Nama Petugas</label>
                                                <input class="form-control" value="<?= $transaksi['t_nama']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="t_telp">Telepon Petugas</label>
                                                <input class="form-control" value="<?= $transaksi['t_telp']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 text-start"></div>
                                            <div class="col-6 text-end">
                                                <a class="btn btn-lg btn-danger ms-1"
                                                    href="t-hapus.php?t_inv=<?= $transaksi['t_inv']; ?>"
                                                    onclick="return confirm('anda yakin ingin hapus transaksi ini<?= $transaksi['t_inv']; ?>?');">Hapus</a>
                                            </div>
                                        </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            scrollX: true,
            dom: "<'row'<'col-sm'l><'col-sm'B><'col-sm'f>>" +
                "<'row'<'col'tr>>" +
                "<'row'<'col'i><'col'p>>",
            buttons: [
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print', {
                    extend: 'print',
                    text: 'Print current page',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }
            ]
        });
    });
</script>

</html>