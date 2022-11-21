<?php
require 'function_radiographer.php';
require '../default-value.php';
require '../model/query-base-workload.php';
require '../model/query-base-workload-bhp.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
session_start();

$uid = $_GET["uid"];
$username = $_SESSION['username'];

$row = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT 
    $select_patient,
    $select_study,
    $select_order,
    $select_workload,
	$select_workload_bhp
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
    LEFT JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
	LEFT JOIN $table_workload_bhp
	ON xray_workload_bhp.uid = xray_workload.uid
    WHERE study.study_iuid = '$uid'"
));

$pat_name = $row['pat_name'];
$pat_sex = $row['pat_sex'];
$pat_birthdate = $row['pat_birthdate'] == null ? '' : date('d-m-Y', strtotime($row['pat_birthdate']));
$study_iuid = $row['study_iuid'];
$accession_no = $row['accession_no'];
$ref_physician = $row['ref_physician'];
$study_desc = $row['study_desc'];
$mods_in_study = $row['mods_in_study'];
$num_series = $row['num_series'];
$num_instances = $row['num_instances'];
$pat_id = $row['pat_id'];
$no_foto = $row['no_foto'];
$address = $row['address'];
$name_dep = $row['name_dep'];
$named = $row['named'];
$weight = $row['weight'];
$contrast = $row['contrast'];
$contrast_allergies = $row['contrast_allergies'];
$radiographer_name = $row['radiographer_name'];
$dokrad_name = $row['dokrad_name'];
$pat_state = $row['pat_state'];
$priority = $row['priority'];
$spc_needs = $row['spc_needs'];
$payment = $row['payment'];
$film_small = $row['film_small'];
$film_medium = $row['film_medium'];
$film_large = $row['film_large'];
$film_reject_small = $row['film_reject_small'];
$film_reject_medium = $row['film_reject_medium'];
$film_reject_large = $row['film_reject_large'];
$re_photo = $row['re_photo'];
$kv = $row['kv'];
$mas = $row['mas'];

if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Update Workload</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="body">
						<div class="container-fluid">
							<center>
								<h1>Edit Data</h1>
							</center>
							<form method="post" id="edit-workload">
								<div style="margin: 0px 0px;" class="row back-search">
									<div class="form-update-workload col-md-4">
										<input type="hidden" name="study_iuid" id="study_iuid" value="<?= $uid; ?>"></input>
										<ul>
											<li>
												<label for="accession_no">Accession Number</label><br>
												<input type="text" id="accession_no" value="<?= $accession_no; ?>" name="accession_no">
											</li>
											<li>
												<label for="no_foto">No Foto</label><br>
												<input type="text" id="no_foto" value="<?= $no_foto; ?>" name="no_foto">
											</li>
											<li>
												<label for="pat_id">MRN</label><br>
												<input class="not-allowed" type="text" name="pat_id" id="pat_id" value="<?= $pat_id; ?>" readonly>
											</li>
											<li>
												<label for="pat_name">Nama</label><br>
												<input class="not-allowed" type="text" id="pat_name" value="<?= removeCharacter($pat_name); ?>" name="pat_name" readonly>
											</li>
											<li>
												<label for="pat_sex"><b>Jenis Kelamin</b></label><br>
												<div class="status">
													<label class="radio-admin">
														<input type="radio" checked="checked" name="pat_sex" id="pat_sex" <?= strtoupper($pat_sex) == 'M' ? 'checked' : ''; ?> value="M"> Laki - laki
														<span class="checkmark"></span>
													</label>
													<label class="radio-admin">
														<input type="radio" name="pat_sex" id="pat_sex" <?= strtoupper($pat_sex) == 'F' ? 'checked' : ''; ?> value="F"> Perempuan
														<span class="checkmark"></span>
													</label>
												</div>
											</li><br>
											<li>
												<label for="pat_birthdate">Tanggal Lahir</label><br>
												<input type="text" name="pat_birthdate" id="pat_birthdate" value="<?= $pat_birthdate; ?>" autocomplete="off">
											</li>
											<li>
												<label for="address">Alamat</label><br>
												<input type="text" name="address" id="address" value="<?= $address; ?>">
											</li>
											<li>
												<label for="weight">Berat Badan</label><br>
												<input type="text" name="weight" id="weight" value="<?= $weight; ?>">
											</li>
											<li>
												<label for="name_dep">Nama Departemen</label><br>
												<select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="dep_id" data-style="btn-info">
													<?php
													$department = mysqli_query($conn, "SELECT * FROM xray_department");
													while ($row_department = mysqli_fetch_array($department)) { ?>
														<option value="<?= $row_department['dep_id']; ?>" data-tokens=""><?= $row_department['name_dep']; ?></option>
													<?php } ?>
												</select>
												<!-- jika menggunakan inputan data -->
												<!-- <input type="text" name="name_dep" id="name_dep" value="<?= $name_dep; ?>"> -->
											</li>
											<li>
												<label for="spc_needs">Klinis</label><br>
												<textarea rows="4" cols="50" type="text" name="spc_needs" id="spc_needs" value="<?= $spc_needs; ?>"><?= $spc_needs; ?></textarea>
											</li>
									</div>
									<div class="form-update-workload col-md-4">
										<li>
											<label for="mods_in_study">Modality</label><br>
											<input class="not-allowed" type="text" name="mods_in_study" id="mods_in_study" value="<?= $mods_in_study; ?>" readonly>
										</li>
										<li class="dokteravail">
											<label for="named">Nama Dokter Pengirim</label><br>
											<input type="text" name="named" id="named" value="<?= $named; ?>">
										</li>
										<li>
											<label for="contrast">Kontras</label><br>
											<div class="status">
												<label class="radio-admin">
													<input type="radio" <?= strtolower($contrast) == 'perlu kontras' ? 'checked' : ''; ?> name="contrast" id="contrast" value="Perlu Kontras"> Perlu Kontras
													<span class="checkmark"></span>
												</label>
												<label class="radio-admin">
													<input type="radio" <?= strtolower($contrast) == 'tidak perlu kontras' ? 'checked' : ''; ?> name="contrast" id="contrast" value="Tidak perlu kontras"> Tidak perlu contrast
													<span class="checkmark"></span>
												</label>
											</div>
										</li>
										<br>
										<li>
											<label for="radiographer_name">Nama Radiographer</label><br>
											<input type="text" name="radiographer_name" id="radiographer_name" value="<?= $radiographer_name; ?>">
										</li>
										<li>
											<label for="priority">Prioritas</label><br>
											<div class="status">
												<label class="radio-admin">
													<input type="radio" <?= strtolower($priority) == 'normal' ? 'checked' : ''; ?> name="priority" id="priority" value="normal"> Normal
													<span class="checkmark"></span>
												</label>
												<label class="radio-admin">
													<input type="radio" <?= strtolower($priority) == 'cito' ? 'checked' : ''; ?> name="priority" id="priority" value="cito"> Cito
													<span class="checkmark"></span>
												</label>
											</div>
										</li>
										<br>
										<li>
											<label for="dokrad_name">Nama Dokter Radiology</label><br>
											<input class="not-allowed" type="text" id="dokrad_name" value="<?= $dokrad_name; ?>" readonly>
										</li>
										<li>
											<label for="pat_state">Keadaan Pasien</label><br>
											<label class="radio-admin">
												<input type="radio" <?= strtolower($pat_state) == 'rawat jalan' ? 'checked' : ''; ?> name="pat_state" value="rawat jalan"> Rawat Jalan
												<span class="checkmark"></span>
											</label>
											<label class="radio-admin">
												<input type="radio" <?= strtolower($pat_state) == 'rawat inap' ? 'checked' : ''; ?> name="pat_state" value="rawat inap"> Rawat Inap
												<span class="checkmark"></span>
											</label>
										</li>
										<br>
										<li>
											<label for="payment">Pembayaran</label><br>
											<input type="text" name="payment" id="payment" value="<?= $payment; ?>">
										</li>
										<li>
											<label for="contrast_allergies">Alergi Kontras</label><br>
											<label class="radio-admin">
												<input type="radio" <?= strtolower($contrast_allergies) == 'alergi contrast' ? 'checked' : ''; ?> name="contrast_allergies" value="alergi contrast"> Alergi Kontras
												<span class="checkmark"></span>
											</label>
											<label class="radio-admin">
												<input type="radio" <?= strtolower($contrast_allergies) == 'tidak alergi contrast' ? 'checked' : ''; ?> name="contrast_allergies" value="tidak alergi contrast"> Tidak Alergi Kontras
												<span class="checkmark"></span>
											</label>
										</li>
										<br>
										<li>
											<label for="study">Study</label><br>
											<input type="text" class="not-allowed" name="study_desc" id="study_desc" value="<?= $study_desc; ?>" readonly>
										</li>
									</div>
									<div class="form-update-workload col-md-4">
										<li>
											<label for="film_small">Film Small</label><br>
											<input type="text" name="film_small" id="film_small" value="<?= $film_small; ?>">
										</li>
										<li>
											<label for="film_medium">Film Medium</label><br>
											<input type="text" name="film_medium" id="film_medium" value="<?= $film_medium; ?>">
										</li>
										<li>
											<label for="film_large">Film Large</label><br>
											<input type="text" name="film_large" id="film_large" value="<?= $film_large; ?>">
										</li>
										<li>
											<label for="film_reject_small">Film Reject Small</label><br>
											<input type="text" name="film_reject_small" id="film_reject_small" value="<?= $film_reject_small; ?>">
										</li>
										<li>
											<label for="film_reject_medium">Film Reject Medium </label><br>
											<input type="text" name="film_reject_medium" id="film_reject_medium" value="<?= $film_reject_medium; ?>">
										</li>
										<li>
											<label for="film_reject_large">Film Reject Large </label><br>
											<input type="text" name="film_reject_large" id="film_reject_large" value="<?= $film_reject_large; ?>">
										</li>
										<li>
											<label for="re_photo">Keterangan pengulangan foto</label><br>
											<textarea rows="4" cols="50" type="text" name="re_photo" id="re_photo" value="<?= $re_photo; ?>"><?= $re_photo; ?></textarea>
										</li>
										<li>
											<label for="kv">KV</label><br>
											<input type="text" name="kv" id="kv" value="<?= $kv; ?>">
										</li>
										<li>
											<label for="mas">mAs</label><br>
											<input type="text" name="mas" id="mas" value="<?= $mas; ?>">
										</li>
										<br>
										<li>
											<!-- <button class="btn buttonsearch2 waves-effect waves-light" type="submit" id="submit" name="submit">
												<div class="spinner-border text-primary" role="status">
													<span class="sr-only">Loading...</span>
												</div>
												Ubah Data
											</button> -->

											<button class="btn buttonsearch2 waves-effect waves-light" type="submit" id="submit" name="submit">
												<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
												<p class="loading" style="display:inline;">Loading...</p>
												<p class="ubah" style="display:inline;">Ubah Data</p>
											</button>
										</li>
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
		<script src="../js/proses/update-workload.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script>
			$(document).ready(function() {
				// class sidebar aktif
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='workload1']").addClass("active");

				// dokter pengirim
				$(".klik-dokter").hide();
				$(".btn-info").click(function() {
					// $(".dokteravail").hide();
					$(".dokteravail").show();
					$(".klik-dokter").hide();
				});

				// tanggal lahir
				$('#pat_birthdate').datetimepicker({
					timepicker: false,
					format: 'd-m-Y'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>