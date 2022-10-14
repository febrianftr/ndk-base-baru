<?php
require 'function_radiographer.php';
session_start();

if (isset($_POST["submit"])) {
	if (inputpatient($_POST)) {
		echo "
<script>
	document.location.href= 'registration-live.php';
</script>
";
	} else {
		echo "
<script>
	alert('pilih data pasien');
	document.location.href= 'inputorder.php';
</script>";
	}
}

@$mrn = $_POST['mrn'];
@$name = $_POST['name'];
@$lastname = $_POST['lastname'];
$result2 = mysqli_query($conn, "SELECT patientid,mrn,name,lastname,create_date FROM xray_patient WHERE (mrn LIKE '%$mrn%') AND (name LIKE '%$name%') AND (lastname LIKE '%$lastname%') ORDER BY create_date DESC");
$num_rows = mysqli_num_rows($result2);

if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include('head.php'); ?>
		<title>Input Order | Radiographer</title>

	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div class="col-12" style="padding-left: 0;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item"><a href="registration.php">Registration</a></li>
							<li class="breadcrumb-item active">Create Order</li>
						</ol>
					</nav>
				</div>

				<div id="content">
					<div class="body">
						<div id=content>
							<?php
							if ($num_rows  > 0) { ?>
								<div class="container-fluid" style="margin-bottom: 100px;">
									<div class="table-view col-md-12 table-box">
										<table class="table-dicom table-paginate" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
											<thead>
												<tr>
													<th>
														<center>No</center>
													</th>
													<th>
														<center>MRN</center>
													</th>
													<th>
														<center><?= $lang['name'] ?></center>
													</th>
													<th>
														<center><?= $lang['create_date'] ?></center>
													</th>
													<th>
														<center>ACTION</center>
													</th>
													<!-- <th></th> -->
												</tr>
											</thead>
											<?php
											$i = 1;
											while ($row = mysqli_fetch_array($result2)) : ?>
												<tr>
													<td> <?= $i; ?> </td>
													<td> <?= $row['mrn'] ?> </td>
													<td><?= $row['name'] . " " . $row['lastname']  ?></td>
													<td><?= $row['create_date'] ?></td>
													<td width="150">
														<form id="order" action="" method="POST">

															<input name="mrn" type="hidden" id="mrn" value="<?= $row['mrn'] ?>">
															<button class="btn-worklist" type="submit" name="submit" id="button" value="Create Order"><?= $lang['create_order'] ?>
														</form>
													</td>
													<!-- <td width="100"><a href="editpasien.php?patientid=<?= $row['patientid']; ?>" class ="btn-worklist" id="button">EDIT</a></td> -->
												</tr>
												<?php $i++; ?>
											<?php endwhile; ?>
										</table>
									</div>
								</div>
							<?php  } ?>



							<?php if ($num_rows == 0) { ?>

								<center><b>
										<font color=red>Patient not found !!
									</b>Search again or Create new patient </font><br /></center>
							<?php } ?>

						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script>
			$(document).ready(function() {
				$("li[data-target='#products1']").addClass("active");
				$("ul[id='products1'] li[id='regist1']").addClass("active");
			});
		</script>

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>