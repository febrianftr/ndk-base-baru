<?php
require '../koneksi/koneksi.php';
require 'default-value.php';
require '../model/query-base-workload.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';

$level = $_SESSION['level'];
$waiting3hour = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT 
	COUNT(*) AS jumlah
	FROM $table_patient
	JOIN $table_study 
	ON patient.pk = study.patient_fk 
	JOIN $table_workload
	ON study.study_iuid = xray_workload.uid 
	LEFT JOIN $table_order
	ON xray_order.uid = xray_workload.uid 
	WHERE status = 'waiting'
	AND study.study_datetime < DATE_SUB(NOW(), INTERVAL 3 HOUR)
	AND study.updated_time >= '2023-11-26'
	AND priority = 'normal'
	"
));
$moreThan3hour = $waiting3hour["jumlah"];

$waiting1hour = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT 
	COUNT(*) AS jumlah
	FROM $table_patient
	JOIN $table_study 
	ON patient.pk = study.patient_fk 
	JOIN $table_workload
	ON study.study_iuid = xray_workload.uid 
	LEFT JOIN $table_order
	ON xray_order.uid = xray_workload.uid 
	WHERE status = 'waiting'
	AND study.study_datetime < DATE_SUB(NOW(), INTERVAL 1 HOUR)
	AND study.updated_time >= '2023-11-26'
	AND priority = 'cito'
	"
));
$moreThan1hour = $waiting1hour["jumlah"];
?>
<div class="col-12" style="padding: 0;">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item active">Workload</li>
		</ol>
	</nav>
</div>
<div class="table-view">
	<?php if ($level == "radiology") { ?>
		<h3 class="text-center">Expertise Approved</h3>
	<?php } else { ?>
		<h3 class="text-center">Workload</h3>
	<?php } ?>
	<hr>
	<?php require_once 'formsearch.php'; ?>

	<!-- waiting three hour normal -->
	<div class="blinking" style="text-align: center;">
		<hr>
		<a href="#" class="hasil-waiting-morethan3hour penawaran-a"><?php echo "Waiting <strong>($moreThan3hour)</strong> study"; ?></a>
		<hr>
	</div>
	<!-- waiting one hour CITO -->
	<div class="blinking-cito" style="text-align: center;">
		<hr>
		<a href="#" class="hasil-waiting-morethan1hour penawaran-a"><?php echo "Waiting CITO <strong>($moreThan1hour)</strong> study"; ?></a>
		<hr>
	</div>

	<div class="col-md-12 table-box" style="overflow-x:auto;">
		<table class="table-dicom" id="purchase_order" style="width: 2400px;" cellpadding="8" cellspacing="0">
			<thead class="thead1">
				<?php require 'thead.php'; ?>
			</thead>
		</table>
	</div>
</div>
<?php require 'modal.php'; ?>
<script src="js/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<script>
	$('#from_study_datetime').datetimepicker({
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
	$('#to_study_datetime').datetimepicker({
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
		$(document).keypress(function(e) {
			var keycode = (e.keycode ? e.keycode : e.which);
			if (keycode == '13') {
				properties_data()
			}
		});

		$(document).on('click', '.cboxtombol', function() {
			$('.cbox').prop('checked', this.checked);
		});
		fetch_data('no');

		function fetch_data(is_date_search = 'yes', from_study_datetime = '', to_study_datetime = '', mods_in_study = '', pat_name = '', mrn = '', patientid = '', fill = '') {
			var dataTable = $('#purchase_order').DataTable({
				"processing": true,
				"serverSide": true,
				"order": [],
				"searching": false,
				"ajax": {
					url: "../prosescari.php",
					type: "POST",
					data: {
						is_date_search: is_date_search,
						from_study_datetime: from_study_datetime,
						to_study_datetime: to_study_datetime,
						mods_in_study: mods_in_study,
						pat_name: pat_name,
						mrn: mrn,
						patientid: patientid,
						fill: fill
					}
				},
			});
		}

		function properties_data() {
			var from_study_datetime = $('#from_study_datetime').val();
			var to_study_datetime = $('#to_study_datetime').val();
			var pat_name = $('#pat_name').val();
			var mrn = $('#mrn').val();
			var mods_in_study = get_filter('checkbox');
			var patientid = $('#patientid').val();
			var fill = $('#fill').val();
			if (from_study_datetime != '' && to_study_datetime != '') {
				$('#purchase_order').DataTable().destroy();
				fetch_data('yes', from_study_datetime, to_study_datetime, mods_in_study, pat_name, mrn, patientid, fill);
			} else {
				alert("Please Select Date");
			}
		}

		$('#range').click(function() {
			properties_data()
		});

		function get_filter(class_name) {
			var filter = [];
			$('#' + class_name + ':checked').each(function() {
				filter.push($(this).val());
			});
			return filter;
		}
		$('.common_selector').click(function() {
			$('#purchase_order');
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