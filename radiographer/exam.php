<?php
$uid = $_POST['uid'];
require "phpqrcode/qrlib.php";
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM xray_order WHERE uid = '$uid'");
($row = mysqli_fetch_array($result));
$acc = $row['acc'];
$patientid = $row['mrn'];
$mrn = $row['mrn'];
$name = $row['name'];
$lastname = $row['lastname'];
$sex = $row['sex'];
$address = $row['address'];
$birth_date = $row['birth_date'];
$text2 = preg_replace('/[^A-Za-z0-9\  ]/', '', $birth_date);

$schedule_time = $row['schedule_time'];
$text3 = str_replace(':', '', $schedule_time);

$weight = $row['weight'];
$name_dep = $row['name_dep'];
$xray_type_code = $row['xray_type_code'];
$typename = $row['typename'];
$type = $row['type'];
$prosedur = $row['prosedur'];
$dokterid = $row['dokterid'];
$named = $row['named'];
$lastnamed = $row['lastnamed'];
$email = $row['email'];

$radiographer = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE username = '$username' ");
$row_radiographer = mysqli_fetch_assoc($radiographer);

$radiographer_id = $row_radiographer['radiographer_id'];
$radiographer_name = $row_radiographer['radiographer_name'];
$radiographer_lastname = $row_radiographer['radiographer_lastname'];

$dokradid = $row['dokradid'];
$dokrad_name = $row['dokrad_name'];
$dokrad_lastname = $row['dokrad_lastname'];
$create_time = $row['create_time'];
$schedule_date = $row['schedule_date'];
$text = preg_replace('/[^A-Za-z0-9\  ]/', '', $schedule_date);
$schedule_time = $row['schedule_time'];
$contrast = $row['contrast'];
$priority = $row['priority'];
$pat_state = $row['pat_state'];
$contrast_allergies = $row['contrast_allergies'];
$text2 = preg_replace('/[^A-Za-z0-9\  ]/', '', $birth_date);
$spc_needs = $row['spc_needs'];
$payment = $row['payment'];
$query123 = mysqli_query($conn_mppsio, "SELECT sps_id FROM mwl_item order by pk DESC");
$result123 = mysqli_fetch_assoc($query123);
$sps_id = $result123['sps_id'];
$sps_id2 = str_replace('SPS-xx', '', $sps_id);
$generatesps = $sps_id2 + 1;
if ($generatesps == 1) {
  $generatesps = 3;
}
$codevalue = 'PROT-2018';
$procid = 'SPS-xx' . $generatesps;
$rp = 'RP-00' . $generatesps;
echo $generatesps;
echo $procid;
// $length = 17;
//   $add = '';
//   for ($i=0;$i<$length;$i++){
//   $add .= rand (1, 9);}
// $uid = '27'.'10'.'21'.'08'.$row['acc'].'.'.$row['patientid'].'.'.$text.'.'.$add;
$xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE dataset [
<!ELEMENT dataset (attr*)>
<!ELEMENT attr (#PCDATA | item)*>
<!ELEMENT item (#PCDATA | attr)*>
<!ATTLIST attr tag CDATA #REQUIRED>
]>
<dataset>
  <!-- Specific Character Set -->
     <attr tag="00080005">ISO_IR 192</attr>
     <!-- Scheduled Procedure Step Sequence -->
   <attr tag="00400100">
   <item>
     <!-- Scheduled Station AE Title -->
     <attr tag="00400001">DCMPACS</attr>
     <!-- Scheduled Procedure Step Start Date -->
     <attr tag="00400002">$text</attr>
     <!-- Scheduled Procedure Step Start Time -->
     <attr tag="00400003">$text3</attr>
     <!-- Modality -->
     <attr tag="00080060">$xray_type_code</attr>
     <!-- Scheduled Performing Physician's Name -->
     <attr tag="00400006">$radiographer_name $radiographer_lastname</attr>
     <!-- Scheduled Procedure Step Description -->
     <attr tag="00400007">$prosedur</attr>
     <!-- Scheduled Procedure Step Location -->
     <attr tag="00400011">Scheduled Procedure Step Location</attr>
     <!-- Scheduled Protocol Code Sequence -->
   <attr tag="00400008">
   <item>
     <!-- Code Value -->
     <attr tag="00080100">$codevalue</attr>
     <!-- Coding Scheme Designator -->
     <attr tag="00080102">DCM</attr>
     <!-- Code Meaning -->
     <attr tag="00080104">NA</attr>
   </item>
   </attr>
     <!-- Pre-Medication -->
     <attr tag="00400012">Pre-Medication</attr>
     <!-- Scheduled Procedure Step ID -->
     <attr tag="00400009">$procid</attr>
     <!-- Requested Contrast Agent -->
     <attr tag="00321070">$contrast</attr>
     <!-- Scheduled Procedure Step Status -->
     <attr tag="00400020">SCHEDULED</attr>
   </item>
   </attr>
     <!-- Requested Procedure ID -->
     <attr tag="00401001">$rp</attr>
     <!-- Requested Procedure Description -->
     <attr tag="00321060">$prosedur</attr>
     <!-- Requested Procedure Code Sequence -->
   <attr tag="00321064">
   <item>
     <!-- Code Value -->
     <attr tag="00080100">PROC-1205</attr>
     <!-- Coding Scheme Designator -->
     <attr tag="00080102">DCM</attr>
     <!-- Code Meaning -->
     <attr tag="00080104">$prosedur</attr>
   </item>
   </attr>
     <!-- Study Instance UID -->
     <attr tag="0020000D">$uid</attr>
     <!-- Requested Procedure Priority -->
     <attr tag="00401003">$priority</attr>
     <!-- Accession Number -->
     <attr tag="00080050">$acc</attr>
     <!-- Requesting Physician -->
     <attr tag="00321032">$dokrad_name $dokrad_lastname</attr>
     <!-- Requesting Service -->
     <attr tag="00321033">$name_dep</attr>
     <!-- Referring Physician's Name -->
     <attr tag="00080090">$named $lastnamed</attr>
     <!-- Admission ID -->
     <attr tag="00380010">ADM-1234</attr>
     <!-- Current Patient Location -->
     <attr tag="00380300">$name_dep</attr>
     <!-- Patient's Name -->
      <attr tag="00100010">$name $lastname</attr>
      <!-- Patient ID -->
      <attr tag="00100020">$patientid</attr>
      <!-- Patients Birth Date -->
      <attr tag="00100030">$text2</attr>
      <!-- Patient's Sex -->
      <attr tag="00100040">$sex</attr>
      <!-- Patient's Weight -->
      <attr tag="00101030">$weight</attr>
      <!-- Confidentiality constraint on patient data -->
      <attr tag="00403001">V</attr>
      <!-- Patient State -->
      <attr tag="00380500">$pat_state</attr>
      <!-- Pregnancy Status -->
      <attr tag="001021C0">0000</attr>
      <!-- Medical Alerts -->
      <attr tag="00102000">-</attr>
      <!-- Contrast Allergies -->
      <attr tag="00102110">$contrast_allergies</attr>
      <!-- Special Needs -->
      <attr tag="00380050">$spc_needs</attr>
   </dataset>
XML;
$xml = simplexml_load_string($xmlstr);

file_put_contents('risworklist.xml', $xml->asXML());



$query = "INSERT INTO xray_exam
        (uid,acc,patientid,mrn,name,lastname,sex,birth_date,weight,name_dep,xray_type_code,typename,type,prosedur,dokterid,named,lastnamed,email,radiographer_id,radiographer_name,radiographer_lastname,create_time,schedule_date,schedule_time,contrast,priority,pat_state,contrast_allergies,spc_needs,payment,arrive_date,arrive_time)
        VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$typename', '$type', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs','$payment', NOW(), NOW())";

mysqli_query($conn, $query);


mysqli_query($conn, "DELETE FROM xray_order WHERE uid = '$uid'");
QRcode::png("Nama Patient: $name
ID : $mrn
Pemeriksaan : $prosedur
Schedule Pemeriksaan : $schedule_date $schedule_time", "phpqrcode/ttddokter/$uid.png", "L", 4, 4);
header("location:sendtojava.php");
