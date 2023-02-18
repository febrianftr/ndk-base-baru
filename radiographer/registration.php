<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Registration | Radiographer</title>
		<?php include('head.php'); ?>
		<style>
			.footerindex {
				position: fixed;
			}
		</style>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="body">

						<div class="container-fluid">
							<div class="head-title" style="width: 365px;">
								<h3 class="textsearchnewpasien2"><?= $lang['regist_new_patient'] ?></h3>
							</div>
							<form method="post" id="registration">
								<div class="row left-information">
									<div style="margin: 0px 0px;" class="row regist">
										<div class="col-sm-6">
											<table class="table-form">
												<tr>
													<td width="150"><label for="mrn"><b>MRN <span class="text-danger">*</span></b></label></td>
													<td><input type="text" name="mrn" id="mrn" maxlength="10" placeholder="<?= $lang['input_mrn'] ?>" required></td>
												</tr>
												<tr>
													<td width="150"><label for="name"><b><?= $lang['name'] ?> <span class="text-danger">*</span></b></label></td>
													<td><input type="text" name="name" id="name" placeholder="<?= $lang['input_f_name'] ?>" required></td>
												</tr>
												<tr>
													<td width="150"><label for="sex"><b>Gender <span class="text-danger">*</span></b></label></td>
													<td>
														<label class="radio-admin">
															<input type="radio" checked="checked" name="sex" value="M" required> <?= $lang['male'] ?>
															<span class="checkmark"></span>
														</label>
														<label class="radio-admin">
															<input type="radio" name="sex" value="F" required> <?= $lang['female'] ?>
															<span class="checkmark"></span>
														</label>
													</td>
												</tr>
												<tr>
													<td width="150"><label for="birth_date"><b><?= $lang['birth_date'] ?> <span class="text-danger">*</span></b></label></td>
													<td><input type="text" name="birth_date" id="birth_date" placeholder="<?= $lang['input_birth_date'] ?>" autocomplete="off" required></td>
												</tr>
												<tr>
													<td width="150"><label for="weight"><b><?= $lang['weight'] ?></b></label></td>
													<td><input type="text" name="weight" id="weight" placeholder="<?= $lang['input_weight'] ?>"></td>
												</tr>
											</table>
										</div>
										<div class="col-sm-6">
											<table class="table-form">
												<tr>
													<td width="150"><label for="address"><b><?= $lang['address'] ?></b></label></td>
													<td><textarea type="text" name="address" id="address" placeholder="<?= $lang['input_address'] ?>"></textarea></td>
												</tr>
												<tr>
													<td width="150"><label for="note"><b><?= $lang['note'] ?></b></label></td>
													<td><textarea type="text" name="note" id="note" placeholder="<?= $lang['input_note'] ?>"></textarea></td>
												</tr>
												<tr>
													<div class="container-fluid">
														<div class="row">
															<td width="150"><label for="phone"><b><?= $lang['no_telp'] ?></b></label></td>
															<td>
																<input style="border-radius: 0px 4px 4px 0px;" type="text" name="phone" id="phone" placeholder="<?= $lang['input_telp'] ?>">
															</td>
														</div>
													</div>
												</tr>
												<tr>
													<td width="150"><label for="email"><b>E-Mail</b></label></td>
													<td><input type="text" name="email" id="email" placeholder="<?= $lang['input_email'] ?>"></td>
												</tr>
											</table>
											<button class="btn btn-worklist btn-expertise waves-effect waves-light" type="submit" id="submit" name="submit" style="float: right;">
												<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
												<p class="loading" style="display:inline;">Loading...</p>
												<p class="ubah" style="display:inline;"><?= $lang['add_data'] ?></p>
											</button>
										</div>

									</div>
								</div>
							</form>
						</div>

					</div>

					<div>
						<div class="container-fluid" style="margin-bottom: 100px;">
							<div class="head-title" style="width: 365px;">
								<h3 class="textsearchnewpasien2">List Patient</h3>
							</div>
							<div class="row left-information">
								<div class="table-view col-md-12 table-box" style="overflow-x: scroll;">
									<table class="table-dicom table-paginate" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
										<thead>
											<tr>
												<th>
													<center>No</center>
												</th>
												<th>
													<center>MRN</center>
												</th>
												<th>
													<center><?= $lang['name'] ?></center>
												</th>
												<th>
													<center>Gender</center>
												</th>
												<th>
													<center>Birth Date</center>
												</th>
												<th>
													<center>Weight</center>
												</th>
												<th>
													<center>Address</center>
												</th>
												<th>
													<center>Phone</center>
												</th>
												<th>
													<center>Email</center>
												</th>
												<th>
													<center>Note</center>
												</th>
												<th>
													<center><?= $lang['create_date'] ?></center>
												</th>
												<th>
													<center>ACTION</center>
												</th>
											</tr>
										</thead>
										<?php
										$i = 1;
										$patient = mysqli_query(
											$conn,
											"SELECT * FROM xray_patient ORDER BY created_at DESC"
										);
										while ($row = mysqli_fetch_array($patient)) { ?>
											<tr>
												<td> <?= $i; ?> </td>
												<td> <?= defaultValue($row['mrn']) ?> </td>
												<td><?= defaultValue($row['name']) . " " . $row['lastname']  ?></td>
												<td><?= defaultValue($row['sex']) ?></td>
												<td><?= defaultValueDate($row['birth_date']) ?></td>
												<td><?= defaultValueNumber($row['weight']) ?></td>
												<td><?= defaultValue($row['address']) ?></td>
												<td><?= defaultValue($row['phone']) ?></td>
												<td><?= defaultValue($row['email']) ?></td>
												<td><?= defaultValue($row['note']) ?></td>
												<td><?= defaultValueDateTime($row['created_at']) ?></td>
												<td width="150">
													<a href="registration-live.php?pk=<?= $row['pk']; ?>" class="btn-worklist" value="Create Order" style="color: #ececec;"><?= $lang['create_order'] ?>
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
			</div>
		</div>
		<div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script src="../js/proses/registration.js?v=<?= $random; ?>"></script>
		<script>
			$(document).ready(function() {
				$("li[data-target='#products1']").addClass("active");
				$("ul[id='products1'] li[id='regist1']").addClass("active");
				$("li[data-target='#products1'] a i").css('color', '#bdbdbd');
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#birth_date').datetimepicker({
					timepicker: false,
					format: 'Y-m-d',
					startDate: '2000-01-02'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>