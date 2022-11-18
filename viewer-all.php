<?php

// PDF
define('PDFFIRST', '<a style="text-decoration:none;" class="" href="../radiology/pdf/expertise.php?uid=');
define('PDFLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/file.svg" data-toggle="tooltip" title="PDF" style="width: 100%;"></span></a>');

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

define('CHANGEDOCTORICONYES', '<i class="fas fa-user-md fa-lg"></i>');
define('CHANGEDOCTORICONNO', '<i class="fas fa-user-times fa-lg text-warning"></i>');
// Change doctor
define('CHANGEDOCTORFIRST', '<a style="text-decoration: none;" href="changedoctorworklist.php?uid=');
define('CHANGEDOCTORMID', '&dokradid=');
define('CHANGEDOCTORSTAT', '&status=');
define('CHANGEDOCTORLAST', '" onclick=\'return confirm("Ubah dokter radiology yang membaca?");\'><span class="btn rgba-stylish-slight darken-1 btn-inti2">');
define('CHANGEDOCTORVERYLAST', '</span></a>');
//radiant
define('RADIANTFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22');
define('RADIANTLAST', '%22" "target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/radiAnt.png" data-toggle="tooltip" title="Radiant Viewer" style="width: 100%;"></span></a>');

// HOROS
define('HOROSFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="Horos://?methodName=retrieve&serverName=INTIWID&then=open&retrieveOnlyIfNeeded=yes&filterKey=StudyInstanceUID&filterValue=');
define('HOROSLAST', '"target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/horos.svg" data-toggle="tooltip" title="Radiant Viewer" style="width: 100%;"></span></a>');

//ipiview
define('IPIVIEWFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="http://192.168.10.144:8089/ipiview/ipiview/html/start.html?StudyInstanceUID=');
define('IPIVIEWLAST', '" target="_blank"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/eyeyellow.svg" data-toggle="tooltip" title="IPI Viewer" style="width: 100%;"></span></a>');

// inobitec
define('INOBITECFIRST', '<a href="#" class="ahref-edit" onclick="inobitec(');
define('INOBITECLAST', ')"id="inobitec" data-ip="' . $_SERVER['SERVER_NAME'] . '"><span class="btn btn-warning btn-inti"><i class="fas fa-eye" data-toggle="tooltip" title="Web Viewer"></i></span></a>');

// DELETE
define('DELETEFIRST', '<a style="text-decoration:none;" class="ahref-edit" href="deleteworkload.php?uid=');
define('DELETELAST', '"onclick=\'return confirm("Delete data?");\'><span class="btn red lighten-1 btn-intiwid1"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></span></a>');

// EDIT PASIEN
define('EDITPASIENFIRST', '<a href="update-workload.php?uid=');
define('EDITPASIENLAST', '"<span class="btn text-primary rgba-stylish-slight btn-inti2"><img src="../image/redo.svg" data-toggle="tooltip" title="Update" style="width: 100%;"></span></a>');

// EDIT WORKLOAD
define('EDITWORKLOADFIRST', '<a href="workload-edit.php?uid=');
define('EDITWORKLOADLAST', '"><span class="btn text-info rgba-stylish-slight btn-inti2"><img src="../image/edit.svg" data-toggle="tooltip" title="Edit Report" style="width: 100%;"></span></a>');

// telegram dokter pengirim
define('TELEDOKTERPENGIRIMFIRST', '<a style="text-decoration: none;" href="../radiology/telenotif.php?uid=');
define('TELEDOKTERPENGIRIMLAST', '" target="_blank"><span class="btn deep-orange-text rgba-stylish-slight btn-inti2"><img src="../image/telegram2.svg" data-toggle="tooltip" title="Telegram" style="width: 100%;"></span></a>');

// telegram signature
define('TELEGRAMSIGNATUREFIRST', '<a style="text-decoration:none;" href="otp.php?uid=');
define('TELEGRAMSIGNATURELAST', '"><span class="btn text-secondary rgba-stylish-slight btn-inti2"><img src="../image/signature.svg" data-toggle="tooltip" title="Signature" style="width: 100%;"></span></a>');

// pop up read more series
define('READMORESERIESFIRST', '<a href="#" class="hasil-series penawaran-a" data-id="');
define('READMORESERIESLAST', '">Read More</a>');

// integrasi simrs
define('SIMRS', '<i class="fas fa-exchange-alt text-info" style="font-size:0.5rem;" title="terintegrasi dengan SIMRS"></i>');

// priority NORMAL
define('PRIORITYNORMAL', '<i style="color: #2d2; font-size:0.4rem;" class="fas fa-circle"></i>');

// PIORITY CITO
define('PRIORITYCITO', '<i style="color: red; font-size:0.4rem;" class="fas fa-circle"></i>');

// WORKLIST DOKTER BELUM DIBACA
define('WORKLISTFIRST', '<a href="worklist.php?uid=');
define('WORKLISTLAST', '"><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/write2.svg" data-toggle="tooltip" title="Go to Expertise" style="width: 110%;"></span></a>');

// DRAFT DOKTER 
define('DRAFTFIRST', '<a href="worklist.php?uid=');
define('DRAFTLAST', '"><span class="btn btn-warning btn-inti"><i class="fas fa-edit" data-toggle="tooltip" title="Go to expertise"></i></span></a>');

// VIEWER DI WORKLIST ICON LARGE
define('DICOMWORKLISTFIRST', '<a href="jnlp://' . $_SERVER['SERVER_NAME'] . ':19898/weasis-pacs-connector/DCM_viewer.jnlp?studyUID=');
define('DICOMWORKLISTLAST', '"class="button8 delete1"><img src="../image/desktop.svg" style="width: 50px;"><br> <span> Dicom Viewer</span></a>');
define('OHIFWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':82/viewer?StudyInstanceUIDs=');
define('OHIFWORKLISTLAST', '"class="button8 delete1" target="_blank"><img src="../image/smartphone.svg" style="width: 50px;"><br> <span> Mobile Viewer</span></a>');
define('HTMLWORKLISTFIRST', '<a href="http://' . $_SERVER['SERVER_NAME'] . ':19898/intiwid/viewer.html?studyUID=');
define('HTMLWORKLISTLAST', '" class="button8 delete1" target="_blank"><img src="../image/html.svg" style="width: 50px;"><br> <span> HTML Viewer</span></a>');
define('RADIANTWORKLISTFIRST', '<a href="radiant://?n=paet&v=dcmPACS&n=pstv&v=0020000D&v=%22');
define('RADIANTWORKLISTLAST', '%22" class="button8 delete1"><img src="../image/radiAnt.png" style="width: 50px;"><br><span> Radiant</span></a>');
define('HOROSWORKLISTFIRST', '<a href="Horos://?methodName=retrieve&serverName=INTIWID&then=open&retrieveOnlyIfNeeded=yes&filterKey=StudyInstanceUID&filterValue=');
define('HOROSWORKLISTLAST', '"class="button8 delete1"><img src="../image/horos.svg" style="width: 50px;"><br><span> Radiant</span></a>');
