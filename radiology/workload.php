<?php

require 'function_radiology.php';

session_start();

// --------------------------------

if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Expertise | Radiology</title>

		<!-- <meta http-equiv="refresh" content="10"/> -->
	</head>
	<?php include('head.php'); ?>
	<style>
		@media only screen and (max-width: 800px) {
			.menu-size2 {
				visibility: hidden;
			}
		}
	</style>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div class="col-12" style="padding-left: 0;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active">Workload</li>
						</ol>
					</nav>
				</div>

				<div id="content1">
					<div class="table-view">
						<?php require_once '../formsearch.php'; ?>

						<div class="col-md-12 dashboard-home" style="overflow-x:auto;">
							<table class="table-dicom" id="purchase_order" style="margin-top: 3px; width: 2362px;" border="1" cellpadding="8" cellspacing="0">
								<thead class="thead1">
									<tr>
										<th>NO</th>
										<th width="174">Action</th>
										<th>No Foto</th>
										<th>MRN</th>
										<th><?= $lang['name'] ?></th>
										<th><?= $lang['age'] ?></th>
										<th><?= $lang['sex'] ?></th>
										<th>Main Prosedur</th>
										<th><?= $lang['procedure'] ?></th>
										<th>#S</th>
										<th>#I</th>
										<th><?= $lang['modality'] ?></th>
										<th><?= $lang['referral_physician'] ?></th>
										<th><?= $lang['departmen'] ?></th>
										<th><?= $lang['radiology_physician'] ?></th>
										<th><?= $lang['name_radiographer'] ?></th>
										<th>PDC</th>
										<th><?= $lang['approve_date'] ?></th>
										<th><?= $lang['spend_time'] ?></th>
									</tr>
								</thead>
							</table>
						</div>

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
		<!-- Script -->
		<?php include('script-footer.php'); ?>
		<script>
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='workload1']").addClass("active");
			});
		</script>

		<script>
			$('#From').datetimepicker({
				format: 'd-m-Y H:i',
				allowTimes: ['00:00',
					'01:00',
					'02:00',
					'03:00',
					'04:00',
					'05:00',
					'06:00',
					'07:00',
					'08:00',
					'09:00',
					'10:00',
					'11:00',
					'12:00',
					'13:00',
					'14:00',
					'15:00',
					'16:00',
					'17:00',
					'18:00',
					'19:00',
					'20:00',
					'21:00',
					'22:00',
					'23:00',
					'23:59'
				]
			});
			$('#to').datetimepicker({
				format: 'd-m-Y H:i',
				allowTimes: ['00:00',
					'01:00',
					'02:00',
					'03:00',
					'04:00',
					'05:00',
					'06:00',
					'07:00',
					'08:00',
					'09:00',
					'10:00',
					'11:00',
					'12:00',
					'13:00',
					'14:00',
					'15:00',
					'16:00',
					'17:00',
					'18:00',
					'19:00',
					'20:00',
					'21:00',
					'22:00',
					'23:00',
					'23:59'
				]
			});
		</script>

		<script>
			$(document).ready(function() {

				$('.cboxtombol').click(function() {
					$('.cbox').prop('checked', this.checked);
				});

				$('.cboxtombolpay').click(function() {
					$('.cboxpay').prop('checked', this.checked);
				});
				fetch_data('no');

				function fetch_data(is_date_search, From = '', to = '', modality = '', keyword = '', keyword_mrn = '', keyword_patientid = '') {
					var dataTable = $('#purchase_order').DataTable({
						"processing": true,
						"serverSide": true,
						"order": [],
						"searching": false,
						"ajax": {
							url: "prosescari.php",
							type: "POST",
							data: {
								is_date_search: is_date_search,
								From: From,
								to: to,
								modality: modality,
								keyword: keyword,
								keyword_mrn: keyword_mrn,
								keyword_patientid: keyword_patientid
							}
						},
					});
				}

				$('#range').click(function() {
					var From = $('#From').val();
					var to = $('#to').val();
					var keyword = $('#keyword').val();
					var keyword_mrn = $('#keyword_mrn').val();
					var keyword_patientid = $('#keyword_patientid').val();
					var modality = get_filter('checkbox');
					if (From != '' && to != '') {
						$('#purchase_order').DataTable().destroy();
						fetch_data('yes', From, to, modality, keyword, keyword_mrn, keyword_patientid);
					} else {
						alert("Please Select Date");
					}
				});

				function get_filter(class_name) {
					var filter = [];
					$('#' + class_name + ':checked').each(function() {
						filter.push($(this).val());
					});
					return filter;
				}
				$('.common_selector').click(function() {
					purchase_order();
				});
			});
		</script>


		<!-- ------------------hide search di tables--------------------- -->
		<script>
			$(document).ready(function() {
				$(".dataTables_filter").hide();
			});
		</script>
		<!-- ----------------------hide search di tables------------------------ -->

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>