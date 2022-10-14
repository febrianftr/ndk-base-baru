<?php
require 'function_radiographer.php';
session_start();
//ambil data di url
$uid = $_GET["uid"];
$result = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid' ");
$row111 = mysqli_fetch_array($result);

$username = $_SESSION['username'];

$name = $row111["name"];
$name1 = str_replace('^', ' ', $name);

$radiographer_name = $row111["radiographer_name"];
$radiographer_name1 = preg_replace('/[^A-Za-z\ ]/', ' ', $radiographer_name);

if (isset($_POST["submit"])) {
	// get order cek acc number
	$row = mysqli_fetch_array(mysqli_query(
		$conn,
		"SELECT * FROM xray_order WHERE acc = '$_POST[acc]' AND mrn LIKE '%$_POST[mrn]%' "
	));
	// cek order
	$cekorder = mysqli_affected_rows($conn);

	// get workload radiographer cek acc number
	$row_workload = mysqli_fetch_assoc(mysqli_query(
		$conn,
		"SELECT * FROM xray_workload_radiographer WHERE acc = '$_POST[acc]' AND mrn LIKE '%$_POST[mrn]%' AND fromorder = 'terkirim'"
	));
	$cekworkload = mysqli_affected_rows($conn);

	if ($cekorder <= 0) {
		// jika tidak ada acc number di xray_order
		// echo "data tidak ada di SIMRS";
		echo "
			<script>
			alert('acc number simrs tidak sesuai');
			document.location.href= 'update_workload_before.php?uid=$uid';
			</script>";
	} else if ($cekworkload > 0) {
		// jika ada acc number di xray_workload
		// echo "data sudah ada di RIS / kesalahan input acc number dialat";
		echo "
        <script>
        alert('acc number sudah ada diRIS');
        document.location.href= 'update_workload_before.php?uid=$uid';
        </script>";
	} else {
		if (ubahworkloadbefore($_POST) > 0) {
			// jika data sukses semua
			echo "
			<script>
				alert('Data Berhasil diubah');
				document.location.href= 'workload.php';
			</script>";
		} else {
			// jika ada data yang gagal
			echo "
			<script>
				alert('Data Gagal diubah');
				document.location.href= 'update_workload_before.php?uid=$uid';
			</script>";
		}
	}
}
function jin_date_str($date)
{
	$exp = explode('-', $date);
	if (count($exp) == 3) {
		$date = $exp[2] . '/' . $exp[1] . '/' . $exp[0];
	}
	return $date;
}
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data Dokter</title>
		<?php include('head.php'); ?>
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
										<li class="breadcrumb-item"><a href="workload.php">Workload</a></li>
										<li class="breadcrumb-item active">Edit Data</li>
									</ol>
								</nav>
							</div>

							<form action="" method="post">
								<div style="margin: 0px 0px;" class="row back-search">
									<div class="form-update-workload col-md-4">
										<input type="hidden" name="uid" id="uid" value="<?= $row111["uid"]; ?>"></input>
										<ul>
											<li>
												<label for="acc">ACCESION NUMBER</label><br>
												<input type="text" id="acc" value="<?= $row111["acc"]; ?>" name="acc">
											</li>
											<li>
												<label for="patientid">ID Pasien</label><br>
												<input type="text" id="patientid" value="<?= $row111["patientid"]; ?>" name="patientid">
											</li>
											<li>
												<label for="mrn">MRN</label><br>
												<input type="text" name="mrn" id="mrn" value="<?= $row111["mrn"]; ?>">
											</li>
											<li>
												<label for="name">Nama Depan</label><br>
												<input type="text" id="name" value="<?= $name1; ?>" name="name">
											</li>
											<li>
												<label for="lastname">Nama Belakang</label><br>
												<input type="text" name="lastname" id="lastname" value="<?= $row111["lastname"]; ?>">
											</li>
											<label for="sex"><b>Jenis Kelamin</b></label><br>
											<label class="radio-admin">
												<input type="radio" checked="checked" name="sex" <?php if ($row111["sex"] == 'M') {
																										echo 'checked';
																									} ?> value="M" required> Laki - laki
												<span class="checkmark"></span>
											</label>
											<label class="radio-admin">
												<input type="radio" name="sex" <?php if ($row111["sex"] == 'F') {
																					echo 'checked';
																				} ?> value="F" required> Perempuan
												<span class="checkmark"></span>
											</label>
											<label class="radio-admin">
												<input type="radio" name="sex" <?php if ($row111["sex"] == 'O') {
																					echo 'checked';
																				} ?> value="O" required> Other
												<span class="checkmark"></span>
											</label>
											<li><br>
												<label for="birth_date">Tanggal Lahir</label><br>
												<?php $d = date('Y-m-d', strtotime($row111["birth_date"])); ?>
												<input type="text" name="birth_date" id="birth_date" value="<?= $d; ?>">
											</li>

											<li>
												<label for="address">Alamat</label><br>
												<input type="text" name="address" id="address" value="<?= $row111["address"]; ?>">
											</li>
											<li>
												<label for="weight">Berat Badan</label><br>
												<input type="text" name="weight" id="weight" value="<?= $row111["weight"]; ?>">
											</li>

											<li>
												<label for="depid">Nama Departemen</label><br>
												<input type="text" name="name_dep" id="name_dep" value="<?= $row111["name_dep"]; ?>">
												<!-- <?php
														// ------------data workload------------
														$depid = $row111['depid'];
														$name_dep = $row111['name_dep'];
														// ------------data department-----------
														$result = mysqli_query($conn, "SELECT * FROM xray_department ");

														if ($name_dep) {
															$selected = 'selected';
														} else {
															$selected = '';
														}
														?> 
										<select name="depid" id="depid">
											<option>--- Pilih Departement ---</option>
											<option value="<?= $depid; ?>" <?php echo $selected; ?> style="color: #ee7423 ;"><?= $name_dep; ?></option>
											<?php while ($row = mysqli_fetch_assoc($result)) { ?>
											<option value="<?= $row['depid']; ?>" ><?= $row['name_dep']; ?></option>
											<?php } ?>
										</select> -->

											</li>

									</div>
									<div class="form-update-workload col-md-4">


										<li>
											<label for="xray_type_code">Modality</label><br>
											<input type="text" name="xray_type_code" id="xray_type_code" value="<?= $row111["xray_type_code"]; ?>">
											<!-- <?php
													// ------------data workload------------
													$xray_type_code = $row111['xray_type_code'];
													$typename = $row111['typename'];
													// ------------data department-----------
													$result = mysqli_query($conn, "SELECT * FROM xray_modalitas");

													if ($xray_type_code) {
														$selected = 'selected';
													} else {
														$selected = '';
													}
													?>
										<select name="xray_type_code" id="xray_type_code">
											<option>--- Pilih Departement ---</option>
											<option value="<?= $xray_type_code; ?>" <?php echo $selected; ?> style="color: #ee7423 ;"><?= $xray_type_code; ?></option>
											<?php while ($row = mysqli_fetch_assoc($result)) { ?>
											<option value="<?= $row['xray_type_code']; ?>" ><?= $row['xray_type_code']; ?></option>
											<?php } ?>
										</select> -->

										</li>
										<li>
											<input type="hidden" name="typename" id="typename" value="<?= $row111["typename"]; ?>">
										</li>
										<!-- 									<li>
										<label for="prosedur">Prosedur</label><br>
										<?php
										$type = $row111['type'];
										$prosedur = $row111['prosedur'];
										$result = mysqli_query($conn, "SELECT * FROM xray_price");
										if ($prosedur) {
											$selected = 'selected';
										} else {
											$selected = '';
										}
										?>
										<select name="prosedur" id="prosedur">
											<option value="">--- Pilih Prosedur ---</option>
											<option value="<?= $prosedur; ?>" <?php echo $selected; ?> style="color: #ee7423;"><?= $prosedur; ?></option>
											<?php while ($row1 = mysqli_fetch_assoc($result)) { ?>
											<option value="<?= $row1['prosedur']; ?>"><?= $row1['prosedur']; ?></option>
											<?php } ?>
										</select>
									</li> -->
										<li class="dokteravail">
											<label for="named">Nama Dokter</label><br>
											<input type="text" name="named" id="named" value="<?= $row111["named"]; ?>">
											<!-- <?php
													$dokterid = $row111['dokterid'];
													$named = $row111['named'];
													$lastnamed = $row111['lastnamed'];
													$result = mysqli_query($conn, "SELECT * FROM xray_dokter");
													if ($dokterid) {
														$selected = 'selected';
													} else {
														$selected = '';
													}
													?>
										<select name="dokterid" id="dokterid">
											<option value="">--- Pilih Dokter ---</option>
											<option value="<?= $dokterid; ?>" <?php echo $selected; ?> style="color: #ee7423;"><?= $named . ' ' . $lastnamed; ?></option>
											<?php while ($row = mysqli_fetch_assoc($result)) { ?>
											<option value="<?= $row['dokterid']; ?>"><?= $row['named'] . ' ' . $row['lastnamed']; ?></option>
											<?php } ?>
											<option  data-toggle="collapse" data-target="#demo" value="">Dokter Lainnya</option>
										</select> -->

										</li>
										<label class="klik-dokter">Klik kembali untuk menampilkan daftar dokter</label>

										<li>
											<div id="demo" class="collapse">
												<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Hide input dokter</button>
												<hr>
												<label>Nama depan</label>

												<input type="text" name="namedluar" placeholder="Masukan nama">
												<label>Nama Belakang</label>
												<input type="text" name="lastnamedluar" placeholder="Masukan nama terakhir">
												<label>Email</label>
												<input type="text" name="emailluar" placeholder="Masukan email"><br>
												<hr>
											</div>
										</li>
										<li>
											<?php
											// $result13 = mysqli_query($conn, "SELECT * FROM xray_workload WHERE uid = '$uid' ");
											// $row13 = mysqli_fetch_assoc($result13);
											// $radiographer_name2 = $row13['radiographer_name'];
											// $radiographer_lastname2 = $row13['radiographer_lastname'];
											?>
											<label for="radiographer_name">Nama Radiographer CR</label><br>
											<input type="text" name="radiographer_name" id="radiographer_name" value="<?= $row111["radiographer_name"] . ' ' . $row111["radiographer_lastname"]; ?>" readonly>
										</li>
										<li>
											<label for="radiographer_name">Nama Radiographer 2</label><br>
											<input type="text" name="operator" id="operator" value="<?= $row111["operator"]; ?>" readonly>
										</li>
										<li>
											<label for="dokrad_name">Nama Dokter Radiology</label><br>
											<input type="text" id="dokrad_name" value="<?= $row111["dokrad_name"] . ' ' . $row111["dokrad_lastname"]; ?>" readonly>
										</li>
										<li>
											<label for="payment">Pembayaran</label><br>
											<input type="text" name="payment" id="payment" value="<?= $row111["payment"]; ?>">
										</li>
										<li>
											<label for="contrast">Contrast</label><br>
											<label class="radio-admin">
												<input type="radio" <?php if ($row111['contrast'] == "Perlu Kontras") {
																		echo "checked";
																	} else {
																		echo "unchecked";
																	} ?> name="contrast" value="Perlu Kontras" required> Perlu Kontras
												<span class="checkmark"></span>
											</label>

											<label class="radio-admin">
												<input type="radio" <?php if ($row111['contrast'] == "Tidak perlu contrast") {
																		echo "checked";
																	} else {
																		echo "unchecked";
																	} ?> name="contrast" value="Tidak perlu contrast" required> Tidak perlu contrast
												<span class="checkmark"></span>
											</label>
										</li><br>
										<li>
											<label for="priority">Prioritas</label><br>
											<input type="text" name="priority" id="priority" value="<?= $row111["priority"]; ?>">
											<!-- <select name="priority">
											<option <?php if ($row111['priority'] == "4Low") {
														echo "selected";
													} ?> value="4Low">Low</option>
											<option <?php if ($row111['priority'] == "3Medium") {
														echo "selected";
													} ?> value="3Medium">Medium</option>
											<option <?php if ($row111['priority'] == "2high") {
														echo "selected";
													} ?> value="2high">High</option>
											<option <?php if ($row111['priority'] == "1Critical") {
														echo "selected";
													} ?> value="1Critical">Critical</option>
										</select> -->
										</li>
										<li>
											<label for="pat_state">Keadaan Pasien</label><br>
											<select name="pat_state">
												<option <?php if ($row111['pat_state'] == " " or $row111['pat_state'] == NULL) {
															echo "selected";
														} ?> value=" "></option>
												<option <?php if ($row111['pat_state'] == "RAWAT INAP" or $row111['pat_state'] == "Rawat Inap") {
															echo "selected";
														} ?> value="Rawat Inap">Rawat Inap</option>
												<option <?php if ($row111['pat_state'] == "RAWAT JALAN" or $row111['pat_state'] == "Rawat Jalan") {
															echo "selected";
														} ?> value="Rawat Jalan">Rawat Jalan</option>
											</select>
										</li>
										<li>
											<label for="contrast_allergies">Alergi Kontras/Tidak</label><br>
											<select name="contrast_allergies">
												<option <?php if ($row111['contrast_allergies'] == " " or $row111['contrast_allergies'] == NULL) {
															echo "selected";
														} ?> value=" "></option>
												<option <?php if ($row111['contrast_allergies'] == "Alergi Contrast") {
															echo "selected";
														} ?> value="Alergi Contrast">Alergi Contrast</option>
												<option <?php if ($row111['contrast_allergies'] == "Tidak Alergi Contrast") {
															echo "selected";
														} ?> value="Tidak Alergi Contrast">Tidak Alergi Contrast</option>
											</select>
										</li>

									</div>

									<div class="form-update-workload col-md-4">
										<li>
											<label for="spc_needs">Catatan Tambahan</label><br>
											<textarea rows="4" cols="50" type="text" name="spc_needs" id="spc_needs" value="<?= $row111["spc_needs"]; ?>"><?= $row111["spc_needs"]; ?></textarea>
										</li>
										<li>
											<label for="rephoto">Keterangan pengulangan foto</label><br>
											<input type="text" name="rephoto" id="rephoto" value="<?= $row111["rephoto"]; ?>">
										</li>
										<li>
											<label for="filmsize8">Film Small</label><br>
											<input type="text" name="filmsize8" id="filmsize8" value="<?= $row111["filmsize8"]; ?>">
										</li>
										<li>
											<label for="filmsize10">Film Medium</label><br>
											<input type="text" name="filmsize10" id="filmsize10" value="<?= $row111["filmsize10"]; ?>">
										</li>
										<li>
											<label for="filmreject8">Film Reject Small</label><br>
											<input type="text" name="filmreject8" id="filmreject8" value="<?= $row111["filmreject8"]; ?>">
										</li>
										<li>
											<label for="filmreject10">Film Reject Medium </label><br>
											<input type="text" name="filmreject10" id="filmreject10" value="<?= $row111["filmreject10"]; ?>">
										</li>
										<li>
											<label for="kv">KV</label><br>
											<input type="text" name="kv" id="kv" value="<?= $row111["kv"]; ?>">
										</li>
										<li>
											<label for="mas">mAs</label><br>
											<input type="text" name="mas" id="mas" value="<?= $row111["mas"]; ?>">
										</li>
										<!-- <li>
										<label for="xraytype">Jenis Pesawat</label><br>
										<select name="xraytype">
											<option <?php if ($row111['xraytype'] == "shimadzu") {
														echo "selected";
													} ?> value="shimadzu">SHIMADZU</option>
											<option <?php if ($row111['xraytype'] == "ge") {
														echo "selected";
													} ?> value="ge">GE</option>
											<option <?php if ($row111['xraytype'] == "toshiba") {
														echo "selected";
													} ?> value="toshiba">THOSIBA</option>
											<option <?php if ($row111['xraytype'] == "asahi") {
														echo "selected";
													} ?> value="asahi">ASAHI</option>
											<option <?php if ($row111['xraytype'] == "pesawat baru") {
														echo "selected";
													} ?> value="pesawat baru">PESAWAT BARU</option>
										</select>
									</li> -->
										<!-- <li>
										<br>
										<label for="formregistration">Kelengkapan Form</label><br>
										<label class="radio-admin">
											<input type="radio" checked <?php if ($row111['formregistration'] == "lengkap") {
																			echo "checked";
																		} ?> name="formregistration" value="lengkap" required> Lengkap
											<span class="checkmark"></span>
										</label><br><br>

										<label class="radio-admin">
											<input type="radio" <?php if ($row111['formregistration'] == "tidak lengkap") {
																	echo "checked";
																} ?> name="formregistration" value="tidak lengkap" required> Tidak Lengkap
											<span class="checkmark"></span>
										</label>
									</li> -->
										<br><br><br>
										<?php if ($username != "demo") { ?>
											<li>
												<button class="btn buttonsearch2 waves-effect waves-light" type="submit" name="submit">Ubah Data</button>
											</li>
										<?php } else { ?>
											<li>
												<button class="btn buttonsearch2 waves-effect waves-light" type="submit" name="submit" disabled>Ubah Data</button>
											</li>
										<?php } ?>
										</ul>
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
		<script>
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='workload1']").addClass("active");
			});
		</script>

		<script>
			$(document).ready(function() {
				$(".klik-dokter").hide();
				$(".btn-info").click(function() {
					// $(".dokteravail").hide();
					$(".dokteravail").show();
					$(".klik-dokter").hide();
				});
			});
		</script>


		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script>
			$(document).ready(function() {
				$('#birth_date').datetimepicker({
					timepicker: false,
					format: 'Y-m-d'
				});
			});
		</script>

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>