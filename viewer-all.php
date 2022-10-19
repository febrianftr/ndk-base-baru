<?php

// PDF
define('PDFFIRST', '<a style="text-decoration:none;" class="" href="../radiology/pdf/testpdf4.php?uid=');
define('PDFLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;">
<img src="../image/file.svg" data-toggle="tooltip" title="PDF" style="width: 100%;"></span></a>');

// DICOM
define('DICOMFIRST', '<a style="text-decoration:none;" href="jnlp://' . $_SERVER['SERVER_NAME'] . ':19898/weasis-pacs-connector/DCM_viewer.jnlp?studyUID=');
define('DICOMLAST', '"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyered.svg" data-toggle="tooltip" title="Dicom Viewer" style="width: 100%;"></span></a>');

// HTML
define('HTMLFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':19898/intiwid/viewer.html?studyUID=');
define('HTMLLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeyellow.svg" data-toggle="tooltip" title="HTML Viewer" style="width: 100%;"></span></a>');

// OHIF (MOBILE)

if ($_SERVER['SERVER_NAME'] == '103.111.207.70') {
    define('OHIFMOBILEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':82/viewer?StudyInstanceUIDs=');
    define('OHIFMOBILELAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeblue.svg" data-toggle="tooltip" title="Web Viewer" style="width: 100%;"></span></a>');
} else {
    define('OHIFMOBILEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':82/viewer?StudyInstanceUIDs=');
    define('OHIFMOBILELAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeblue.svg" data-toggle="tooltip" title="Web Viewer" style="width: 100%;"></span></a>');
}

// OHIF LAMA

if ($_SERVER['SERVER_NAME'] == '103.111.207.70') {
    define('OHIFFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':92/viewer/');
    define('OHIFLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyegreen.svg" data-toggle="tooltip" title="Tab Viewer" style="width: 100%;"></span></a>');
} else {
    define('OHIFFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':91/viewer/');
    define('OHIFLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyegreen.svg" data-toggle="tooltip" title="Tab Viewer" style="width: 100%;"></span></a>');
}
// Mobile

define('MOBILEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://' . $_SERVER['SERVER_NAME'] . ':19898/dwv-viewer/index.html?type=manifest&input=%2Fweasis-pacs-connector%2Fmanifest%3FseriesUID%3D');
define('MOBILELAST', '"target="_blank"><span class="btn btn-warning btn-inti"><i class="fas fa-eye" data-toggle="tooltip" title="Web Viewer"></i></span></a>');

// Change doctor

define('CHANGEDOCTORFIRST', '<a style="text-decoration: none;" href="changedoctorworklist.php?uid=');
define('CHANGEDOCTORLAST', '" onclick=\'return confirm("Ubah dokter radiology yang membaca?");\'><span class="btn yellow darken-1 btn-intiwid1"><i class="fas fa-user-md"></i></span></a>');
// http://36.92.153.227:19898/dwv-viewer/index.html?type=manifest&input=%2Fweasis-pacs-connector%2Fmanifest%3FstudyUID%3D1.3.51.0.7.11564725948.34074.16711.35059.47502.2920.19866

//radiant
define('RADIANTFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22');
define('RADIANTLAST', '%22" "target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/radiAnt.png" data-toggle="tooltip" title="Radiant Viewer" style="width: 100%;"></span></a>');
//Radiant

//ipiview
define('IPIVIEWFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://192.168.10.144:8089/ipiview/ipiview/html/start.html?StudyInstanceUID=');
define('IPIVIEWLAST', '" target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeyellow.svg" data-toggle="tooltip" title="IPI Viewer" style="width: 100%;"></span></a>');
//ipiview

// inobitec
define('INOBITECFIRST', '<a href="#" class="ahref-edit" onclick="inobitec(');
define('INOBITECLAST', ')"id="inobitec" data-ip="' . $_SERVER['SERVER_NAME'] . '"><span class="btn btn-warning btn-inti"><i class="fas fa-eye" data-toggle="tooltip" title="Web Viewer"></i></span></a>');
// inobitec

// DELETE
define('DELETEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="deleteworkload.php?uid=');
define('DELETELAST', '"onclick=\'return confirm("Delete data?");\'><span class="btn red lighten-1 btn-intiwid1"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></span></a>');
// DELETE

// EDIT PASIEN
define('EDITPASIENFIRST', '<a href="update_workload.php?uid=');
define('EDITPASIENLAST', '"<span class="btn text-primary rgba-stylish-slight btn-inti2"><img src="../image/redo.svg" data-toggle="tooltip" title="Update" style="width: 100%;"></span></a>');
// EDIT PASIEN

// EDIT WORKLOAD
define('EDITWORKLOADFIRST', '<a href="workload-edit.php?uid=');
define('EDITWORKLOADLAST', '"><span class="btn text-info rgba-stylish-slight btn-inti2"><img src="../image/edit.svg" data-toggle="tooltip" title="Edit Report" style="width: 100%;"></span></a>');
// EDIT WORKLOAD

// telegram dokter pengirim
define('TELEDOKTERPENGIRIMFIRST', '<a style="text-decoration: none;" href="../radiology/telenotif.php?uid=');
define('TELEDOKTERPENGIRIMLAST', '" target="_blank"><span class="btn deep-orange-text rgba-stylish-slight btn-inti2"><img src="../image/telegram2.svg" data-toggle="tooltip" title="Telegram" style="width: 100%;"></span></a>');
// telegram dokter pengirim

// telegram signature
define('TELEGRAMSIGNATUREFIRST', '<a style="text-decoration:none;" href="otp.php?uid=');
define('TELEGRAMSIGNATURELAST', '"><span class="btn text-secondary rgba-stylish-slight btn-inti2"><img src="../image/signature.svg" data-toggle="tooltip" title="Signature" style="width: 100%;"></span></a>');
// telegram signature

// pop up read more series
define('READMORESERIESFIRST', '<a href="#" class="hasil-series penawaran-a" data-id="');
define('READMORESERIESLAST', '">Read More</a>');
// pop up read more series

// pop up read more info
define('READMOREINFOFIRST', '<a href="#" class="hasil-all penawaran-a" data-id=');
define('READMOREINFOLAST', '"><span class="btn blue lighten-1 btn-intiwid1"><i class="fas fa-info" data-toggle="tooltip" title="Delete"></i></span></a>');

// integrasi simrs
define('SIMRS', '<i class="fas fa-exchange-alt text-info" font-size:0.5rem;" title="terintegrasi dengan SIMRS"></i>');
