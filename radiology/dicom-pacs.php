<?php
require '../koneksi/koneksi.php';
session_start();
$query2 = "SELECT * 
		   FROM study 
		   INNER JOIN patient 
		   ON study.patient_fk = patient.pk
		   INNER JOIN series
		   ON patient.pk = series.study_fk GROUP BY pat_name  ";
$data_dicom2 = mysqli_query($conn_pacs,$query2);

if ($_SESSION['level'] == "radiology") {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Data Dokter</title>
		<?php include('head.php'); ?>
	</head>
	<body>
		<?php include('menu-bar.php'); ?>br
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Worklist-pacs</li>
				<li style="float: right;">
						<label>Zoom</label>
						<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
						<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
					</li>
			</ol>
		</nav>
	

	<div id="container1">
		<div id="content1">
	<div class="body">
		<h1 style="color: #EE7423">YOUR WORKLIST PACS</h1>
		<div class="container-fluid">
			<div class="table-view" style="overflow-x:auto;">
				<table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
					<thead class="thead1">
					<tr>
						<th>accession no</th>
						<th>patient id</th>
						<th>patient name</th>
						<th>age</th>
						<th>patient sex</th>
						<th>modality</th>
						<th>study desc</th>
						<!-- <th>#series</th>
						<th>#img</th> -->
						<th>radiorapher</th>
						<th>referral</th>
						<th>time</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
						<?php while ($row2 = mysqli_fetch_assoc($data_dicom2)) : ?>
						<?php $pat_birthdate = $row2['pat_birthdate'];
                        	  $bday = new DateTime($pat_birthdate);
			            	  $today = new DateTime(date('y-m-d'));
			            	  $diff = $today->diff($bday);
			            	  $pat_name = $row2['pat_name'];
							  $pat_name1 = preg_replace('/[^A-Za-z\ ]/', '', $pat_name); 
							  $pat_sex = $row2['pat_sex'];
						?>
						<tr>
							<td><?php echo $row2['accession_no']; ?></td>
							<td><?php echo $row2['pat_id']; ?></td>
							<td><?php echo $pat_name1; ?></td>
							<td><?php echo $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D'; ?></td>
							<td>
								<?php if ($pat_sex == 'M') { ?>
									<!-- kalo cowo- -->
									<i style="color: blue;" class="fas fa-mars"></i> M
								<?php } else if ($pat_sex == 'F') { ?>
									<!-- kalo cewek -->
									<i style="color: #ff637e;" class="fas fa-venus"></i> F
								<?php } else if ($pat_sex == 'O') { ?>
									<!-- other -->
									<i class="far fa-genderless"></i> O
								<?php } ?>
							</td>
							<td><?php echo $row2['mods_in_study']; ?></td>
							<td><?php echo $row2['study_desc']; ?></td>
							<!-- <td><?php echo $row2['num_series']; ?></td>
							<td><?php echo $row2['num_instances']; ?></td> -->
							<td><?php echo $row2['perf_physician']; ?></td>
							<td><?php echo $row2['ref_physician']; ?></td>
							<td><?php echo $row2['updated_time']; ?></td>
							<?php 
								$img = $row2['img'];
								$result1 = mysqli_query($conn_pacs, "SELECT * FROM study WHERE img = '$img' ");
								$row1 = mysqli_fetch_assoc($result1);
								$img1 = $row1['img'];
								if (!$img1) { ?>
								<td><a href="worklist-pacs.php?study_iuid=<?= $row2['study_iuid']; ?>">
								<img src="../image/edit.png" style="width: 20px;">
								</a></td>
							<?php } else { ?>
								<td>
								<img src="../image/edit1.png" style="width: 20px;">
								</td>
							<?php } ?>
						</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	<div class="footerindex">
    <div class="">
          <div class="footer-login col-sm-12"><br>
            <center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
          </div> 
        </div>
</div>
</div>
	<?php include('script-footer.php'); ?>
	
</body>
</html>
<?php } else {header("location:../index.php");} ?>