<?php

session_start();

include "../koneksi.php";

if (empty($_SESSION['level'])) {
  header("location:../index.php");
}

if (isset($_GET['b_barcode'])) {
  $id = $_GET['b_barcode'];
  $hapus = mysqli_query($conn, "DELETE FROM barang WHERE b_barcode='$id'");

  if ($hapus) {
    ?>
    <script>
      alert('Selamat! Hapus barang berhasil ...');
      document.location = "barang.php";
    </script>
    <?php
  }
}
?>