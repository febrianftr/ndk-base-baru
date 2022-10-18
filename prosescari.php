<?php
session_start();
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
$username = $_SESSION['username'];

// kolom untuk order by 
$columns = array('pk', 'pk', 'status', 'patientid', 'mrn', 'pat_name', 'pat_birthdate', 'pat_sex', 'study_desc', 'series_desc', 'mods_in_study',  'named', 'name_dep', 'dokrad_name', 'radiographer_name', 'updated_time', 'approved_at', 'pk');

$query = "SELECT patient.pat_id, 
          patient.pat_name, 
          patient.pat_birthdate, 
          patient.pat_sex,
          study.study_iuid,
          study.study_datetime,
          study.accession_no,
          study.ref_physician,
          study.study_desc,
          study.mods_in_study,
          study.num_series,
          study.num_instances,
          study.retrieve_aets,
          study.updated_time,
          xray_order.mrn,
          xray_order.address,
          xray_order.name_dep,
          xray_order.named,
          xray_order.radiographer_name,
          xray_order.dokrad_name,
          xray_order.create_time,
          xray_order.pat_state,
          xray_order.spc_needs,
          xray_order.payment,
          xray_order.examed_at,
          xray_order.patientid AS no_foto,
          xray_workload.status,
          xray_workload.approved_at
          FROM pacsio.patient AS patient
          JOIN pacsio.study AS study
          ON patient.pk = study.patient_fk
          LEFT JOIN intimedika_base.xray_order AS xray_order
          ON xray_order.uid = study.study_iuid
          LEFT JOIN intimedika_base.xray_workload AS xray_workload
          ON study.study_iuid = xray_workload.uid WHERE ";

if ($_POST["is_date_search"] == "yes") {
  $From = date_create($_POST["From"]);
  $dateFrom = date_format($From, "Y-m-d H:i");

  $to = date_create($_POST["to"]);
  $dateto = date_format($to, "Y-m-d H:i");
  $query .= 'study.updated_time BETWEEN "' . $dateFrom . '" AND "' . $dateto . '" AND ';
}

// kolom untuk mencari LIKE masing2 kolom (SEARCHING)
if (isset($_POST["search"]["value"])) {
  $query .= '
  (mrn LIKE "%' . $_POST["search"]["value"] . '%" 
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
  $mods_in_study = strtoupper($mods_in_study);
  $query .= "AND mods_in_study IN('" . $mods_in_study . "')
 ";
}

// jika keyword nama diketik
if (isset($_POST['keyword']) && $_POST['keyword'] != "") {
  $query .= 'AND pat_name LIKE "%' . $_POST['keyword'] . '%"
 ';
}

// jika mrn diketik
if (isset($_POST['keyword_mrn']) && $_POST['keyword_mrn'] != "") {
  $query .= 'AND pat_id LIKE "%' . $_POST['keyword_mrn'] . '%"
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
  // if ($row['status'] == 'APPROVED') {
  //   $btnStatus = '<a class="" href="update_workload.php?uid=' . $uid . ' "><span class="btn text-primary rgba-stylish-slight btn-inti2"><img src="../image/redo.svg" data-toggle="tooltip" title="Update" style="width: 100%;"></span></a>';
  // } else {
  //   $btnStatus = '<a class="" href="update_workload_before.php?uid=' . $uid . ' "><span class="btn text-primary rgba-stylish-slight btn-inti2"><img src="../image/redo.svg" data-toggle="tooltip" title="Update" style="width: 100%;"></span></a>';
  // }
  // if ($username == 'rafdi') {
  //   $btnHamzah = '<a style="text-decoration:none;" class="ahref-edit" href="deleteworkload.php?uid=' . $uid . '" 
  //   onclick=\'return confirm("Delete data?");\'>
  //   <span class="btn red lighten-1 btn-intiwid1">
  //   <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></span></a>' . CHANGEDOCTORFIRST . $uid . CHANGEDOCTORLAST;
  // } else {
  //   $btnHamzah = '';
  // }

  // if ($row['fromorder'] == "manual" or $row['fromorder'] == NULL) {
  //   $btnSend = '<a href="sendsimrs-sumedang.php?acc=' . $row['acc'] . '&mrn=' . $row['mrn'] . ' "><span class="btn default-color darken-1 btn-intiwid1"><i class="fas fa-share"></i></span></a>';
  // } else {
  //   $btnSend = '';
  // }

  $pat_name = defaultValue($row['pat_name']);
  $pat_sex = styleSex($row['pat_sex']);
  $pat_birthdate = diffDate($row['pat_birthdate']);
  $study_iuid = defaultValue($row['study_iuid']);
  $study_datetime = defaultValue($row['study_datetime']);
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
  $create_time = defaultValueDateTime($row['create_time']);
  $pat_state = defaultValue($row['pat_state']);
  $spc_needs = defaultValue($row['spc_needs']);
  $payment = defaultValue($row['payment']);
  $status = styleStatus($row['status']);
  $approved_at = defaultValueDateTime($row['approved_at']);
  $spendtime = spendTime($updated_time, $approved_at, $row['status']);
  $series_desc = '<a href="#" class="hasil-series penawaran-a" data-id="' . $study_iuid . '">Read More</a>';

  $sub_array = array();
  $sub_array[] = $i;
  $sub_array[] =
    PDFFIRST . $study_iuid . PDFLAST .
    RADIANTFIRST . $study_iuid . RADIANTLAST .
    DICOMFIRST . $study_iuid . DICOMLAST;
  $sub_array[] = $status;
  $sub_array[] = $no_foto;
  $sub_array[] = $pat_id;
  $sub_array[] = removeCharacter($pat_name);
  $sub_array[] = $pat_birthdate;
  $sub_array[] = $pat_sex;
  $sub_array[] = $study_desc;
  $sub_array[] = $series_desc;
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

function get_all_data($conn_pacsio)
{
  $query = "SELECT patient.pat_id, 
  patient.pat_name, 
  patient.pat_birthdate, 
  patient.pat_sex,
  study.study_iuid,
  study.study_datetime,
  study.accession_no,
  study.ref_physician,
  study.study_desc,
  study.mods_in_study,
  study.num_series,
  study.num_instances,
  study.retrieve_aets,
  study.updated_time,
  xray_order.mrn,
  xray_order.address,
  xray_order.name_dep,
  xray_order.named,
  xray_order.radiographer_name,
  xray_order.dokrad_name,
  xray_order.create_time,
  xray_order.pat_state,
  xray_order.spc_needs,
  xray_order.payment,
  xray_order.examed_at,
  xray_order.patientid AS no_foto,
  xray_workload.status,
  xray_workload.approved_at
  FROM pacsio.patient AS patient
  JOIN pacsio.study AS study
  ON patient.pk = study.patient_fk
  LEFT JOIN intimedika_base.xray_order AS xray_order
  ON xray_order.uid = study.study_iuid
  LEFT JOIN intimedika_base.xray_workload AS xray_workload
  ON study.study_iuid = xray_workload.uid";
  $result = mysqli_query($conn_pacsio, $query);
  return mysqli_num_rows($result);
}

$output = array(
  "draw"    => intval($_POST["draw"]),
  "recordsTotal"  =>  get_all_data($conn_pacsio),
  "recordsFiltered" => $number_filter_row,
  "data"    => $data
);

echo json_encode($output);
