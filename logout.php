<?php

session_start();

session_destroy();


if (isset($_GET['waktuhabis'])) {
  ?>
  <script>
    alert('Sesi Anda Telah Habis, Silahkan Masuk Kembali!...');
    document.location = "index.php";
  </script>
  <?php
} else {
  ?>
  <script>
    alert('Anda Berhasil Keluar ...');
    document.location = "index.php";
  </script>
<?php
}