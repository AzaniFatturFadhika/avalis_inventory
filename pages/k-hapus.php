<?php

include "../koneksi.php";

session_start();

if (empty($_SESSION['level'] == "superadmin" || $_SESSION['level']) == "admin") {
  header("location:../index.php");
}

if (isset($_GET['k_id'])) {
  $k_id = $_GET['k_id'];
  $hapus = mysqli_query($conn, "DELETE FROM kategori WHERE k_id='$k_id'");

  if ($hapus) {
    ?>
    <script>
      alert('Selamat! Hapus kategori berhasil ...');
      document.location = "kategori.php";
    </script>
    <?php
  }
}
?>