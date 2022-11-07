<?php
session_start();
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-dokter-radiology.php';

$username = $_SESSION['username'];
$level = $_SESSION['level'];

// kolom untuk order by 
$columns = array('pk', 'pk', 'status', 'pat_name', 'pat_id', 'patientid', 'pat_birthdate', 'pat_sex', 'study_desc', 'pk', 'mods_in_study', 'named', 'name_dep', 'dokrad_name', 'radiographer_name', 'updated_time', 'approved_at', 'pk');

$row_dokrad = mysqli_fetch_assoc(mysqli_query(
  $conn,
  "SELECT $select_dokter_radiology 
  FROM $table_dokter_radiology 
  WHERE username = '$username'"
));
$pk = $row_dokrad['pk'];

// query ketika login radiologi
$kondisi = " WHERE xray_workload.status = 'approved'
AND xray_workload.pk_dokter_radiology = '$pk'";

$query_base = "SELECT 
              $select_patient,
              $select_study,
              $select_order,
              $select_workload
              FROM $table_patient
              JOIN $table_study
              ON patient.pk = study.patient_fk
              LEFT JOIN $table_order
              ON xray_order.uid = study.study_iuid
              LEFT JOIN $table_workload
              ON study.study_iuid = xray_workload.uid";

// kondisi jika login radiology
if ($level == 'radiology') {
  $query =  $query_base . $kondisi . ' AND ';
} else {
  // kondisi jika login selain radiology
  $query = $query_base . ' WHERE ';
  $kondisi = '';
}

if ($_POST["is_date_search"] == "yes") {
  $from = date_create($_POST["from_updated_time"]);
  $from_updated_time = date_format($from, "Y-m-d H:i");

  $to = date_create($_POST["to_updated_time"]);
  $to_updated_time = date_format($to, "Y-m-d H:i");

  $query .= 'study.updated_time BETWEEN "' . $from_updated_time . '" AND "' . $to_updated_time . '" AND ';
}

// kolom untuk mencari LIKE masing2 kolom (SEARCHING)
if (isset($_POST["search"]["value"])) {
  $query .= '
  (pat_id LIKE "%' . $_POST["search"]["value"] . '%" 
  OR patientid LIKE "%' . $_POST["search"]["value"] . '%" 
  OR pat_name LIKE "%' . $_POST["search"]["value"] . '%" 
  OR pat_birthdate LIKE "%' . $_POST["search"]["value"] . '%"
  OR pat_sex LIKE "%' . $_POST["search"]["value"] . '%"
  OR study_desc LIKE "%' . $_POST["search"]["value"] . '%"
  OR mods_in_study LIKE "%' . $_POST["search"]["value"] . '%" 
  OR named LIKE "%' . $_POST["search"]["value"] . '%"
  OR radiographer_name LIKE "%' . $_POST["search"]["value"] . '%"
  OR study.updated_time LIKE "%' . $_POST["search"]["value"] . '%"
  OR approved_at LIKE "%' . $_POST["search"]["value"] . '%"
  )';
}

// jika modality disearch
if (isset($_POST['mods_in_study']) && $_POST['mods_in_study'] != "") {
  $mods_in_study = implode("','", $_POST['mods_in_study']);
  $mods_in_study = str_replace('\SR', '\\\SR', $mods_in_study);
  $query .= "AND mods_in_study IN('" . $mods_in_study . "')
 ";
}

// jika keyword nama diketik
if (isset($_POST['pat_name']) && $_POST['pat_name'] != "") {
  $pat_name = strtoupper($_POST['pat_name']);
  $query .= 'AND pat_name LIKE "%' . $pat_name . '%"
 ';
}

// jika mrn diketik
if (isset($_POST['mrn']) && $_POST['mrn'] != "") {
  $mrn = strtoupper($_POST['mrn']);
  $query .= 'AND pat_id LIKE "%' . $mrn . '%"
 ';
}

// order by
if (isset($_POST["order"])) {
  $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
  $query .= 'ORDER BY study.updated_time DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
  $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

// echo $query;

$number_filter_row = mysqli_num_rows(mysqli_query($conn_pacsio, $query));

$result = mysqli_query($conn_pacsio, $query . $query1);


$data = array();
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  $pat_name = defaultValue($row['pat_name']);
  $pat_sex = styleSex($row['pat_sex']);
  $pat_birthdate = diffDate($row['pat_birthdate']);
  $study_iuid = defaultValue($row['study_iuid']);
  $study_datetime = defaultValueDateTime($row['study_datetime']);
  $accession_no = defaultValue($row['accession_no']);
  $ref_physician = defaultValue($row['ref_physician']);
  $study_desc = defaultValue($row['study_desc']);
  $mods_in_study = defaultValue($row['mods_in_study']);
  $num_series = defaultValue($row['num_series']);
  $num_instances = defaultValue($row['num_instances']);
  $updated_time = defaultValueDateTime($row['updated_time']);
  $pat_id = defaultValue($row['pat_id']);
  $no_foto = defaultValue($row['no_foto']);
  $address = defaultValue($row['address']);
  $name_dep = defaultValue($row['name_dep']);
  $named = defaultValue($row['named']);
  $radiographer_name = defaultValue($row['radiographer_name']);
  $dokrad_name = defaultValue($row['dokrad_name']);
  $dokradid = defaultValue($row['dokradid']);
  $create_time = defaultValueDateTime($row['create_time']);
  $pat_state = defaultValue($row['pat_state']);
  $spc_needs = defaultValue($row['spc_needs']);
  $payment = defaultValue($row['payment']);
  $status = styleStatus($row['status']);
  $fromorder = $row['fromorder'];
  $approved_at = defaultValueDateTime($row['approved_at']);
  $spendtime = spendTime($updated_time, $approved_at, $row['status']);
  $pk_dokter_radiology = $row['pk_dokter_radiology'];
  //kondisi status change doctor
  if ($row['status'] == 'approved') {
    $workloadstat = 'approved';
  } else {
    $workloadstat = 'waiting';
  }
  //kondisi status change doctor
  // kondisi session level ketika login
  $level = $_SESSION['level'];
  if ($level == 'radiology') {
    $level =
      RADIANTFIRST . $study_iuid . RADIANTLAST .
      HTMLFIRST . $study_iuid . HTMLLAST .
      OHIFMOBILEFIRST . $study_iuid . OHIFMOBILELAST .
      CHANGEDOCTORFIRST . $study_iuid . CHANGEDOCTORMID . $dokradid . CHANGEDOCTORSTAT . $workloadstat . CHANGEDOCTORLAST .
      EDITWORKLOADFIRST . $study_iuid . EDITWORKLOADLAST .
      TELEDOKTERPENGIRIMFIRST . $study_iuid . TELEDOKTERPENGIRIMLAST .
      TELEGRAMSIGNATUREFIRST . $study_iuid . TELEGRAMSIGNATURELAST;
  } else if ($level == 'radiographer') {
    $level =  RADIANTFIRST . $study_iuid . RADIANTLAST .
      HTMLFIRST . $study_iuid . HTMLLAST .
      OHIFMOBILEFIRST . $study_iuid . OHIFMOBILELAST .
      EDITPASIENFIRST . $study_iuid . EDITPASIENLAST .
      CHANGEDOCTORFIRST . $study_iuid . CHANGEDOCTORMID . $dokradid . CHANGEDOCTORSTAT . $workloadstat . CHANGEDOCTORLAST .
      TELEDOKTERPENGIRIMFIRST . $study_iuid . TELEDOKTERPENGIRIMLAST;
    // DELETEFIRST . $study_iuid . DELETELAST;
  } else if ($level == 'refferal') {
    $level = DICOMFIRST . $study_iuid . DICOMLAST;
  } else {
    $level = '-';
  }

  // kondisi ketika data dari simrs
  if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
    $badge = SIMRS;
  } else {
    $badge = '';
  }

  $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $row['study_iuid'] . '">' . removeCharacter($pat_name) . '</a>';


  // kondisi mencari ditabel dokter radiology
  $row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
      FROM $table_dokter_radiology 
      WHERE pk = '$pk_dokter_radiology'"
  ));

  if ($row['status'] == 'waiting' || $row['status'] == '') {
    // jika status waiting kalo ada dokradid di xray_order tampilkan di xray_order
    $dokrad_name = defaultValue($row['dokrad_name']);
  } else if ($row['status'] == 'approved') {
    // jika status approved ambil data dari pk_dokter_radiology tabel xray_dokter_radiology
    $dokrad_name = defaultValue($row_dokrad['dokrad_fullname']);
  }

  $sub_array = array();
  $sub_array[] = $i;
  $sub_array[] =
    PDFFIRST . $study_iuid . PDFLAST .
    $level;
  $sub_array[] = $status . '&nbsp;' . $badge;
  $sub_array[] = $detail;
  $sub_array[] = $pat_id;
  $sub_array[] = $no_foto;
  $sub_array[] = $pat_birthdate;
  $sub_array[] = $pat_sex;
  $sub_array[] = $study_desc;
  $sub_array[] = READMORESERIESFIRST . $study_iuid . READMORESERIESLAST;
  $sub_array[] = $mods_in_study;
  $sub_array[] = $named;
  $sub_array[] = $name_dep;
  $sub_array[] = $dokrad_name;
  $sub_array[] = $radiographer_name;
  $sub_array[] = $updated_time;
  $sub_array[] = $approved_at;
  $sub_array[] = $spendtime;
  $sub_array[]  = $i++;
  $data[] = $sub_array;
}

function get_all_data($val_con, $val_query)
{
  $result = mysqli_query($val_con, $val_query);
  return mysqli_num_rows($result);
}

$output = array(
  "draw"    => intval($_POST["draw"]),
  "recordsTotal"  =>  get_all_data($conn_pacsio, $query_base . $kondisi),
  "recordsFiltered" => $number_filter_row,
  "data"    => $data
);

echo json_encode($output);
