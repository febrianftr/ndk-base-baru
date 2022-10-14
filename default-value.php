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
