<?php
require 'function_radiology.php';
session_start();
// menampilkan data xray exam
@$uid = $_GET['uid'];
$username = $_SESSION['username'];
$query = "SELECT *
		FROM xray_exam2
		WHERE uid = '$uid'";
$data_dicom = mysqli_query($conn, $query);
// tutup menampilkan data xray exam
// menampilkan data xray template
$query_tampil = "SELECT MAX(template_id) as user_id3 FROM xray_template";
$result_tampil = mysqli_query($conn, $query_tampil);
$row_tampil = mysqli_fetch_assoc($result_tampil);
// tutup menampilkan data xray exam
if (isset($_POST['saveas'])) {
	// Insert TEXTAREA POSTINGAN DOKTER
	$pk = $row_tampil['user_id3'] + 1;
	$title = $_POST['title'];
	$fill = $_POST['fill'];
	$typemod = $_POST['typemod'];
	$level = $_POST['level'];
	$username = $_SESSION['username'];
	$query_insert = "INSERT INTO xray_template (template_id, title, fill, typemod, level, username) VALUES ('$pk', ' $title', ' $fill', ' $typemod', ' $level', '$username')";
	$result = mysqli_query($conn, $query_insert);
	// Tutup Insert TEXTAREA POSTINGAN DOKTER
}
// penutup insert TEXTAREA POSTINGAN DOKTER
if (isset($_POST["approve"])) {
	if (input_approve($_POST)) {
		echo "
<script>
	document.location.href= 'dicom.php';
	win = window.open('pdf/testpdf4.php?uid=$uid', '_blank');
	win.focus();
</script>
";
	} else {
		echo "
<script>
	alert('approve gagal');
	document.location.href= 'worklist.php?uid=$uid';
</script>";
	}
}
if (isset($_POST["savetemp"])) {
	if (input_temp($_POST)) {
		echo "
<script>
	alert('Report Telah Di Simpan ke template');
	document.location.href= 'worklist.php?uid=$uid';
</script>
";
	} else {
		echo "
<script>
	alert('Report Gagal Di Simpan ke template');
	document.location.href= 'worklist.php?uid=$uid';
</script>";
	}
}
if (isset($_POST["savedraft"])) {
	if (ubah_exam($_POST)) {
		echo "
<script>
	alert('Report Telah Di Simpan ke Draft');
	document.location.href= 'dicom.php';
</script>
";
	} else {
		echo "
<script>
	alert('Report Gagal Di Simpan ke Draft');
	document.location.href= 'worklist.php?uid=$uid';
</script>";
	}
}
if (isset($_POST["showpdf"])) {
	if (bgst($_POST)) {
		echo "
<script>
	window.open('pdf/testpdf.php?uid=$uid', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=800');
</script>";
		// header("location:http://192.168.2.114/intiwid/radiology/pdf/testpdf3.php?uid=$uid", "_blank");
	} else {
		echo "
<script>
	alert('Report Gagal Di Simpan ke Draft');
	document.location.href= 'pdf/testpdf.php';
</script>";
	}
}
if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Expertise | Radiology Physician</title>
		<script type="text/javascript" src="js/jquery1.10.2.js"></script>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">

				<div id="content1">
					<div class="container-fluid">
						<div class="row">

							<div class="col-12" style="padding-left: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item"><a href="dicom.php">Worklist</a></li>
										<li class="breadcrumb-item active">Expertise</li>
									</ol>
								</nav>
							</div>

							<div class="col-lg-2">
								<div class="div-left">
									<div class="left-top">
										<div style="width: 50%; padding: 3px;">
											<div class="work-order">
												<ul>
													<a class="button-work-order" href="#">
														<li class="li-work patient-work">History</li>
													</a>
												</ul>
											</div>
										</div>
										<div style="width: 50%; padding: 3px;">
											<div class="work-patient">
												<ul>
													<a class="button-work-patient" href="#">
														<li class="li-work patient-work">viewer</li>
													</a>
												</ul>
											</div>
										</div>

									</div>
									<?php
									$result = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE uid = '$uid'");
									$row = mysqli_fetch_assoc($result);
									$mrn = $row['mrn'];
									$dokterradiology = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username'");
									$row2 = mysqli_fetch_assoc($dokterradiology);
									$dokradid = $row2['dokradid'];
									$result1 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE mrn = '$mrn'");
									?>



									<!-- Modal -->
									<div class="modal fade" id="mobile-viewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Series Desc</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">

													<?php
													require '../koneksi/koneksi.php';
													require '../viewer-all.php';

													$query = "SELECT * FROM xray_series INNER JOIN xray_workload_radiographer ON xray_workload_radiographer.uid = xray_series.uid WHERE xray_series.uid = '$uid'";
													$value = mysqli_query($conn, $query);
													$row2 = mysqli_fetch_assoc($value);


													$query1 = "SELECT * FROM xray_series WHERE uid = '$uid'";
													$value1 = mysqli_query($conn, $query1);
													?>
													<style>
														.fill {
															padding: 50px;
														}
													</style>

													<div class="fill">
														<table class="table" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
															<thead class="thead1">
																<tr>
																	<th>Name :</th>
																	<th>MRN :</th>
																	<th>Sex :</th>
																	<th>Department :</th>
																	<th>Referral Physician :</th>
																</tr>
																<tr>
																	<td align="left"><?= $row2['name']; ?></td>
																	<td align="left"><?= $row2['mrn']; ?></td>
																	<td align="left"><?= $row2['sex']; ?></td>
																	<td align="left"><?= $row2['name_dep']; ?></td>
																	<td align="left"><?= $row2['named'] . ' ' . $row2['lastnamed']; ?></td>
																</tr>
															</thead>
														</table>
														</strong></h4>
														<center>
															<h4><strong><label>SERIES DESC </label>&nbsp;<label></label></strong></h4>
															<h4><strong>
														</center>
														<table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
															<thead class="thead1">
																<tr>
																	<th>viewer</th>
																	<th>series</th>
																	<th>#i</th>
																	<th>Create Time</th>
																</tr>


																<?php
																while ($row1 = mysqli_fetch_assoc($value1)) {

																?>
																	<tr>
																		<td align="left">
																			<?= MOBILEFIRST . $row1['series_iuid'] . MOBILELAST; ?>
																		</td>
																		<td align="left"><?= $row1['series_desc']; ?></td>
																		<td align="left"><?= $row1['num_instances']; ?></td>
																		<td align="left"><?= $row1['created_time']; ?></td>
																	</tr>

																<?php } ?>
															</thead>
														</table>
														</strong></h4>
														<br>
														<p>
													</div>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>




									<?php $row = mysqli_fetch_assoc($data_dicom);
									$birth_date = $row['birth_date'];
									$uid5 = $row['uid'];
									$query2 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
									$row2 = mysqli_fetch_assoc($query2);
									$body_part_series = $row2['body_part'];
									$prosedur = $row['prosedur'];
									if ($prosedur == '') {
										$prosedur1 = $body_part_series;
									} else {
										$prosedur1 = $prosedur;
									}
									$bday = new DateTime($birth_date);
									$today = new DateTime(date('y-m-d'));
									$diff = $today->diff($bday);
									$uid2 = $row['uid'];
									$dokradid = $row['dokradid'];
									?>
									<div class="info-patient">
										<div class="info-patient2">
											<div class="row justify-content-center">
												<div class="info-left col-sm-12">
													<?php if (isset($_GET['uid'])) { ?>
														<table class="infopatientworklist table-left" border="0">
															<tr>
																<td><span class="table-left">Name</span></td>

															</tr>
															<tr>
																<td><?php echo $row['name'] . ' ' . $row['lastname']; ?></td>

															</tr>
															<tr>
																<td><span class="table-left">MRN</span></td>
															</tr>
															<tr>
																<td><?php echo $row['mrn']; ?></td>

															</tr>
															<tr>
																<td><span class="table-left">Sex</span></td>
															</tr>
															<tr>
																<td><?php echo $row['sex']; ?></td>

															</tr>
															<tr>
																<td><span class="table-left">Age</span></td>
															</tr>
															<tr>
																<td><?php echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>

															</tr>
															<tr>
																<td><span class="table-left">Special Needs</span></td>
															</tr>
															<tr>
																<td>
																	<?php
																	$text = "";
																	if ($row['spc_needs'] == "" or $row['spc_needs'] == NULL) {
																		$text = "-";
																	} else {
																		$text = $row['spc_needs'];
																	}
																	echo $text;
																	?>
																</td>

															</tr>

															<tr>
																<td><span class="table-left">Procedure</span></td>
															</tr>
															<tr>
																<td><?php echo $prosedur1; ?></td>

															</tr>
															<tr>
																<?php
																$schedule_date = $row['schedule_date'];
																$sd = date("d F Y", strtotime($schedule_date)) ?>
																<td><span class="table-left">Schedule Date</span></td>
															</tr>
															<tr>
																<td><?php echo $sd; ?></td>

															</tr>
															<tr>
																<td><span class="table-left">Department</span></td>
															</tr>
															<tr>
																<td>
																	<?php
																	$text = "";
																	if ($row['name_dep'] == "" or $row['name_dep'] == NULL) {
																		$text = "-";
																	} else {
																		$text = $row['name_dep'];
																	}
																	echo $text;
																	?>
																</td>
															</tr>
															<tr>
																<td><span class="table-left">Refferal Physician</span></td>
															</tr>
															<tr>
																<td>
																	<?php
																	$text = "";
																	if ($row['named'] == "" or $row['named'] == NULL) {
																		$text = "-";
																	} else {
																		$text = $row['named'];
																	}
																	echo $text;
																	?>
																</td>
															</tr>
														<?php } else {
														echo "404 Not Found";
													} ?>
														</table>

												</div>

											</div>

										</div>

									</div>

									<div class="data-order">
										<b class="title-history">History Patient</b><br>
										<?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
											<table>
												<tr>
													<td>MRN</td>
													<td>&nbsp;:&nbsp;</td>
													<td><b><?= $row1['mrn']; ?></b></td>
												</tr>
												<tr>
													<td>Name</td>
													<td>&nbsp;:&nbsp;</td>
													<td><b><?= $row1['name'] . '' . $row1['lastname']  ?></b></td>
												</tr>
												<p><strong style="color: #a4a4a4;"><?= $row1['complete_date']; ?>&nbsp;/&nbsp;<?= $row1['complete_time']; ?></strong></p>
												<p></p>
												<p><?= $row1['prosedur']; ?> :
													<!-- <a style="text-decoration:none;" class="" href="pdf/testpdf4.php?uid=<?= $row1['uid']; ?>" target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/pdf.svg" data-toggle="tooltip" title="PDF" style="width: 100%;"></span></a>
													<a href="<?php echo "radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22$uid%22" ?>" class="button8 delete1"><img src="../image/radiAnt.png" style="width: 29px;"></a>
													<a style="text-decoration:none;" href="<?php echo "radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22" . $row1['uid'] . "%22"; ?>"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eye22.svg" data-toggle="tooltip" title="Dicom Viewer" style="width: 100%;"></span></a>
													<a style="text-decoration:none;" class="ahref-edit" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>:82/viewer/" target="_blank"> <span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eye11.svg" data-toggle="tooltip" title="Web Viewer" style="width: 100%;"></span></a> -->
												<?php 
													echo PDFFIRST . $row1['uid'] . PDFLAST .
													RADIANTFIRST . $row1['uid'] . RADIANTLAST .
													DICOMFIRST . $row1['uid'] . DICOMLAST .
													// OHIFMOBILEFIRST . $row1['uid'] . OHIFMOBILELAST .
													OHIFFIRST . $row1['uid'] . OHIFLAST .
													HTMLFIRST . $row1['uid'] . HTMLLAST;
												?>
												</p>
											</table>
											<hr>
										<?php } ?>

									</div>
									<div class="data-patient">
										<?php
										$query123 = "SELECT *
										FROM xray_exam2
										WHERE uid = '$uid'";
										$data_dicom123 = mysqli_query($conn, $query123);
										$row1 = mysqli_fetch_assoc($data_dicom123);
										$xray_type_code1 = $row1['xray_type_code'];

										$result = mysqli_query($conn, "SELECT *
																	FROM xray_modalitas
																	WHERE xray_type_code = '$xray_type_code1' ");
										$row = mysqli_fetch_assoc($result);
										?>

										<div class="content2-adm li-adm">
											<h4 style="margin: 0px;">Intiwid Viewer</h4>
											<hr style="margin: 10px 0px;">

											<div class="buttons1">
												<a href="<?php echo "radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22$uid%22" ?>" class="button8 delete1"><img src="../image/radiAnt.png" style="width: 50px;"><br> <span> Dicom Viewer</span></a><?php if ($_SERVER['SERVER_NAME'] == '103.111.207.70') { ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>:82/viewer?StudyInstanceUIDs=<?php echo $uid; ?>" class="button8 delete1" target="_blank"><img src="../image/web.svg" style="width: 50px;"> <br><span> Mobile Viewer</span></a><?php } else { ?><a target="_blank" href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>:82/viewer?StudyInstanceUIDs=<?php echo $uid; ?>" class="button8 delete1"><img src="../image/web.svg" style="width: 50px;"> <br><span> Mobile Viewer</span></a>
												<?php } ?>


												<?php if ($_SERVER['SERVER_NAME'] == '103.111.207.70') { ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . ":92/viewer/" . $uid ?> " class="button8 delete1" target="_blank"><img src="../image/web2.svg" style="width: 50px;"><br> <span> WEB Viewer</span></a><?php } else { ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . ":5000/viewer/" . $uid ?> " class="button8 delete1" target="_blank"><img src="../image/web2.svg" style="width: 50px;"><br><span> WEB Viewer</span></a><?php } ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>:19898/intiwid/viewer.html?studyUID=<?php echo $uid; ?>" class="button8 delete1" target="_blank"><img src="../image/html.svg" style="width: 50px;"><br> <span> HTML Viewer</span></a>


											</div>

										</div>
									</div>

									<form action="" method="post">
										<div class="tambahan1">
											<label for="patienttype">
												<h5 style="margin-top: 0px; margin-bottom:-6px; font-weight:bold;"><?= $lang['information'] ?></h5>
											</label><br>
											<label class="radio-admin">
												<input type="radio" checked name="patienttype" value="normal" required> Normal
												<span class="checkmark"></span>
											</label><br>
											<label class="radio-admin">
												<input type="radio" name="patienttype" value="kritis" required> <?= $lang['critical'] ?>
												<span class="checkmark"></span>
											</label>
										</div>


								</div>
								<br>
							</div>


							<div class="col-lg-7 padding-rl-less">
								<div class="div-mid">


									<div class="work-patient6">

										<input type="hidden" name="uid" value="<?= $uid5; ?>">
										<input type="hidden" name="username" value="<?= $username; ?>">

										<?php
										@$template_id = $_GET['template_id'];
										$query3 = "SELECT *
													FROM xray_exam2
													WHERE uid = '$uid'
															";
										$result3 = mysqli_query($conn, $query3);
										$row3 = mysqli_fetch_assoc($result3);
										$query = "SELECT *
															FROM xray_template
															WHERE template_id = '$template_id'
															";
										$result = mysqli_query($conn, $query);
										$row10 = mysqli_fetch_assoc($result);
										if ($template_id == "") {
											$fill = $row3['fill'];
										} else {
											$fill = $row10['fill'];
										}
										?>

										<br>
										<div class="textarea-ckeditor">
											<textarea class="ckeditor" name="fill" style="width: 100%; height: 320px;" id="ckeditor">
														<?= $fill; ?>
														</textarea>
										</div>
										<?php if ($username == "demo2") { ?>
											<button class="btn btn-worklist btn-expertise button-popup-approve" name="approve" disabled><i class="fas fa-check-square"></i> Approve</button>
											<div class="kotak">
											<?php } else { ?>
												<button class="btn btn-worklist btn-expertise button-popup-approve" name="approve"><i class="fas fa-check-square"></i> Approve</button>
												<div class="kotak">
												<?php } ?>
												<!---POP UP -->
												<div class="container">
													<!-- Button to Open the Modal -->
													<button class="btn btn-worklist1 btn-expertise button-popup" type="button" data-toggle="modal" data-target="#myModal2"><i class="fas fa-file-export"></i> Save Template
													</button>
													<!-- Modal -->
													<div class="modal fade" id="myModal2" role="dialog">
														<div class="modal-dialog">

															<!-- Modal content-->
															<div class="modal-content">
																<!-- Modal Header -->
																<div class="modal-header">
																	<h4 class="modal-title">Insert Tittle</h4><br />
																	<input class="form-control" type="text" name="title" value="" placeholder="Insert Tittle">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>

																<!-- Modal body -->
																<!-- <div class="modal-body">
																			<textarea style="width: 100%;" class="textarea-worklist" id="ckeditor" name="fill"></textarea>
																	</div> -->

																<!-- Modal footer -->
																<div class="modal-footer">
																	<button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
																	<button style="border-radius: 5px; font-weight: bold; margin-bottom:4px;" class=" btn btn-success" name="savetemp">Save</button>
																</div>

															</div>

														</div>
													</div>
												</div>
												<!-- END OF POP UP -->

												<div class="btn-bar-1">
													<?php if ($username == "demo2") { ?>
														<button class="btn btn-worklist3 btn-expertise" name="savedraft" onclick="return confirm('Are you sure save draft?');" disabled><i class="fas fa-save"></i> Save Draft</button>
													<?php } else { ?>
														<button class="btn btn-worklist3 btn-expertise" name="savedraft" onclick="return confirm('Are you sure save draft?');"><i class="fas fa-save"></i> Save Draft</button>

													<?php } ?>

												</div>
												</form>
												</div>
											</div>
									</div>

								</div>
								<!-- </div> -->

								<div class="col-lg-3">
									<div class="div-right">
										<div class="">
											<input type="text" class="form-control" placeholder="search by tittle.. " id="myInput" style="margin: 9px 0px; width: 100%;">
										</div>
										<!-- ------template dokter button--------- -->
										<a href="test-table.php?uid=<?= $uid; ?>">
											<div class="template-save1">
												Template Name
											</div>
										</a>
										<!-- ------template dokter button--------- -->
										<!-- -------------------------------------------------------------------------- -->
										<!-- Central Modal-->
										<div class="modal fade" id="template-expertise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<!-- Change class .modal-sm to change the size of the modal -->
											<div style="margin: 10px 10px;" class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title w-100" id="myModalLabel">Template Expertise</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body" style="overflow-x: scroll; font-size: 15px;">
														HALOOOO
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

													</div>
												</div>
											</div>
										</div>
										<!-- Central Modal-->

										<!-- -------------------------------------------------------------------------- -->
										<?php if ($username != 'drwawan') { ?>
											<div class="template-save" id="container-template">
												<!-- <div id="content"></div> -->
												<table border="1" id="mytemplate" class="type-choice mytemplate" style="width: 100%;">
													<?php
													$username = $_SESSION['username'];
													$result = mysqli_query($conn, "SELECT * FROM xray_template WHERE username = '$username'");



													while ($row1 = mysqli_fetch_assoc($result)) { ?>
														<thead class="myTable">
															<td class="td1">
																<a href="worklist.php?uid=<?= $uid; ?>&template_id=<?= $row1['template_id']; ?>"><?= $row1['title']; ?></a>

															</td>
															<td style="text-align: center;">
																<a href="#" class="edit-recordworklist" data-id="<?= $row1['template_id'];  ?>">
																	<i data-toggle="tooltip" title="View Template" class="fas fa-eye fa-lg"></i>
																</a>

															</td>
															<td style="text-align: center;">
																<a href="hapustemplate.php?uid=<?= $uid; ?>&amp;template_id=<?= $row1['template_id']; ?>" data-id="<?= $row1['template_id'];  ?>" onclick="return confirm('Teruskan Menghapus Data?');">
																	<i data-toggle="tooltip" title="Delete Template" class="fas fa-trash fa-lg"></i>
																</a>
															</td>
													<?php }
												} ?>
														</thead>
												</table>
											</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModal5" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Report</h4>
								</div>
								<div class="modal-body">
									<textarea style="width: 100%; height: 320px;"><?= $row10['template_id'];  ?></textarea>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
					<!-- Modal -->



				</div>
			</div>

			<div class="footerindex">
				<div class="">
					<?php include('footer-itw.php'); ?>
				</div>
			</div>
			<!-- SCRIPT -->
			<?php include('script-footer.php'); ?>
			<script>
				$(document).ready(function() {
					$("li[id='worklist1']").addClass("active");
				});
			</script>
			<script>
				// untuk menampilkan data popup
				$(function() {
					$(document).on('click', '.edit-recordworklist', function(e) {
						e.preventDefault();
						$("#myModal5").modal('show');
						$.post('hasil.php', {
								template_id: $(this).attr('data-id')
							},
							function(html) {
								$(".modal-body").html(html);
							}
						);
					});
				});
				// end untuk menampilkan data popup
			</script>
			<script>
				CKEDITOR.replace('ckeditor', {
					// Pressing Enter will create a new <BR> element.
					enterMode: CKEDITOR.ENTER_BR,
					// Pressing Shift+Enter will create a new <BR> element.
					// shiftEnterMode: CKEDITOR.ENTER_BR
				});
			</script>

			<script>
				var app = angular.module('myApp', []);
				app.controller('myCtrl', function($scope) {
					$scope.textarea_template = "";
				});
			</script>
			<!--- SCRIPT AUTO SAVE TEXTAREA FILL-->
			<!-- <script type="text/javascript">
					$(document).ready(function(){
			autosave();
		});
		function autosave()
		{
			var t = setTimeout("autosave()", 2000); // Jalankan fungsi autosave setiap 20 detik sekali
							
			var fill = $("#txt_fill").val();
				
			if (fill.length > 0)
			{
				$.ajax(
				{
					type: "POST",
					url: "autosave.php",
					data: "&fill=" + fill,
					cache: false,
				});
			}
		}
		</script>	 -->
			<!--- PENUTUP SCRIPT AUTO SAVE TEXTAREA FILL-->
			<!--  SCRIPT AJAX CRUD   -->
			<script type="text/javascript">
				$(document).ready(function() {
					loadData();
					$('form69').on('submit37', function(e) {
						e.preventDefault();
						$.ajax({
							type: $(this).attr('method'),
							url: $(this).attr('action'),
							data: $(this).serialize(),
							success: function() {
								loadData();
								resetForm();
							}
						});
					})
				})

				function loadData() {
					$.get('data.php', function(data) {
						$('#content').html(data);
						$('.hapusData').click(function(e) {
							e.preventDefault();
							$.ajax({
								type: 'get',
								url: $(this).attr('href'),
								success: function() {
									loadData();
								}
							});
						});
						$('.updateData').click(function(e) {
							e.preventDefault();
							$('.ckeditor').val($(this).attr('fill'));
							$('form').attr('action', $(this).attr('href'));
						});
					})
				}

				function resetForm() {
					$('[textarea]').val();
					$('[name=fill]').focus();
				}
			</script>
			<script>
				// function myFunction() {
				//   var x = document.getElementById("myInput").value;
				//   document.getElementById("demo").innerHTML = "You wrote: " + x;
				// }
				function myFunction1() {
					window.open("pdf/testpdf.php?uid=<?php echo $row['uid']; ?> ", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=800");
				}

				function myFunction3() {
					window.open("pdf/testpdf.php?uid=<?php echo $row['uid']; ?> ", 'popup', 'width=600,height=600');
					return false;
				}
			</script>
			<!-- -------------------javascript select template-------------- -->
			<script>
				$(document).ready(function() {
					$(".type-choice").show();
				});
				$(function() {
					$('#selector1').change(function() {
						$('.type-choice').hide();
						$('#' + $(this).val()).show();
					});
				});
			</script>
			<!-- --------------------------script search liv end------------------------ -->
			<!-- -------------------javascript select temlate-------------- -->
			<script>
				$(document).ready(function() {
					$(".data-order").hide();
					$(".work-patient").css("background", "#68b399");
					$(".work-order").css("background", "#f1f1f1");
					$(".work-patient a").css("color", "#fff");
					$(".work-order a").css("color", "#68b399");
					$(".button-work-order").click(function() {
						$(".work-order").css("background", "#68b399");
						$(".work-patient").css("background", "#f1f1f1");
						$(".work-order a").css("color", "#fff");
						$(".work-patient a").css("color", "#68b399");
						$(".data-order").show();
						$(".data-patient").hide();
					});
				});
				$(document).ready(function() {

					$(".button-work-patient").click(function() {
						$(".work-patient").css("background", "#68b399");
						$(".work-order").css("background", "#f1f1f1");
						$(".work-patient a").css("color", "#fff");
						$(".work-order a").css("color", "#68b399");
						$(".data-patient").show();
						$(".data-order").hide();
					});
				});
			</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>
<!-- ------------------------script----------------------- -->




<script>
	$(document).ready(function() {
		$(".dokteravail").toggle();
		$(".btn-info").click(function() {
			$(".dokteravail").hide();
		});
	});
</script>

//backup radiant
<!-- <a href="<?php echo "radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22" . $uid . "%22" ?> " class="button8 delete1"><img src="../image/radiAnt.png" style="width: 50px;"><br> <span> Radiant Viewer</span></a> -->