<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<!-- Load file CSS Bootstrap dan Select2 melalui CDN -->
		<link href="css/select2.min.css" rel="stylesheet" />
		<title>Report Excel</title>
	</head>
	<style>
		.cont-regist h4 {
			color: #064588;
		}

		.input-regist input,
		.input-regist input[type="radio"]+label,
		.input-regist input[type="checkbox"]+label:before,
		.input-regist input[type="checkbox"]+label,
		.input-regist select option,
		.input-regist select {
			width: 100%;
			padding: 1em;
			line-height: 1.4;
			background-color: #f9f9f9;
			border: 1px solid #e5e5e5;
			border-radius: 3px;
			-webkit-transition: 0.35s ease-in-out;
			-moz-transition: 0.35s ease-in-out;
			-o-transition: 0.35s ease-in-out;
			transition: 0.35s ease-in-out;
			transition: all 0.35s ease-in-out;
		}

		.input-regist input:focus {
			outline: 0;
			border-color: #309ace;
		}

		.input-regist input:focus+.input-icon i {
			color: #377d71;
		}

		.input-regist input:focus+.input-icon:after {
			border-right-color: #377d71;
		}

		.input-regist input[type="radio"],
		.input-regist input[type="checkbox"] {
			display: none;
		}

		.input-regist input[type="radio"]+label,
		.input-regist input[type="checkbox"]+label,
		.input-regist select {
			display: inline-block;
			width: 30%;
			text-align: center;
			border-radius: 0;
		}

		.input-regist-gender input[type="radio"]+label,
		.input-regist-gender input[type="checkbox"]+label {
			display: inline-block;
			width: 33%;
			text-align: center;
			border-radius: 0;
			cursor: pointer;
		}

		.input-regist input[type="radio"]+label:first-of-type,
		.input-regist input[type="checkbox"]+label:first-of-type {
			border-top-left-radius: 3px;
			border-bottom-left-radius: 3px;
		}

		.input-regist input[type="radio"]+label:last-of-type,
		.input-regist input[type="checkbox"]+label:last-of-type {
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
		}

		.input-regist input[type="radio"]+label i,
		.input-regist input[type="checkbox"]+label i {
			padding-right: 0.4em;
		}

		.input-regist input[type="radio"]:checked+label,
		.input-regist input[type="checkbox"]:checked+label,
		.input-regist input:checked+label:before,
		.input-regist select:focus,
		.input-regist select:active {
			background-color: #377d71;
			color: #fff;
			/* border-color: #309ace; */
		}

		.input-regist input:checked+label:after {
			opacity: 1;
		}

		.input-regist select {
			/* height: 3.4em; */
			line-height: 2;
			margin: 0;
		}

		.input-regist select:first-of-type {
			border-top-left-radius: 3px;
			border-bottom-left-radius: 3px;
		}

		.input-regist select:last-of-type {
			border-top-right-radius: 3px;
			border-bottom-right-radius: 3px;
		}

		.input-regist select:focus,
		.input-regist select:active {
			outline: 0;
		}

		.input-regist select option {
			background-color: #ececec;
			color: #747474;
		}

		.input-group-regist {
			margin-bottom: 1em;
			zoom: 1;
		}

		.input-group:before,
		.input-group:after {
			content: "";
			display: table;
		}

		.input-group:after {
			clear: both;
		}

		.input-group-icon {
			position: relative;
		}

		.input-group-icon input {
			padding-left: 4.4em;
		}

		.input-group-icon .input-icon {
			position: absolute;
			top: 15px;
			left: 0;
			width: 3.4em;
			height: 3.4em;
			line-height: 3.4em;
			text-align: center;
			pointer-events: none;
		}

		.input-group-icon .input-icon:after {
			position: absolute;
			top: 0px;
			bottom: 23px;
			left: 3.4em;
			display: block;
			border-right: 1px solid #e5e5e5;
			content: "";
			-webkit-transition: 0.35s ease-in-out;
			-moz-transition: 0.35s ease-in-out;
			-o-transition: 0.35s ease-in-out;
			transition: 0.35s ease-in-out;
			transition: all 0.35s ease-in-out;
		}

		.input-group-icon .input-icon i {
			-webkit-transition: 0.35s ease-in-out;
			-moz-transition: 0.35s ease-in-out;
			-o-transition: 0.35s ease-in-out;
			transition: 0.35s ease-in-out;
			transition: all 0.35s ease-in-out;
		}


		.cont-regist {
			padding: 1em 3em 2em 3em;
			margin: 0em auto;
			background-color: #fff;
			border-radius: 4.2px;
			box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
		}

		.regist-live tr td {
			font-size: 15px;
			color: #377d71;
		}

		.right-regist {
			width: 100%;
			background-color: #fff;
			padding: 5px;
			border: 3px solid #fff;
			padding: 10px;
			border-radius: 5px;
		}



		.ks-cboxtags {
			list-style: none;
			/* padding: 20px; */
		}

		.ks-cboxtags li {
			display: inline;
		}

		.ks-cboxtags li span {
			display: inline-block;
			background-color: rgba(255, 255, 255, .9);
			border: 2px solid rgba(139, 139, 139, .3);
			color: #adadad;
			border-radius: 10px;
			white-space: nowrap;
			margin: 3px 0px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-tap-highlight-color: transparent;
			transition: all .2s;
		}

		.ks-cboxtags li span {
			padding: 8px 12px;
			cursor: pointer;
		}

		.ks-cboxtags li span::before {
			display: inline-block;
			font-style: normal;
			font-variant: normal;
			text-rendering: auto;
			-webkit-font-smoothing: antialiased;
			font-family: "Font Awesome 5 Free";
			font-weight: 900;
			font-size: 12px;
			padding: 2px 6px 2px 2px;
			content: "\f068";
			transition: transform .3s ease-in-out;
		}

		.ks-cboxtags li input[type="checkbox"]:checked+span::before {
			content: "\f00c";
			transform: rotate(-360deg);
			transition: transform .3s ease-in-out;
		}

		.ks-cboxtags li input[type="checkbox"]:checked+span {
			border: 2px solid #fff;
			background-color: #1f69b7;
			color: #fff;
			transition: all .2s;
		}

		.ks-cboxtags li input[type="checkbox"] {
			display: absolute;
		}

		.ks-cboxtags li input[type="checkbox"] {
			position: absolute;
			opacity: 0;
		}

		.ks-cboxtags li input[type="checkbox"]:focus+span {
			border: 1px solid #377d71;
		}

		.card-body i,
		.card-body h4 {
			color: #2a412f;
		}
	</style>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<?php require '../report-index.php'; ?>
		</div>
		<div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script src="../js/proses/report-excel.js"></script>
		<script>
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='report1']").addClass("active");

				$(".select2").select2({
					placeholder: 'Select Radiographer'
				});

				$('.cboxtombol').click(function() {
					$('.cbox').prop('checked', this.checked);
				});
				// --------------------
				$('#from_workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
				$('#to_workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>