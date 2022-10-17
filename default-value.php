<?php

function defaultValue($value)
{
    return $value ?? '-';
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
    return str_replace('^', '', $value);
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

function spendTime($value_updated_time, $value_approved_at, $value_status)
{
    $updated_time = date("Y-m-d H:i", strtotime($value_updated_time));
    $approved_at = date("Y-m-d H:i", strtotime($value_approved_at));
    if ($value_status == 'APPROVED' || $value_status == 'approved') {
        $interval = strtotime($approved_at) - strtotime($updated_time);
        $hour = floor($interval / (60 * 60));
        $minute = $interval - $hour * (60 * 60);
        $minute = $minute / 60;
        $spendTime = "{$hour} jam {$minute} menit";
    } else {
        $spendTime = '-';
    }

    return $spendTime;
}

function styleSex($value)
{
    if ($value == 'M') {
        $sex = '<i style="color: #1f69b7;" class="fas fa-mars"> M</i>';
    } else if ($value == 'L') {
        $sex = '<i style="color: #1f69b7;" class="fas fa-mars"> L</i>';
    } else if ($value == 'P') {
        $sex = '<i style="color: #ff637e;" class="fas fa-venus"> P</i>';
    } else if ($value == 'F') {
        $sex = '<i style="color: #ff637e;" class="fas fa-venus"> F</i>';
    } else if ($value == 'O') {
        $sex = '<i class="fas fa-genderless"> O</i>';
    } else {
        $sex = '-';
    }

    return $sex;
}

function styleStatus($value)
{
    if ($value == 'WAITING' || $value == 'waiting') {
        $status =  '<i style="color: #18A850;" class="fas fa-sync"> Waiting</i>';
    } else if ($value == 'APPROVED' || $value == 'approved') {
        $status =  '<i style="color: #1862B0" class="fas fa-check-square"> Approved</i>';
    } else if ($value == 'backup') {
        $status =  '<i style="color: red" class="fas fa-check-square"> BACK UP</i>';
    } else {
        $status = '-';
    }
    return $status;
}
