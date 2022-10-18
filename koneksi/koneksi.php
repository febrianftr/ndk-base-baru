<?php
$database_ris = 'intimedika_base';
$database_pacsio = 'pacsio';
$database_mppsio = 'mppsio';
$conn = mysqli_connect("localhost", "root", "efotoadmin", $database_ris);
$conn_mppsio = mysqli_connect("localhost", "root", "efotoadmin", $database_mppsio);
$conn_pacsio = mysqli_connect("localhost", "root", "efotoadmin", $database_pacsio);
