<?php
require 'function_radiology.php';
session_start();
// menampilkan data xray exam
@$uid = $_GET['uid'];
$username = $_SESSION['username'];
$query = "SELECT *
		FROM xray_workload
		WHERE uid = '$uid' ORDER BY schedule_time";
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
// if(isset($_SESSION["username"]))
//       {
//            if((time() - $_SESSION['last_login_timestamp']) > 60) //  60 = 1 * 60
//            {
//                 header("location:logout.php");
//            }
//            else
//            {
//                 $_SESSION['last_login_timestamp'] = time();
//            }
//       }
//       else
//       {
//            header('location:../index.php');
//       }

if (isset($_POST["savetemp"])) {
	if (savetempworkload($_POST)) {
		echo "
<script>
	alert('Report Telah Di Simpan ke template');
	document.location.href= 'workload-edit.php?uid=$uid';
</script>
";
	} else {
		echo "
<script>
	alert('Report Gagal Di Simpan ke template');
	document.location.href= 'workload-edit.php?uid=$uid';
</script>";
	}
}
if (isset($_POST["savedraft"])) {
	if (savedraftworkload($_POST)) {
		echo "
<script>
	document.location.href= 'workload.php';
	win = window.open('pdf/testpdf4.php?uid=$uid', '_blank');
	win.focus();
</script>
";
	} else {
		echo "
<script>
	alert('Report Gagal Di Simpan ke Draft');
	document.location.href= 'workload-edit.php?uid=$uid';
</script>";
	}
}
// if( isset($_POST["showpdf"]) ) {
// if ( bgst($_POST)){
// echo "
// <script>
// 	window.open('pdf/testpdf.php?uid=$uid', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=800');
// </script>";
// // header("location:http://192.168.2.91/project3/radiology/pdf/testpdf3.php?uid=$uid", "_blank");
// }else {
// echo "
// <script>
// 	alert('Report Gagal Di Simpan ke Draft');
// 	document.location.href= 'pdf/testpdf.php';
// </script>";
// }
// }
if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Edit Expertise | Radiology</title>
		<script type="text/javascript" src="js/jquery1.10.2.js"></script>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">

				<div id="content1">
					<div class="container-fluid">
						<div class="col-12" style="padding-left: 0;">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item"><a href="workload.php">Workload</a></li>
									<li class="breadcrumb-item active">Edit Expertise</li>
								</ol>
							</nav>
						</div>
						<div class="row">
							<div class="col-md-2 padding-rl-less-media">
								<div class="div-left">
									<div class="left-top">
										<div style="width: 50%; padding: 3px;">
											<div class="work-order">
												<ul>
													<a class="button-work-order" href="#">
														<li class="li-work patient-work"> History</li>
													</a>
												</ul>
											</div>
										</div>
										<div style="width: 50%; padding: 3px;">
											<div class="work-patient">
												<ul>
													<a class="button-work-patient" href="#">
														<li class="li-work patient-work"> viewer</li>
													</a>
												</ul>
											</div>
										</div>
									</div>

									<?php
									// $result = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE uid = '$uid'");
									// $row = mysqli_fetch_assoc($result);
									// $mrn = $row['mrn'];
									// $dokterradiology = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username'");
									// $row2 = mysqli_fetch_assoc($dokterradiology);
									// $dokradid = $row2['dokradid'];
									// $result1 = mysqli_query($conn, "SELECT * FROM xray_workload WHERE mrn = '$mrn'");
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




									<?php
									$result = mysqli_query($conn, "SELECT * FROM xray_workload WHERE uid = '$uid'");
									$row = mysqli_fetch_assoc($result);
									$mrn = $row['mrn'];
									$result1 = mysqli_query($conn, "SELECT * FROM xray_workload WHERE mrn = '$mrn' AND uid <> '$uid'");
									?>
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
											</table>
											<p><strong style="color: #a4a4a4;"><?= $row1['complete_date']; ?>&nbsp;/&nbsp;<?= $row1['complete_time']; ?></strong></p>
											<p></p>
											<p><strong><?= $row1['prosedur']; ?></strong> : <br>
												<?= HTMLFIRST . $row1['uid'] . HTMLLAST; ?>
												<span>
													<a style="text-decoration:none;" href="<?php echo "jnlp://" . $_SERVER['SERVER_NAME']; ?>:19898/weasis-pacs-connector/DCM_viewer.jnlp?studyUID=<?php echo $row1['uid']; ?>"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eye22.png" data-toggle="tooltip" title="Dicom Viewer" style="width: 100%;"></span></a></span>
												<a style="text-decoration:none;" class="" href="pdf/testpdf4.php?uid=<?= $row1['uid']; ?>" target="_blank">
													<span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/file.png" data-toggle="tooltip" title="PDF" style="width: 100%;"></span>
												</a>
											</p>

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
											<h3 style="margin: 0px;">Intiwid Viewer</h3>
											<hr style="margin: 10px 0px;">

											<div class="buttons1">
												<a href="<?php echo "radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22$uid%22" ?>" class="button8 delete1"><img src="../image/radiAnt.png" style="width: 50px;"><br> <span> Dicom Viewer</span></a><?php if ($_SERVER['SERVER_NAME'] == '103.111.207.70') { ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>:82/viewer?StudyInstanceUIDs=<?php echo $uid; ?>" class="button8 delete1" target="_blank"><img src="../image/web.svg" style="width: 50px;"> <br><span> Mobile Viewer</span></a><?php } else { ?><a target="_blank" href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>:81/viewer?StudyInstanceUIDs=<?php echo $uid; ?>" class="button8 delete1"><img src="../image/web.svg" style="width: 50px;"> <br><span> Mobile Viewer</span></a>
												<?php } ?>


												<?php if ($_SERVER['SERVER_NAME'] == '103.111.207.70') { ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . ":92/viewer/" . $uid ?> " class="button8 delete1" target="_blank"><img src="../image/web2.svg" style="width: 50px;"><br> <span> WEB Viewer</span></a><?php } else { ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . ":91/viewer/" . $uid ?> " class="button8 delete1" target="_blank"><img src="../image/web2.svg" style="width: 50px;"><br><span> WEB Viewer</span></a><?php } ?><a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>:19898/intiwid/viewer.html?studyUID=<?php echo $uid; ?>" class="button8 delete1" target="_blank"><img src="../image/html.svg" style="width: 50px;"><br> <span> HTML Viewer</span></a>


											</div>

										</div>
									</div>

									<?php $row = mysqli_fetch_assoc($data_dicom);
									$birth_date = $row['birth_date'];
									$bday = new DateTime($birth_date);
									$today = new DateTime(date('y-m-d'));
									$diff = $today->diff($bday);
									$name = $row['name'];
									$name1 = str_replace('^', ' ', $name);
									$radiographer_name = $row['radiographer_name'];
									$radiographer_name1 = str_replace('^', ' ', $radiographer_name);
									$dokradid = $row['dokradid'];
									$uid2 = $row['uid'];
									?>
									<div class="info-patient">
										<div class="info-patient2">
											<div class="row justify-content-center">
												<div class="info-left col-sm-12">
													<?php if (isset($_GET['uid'])) { ?>
														<table class="infopatientworklist" border="0">
															<tr>
																<td><b>Name</b></td>

															</tr>
															<tr>
																<td><?php echo $row['name'] . ' ' . $row['lastname']; ?></td>

															</tr>
															<tr>
																<td><b>MRN</b></td>
															</tr>
															<tr>
																<td><?php echo $row['mrn']; ?></td>

															</tr>
															<tr>
																<td><b>Sex</b></td>
															</tr>
															<tr>
																<td><?php echo $row['sex']; ?></td>

															</tr>
															<tr>
																<td><b>Age</b></td>
															</tr>
															<tr>
																<td><?php echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>

															</tr>
															<tr>
																<td><b>Special Needs</b></td>
															</tr>
															<tr>
																<td><?php
																	$text = "";
																	if ($row['spc_needs'] == "" or $row['spc_needs'] == NULL) {
																		$text = "-";
																	} else {
																		$text = $row['spc_needs'];
																	}
																	echo $text;
																	?></td>

															</tr>

															<tr>
																<td><b>Procedure</b></td>
															</tr>
															<tr>
																<td><?php echo $row['prosedur']; ?></td>

															</tr>
															<tr>
																<?php
																$schedule_date = $row['schedule_date'];
																$sd = date("d F Y", strtotime($schedule_date)) ?>
																<td><b>Schedule Date</b></td>
															</tr>
															<tr>
																<td><?php echo $sd; ?></td>

															</tr>
															<tr>
																<td><b>Department</b></td>
															</tr>
															<tr>
																<td><?php echo $row['name_dep']; ?></td>

															</tr>
															<tr>
																<td><b>Refferal Physician</b></td>
															</tr>
															<tr>
																<td><?php echo $row['named'] . ' ' . $row['lastnamed']; ?></td>

															</tr>
														<?php } else {
														echo "404 Not Found";
													} ?>
														</table>
												</div>
											</div>
										</div>

									</div>

									<form action="" method="post">
										<div class="tambahan1">
											<label for="patienttype">
												<h5 style="margin-top: 0px; margin-bottom:-6px; font-weight:bold;"><?= $lang['information'] ?></h5>
											</label><br>
											<label class="radio-admin">
												<?php
												$kritis = "kritis";
												if ($row['patienttype'] == "kritis") {
													echo $kritis;
												} ?>
												<input type="radio" checked name="patienttype" value="normal" required> Normal
												<span class="checkmark"></span>
											</label><br>
											<label class="radio-admin">
												<?php
												$kritis = "kritis";
												if ($row['patienttype'] == "kritis") {
													echo $kritis;
												} ?>
												<input type="radio" name="patienttype" value="<?php $kritis ?>" required> Kritis
												<span class="checkmark"></span>
											</label>
										</div>

								</div>
							</div>

							<div class="col-md-7 padding-rl-less">
								<div class="div-mid" style="padding-top:10px;">
									<div class="kotak">
										<div class="work-patient6">
											<input type="hidden" name="uid" value="<?= $row['uid']; ?>">
											<div ng-app="myApp" ng-controller="myCtrl">
												<?php
												@$template_id = $_GET['template_id'];
												$query = "SELECT * 
											  FROM xray_template 
											  WHERE template_id = '$template_id'
											  ";
												$result = mysqli_query($conn, $query);
												$row10 = mysqli_fetch_assoc($result);

												if ($template_id == "") {
													$fill = $row['fill'];
												} else {
													$fill = $row10['fill'];
												}
												?>
												<h3 class="h3-template"></h3>
												<div class="textarea-ckeditor">
													<textarea class="ckeditor" name="fill" style="width: 10%; height: 250px;" id="ckeditor">
											<?= $fill ?>
										</textarea>
												</div><br />
												<!---POP UP -->
												<div class="container">
													<!-- Button to Open the Modal -->
													<button class="btn btn-worklist1 btn-expertise button-popup" type="button" data-toggle="modal" data-target="#modal-saveT" style="margin-left: -10px;"><i class="fas fa-file-export"></i> Save Template
													</button>
													<!-- The Modal -->
													<div class="modal" id="modal-saveT">
														<div class="modal-dialog">
															<div class="modal-content">

																<!-- Modal Header -->
																<div class="modal-header">
																	<h4 class="modal-title">Title</h4> <br />
																	<input type="text" name="title" value="" placeholder="Insert Tittle">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>

																<!-- Modal body -->
																<!-- <div class="modal-body">
														<textarea style="width: 100%;" class="textarea-worklist" id="ckeditor" name="fill"></textarea>
													</div> -->

																<!-- Modal footer -->
																<div class="modal-footer">
																	<button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
																	<button class=" btn btn-save-worklist" name="savetemp">Save</button>
																</div>

															</div>
														</div>
													</div>

												</div>
												<!-- END OF POP UP -->
											</div>
											<div class="btn-bar-1">
												<button class="btn btn-worklist btn-expertise button-popup-approve waves-effect waves-light" name="savedraft"><i class="fas fa-save"></i> Save Edit</button>
												<!-- <button class="btn btn-worklist" name="showpdf">Show Preview Pdf</button> -->

											</div>
											<div class="btn-bar-2">
												<!-- 
									<button class="btn btn-worklist" name="xml">XML</button>
									
									<button type="button" class="btn btn-worklist" name="send_mail" data-toggle="modal" data-target="#myModal2">Send Mail</button> -->

											</div>
											</form>
											</li>
											</ul>
										</div>





									</div>
								</div>
							</div>
							<!-- ========== END MODALS ========== -->
							<div class="col-md-3 padding-rl-less-media">
								<div class="div-right">
									<div class="">
										<input type="text" class="form-control" placeholder="search by tittle.. " id="myInput" style="margin: 9px 0px; width: 100%;">
									</div>
									<a href="test-table2.php?uid=<?= $uid; ?>">
										<div class="template-save1">
											Template Name
										</div>
									</a>
									<?php if ($username != 'drwawan') { ?>
										<div class="template-save" id="container-template">

											<table border="1" id="mytemplate" class="type-choice mytemplate" style="width: 100%;">
												<?php

												$result = mysqli_query($conn, "SELECT * FROM xray_template WHERE username = '$username'");
												while ($row1 = mysqli_fetch_assoc($result)) { ?>
													<thead class="myTable">
														<td class="td1">
															<a href="workload-edit.php?uid=<?= $uid; ?>&amp;template_id=<?= $row1['template_id']; ?>" onclick="return confirm('Change template?');"><?= $row1['title']; ?></a>
														</td>
														<td style="text-align: center;">
															<a href="#" class="edit-record" data-id="<?= $row1['template_id'];  ?>">
																<i data-toggle="tooltip" title="View Template" class="fas fa-eye fa-lg"></i>
															</a>
														</td>
														<td style="text-align: center;">
															<a href="hapustemplateworkload.php?uid=<?= $uid; ?>&amp;template_id=<?= $row1['template_id']; ?>" data-id="<?= $row1['template_id'];  ?>" onclick="return confirm('Teruskan Menghapus Data?');">
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
					<!-- Modal buat show fill template -->
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
				</div>
				<!-- modal -->
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
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='workload1']").addClass("active");
			});
		</script>

		<script>
			// untuk menampilkan data popup
			$(function() {
				$(document).on('click', '.edit-record', function(e) {
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
				$.get('data-workload.php', function(data) {
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
		<!-- javascript select template -->
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
		<!-- script search live -->
		<script>
			var keyword = document.getElementById('keyword-template');
			var tombolCari = document.getElementById('tombol-cari');
			var containerTemplate = document.getElementById('container-template');
			// tambahkan event ketika keyword ditulis
			keyword.addEventListener('keyup', function() {
				// buat object ajax
				var xhr = new XMLHttpRequest();
				// cek kesiapan ajax
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						containerTemplate.innerHTML = xhr.responseText;
					}
					$('.showData').click(function(e) {
						e.preventDefault();
						$('[name=fill]').val($(this).attr('fill'));
						$('form').attr('action', $(this).attr('href'));
					});

				}
				// eksekusi ajax
				xhr.open('GET', 'data-workload.php?keyword=' + keyword.value, true);
				xhr.send();
			});
		</script>
		<!-- script search liv end -->
		<!-- javascript select temlate -->
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
<!-- script- -->