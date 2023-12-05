<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include "koneksi.php";

// menangkap data yang dikirim dari form login
if (isset($_POST['Masuk'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars(md5($_POST['password']));

	// cek apakah terdapat username yang diinputkan
	$querycek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	$cekdata = mysqli_fetch_array($querycek);


	if ($username == $cekdata['username']) {

		// cek apakah password benar
		if ($password == $cekdata['password']) {

			// masuk sesuai yang diinputkan
			$qmasuk = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
			$data = mysqli_fetch_assoc($qmasuk);

			// cek jika user login sebagai superadmin
			if ($data['level'] == "superadmin") {
				// buat session login dan username
				$_SESSION['username'] = $username;
				$_SESSION['level'] = "superadmin";
				$_SESSION['nik'] = $data['nik'];
				// alihkan ke halaman dashboard superadmin
				header("location:pages/dashboard.php");

				// cek jika user login sebagai admin
			} else if ($data['level'] == "admin") {
				// buat session login dan username
				$_SESSION['username'] = $username;
				$_SESSION['level'] = "admin";
				$_SESSION['nik'] = $data['nik'];
				// alihkan ke halaman dashboard admin
				header("location:pages/dashboard.php");

				// cek jika user login sebagai member
			} else if ($data['level'] == "member") {
				// buat session login dan username
				$_SESSION['username'] = $username;
				$_SESSION['level'] = "member";
				$_SESSION['nik'] = $data['nik'];
				// alihkan ke halaman dashboard member
				header("location:pages/dashboard.php");
			}
		} else {
			?>
			<script>
				alert('Oops Gagal Masuk, sandi salah ...');
				document.location = "index.php";
			</script>
			<?php
		}

	} else {
		?>
		<script>
			alert('Oops Gagal Masuk, nama pengguna tidak ditemukan ...');
			document.location = "index.php";
		</script>
		<?php
	}

} else {
	header("location:index.php");
}
?>