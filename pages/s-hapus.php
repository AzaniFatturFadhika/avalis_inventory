<?php

include "../koneksi.php";

session_start();

if (empty($_SESSION['level'])) {
  header("location:../index.php");
}

if (isset($_GET['s_kode'])) {
  $kode = $_GET['s_kode'];
  $hapus = mysqli_query($conn, "DELETE FROM supplier WHERE s_kode='$kode'");

  if ($hapus) {
    ?>
    <script>
      alert('Selamat! Hapus supplier berhasil ...');
      document.location = "supplier.php";
    </script>
    <?php
  } else {
    ?>
    <script>
      alert('Maaf! Hapus supplier gagal karena ada transaksi ...');
      document.location = "supplier.php";
    </script>
    <?php
  }
}
?>