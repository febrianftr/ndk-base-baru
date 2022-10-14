<?php
require 'function_dokter.php';
session_start();

$data_admin = mysqli_query($conn, "SELECT * FROM xray_admin
									INNER JOIN xray_login
									ON xray_admin.username = xray_login.username");
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Data Admin</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['table_admin'] ?></li>
				<li style="float: right;">
					<label>Zoom</label>
					<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
					<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
				</li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">
				<div class="body">
					<h2 style="color: #EE7423; text-align: center;"><?= $lang['list_admin'] ?></h2>
					<br>
					<div class="container-fluid">
						<div class="">
							<div class="container-fluid">
								<div class="">
									<div style="padding: 0px;" class="col-md-6">
										<br>
										<a class="ahref" href="new_admin.php"><i class="fas fa-plus"></i> <?= $lang['add_data'] ?></a>
									</div>
									<!-- <div style="padding: 0px;" class="col-md-3 col-md-offset-3">
				<input class="form-control" id="myInput" type="text" placeholder="Search..">
				</div> -->
								</div>


								<div class="col-md-12 table-box" style="overflow-x:auto;">
									<table class=" table-dicom table-paginate" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">

										<thead>
											<tr>
												<th>No</th>
												<th>Admin ID</th>
												<th><?= $lang['admin_name'] ?></th>
												<th>Username</th>
												<th><?= $lang['action'] ?></th>
											</tr>
										</thead>
										<?php $i = 1; ?>
										<?php foreach ($data_admin as $row) : ?>
											<tr>
												<td><?= $i ?></td>
												<td><?= $row["admin_id"]; ?></td>
												<td><?= $row["ad_name"] . " " . $row["ad_lastname"]; ?></td>
												<td><?= $row["username"]; ?></td>
												<td>
													<a href="update_admin.php?admin_id=<?= $row["admin_id"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
													<a href="delete_admin.php?admin_id=<?= $row["admin_id"]; ?>&amp;id_table=<?= $row['id_table']; ?>" onclick="return confirm('Teruskan Menghapus Data?');"><img data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>
												</td>
											</tr>
											<?php $i++; ?>
										<?php endforeach; ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footerindex">
					<div class="">
						<div class="footer-login col-sm-12"><br>
							<center>
								<p>&copy; Powered by Intiwid IT Solution 2019</a>.</p>
							</center>
						</div>
					</div>
				</div>
			</div>
			<?php include('script-footer.php'); ?>
			<script>
				$(document).ready(function() {
					$('[data-toggle="tooltip"]').tooltip();
				});
			</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>