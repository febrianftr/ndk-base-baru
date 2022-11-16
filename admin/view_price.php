<?php
require 'function_dokter.php';
session_start();
if (isset($_SESSION["username"]))

	$data_price = mysqli_query($conn, "SELECT * FROM xray_price GROUP BY main_prosedur ORDER BY type, main_prosedur ASC");
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Data Harga</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['table_procedure'] ?></li>
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
					<h2 style="color: #EE7423; text-align: center;"><?= $lang['list_procedure'] ?></h2>
					<br>
					<div class="container-fluid">
						<div class="">
							<div class="container-fluid">
								<div class="">
									<div style="padding: 0px;" class="col-md-6">
										<br>
										<a class="ahref" href="new_price.php"><i class="fas fa-plus"></i> <?= $lang['add_procedure'] ?></a>
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
												<!-- <th><?= $lang['xray_code'] ?></th> -->
												<th>Main Procedure</th>
												<!-- <th><?= $lang['procedure'] ?></th> -->
												<th><?= $lang['pro_type'] ?></th>
												<th><?= $lang['price'] ?></th>
												<th><?= $lang['action'] ?></th>
											</tr>
										</thead>
										<?php
										$i = 1;
										while ($row = mysqli_fetch_assoc($data_price)) { ?>
											<tr>
												<td><?= $i; ?></td>
												<!-- <td><?= $row["code_xray"]; ?></td> -->
												<td><?= $row["main_prosedur"]; ?></td>
												<!-- <td><?= $row["prosedur"]; ?></td> -->
												<td><?= $row["type"]; ?></td>
												<td><?= $row["price"]; ?></td>
												<td>
													<a href="update_price.php?idharga=<?= $row["idharga"]; ?>"><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png"></a>
													<a href="delet_price.php?idharga= <?= $row["idharga"]; ?>" onclick="return confirm('Teruskan Menghapus Data?');"><img data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>
												</td>
											</tr>
											<?php $i++; ?>
										<?php } ?>
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
								<p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
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