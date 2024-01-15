<?php

function defaultValue($value)
{
    return $value ?? '-';
}

function defaultValueNumber($value)
{
    return $value ?? 0;
}

function defaultValueDate($value)
{
    return isset($value) ? date('d-m-Y', strtotime($value)) : '-';
}

function defaultValueDateTime($value)
{
    return isset($value) ? date('d-m-Y H:i', strtotime($value)) : '-';
}

function removeCharacter($value)
{
    return str_replace('^', ' ', $value);
}

function diffDate($value)
{
    if (isset($value)) {
        $bday = new DateTime(date('Y-m-d', strtotime($value)));
        $today = new DateTime(date('Y-m-d'));
        $diff = $today->diff($bday);
        $result = $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D';
    } else {
        $result = '-';
    }

    return $result;
}

function spendTime($value_study_datetime, $value_approved_at, $value_status)
{
    $study_datetime = date("Y-m-d H:i", strtotime($value_study_datetime));
    $approved_at = date("Y-m-d H:i", strtotime($value_approved_at));
    if ($value_status == 'APPROVED' || $value_status == 'approved') {
        $interval = strtotime($approved_at) - strtotime($study_datetime);
        $hour = floor($interval / (60 * 60));
        $minute = $interval - $hour * (60 * 60);
        $minute = $minute / 60;
        $spendTime = "{$hour} jam {$minute} menit";
    } else {
        $spendTime = '-';
    }

    return $spendTime;
}

function hour($value_study_datetime, $value_status, $value_priority, $value_mods_in_study, $value_contrast, $value_study_desc_pacsio)
{
    date_default_timezone_set('Asia/Jakarta');
    $study_datetime = date("Y-m-d H:i", strtotime($value_study_datetime));
    $datenow = date("Y-m-d H:i");
    if (strtolower($value_status) == 'waiting') {
        $interval =  strtotime($datenow) - strtotime($study_datetime);
        $hour = floor($interval / (60 * 60));
        $minute = $interval - $hour * (60 * 60);
        $minute = $minute / 60;
        $resulthour = "{$hour}";
    } else {
        $resulthour = '-';
    }

    if ($resulthour >= 6 && strtolower($value_priority) == "normal" && ($value_mods_in_study == "DX" || $value_mods_in_study == "CR" || $value_mods_in_study == "DX\\CR") && $value_contrast == 0) {
        // jika pasien lebih dari 6 jam && prioritas NORMAL && (modalitas DX || CR || DX\CR) && non contrast
        $blinking = "blinking-6-hour ";
    } else if ($resulthour >= 12 && strtolower($value_priority) == "normal" && ($value_mods_in_study == "CT" || $value_mods_in_study == "CT\\SR") && $value_contrast == 0) {
        // jika pasien lebih dari 12 jam && prioritas NORMAL && (modalitas CT || CT\SR) && non contrast
        $blinking = "blinking-12-hour ";
    } else if ($resulthour >= 24 && strtolower($value_priority) == "normal" && $value_contrast == 1 && ($value_mods_in_study == "CT" || $value_mods_in_study == "CT\\SR" || $value_mods_in_study == "DX" || $value_mods_in_study == "CR" || $value_mods_in_study == "DX\\CR")) {
        // jika pasien lebih dari 24 jam && prioritas NORMAL && (modalitas CT || CT\SR || DX || CR || DX\CR) && contrast
        $blinking = "blinking-24-hour ";
    } else if ($resulthour >= 24 && strtolower($value_priority) == "normal" && $value_mods_in_study == "US" && strtolower($value_study_desc_pacsio) == "usg vasculer") {
        // jika pasien lebih dari 24 jam && prioritas NORMAL && (modalitas US dan USG VASCULER)
        $blinking = "blinking-24-hour ";
    } else if ($resulthour >= 3 && strtolower($value_priority) == "normal" && $value_mods_in_study == "US" && strtolower($value_study_desc_pacsio) != "vasculer") {
        // jika pasien lebih dari 3 jam && prioritas NORMAL && modalitas US && bukan study vasculer
        $blinking = "blinking-3-hour ";
    } else if ($resulthour >= 1 && strtolower($value_priority) == "cito") {
        // jika pasien lebih dari 1 jam && prioritas CITO
        $blinking = "blinking-cito ";
    } else {
        $blinking = "";
    }

    return $blinking;
}

function styleSex($value)
{
    if ($value == 'M') {
        $sex = '<i style="font-size: 14px; color: #1ecef7;" class="fas fa-mars"> M</i>';
    } else if ($value == 'L') {
        $sex = '<i style="font-size: 14px; color: #1ecef7;" class="fas fa-mars"> L</i>';
    } else if ($value == 'P') {
        $sex = '<i style="font-size: 14px; color: #ff9bca;" class="fas fa-venus"> P</i>';
    } else if ($value == 'F') {
        $sex = '<i style="font-size: 14px; color: #ff9bca;" class="fas fa-venus"> F</i>';
    } else if ($value == 'O') {
        $sex = '<i class="fas fa-genderless"> O</i>';
    } else {
        $sex = '-';
    }

    return $sex;
}

function styleStatus($value, $study_iuid)
{
    if ($value == 'WAITING' || $value == 'waiting') {
        $status =  '<i style="font-size: 14px; color: #25FF51;" class="fas fa-sync"> Waiting</i>';
    } else if ($value == 'APPROVED' || $value == 'approved') {
        $status =  '<i class="fa fa-history text-success" title="Expertise History" aria-hidden="true"></i> <a href="workload-fill-detail.php?study_iuid=' . $study_iuid . '"><i style="font-size: 14px; color: #25CCFF" class="fas fa-check-square"> Approved</i></a>';
    } else if ($value == 'backup') {
        $status =  '<i style="font-size: 14px; color: red" class="fas fa-check-square"> BACK UP</i>';
    } else {
        $status = '-';
    }
    return $status;
}

function contrast($value)
{
    if ($value == 0) {
        $contrast = "Tidak Kontras";
    } else if ($value == 1) {
        $contrast = "Kontras";
    } else {
        $contrast = "-";
    }

    return $contrast;
}
