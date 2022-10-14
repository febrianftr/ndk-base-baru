<?php
require 'function_radiology.php';
session_start();
// menampilkan data xray exam
@$study_iuid = $_GET['study_iuid'];
$query1 = "SELECT
study.patient_fk,
patient.pk,
series.study_fk,
patient.merge_fk,
patient.pat_id,
patient.pat_id_issuer,
patient.pat_name,
patient.pat_fn_sx,
patient.pat_gn_sx,
patient.pat_i_name,
patient.pat_p_name,
patient.pat_birthdate,
patient.pat_sex,
patient.pat_custom1,
patient.pat_custom2,
patient.pat_custom3,
patient.created_time,
patient.pat_attrs,
study.pk,
study.accno_issuer_fk,
study.study_iuid,
study.study_id,
study.study_datetime,
study.accession_no,
study.ref_physician,
study.ref_phys_fn_sx,
study.ref_phys_gn_sx,
study.ref_phys_i_name,
study.ref_phys_p_name,
study.study_desc,
study.study_custom1,
study.study_custom2,
study.study_custom3,
study.study_status_id,
study.mods_in_study,
study.cuids_in_study,
study.num_series,
study.num_instances,
study.ext_retr_aet,
study.retrieve_aets,
study.fileset_iuid,
study.fileset_id,
study.availability,
study.study_status,
study.checked_time,
study.updated_time,
study.created_time,
study.study_attrs,
study.chargeId,
study.totalCharge,
study.billId,
study.invoiceNo,
study.batchNo,
study.img,
study.fill,
study.del,
series.pk,
series.mpps_fk,
series.inst_code_fk,
series.series_iuid,
series.series_no,
series.modality,
series.body_part,
series.laterality,
series.series_desc,
series.institution,
series.station_name,
series.department,
series.perf_physician,
series.perf_phys_fn_sx,
series.perf_phys_gn_sx,
series.perf_phys_i_name,
series.perf_phys_p_name,
series.pps_start,
series.pps_iuid,
series.series_custom1,
series.series_custom2,
series.series_custom3,
series.num_instances,
series.src_aet,
series.ext_retr_aet,
series.retrieve_aets,
series.fileset_iuid,
series.fileset_id,
series.availability,
series.series_status,
series.created_time,
series.series_attrs,
series.content_time
FROM
patient
INNER JOIN study ON study.patient_fk = patient.pk
INNER JOIN series ON series.study_fk = study.pk
		WHERE study_iuid = '$study_iuid'";
$data_dicom1 = mysqli_query($conn_pacs,$query1);
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
if( isset($_POST["approve"]) ) {
	if ( input_approve_pacs($_POST)){
		echo "
<script>
	alert('Data sudah diapprove');
	document.location.href= 'workload.php';
</script>
";
}
else
{
echo "
<script>
	alert('approve gagal');
	document.location.href= 'worklist-pacs.php?study_iuid=$study_iuid';
</script>";
}
}
if( isset($_POST["savetemp"]) ) {
if ( input_temp($_POST)){
echo "
<script>
	alert('Report Telah Di Simpan ke template');
	document.location.href= 'worklist-pacs.php?study_iuid=$study_iuid';
</script>
";
}else {
echo "
<script>
	alert('Report Gagal Di Simpan ke template');
	document.location.href= 'worklist-pacs.php?study_iuid=$study_iuid';
</script>";
}
}
if( isset($_POST["savedraft"]) ) {
if ( ubah_exam_pacs($_POST)){
echo "
<script>
	alert('Report Telah Di Simpan ke Draft');
	document.location.href= 'dicom.php';
</script>
";
}else {
echo "
<script>
	alert('Report Gagal Di Simpan ke Draft');
	document.location.href= 'worklist-pacs.php?study_iuid=$study_iuid';
</script>";
}
}
if( isset($_POST["showpdf"]) ) {
if ( bgst($_POST)){
echo "
<script>
	window.open('pdf/testpdf.php?uid=$uid', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=800');
</script>";
// header("location:http://192.168.2.114/intiwid/radiology/pdf/testpdf3.php?uid=$uid", "_blank");
}else {
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
		<link rel="stylesheet" type="text/css" href="css/css-navbar.css">
		
		<?php include('head.php'); ?>
		
		<title>Home | radiology</title>
		<script type="text/javascript" src="js/jquery1.10.2.js"></script>
	</head>
	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="dicom.php">Worklist</a></li>
				<li class="breadcrumb-item active" aria-current="page">Report</li>
			</ol>
		</nav>
		<div id="container1">
			<div id="content1">
				<div class="container-fluid">
					<div class="row row_worklist">
						<div class="col-md-2 div-left" style="padding: 0px;">
							<div class="left-top">
								<div class="work-order">
									<ul>
										<li  class="li-work patient-work"><a class="button-work-order" href="#"><i class="fas fa-eye"></i>Workload</a></li>
									</ul>
								</div>
								<div class="work-patient">
									<ul>
										<li  class="li-work patient-work"><a class="button-work-patient" href="#"><i class="fas fa-eye"></i> viewer</a></li>
									</ul>
								</div>
							</div>
							<!-- 				<?php
								$result = mysqli_query($conn_pacs,"SELECT * FROM xray_exam2 WHERE uid = '$uid'");
								$row = mysqli_fetch_assoc($result);
								$patientid = $row['patientid'];
								$result1 = mysqli_query($conn, "SELECT * FROM xray_workload WHERE patientid = '$patientid'");
							?>
							-->				<div class="data-order">
								Ini Data Patient<br><br>
								<?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
								<p><?= $row1['name'] . '' . $row1['lastname']  ?></p>
								<p><?= $row1['complete_time']; ?></p>
								<p><?= $row1['prosedur']; ?> | <span><?php include '../viewer-dicom-pacs.php'; ?></span></p>
								<?php } ?>
								
							</div>
							<div class="data-patient">
								<?php
								$query123 = "SELECT *
								FROM study
								INNER JOIN patient
								ON study.patient_fk = patient.pk
								INNER JOIN series
								ON study.pk = series.study_fk
								WHERE study_iuid = '$study_iuid'";
								$data_dicom123 = mysqli_query($conn_pacs,$query123);
								$row123 = mysqli_fetch_assoc($data_dicom123);
								$study_iuid = $row123['study_iuid'];
								$mods_in_study1 = $row123['mods_in_study'];
								$result = mysqli_query($conn,"SELECT *
																		FROM xray_modalitas
																		WHERE xray_type_code = '$mods_in_study1' ");
											$row = mysqli_fetch_assoc($result);
								?>
								<br>
								<div class="content1-adm li-adm">
									<td><img class="img-thumbnail" src="../gambar/<?= $row['imgmod']; ?>" width="100px;"></td>
									<ul>
										<!-- <?= $study_iuid; ?> -->
										<span><li><?php include '../viewer-dicom-pacs.php'; ?>Dicom Viewer</li></span>
										<span><li><?php include '../viewer-ohif-pacs.php'; ?>Web Viewer</li></span>
									</ul>
								</div>
							</div>
						</div>
						<?php $row = mysqli_fetch_assoc($data_dicom1);
							$pat_name = $row['pat_name'];
							$pat_name1 = preg_replace('/[^A-Za-z\ ]/', ' ', $pat_name);
							$perf_physician = $row['perf_physician'];
							$perf_physician1 = preg_replace('/[^A-Za-z\ ]/', ' ', $perf_physician);
							$ref_physician = $row['ref_physician'];
							$ref_physician1 = preg_replace('/[^A-Za-z\ ]/', ' ', $ref_physician); 
							$updated_time = $row2["updated_time"];
					        $updated_time1 = date("d-m-Y H:i", strtotime($updated_time));
							$pat_birthdate = $row['pat_birthdate'];
						$bday = new DateTime($pat_birthdate);
						$today = new DateTime(date('y-m-d'));
						$diff = $today->diff($bday);
					
						?>
						<div class="col-md-7 div-mid">
							<div class="kotak">
								<div class="info-patient">
									<div class="info-patient2">
										<div class="row justify-content-center">
											<div class="info-left col-sm-5">
												<?php if (isset($_GET['study_iuid'])) { ?>
												<table class="infopatientworklist" border="0">
													<tr>
														<td><b>Acc Number</b> <td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $row['accession_no']; ?></td></td>
													</tr>
													<tr>
														<td><b>Patient Name</b> <td>&nbsp;&nbsp;:&nbsp;</td><td><?php echo $pat_name1; ?></td></td>
													</tr>
													<tr>
														<td><b>Age</b> <td>&nbsp;&nbsp;:&nbsp;</td><td><?php echo $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D'; ?></td></td>
													</tr><br>
													<tr>
														<td><b>Sex</b> <td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $row['pat_sex']; ?></td></td>
													</tr><br>
													<tr>
														<td><b>Modality</b> <td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $row['mods_in_study']; ?></td></td><br>
													</tr>
												</table><br>
											</div>
											<div class="info-right col-sm-7">
												<table class="infopatientworklist2" border="0">
													<tr>
														<td><b>Study Desc</b><td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $row['study_desc']; ?></td></td>
													</tr>
													<tr>
														<td><b>Series</b><td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $row['num_series']; ?></td></td>
													</tr><br>
													<tr>
														<td><b>Referral Physician</b><td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $ref_physician1; ?></td></td>
													</tr><br>
													<tr>
														<td><b>Perf Physician</b><td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $perf_physician1; ?></td></td>
													</tr><br>
													<tr>
														<td><b>Time</b><td>&nbsp;&nbsp;:&nbsp;</td> <td><?php echo $updated_time1; ?></td></td>
													</tr><br>
													<?php } else { echo "404 Not Found";}?>
												</table>
											</div>
										</div>
									</div>
									
								</div>
							</form>
							<div class="work-patient6">
								<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
								<button id="jBold"><b>B</b></button>
								
								<script>
								$(document).ready(function() {
								$('#jBold').click(function() {
								document.execCommand('bold');
								});
								});
								</script> -->
								<form action="" method="post">
									<input type="hidden" name="study_iuid" value="<?= $row['study_iuid']; ?>">
									<input type="hidden" name="username" value="<?= $username ?>">
									<div ng-app="myApp" ng-controller="myCtrl">
										<?php
											@$template_id = $_GET['template_id'];
											$query = "SELECT *
										FROM study
										INNER JOIN patient
										ON study.patient_fk = patient.pk
										INNER JOIN series
										ON study.pk = series.study_fk
										WHERE study_iuid = '$study_iuid'
												";
											$result = mysqli_query($conn_pacs, $query);
											$row3 = mysqli_fetch_assoc($result);
											$query = "SELECT *
												FROM xray_template
												WHERE template_id = '$template_id'
												";
											$result = mysqli_query($conn, $query);
											$row10 = mysqli_fetch_assoc($result);
											if ($template_id == "") {
												$fill = $row3['fill'];
											}
											else
											{
												$fill = $row10['fill'];
											}
										?>
										<h3 class="h3-template"></h3>
										<div class="textarea-ckeditor">
											<textarea class="ckeditor" name="fill" style="width: 100%; height: 250px;" id="ckeditor">
											<?= $fill ?>
											</textarea>
										</div><br/>
										<!---POP UP -->
										<div class="container">
											<!-- Button to Open the Modal -->
											<button class="btn btn-worklist button-popup" type="button" data-toggle="modal" data-target="#myModal"><i class="fas fa-file-export"></i> Save Template
											</button>
											<!-- The Modal -->
											<div class="modal fade" id="myModal">
												<div class="modal-dialog">
													<div class="modal-content">
														
														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Title</h4><br />
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
										<button class="btn btn-worklist" name="savedraft" onclick="return confirm('Are you sure save draft?');"><i class="fas fa-save"></i> Save Draft</button>
										<!-- <button class="btn btn-worklist" name="showpdf">Show Preview Pdf</button> -->
										<button class="btn btn-worklist button-popup-approve" name="approve" onclick="return confirm('Are you sure approve?');"><i class="fas fa-check-square"></i> Approve</button><br>
									</div>
									<div class="btn-bar-2"><!--
										<button class="btn btn-worklist" name="xml">XML</button>
										
										<button type="button" class="btn btn-worklist" name="send_mail" data-toggle="modal" data-target="#myModal2">Send Mail</button> -->
										
									</div>
								</form>
							</li>
						</ul>
					</div>
					
					
					<br/>
					
					
				</div>
			</div>
			<!-- ========== END MODALS ========== -->
			<div class="col-md-2 div-right">
				<div class="profil_doc">
					<div class="text-center">
						<label style="color: #ee7423;">Login</label><br>
						<?php
								$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ");
								$row1234 = mysqli_fetch_assoc($result);
								$dokrad_img = $row1234['dokrad_img'];
						?>
						<img src="../image/<?= $dokrad_img; ?>" width="50%" class="img-circle"><br>
						<strong><?php echo $row1234['dokrad_name'].' '.$row1234['dokrad_lastname']; ?></strong><br>
						
					</div>
				</div>
				<div class="info-rad">
					<h2>Information</h2>
					<table class="infopatientworklist3">
						<tr>
							<td><b>Radiographer</b> <td>:</td>
							<tr><td><?php echo $perf_physician1; ?></td></td>
						</tr>
					</tr><br>
					<tr>
						<td><b>Radiology Physician</b> <td>:</td>
						<tr><td><?php echo $row1234['dokrad_name'].' '.$row1234['dokrad_lastname']; ?></td></td></tr>
					</tr><br>
				</table>
			</div>
			<div class="search-template">
				<input type="text" name="search-template" class="live-search-box" placeholder="search by tittle.. " id="myInput">
			</div>
			<div class="template-save1">
				Template Name
			</div>
			<div class="template-save" id="container-template">
				<!-- <div id="content"></div> -->
				<table border="1" id="mytemplate" class="type-choice mytemplate">
					<?php
					$username = $_SESSION['username'];
					$result = mysqli_query($conn, "SELECT * FROM xray_template WHERE username = '$username'");
					while ($row1 = mysqli_fetch_assoc($result)) { ?>
					<thead class="myTable">
						<td class="td1">
							<a href="worklist-pacs.php?study_iuid=<?= $study_iuid; ?>&amp;template_id=<?= $row1['template_id']; ?>" onclick="return confirm('Change Template?');"><?= $row1['title']; ?></a>
							
						</td>
						<td>
							<a href="#" class="edit-record" data-id="<?= $row1['template_id'];  ?>">
								<img data-toggle="tooltip" title="Show Template" style="width: 20px; padding: 3px;" src="../image/look3.png">
							</a>
						</td>
						<td>
							<a href="hapustemplatepacs.php?study_iuid=<?= $study_iuid; ?>&amp;template_id=<?= $row1['template_id'];?>"  data-id="<?= $row1['template_id'];  ?>" onclick="return confirm('Teruskan Menghapus Data?');">
							<img data-toggle="tooltip" title="Delete Template" style="width: 20px; padding: 3px;" src="../image/delete.png">
							</a>
						</td>
							<?php } ?>
						</thead>
					</table>
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
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			
		</div>
	</div>

	<!-- modal -->



	<div class="footerindex">
		<div class="">
			<div class="footer-login col-sm-12"><br>
				<center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
			</div>
		</div>
	</div>
</div>
<!-- SCRIPT -->
<?php include('script-footer.php'); ?>

<script>
		// untuk menampilkan data popup
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal5").modal('show');
                $.post('hasil.php',
                    {template_id:$(this).attr('data-id')},
                    function(html){
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
<!-- script search live bootstrap -->


<!-- <script src="js/angular.min.js"></script>

<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
$scope.textarea_template = "";
});
</script> -->
<!--- SCRIPT AUTO SAVE TEXTAREA FILL-->
<script type="text/javascript">
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
</script>
<!--- PENUTUP SCRIPT AUTO SAVE TEXTAREA FILL-->
<!--  SCRIPT AJAX CRUD   -->
<script type="text/javascript">
$(document).ready(function(){
loadData();
$('form69').on('submit37', function(e){
e.preventDefault();
$.ajax({
type:$(this).attr('method'),
url:$(this).attr('action'),
data:$(this).serialize(),
success:function(){
loadData();
resetForm();
}
});
})
})
function loadData(){
$.get('data.php',function(data){
$('#content').html(data);
$('.hapusData').click(function(e){
e.preventDefault();
$.ajax({
type:'get',
url:$(this).attr('href'),
success:function(){
loadData();

}
});
});
$('.updateData').click(function(e){
e.preventDefault();
$('.ckeditor').val($(this).attr('fill'));
$('form').attr('action',$(this).attr('href'));
});
})
}
function resetForm(){
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
window.open("pdf/testpdf.php?uid=<?php echo $row['uid']; ?> ",'popup','width=600,height=600'); return false;
}
</script>
<!-- -------------------javascript select template-------------- -->
<script>
	$(document).ready(function(){
		$(".type-choice").show();
		});
		$(function() {
			$('#selector1').change(function(){
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
if( xhr.readyState == 4 && xhr.status == 200 ) {
containerTemplate.innerHTML = xhr.responseText;
}
$('.showData').click(function(e){
e.preventDefault();
$('[name=fill]').val($(this).attr('fill'));
$('form').attr('action',$(this).attr('href'));
});
	
}
// eksekusi ajax
xhr.open('GET', 'data.php?keyword=' + keyword.value, true);
xhr.send();
});
</script>
<!-- --------------------------script search liv end------------------------ -->
<!-- -------------------javascript select temlate-------------- -->
<script>
	$(document).ready(function(){
	$(".data-order").hide();
	$(".button-work-order").click(function(){
	$(".data-order").toggle();
	$(".data-patient").hide();
	});
	});
	$(document).ready(function(){
	
	$(".button-work-patient").click(function(){
	$(".data-patient").toggle();
	$(".data-order").hide();
	});
	});
</script>

</body>
</html>
<?php } else { header("location:../index.php");} ?>
<!-- ------------------------script----------------------- -->
<script>
	$(function() {
$('.ckeditor').ckeditor({
toolbar: 'Full',
enterMode : CKEDITOR.ENTER_BR,
shiftEnterMode: CKEDITOR.ENTER_P,
});
});
CKEDITOR.config.autoParagraph = false;
</script>