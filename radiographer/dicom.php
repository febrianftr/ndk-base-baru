<?php
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];
$data_dicom2 = mysqli_query($conn, "SELECT *
								   FROM xray_exam2 
								   order by pk DESC");
// -----------------pacsio------------------
// $data_dicom3 = mysqli_query($conn_pacs,"SELECT
// study.patient_fk,
// patient.pk,
// series.study_fk,
// patient.merge_fk,
// patient.pat_id,
// patient.pat_id_issuer,
// patient.pat_name,
// patient.pat_fn_sx,
// patient.pat_gn_sx,
// patient.pat_i_name,
// patient.pat_p_name,
// patient.pat_birthdate,
// patient.pat_sex,
// patient.pat_custom1,
// patient.pat_custom2,
// patient.pat_custom3,
// patient.created_time,
// patient.pat_attrs,
// study.pk,
// study.accno_issuer_fk,
// study.study_iuid,
// study.study_id,
// study.study_datetime,
// study.accession_no,
// study.ref_physician,
// study.ref_phys_fn_sx,
// study.ref_phys_gn_sx,
// study.ref_phys_i_name,
// study.ref_phys_p_name,
// study.study_desc,
// study.study_custom1,
// study.study_custom2,
// study.study_custom3,
// study.study_status_id,
// study.mods_in_study,
// study.cuids_in_study,
// study.num_series,
// study.num_instances,
// study.ext_retr_aet,
// study.retrieve_aets,
// study.fileset_iuid,
// study.fileset_id,
// study.availability,
// study.study_status,
// study.checked_time,
// study.updated_time,
// study.created_time,
// study.study_attrs,
// study.chargeId,
// study.totalCharge,
// study.billId,
// study.invoiceNo,
// study.batchNo,
// study.img,
// study.fill,
// study.del,
// series.pk,
// series.mpps_fk,
// series.inst_code_fk,
// series.series_iuid,
// series.series_no,
// series.modality,
// series.body_part,
// series.laterality,
// series.series_desc,
// series.institution,
// series.station_name,
// series.department,
// series.perf_physician,
// series.perf_phys_fn_sx,
// series.perf_phys_gn_sx,
// series.perf_phys_i_name,
// series.perf_phys_p_name,
// series.pps_start,
// series.pps_iuid,
// series.series_custom1,
// series.series_custom2,
// series.series_custom3,
// series.num_instances,
// series.src_aet,
// series.ext_retr_aet,
// series.retrieve_aets,
// series.fileset_iuid,
// series.fileset_id,
// series.availability,
// series.series_status,
// series.created_time,
// series.series_attrs,
// series.content_time
// FROM
// patient
// INNER JOIN study ON study.patient_fk = patient.pk
// INNER JOIN series ON series.study_fk = study.pk GROUP BY study_iuid ORDER BY study.pk DESC 
// 									   ");


if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Worklist | Radiographer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page">Physician Worklist</li>
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
					<center>
						<h1 style="color: #EE7423"><?= $lang['your_worklist'] ?></h1>
					</center>
					<div class="container-fluid">
						<div class="table-view col-md-12 table-box" style="overflow-x:auto;">
							<table class="table-dicom" id="example" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
								<thead class="thead1">
									<tr>
										<th>NO</th>
										<th>MRN/ACC</th>
										<!-- <th>Radiology Physician</th> -->
										<th><?= $lang['name'] ?></th>
										<th><?= $lang['age'] ?></th>
										<th><?= $lang['sex'] ?></th>
										<th><?= $lang['modality'] ?></th>
										<th><?= $lang['procedure'] ?></th>
										<th><?= $lang['referral_physician'] ?></th>
										<th><?= $lang['name_radiographer'] ?></th>
										<th><?= $lang['departmen'] ?></th>
										<th>Status</th>
										<th><?= $lang['arrive_date'] ?></th>
										<th><?= $lang['exam_date'] ?></th>
										<th>PDC</th>
										<th><?= $lang['spc_needs'] ?></th>
										<th><?= $lang['action'] ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row1 = mysqli_fetch_assoc($data_dicom2)) : ?>
										<?php $priority = $row1['priority']; ?>
										<?php $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);
										$birth_date = $row1['birth_date'];
										$bday = new DateTime($birth_date);
										$today = new DateTime(date('y-m-d'));
										$diff = $today->diff($bday);
										$sex = $row1['sex'];
										$uid = $row1['uid'];

										$maruf = $row1['study_datetime'];
										$sandi = new DateTime($maruf);
										$jkw = $sandi->format('d F Y');
										$prbw = $sandi->format('H:i:s');
										$arrive_date = $row1["arrive_date"];
										$arrive_date1 = str_replace("0000-00-00", " ", $arrive_date);
										$arrive_time = $row1["arrive_time"];
										$arrive_time1 = str_replace("00:00:00", " ", $arrive_time);
										$study_datetime = $row1['study_datetime'];
										$study_datetime1 = date("d-m-Y H:i", strtotime($study_datetime));
										$updated_time = $row1['updated_time'];
										$updated_time1 = date("d-m-Y H:i", strtotime($updated_time));
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row1['mrn']; ?></td>
											<!-- <td><?php echo $row1['dokrad_name'] . ' ' . $row1['dokrad_lastname']; ?></td> -->
											<td><?php echo $row1['name'] . ' ' . $row1['lastname']; ?></td>
											<td><?php echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>
											<td style="padding: 0px 10px;">
												<?php if ($sex == 'M') { ?>
													<!-- kalo cowo- -->
													<i style="color: blue;" class="fas fa-mars"></i> M
												<?php } else if ($sex == 'F') { ?>
													<!-- kalo cewek -->
													<i style="color: #ff637e;" class="fas fa-venus"></i> F
												<?php } else if ($sex == 'O') { ?>
													<!-- other -->
													<i class="fas fa-genderless"></i> O
												<?php } ?>
											</td>
											<td><?php echo $row1['xray_type_code']; ?></td>
											<td><?php echo $row1['prosedur']; ?></td>
											<td><?php echo $row1['named'] . ' ' . $row1['lastnamed']; ?></td>
											<td><?php echo $row1['radiographer_name'] . ' ' . $row1['radiographer_lastname']; ?></td>
											<td><?php echo $row1['name_dep']; ?></td>
											<td style="text-align: left;">
												<?php if ($text == 'Low') { ?>
													<!-- kalo cowo- -->
													<i style="color: #2d2;" class="fas fa-circle"></i> Low
												<?php } else if ($text == 'Medium') { ?>
													<!-- kalo cewek -->
													<i style="color: yellow;" class="fas fa-circle"></i> Medium
												<?php } else if ($text == 'high') { ?>
													<!-- other -->
													<i style="color: #fb9246;" class="fas fa-circle"></i> High
												<?php } else if ($text == 'Critical') { ?>
													<!-- other -->
													<i style="color: red;" class="fas fa-circle"></i> Critical
												<?php } ?>
											</td>
											<td><?php echo $arrive_date1; ?></td>
											<td><?php echo $study_datetime1; ?></td>
											<td><?php echo $updated_time1; ?></td>
											<td><?php echo $row1['spc_needs']; ?></td>
											<td>
												<?php include '../viewer-dicom.php'; ?>
												<?php include '../viewer-ohif.php'; ?>
												<?php include '../viewer-html.php'; ?>
												<a style="text-decoration:none;" href="deleteworklist.php?uid=<?php echo $row1['uid']; ?>" onclick="return confirm('Delete data?');">
													<!-- <img data-toggle="tooltip" title="Delete" src="../image/delete.png" style="width: 25px;"> --><button class="btn ahref-edit btn-danger btn-inti3"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></button>
												</a>
											</td>
										</tr>
										<?php $i++; ?>
									<?php endwhile; ?>

									<!-- pacsio -->

								</tbody>
							</table>
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

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>