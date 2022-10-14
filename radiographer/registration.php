<?php
require '../koneksi/koneksi.php';
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
							<div class="col-12" style="padding-left: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active">Registration</li>
									</ol>
								</nav>
							</div>

							<div class="head-title" style="width: 300px;">
								<h3 class="textsearchnewpasien2"><?= $lang['search_patient'] ?></h3>
							</div>
							<form method="post" action="inputorder.php">
								<div class="row back-search">
									<div class="content1 col-sm-3" style="padding: 0px;">
										<div class="wrap-search1">
											<span class="search-icon2"><i class="ic-search fas fa-search"></i>
												<input class="search-input-reg" type="text" name="mrn" placeholder="<?= $lang['input_mrn'] ?>">
											</span>
										</div>
									</div>
									<div class="content1 col-sm-4" style="padding: 0px;">
										<div class="wrap-search1">
											<span class="search-icon2"><i class="ic-search fas fa-search"></i>
												<input class="search-input-reg" type="text" name="name" value="" placeholder="<?= $lang['search_f_name'] ?>">
											</span>
										</div>
									</div>
									<div class="content1 col-sm-4" style="padding: 0px;">
										<div class="wrap-search1">
											<span class="search-icon2"><i class="ic-search fas fa-search"></i>
												<input class="search-input-reg" type="text" name="lastname" placeholder="<?= $lang['search_l_name'] ?> ">
											</span>
										</div>
									</div>
									<div class="col-sm-1" style="padding: 0;">
										<button class="btn buttonsearch" type="submit" name="submit2" style="margin: 12px 0 0 0; float:unset; width:100%; box-shadow:none; padding: 12px 0; border-radius: 2px;">
											<i class="fas fa-search"></i><span></span>
										</button>
									</div>
								</div>
							</form>
						</div>

						<div class="container-fluid">
							<div class="head-title" style="width: 365px;">
								<h3 class="textsearchnewpasien2"><?= $lang['regist_new_patient'] ?></h3>
							</div>
							<form action="afterregist.php" method="post">
								<div class="row back-search">
									<div style="margin: 0px 0px;" class="row regist">

										<div class="col-sm-6">
											<table class="table-form">
												<tr>
													<td><label for="mrn"><b>MRN <span class="text-danger">*</span></b></label></td>
													<td><input type="text" name="mrn" id="mrn" maxlength="10" placeholder="<?= $lang['input_mrn'] ?>" required></td>
												</tr>
												<tr>
													<td><label for="name"><b><?= $lang['name'] ?> <span class="text-danger">*</span></b></label></td>
													<td>
														<div class="container">
															<div class="row">
																<div class="col-sm-6" style="padding: 0px 5px 0 0">
																	<input type="text" name="name" id="name" placeholder="<?= $lang['input_f_name'] ?>" required>
																</div>
																<div class="col-sm-6" style="padding: 0px 0px">
																	<input type="text" name="lastname" id="lastname" placeholder="<?= $lang['input_l_name'] ?>">
																</div>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><label for="sex"><b><?= $lang['sex'] ?> <span class="text-danger">*</span></b></label></td>
													<td><label class="radio-admin">
															<input type="radio" checked="checked" name="sex" value="M" required> <?= $lang['male'] ?>
															<span class="checkmark"></span>
														</label>
														<label class="radio-admin">
															<input type="radio" name="sex" value="F" required> <?= $lang['female'] ?>
															<span class="checkmark"></span>
														</label>
														<label class="radio-admin">
															<input type="radio" name="sex" value="O" required> <?= $lang['other'] ?>
															<span class="checkmark"></span>
														</label>
													</td>
												</tr>
												<tr>
													<td><label for="birth_date"><b><?= $lang['birth_date'] ?> <span class="text-danger">*</span></b></label></td>
													<td><input type="text" name="birth_date" id="birth_date" placeholder="<?= $lang['input_birth_date'] ?>" autocomplete="off" required></td>
												</tr>
												<tr>
													<td><label for="road"><b><?= $lang['weight'] ?></b></label></td>
													<td><input type="text" name="weight" id="road" placeholder="<?= $lang['input_weight'] ?>"></td>
												</tr>
												<tr>
													<td><label for="address"><b><?= $lang['address'] ?></b></label></td>
													<td><textarea type="text" name="address" id="address" placeholder="<?= $lang['input_address'] ?>"></textarea></td>
												</tr>
												<tr>
													<td><label for="road"><b><?= $lang['village'] ?></b></label></td>
													<td><input type="text" name="village" id="road" placeholder="<?= $lang['input_village'] ?>"></td>
												</tr>
												<tr>
													<td><label for="village"><b><?= $lang['sub_district'] ?></b></label></td>
													<td><input type="text" name="sub_district" id="village" placeholder="<?= $lang['input_sub_district'] ?>"></td>
												</tr>
											</table>
										</div>

										<div class="col-sm-6">
											<table class="table-form">
												<tr>
													<td><label for="amphoe_code"><b><?= $lang['city'] ?></b></label></td>
													<td><input type="text" name="city" id="amphoe_code" placeholder="<?= $lang['input_city'] ?>"></td>
												</tr>
												<tr>
													<td><label for="province_code"><b><?= $lang['province'] ?></b></label></td>
													<td><input type="text" name="province" id="province_code" placeholder="<?= $lang['input_province'] ?>"></td>
												</tr>
												<tr>
													<td><label for="tambon_code"><b><?= $lang['zip'] ?></b></label></td>
													<td><input type="text" name="post_code" id="tambon_code" maxlength="5" placeholder="<?= $lang['input_zip'] ?>"></td>
												</tr>
												<tr>
													<td><label for="country_code"><b><?= $lang['country'] ?></b></label></td>
													<td><select name="country" id="country_code">
															<option value=""><?= $lang['input_country'] ?></option>
															<option value="indonesia">Indonesia</option>
														</select>
													</td>
												</tr>
												<!-- <input type="text"	name="country" id="country_code" placeholder="Masukan Negara.."><br> -->

												<tr>
													<td><label for="note"><b><?= $lang['note'] ?></b></label></td>
													<td><textarea type="text" name="note" id="note" placeholder="<?= $lang['input_note'] ?>"></textarea></td>
												</tr>
												<tr>
													<div class="container-fluid">
														<div class="row">
															<td><label for="phone"><b><?= $lang['no_telp'] ?></b></label></td>
															<td>
																<div class="container">
																	<div class="row">
																		<div style="padding: 0px 0px" class="col-sm-3">
																			<select class="select-regist" name="kodearea" r>
																				<option value="+62"> +62 | Indonesia</option>
																				<option value="+60">+60 | Malaysia</option>
																				<option value="+95">+95 | Myanmar</option>
																				<option value="+673">+673 | Brunei Darussalam</option>
																				<option value="+855">+855 | Kamboja</option>
																				<option value="+856">+856 | Laos</option>
																				<option value="+670">+670 | Timor Leste</option>
																				<option value="+65">+65 | Singapura</option>
																				<option value="+66">+66 | Thailand</option>
																				<option value="+63">+63 | Filipina</option>
																			</select>
																		</div>
																		<div style="padding: 0px 0px" class="col-sm-9">
																			<input style="border-radius: 0px 4px 4px 0px;" type="text" name="phone" id="phone" placeholder="<?= $lang['input_telp'] ?>">
																		</div>
																	</div>
																</div>
															</td>
														</div>
													</div>
												</tr>
												<tr>
													<td><label for="email"><b>E-Mail</b></label></td>
													<td><input type="text" name="email" id="email" placeholder="<?= $lang['input_email'] ?>"></td>
												</tr>
											</table>
											<button class="btn btn-worklist btn-expertise waves-effect waves-light" type="submit" name="submit" style="float: right;"><span><b><?= $lang['add_data'] ?></b></span></button>
										</div>

									</div>
								</div>
							</form>
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

		<script>
			$(document).ready(function() {
				$("li[data-target='#products1']").addClass("active");
				$("ul[id='products1'] li[id='regist1']").addClass("active");
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