<?php
session_start();
include('head.php');
$username = $_SESSION['username']; ?>
<style type="text/css">
	.template-doc {
		height: 100%;
		width: 100%;
	}

	#testDiv {
		width: 100%;
		height: 100%;
		overflow-x: auto;
		border: 1px solid black;
		white-space: nowrap;
		font-size: 10;
	}

	.template-doc-div {
		/*width: 120px;*/
		height: 40px;
		display: inline-block;
		padding: 5px;
		font-size: 15px;
	}
</style>

<div class="container-fluid">
	<div id="testDiv">

		<?php
		$uid = $_GET['uid'];
		require '../koneksi/koneksi.php';
		$query = mysqli_query($conn, "SELECT * FROM xray_template where username = '$username'");
		$i = 1;
		while ($row = mysqli_fetch_assoc($query)) {
			$name = $row['title'];
			$template_id = $row['template_id'];
			if (($i - 1) % 15 == 0) {
				echo "<div class='template-doc-div'>";
			}

			$result = "<a href='workload-edit.php?uid=$uid&template_id=$template_id'><div class='template-doc'>" . "<i class='fas fa-file'></i> <label class='font-template1'>" . $name . $i . "</lebel></div></a>
			";
			echo $result;
			if ($i % 15 == 0) {
				echo "</div>";
			}
			$i++;
		}
		// $conn = mysqli_connect('127.0.0.1', 'root', 'efotoadmin', 'intimedika');
		// $query = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer");
		// while ($row = mysqli_fetch_assoc($query)) {
		// 	$name = $row['name'];
		// 	$result = "<div class='template-doc'>" . "<i class='fas fa-file'></i> " . $name . "</div>
		// 	";
		// 	echo $result;
		// }
		?>

	</div>
</div>




<!-- 
<div style="width: auto; overflow-x: scroll; white-space: nowrap;" class="dashboard-home container-fluid ovrflow">
	<div class="ovrflow">
		 <table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
	<?php
	for ($i = 1; $i < 8000; $i++) {
		if (($i - 1) % 10 == 0) {
			echo "<div class='col1'>";
		}
		echo "<label>" . $i . "</label><br>";
		if ($i % 10 == 0) {
			echo "</div>";
		}
	}
	?>
	</table>
	 </div>
</div> -->

<?php include('script-footer.php'); ?>