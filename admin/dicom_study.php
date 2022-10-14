<?php 

require 'koneksi/koneksi_dicom.php';

session_start();

$query = "SELECT * 
		  FROM patient
		  INNER JOIN study ON patient.pk=study.pk ORDER BY pat_name";

$data_dicom = mysqli_query($conn,$query);
 
if ($_SESSION['level'] == "admin") {

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Data Dokter</title>
 	<?php include('head.php'); ?>

 </head>
 <body>
 	<?php include('menu-bar.php'); ?>

	<h1 style="color: #EE7423">DCM</h1>
	<div class="table-view">
		<table border="1" cellpadding="8" cellspacing="0">
			<thead class="thead1">
				<tr>
					<th>Patient Name</th>
					<th>Patient ID Issuer</th>
					<th>Birth Date</th>
					<th>Sex</th>
					<th>Comments</th>
					<th></th>
					<th></th>
					<th>Aksi</th>
				</tr>
			</thead>
			<thead class="thead2">
				<tr>
					<th>Study Date/Time</th>
					<th>Study ID</th>
					<th>Accession No</th>
					<th>Modality</th>
					<th>Description</th>
					<th>#S/#I</th>
					<th>Availability</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($data_dicom)) : ?>
					<?php $online = $row['availability'] = "online"; ?>
					<?php $nama = $row['pat_name']; ?>
					<?php $text = preg_replace('/[^A-Za-z0-9\  ]/', ' ', $nama);?>
				<tr>
					<td><?php echo $text; ?></td>
					<td><?php echo $row['pat_id']; ?></td>
					<td><?php echo $row['pat_birthdate']; ?></td>
					<td><?php echo $row['pat_sex']; ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					<a class="ahref" href="http://192.168.2.91:8080/weasis-pacs-connector/viewer?pat_id=<?php echo $row['pat_id']; ?>">OWV</a>
					</td>
				</tr>
				<tr>
					<td><?php echo $row['study_datetime']; ?></td>
					<td><?php echo $row['study_id']; ?></td>
					<td><?php echo $row['accession_no']; ?></td>
					<td><?php echo $row['mods_in_study']; ?></td>
					<td><?php echo $row['study_desc']; ?></td>
					<td><?php echo $row['num_series'] . "/" . $row['num_instances']; ?></td>
					<td><?php echo $online; ?></td>
					<td><a class="ahref" href="http://192.168.2.91:8080/weasis-pacs-connector/viewer?study_iuid_id=<?php echo $row['study_iuid']; ?>">OWV</a></td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
 <?php include('script-footer.php'); ?>
 </body>
 </html>

<?php } else {header("location:../index.php");} ?>