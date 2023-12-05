<?php

include "../koneksi.php";

session_start();

if (empty($_SESSION['level'] == "superadmin" || $_SESSION['level']) == "admin") {
  header("location:../index.php");
}

if (isset($_GET['sa_id'])) {
  $sa_id = $_GET['sa_id'];
  $hapus = mysqli_query($conn, "DELETE FROM satuan WHERE sa_id='$sa_id'");

  if ($hapus) {
    ?>
    <script>
      alert('Selamat! Hapus satuan berhasil ...');
      document.location = "satuan.php";
    </script>
    <?php
  }
}
?>