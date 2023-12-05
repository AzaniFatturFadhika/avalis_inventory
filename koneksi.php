<?php


$hostserver = "localhost";
$username = "root";
$password = "";
$database = "afalis_inventory";

$conn = mysqli_connect($hostserver, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Koneksi ke database gagal : --> " . mysqli_connect_error();
}
?>