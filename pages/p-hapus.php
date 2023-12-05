<?php

include "../koneksi.php";

session_start();

if (empty($_SESSION['level'] == 'superadmin')) {
  header("location:../index.php");
} else if (empty($_SESSION['level'])) {
  ?>
    <script>
      alert('Oops anda tidak diizinkan mengakses halaman ini ...');
      document.location = "dashboard.php";
    </script>
  <?php
}

if (isset($_GET['nik'])) {
  $nik = $_GET['nik'];
  $query = mysqli_query($conn, "SELECT*FROM users WHERE nik = '$nik'");
  $delfoto = mysqli_fetch_array($query);
  $foto = $delfoto['foto'];

  $query2 = mysqli_query($conn, "SELECT*FROM users WHERE foto = '$foto'");
  $cekfoto = mysqli_num_rows($query2);

  if ($cekfoto == 1) {
    if ($foto != 'user.png') {
      unlink('img/profil/' . $foto);
    }
  }

  $hapus = mysqli_query($conn, "DELETE FROM users WHERE nik='$nik'");

  if ($hapus) {
    ?>
    <script>
      alert('Selamat! Hapus pengguna berhasil ...');
      document.location = "pengguna.php";
    </script>
    <?php
  }
}
?>