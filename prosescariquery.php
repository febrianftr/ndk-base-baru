<?php
//fetch.php
require 'koneksi/koneksi.php';

require 'viewer-all.php';
$columns = array('pk', 'pk', 'status', 'patientid', 'mrn', 'name', 'birth_date', 'sex', 'prosedur', 'series_desc', 'num_series', 'num_instances', 'xray_type_code',  'named', 'name_dep', 'dokrad_name', 'radiographer_name', 'updated_time', 'approve_date', 'pk');

$query = "SELECT * FROM xray_workload_radiographer WHERE ";

if ($_POST["is_date_search"] == "yes") {
  $From = date_create($_POST["From"]);
  $dateFrom = date_format($From, "Y-m-d H:i");

  $to = date_create($_POST["to"]);
  $dateto = date_format($to, "Y-m-d H:i");
  $query .= 'updated_time BETWEEN "' . $dateFrom . '" AND "' . $dateto . '" AND ';
}

if (isset($_POST["search"]["value"])) {
  $query .= '
  (pk LIKE "%' . $_POST["search"]["value"] . '%"
  OR status LIKE "%' . $_POST["search"]["value"] . '%"
  OR patientid LIKE "%' . $_POST["search"]["value"] . '%" 
  OR mrn LIKE "%' . $_POST["search"]["value"] . '%" 
  OR name LIKE "%' . $_POST["search"]["value"] . '%" 
  OR birth_date LIKE "%' . $_POST["search"]["value"] . '%" 
  OR sex LIKE "%' . $_POST["search"]["value"] . '%"
  OR prosedur LIKE "%' . $_POST["search"]["value"] . '%" 
  OR series_desc LIKE "%' . $_POST["search"]["value"] . '%"
  OR num_series LIKE "%' . $_POST["search"]["value"] . '%" 
  OR num_instances LIKE "%' . $_POST["search"]["value"] . '%" 
  OR xray_type_code LIKE "%' . $_POST["search"]["value"] . '%" 
  OR named LIKE "%' . $_POST["search"]["value"] . '%"
  OR name_dep LIKE "%' . $_POST["search"]["value"] . '%" 
  OR dokrad_name LIKE "%' . $_POST["search"]["value"] . '%" 
  OR radiographer_name LIKE "%' . $_POST["search"]["value"] . '%"
  OR updated_time LIKE "%' . $_POST["search"]["value"] . '%"
  OR approve_date LIKE "%' . $_POST["search"]["value"] . '%")
 ';
}

if (isset($_POST['modality']) && $_POST['modality'] != "") {
  $modality = implode("','", $_POST['modality']);
  $query .= "
 AND xray_type_code IN('" . $modality . "')
 ";
}

if (isset($_POST['keyword']) && $_POST['keyword'] != "") {
  $query .= '
 AND CONCAT (name," ",lastname) LIKE "%' . $_POST['keyword'] . '%"
 ';
}

if (isset($_POST['keyword_mrn']) && $_POST['keyword_mrn'] != "") {
  $query .= '
 AND mrn LIKE "%' . $_POST['keyword_mrn'] . '%"
 ';
}

if (isset($_POST['keyword_patientid']) && $_POST['keyword_patientid'] != "") {
  $query .= '
 AND patientid LIKE "%' . $_POST['keyword_patientid'] . '%"
 ';
}

if (isset($_POST["order"])) {
  $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
  $query .= 'ORDER BY updated_time DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
  $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  $uid = $row['uid'];
  $query2 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
  $row2 = mysqli_fetch_assoc($query2);
  $body_part_series = $row2['body_part'];
  $prosedur = $row['prosedur'];
  if ($prosedur == '') {
    $prosedur1 = $body_part_series;
  } else {
    $prosedur1 = $prosedur;
  }
  $name = $row['name'];
  $name = str_replace('^', ' ', $name);
  $fullname = $name . ' ' . $row['lastname'];
  $fullname = utf8_encode($fullname);
  $birth_date = $row['birth_date'];
  $status = $row['status'];
  if ($status == 'ready to approve') {
    $status1 =  '<i style="color: #3DA83D;" class="fas fa-sync"> Waiting</i>';
  } else if ($status == 'APPROVED') {
    $status1 =  '<i style="color: #329ECF" class="fas fa-check-square"> Approved</i>';
  }
  $bday = new DateTime($birth_date);
  $today = new DateTime(date('y-m-d'));
  $diff = $today->diff($bday);
  $named = $row['named'];
  $named = str_replace('^', ' ', $named);
  $fullnamed = $named . ' ' . $row['lastnamed'];
  $fulldokradname = $row['dokrad_name'] . ' ' . $row['dokrad_lastname'];
  $radiographer_name = $row['radiographer_name'];
  $radiographer_name = str_replace('^', ' ', $radiographer_name);
  $fullradiographername = $radiographer_name . ' ' . $row['radiographer_lastname'];
  $src_aet = $row['src_aet'];
  if ($src_aet == "NX_IGD") {
    $src_aet1 = "R. IGD";
  } else if ($src_aet == "NX_DEFAULT1") {
    $src_aet1 = "R. ARAFAH 1";
  } else if ($src_aet == "NX_DEFAULT2") {
    $src_aet1 = "R. ARAFAH 2";
  } else if ($src_aet == "FLC_STORE_SCU") {
    $src_aet1 = "Siemens";
  } else {
    $src_aet1 = "";
  }
  $updated_time = $row["updated_time"];
  $updated_time = date("d-m-Y H:i", strtotime($updated_time));
  $approve = $row["approve_date"] . ' ' . $row["approve_time"];
  $complete = $row["complete_date"] . ' ' . $row["complete_time"];
  if (!empty($approve == 0)) {
    $approve1 = " ";
  } else {
    $approve1 = date("d-m-Y H:i", strtotime($approve));
  }
  $sex = $row['sex'];
  if ($sex == 'M') {
    $sex1 = '<i style="color: blue;" class="fas fa-mars"></i> M';
  } else if ($sex == 'L') {
    $sex1 = '<i style="color: blue;" class="fas fa-mars"></i> L';
  } else if ($sex == 'P') {
    $sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> P';
  } else if ($sex == 'F') {
    $sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> F';
  } else if ($sex == 'O') {
    $sex1 = '<i class="fas fa-genderless"></i> O';
  } else {
    $sex1 = '.';
  }
  $hasil = "";
  $series_desc1 = '<a href="#" class="edit-record1 penawaran-a" data-id="' . $uid . '">Read More</a>';
  // $series_desc = $row['series_desc'];
  // $series_desc1 = substr($series_desc, 0, 10);
  // if ($series_desc > $series_desc1) {
  //   $hasil .= '<a href="#" class="edit-record1 penawaran-a" data-id="' . $uid . '">Read More</a>';
  // } else {
  //   "";
  // }
  // if ($series_desc1 >= 2) {
  //   $series_desc1;
  // }
  $awal  = strtotime($complete); //waktu awal
  $akhir = strtotime($approve); //waktu akhir
  $diff1  = $akhir - $awal;
  $jam   = floor($diff1 / (60 * 60));
  $menit = $diff1 - $jam * (60 * 60);
  if (!empty($approve == 0) or !empty($complete == 0)) {
    $spendtime = '';
  } else {
    $spendtime = $jam .  ' jam, ' . floor($menit / 60) . ' menit';
  }
  $sub_array = array();
  $sub_array[] = $i;
  $sub_array[] = PDFFIRST . $uid . PDFLAST .
    RADIANTFIRST . $uid . RADIANTLAST .
    DICOMFIRST . $uid . DICOMLAST .
    OHIFMOBILEFIRST . $uid . OHIFMOBILELAST .
    // OHIFFIRST . $uid . OHIFLAST .
    HTMLFIRST . $uid . HTMLLAST;
  $sub_array[] = $status1;
  $sub_array[] = $row["patientid"];
  $sub_array[] = $row["mrn"];
  $sub_array[] = $fullname;
  $sub_array[] = $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D';
  $sub_array[] = $sex1;
  $sub_array[] = $prosedur1;
  $sub_array[] = $series_desc1 . '<br /> ' . $hasil;
  $sub_array[] = $row["num_series"];
  $sub_array[] = $row["num_instances"];
  $sub_array[] = $row["xray_type_code"];
  $sub_array[] = $fullnamed;
  $sub_array[] = $row["name_dep"];
  $sub_array[] = $fulldokradname;
  $sub_array[] = $fullradiographername;
  $sub_array[] = $updated_time;
  $sub_array[] = $approve1;
  $sub_array[] = $spendtime;
  $i++;
  $data[] = $sub_array;
}

function get_all_data($conn)
{
  $query = "SELECT * FROM xray_workload_radiographer";
  $result = mysqli_query($conn, $query);
  return mysqli_num_rows($result);
}

$output = array(
  "draw"    => intval($_POST["draw"]),
  "recordsTotal"  =>  get_all_data($conn),
  "recordsFiltered" => $number_filter_row,
  "data"    => $data
);

echo json_encode($output);
