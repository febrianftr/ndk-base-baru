<?php

require '../koneksi/koneksi.php';

session_start();
$username = $_SESSION['username'];


if ($_SESSION['level'] == "admin") {

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Administrator | Admin</title>
		<?php include('head.php'); ?>

	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['administrator'] ?></li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">

				<div class="container-fluid adm">
					<div class="header-adm">
						<h1><?= $lang['administrator'] ?></h1>
					</div>

					<div class="content-adm table-box">
						<div class="content1-adm">

							<div class="col-sm-2">
								<h4 class="h4"><?= $lang['referral_physician'] ?></h4>
								<li class="li-adm"><a href="new_dokter.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_dokter.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>

							<div class="col-sm-2">
								<h4 class="h4"><?= $lang['radiology_physician'] ?></h4>
								<li class="li-adm"><a href="new_dokter_radiology.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_dokter_radiology.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>

							<div class="col-sm-2">
								<h4 class="h4">Radiographer</h4>
								<li class="li-adm"><a href="new_radiographer.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_radiographer.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>

							<div class="col-sm-2">
								<h4 class="h4"><?= $lang['departmen'] ?></h4>
								<li class="li-adm"><a href="new_department.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_department.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>

							<div class="col-sm-2">
								<h4 class="h4"><?= $lang['modality'] ?></h4>
								<li class="li-adm"><a href="new_modalitas.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_modalitas.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>

							<div class="col-sm-2">
								<h4 class="h4"><?= $lang['procedure'] ?></h4>
								<li class="li-adm"><a href="new_study.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_study.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>
							<div class="col-sm-2">
								<h4 class="h4">AET</h4>
								<li class="li-adm"><a href="new_ae.php"><i class="fas fa-plus-square"></i> <?= $lang['add'] ?></a></li>
								<li class="li-adm"><a href="view_ae.php"><i class="fas fa-paper-plane"></i> <?= $lang['view'] ?></a></li>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footerindex">
				<div class="footer-login col-sm-12"><br>
					<center>
						<p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
					</center>
				</div>
			</div>
		</div>
		</div>
		<?php include('script-footer.php'); ?>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>