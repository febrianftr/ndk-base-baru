<?php 

require 'function_radiographer.php';

$patientid = $_GET['patientid'];

$result = mysqli_query($conn,"SELECT * FROM xray_patient");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Xra</title>
</head>
<body>

</body>
</html>