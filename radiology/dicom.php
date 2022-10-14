<?php
require '../koneksi/koneksi.php';
session_start();

$username = $_SESSION['username'];
// -----------------xray_exam2--------------

if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Worklist | Radiology</title>
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
										<li class="breadcrumb-item active">Worklist</li>
									</ol>
								</nav>
							</div>
							<div class="table-view col-md-12 dashboard-home" style="overflow-x:auto;">

								<table class="table-dicom" id="example" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px; width: 2325px;">
									<thead class="thead1">
										<div class="input-group-sm" style="    margin-bottom: -8px;">
											<input type="text" class="form-control" style="width: 115px; float: right;" id="mrn" placeholder="search MRN">
											<input type="text" class="form-control" style="width: 115px; float: right; margin-right: 6px;" id="name" placeholder="search Name">
										</div>
										<tr>
											<th>NO</th>
											<th><?= $lang['action'] ?></th>
											<th>MRN/NO FOTO</th>
											<!-- <th>Radiology Physician</th> -->
											<th><?= $lang['name'] ?></th>
											<th><?= $lang['age'] ?></th>
											<th><?= $lang['sex'] ?></th>
											<th><?= $lang['modality'] ?></th>
											<th>Main Prosedur</th>
											<th><?= $lang['procedure'] ?></th>
											<th><?= $lang['referral_physician'] ?></th>
											<th>Status</th>
											<th><?= $lang['name_radiographer'] ?></th>
											<th><?= $lang['departmen'] ?></th>
											
											<th><?= $lang['arrive_date'] ?></th>
											<th><?= $lang['exam_date'] ?></th>
											<th>PDC</th>
											<th><?= $lang['spc_needs'] ?></th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- The Modal -->
				<div class="modal" id="myModal1">
					<div class="modal-dialog modal-dialog-scrollable">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<!-- <h1 class="modal-title">Modal Heading</h1> -->
								<button type="button" class="close" data-dismiss="modal">×</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">
								<h3>Specification</h3>
								<p><?php echo $row1['uid']; ?></p>
							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>

						</div>
					</div>
				</div>
				<!-- End The Modal -->

		</div>       
    </div>

    <div class="footerindex">
        <div class="">
          <?php include('footer-itw.php'); ?>
        </div>
    </div>
		<?php include('script-footer.php'); ?>
		<script>
			$(document).ready(function(){
				$("li[id='worklist1']").addClass("active");
				});
		</script>
		<script>
			$(document).ready(function() {
				var table = $('#example').DataTable({
					"ajax": {
						"url": "getDicom.php",
						"dataSrc": ""
					},
					"columns": [{
							"data": "no"
						},
						{
							"data": "action"
						},
						{
							"data": "mrn"
						},
						{
							"data": "name"
						},
						{
							"data": "birth_date"
						},
						{
							"data": "sex"
						},
						{
							"data": "xray_type_code"
						},
						{
							"data": "prosedur"
						},
						{
							"data": "series_desc"
						},
						{
							"data": "named"
						},
						{
							"data": "priority"
						},
						{
							"data": "radiographer_name"
						},
						{
							"data": "name_dep"
						},
						
						{
							"data": "arrive_date"
						},
						{
							"data": "complete_date"
						},
						{
							"data": "updated_time"
						},
						{
							"data": "spc_needs"
						}
					]
				});
				$('#mrn').on('keyup', function() {
					table
						.columns(2)
						.search(this.value)
						.draw();
				});
				$('#name').on('keyup', function() {
					table
						.columns(3)
						.search(this.value)
						.draw();
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>