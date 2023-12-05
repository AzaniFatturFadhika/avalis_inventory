<?php

include '../koneksi.php';

session_start();

if (empty($_SESSION['level'])) {
    header('location:../index.php?pesan=belum_login');
}

if (isset($_GET['t_inv'])) {
    $t_inv = $_GET['t_inv'];
    $hapus = mysqli_query($conn, "DELETE FROM transaksi WHERE t_inv='$t_inv'");

    if ($hapus) {
        ?>
        <script>
            alert('Selamat! Hapus riwayat transaksi berhasil ...');
            document.location = "t-masuk.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Maaf! Hapus riwayat transaksi gagal ...');
            document.location = "t-masuk.php";
        </script>
        <?php
    }
}
?>