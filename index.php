<?php session_start(); ?>

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

	<link rel="shortcut icon" href="pages/img/icons/logo.png" />

	<title>Inventory Barang - Login</title>

	<!-- css template -->
	<link href="pages/css/app.css" rel="stylesheet">

	<!-- font -->
	<link href="pages/fonts/InterWeb/inter.css" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Selamat Datang di Afalis Inventory</h1>
							<p class="lead">
								Masuk dengan akun anda untuk melanjutkan
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="pages/img/icons/logo.png" alt="Charles Hall" class="img-fluid rounded-circle mb-4"
											width="132" height="132" />
									</div>
									<form action="login.php" method="POST">
										<div class="mb-3">
											<label class="form-label">Nama Pengguna</label>
											<input class="form-control form-control-lg" type="text" name="username"
												placeholder="Masukkan nama pengguna anda" />
										</div>
										<div class="mb-3">
											<label class="form-label">Sandi</label>
											<input class="form-control form-control-lg" type="password" name="password"
												placeholder="Masukkan sandi anda" />
										</div>
										<div class="text-center mt-4">
											<input class="btn btn-lg btn-primary" type="submit" name="Masuk" value="Masuk"></input>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>


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

</html>