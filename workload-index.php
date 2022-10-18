<div class="col-12" style="padding-left: 0;">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item active">Workload</li>
		</ol>
	</nav>
</div>
<div class="table-view">
	<?php require_once 'formsearch.php'; ?>
	<div class="col-md-12 table-box" style="overflow-x:auto;">
		<table class="table-dicom" id="purchase_order" style="width: 2400px;" cellpadding="8" cellspacing="0">
			<thead class="thead1">
				<?php require 'thead.php'; ?>
			</thead>
		</table>
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="modal-series">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<!-- <h1 class="modal-title">Modal Heading</h1> -->
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" style="cursor:not-allowed">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End The Modal -->
<script src="js/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<script>
	$('#from_updated_time').datetimepicker({
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
	$('#to_updated_time').datetimepicker({
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
		$(document).on('click', '.cboxtombol', function() {
			$('.cbox').prop('checked', this.checked);
		});
		fetch_data('no');

		function fetch_data(is_date_search = 'yes', from_updated_time = '', to_updated_time = '', mods_in_study = '', pat_name = '', mrn = '') {
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
						from_updated_time: from_updated_time,
						to_updated_time: to_updated_time,
						mods_in_study: mods_in_study,
						pat_name: pat_name,
						mrn: mrn
					}
				},
			});
		}

		$('#range').click(function() {
			var from_updated_time = $('#from_updated_time').val();
			var to_updated_time = $('#to_updated_time').val();
			var pat_name = $('#pat_name').val();
			var mrn = $('#mrn').val();
			var mods_in_study = get_filter('checkbox');
			if (from_updated_time != '' && to_updated_time != '') {
				$('#purchase_order').DataTable().destroy();
				fetch_data('yes', from_updated_time, to_updated_time, mods_in_study, pat_name, mrn);
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