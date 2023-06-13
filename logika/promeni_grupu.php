<?php

$id = $_POST['id'];
$naziv = $_POST['naziv_nove_grupe'];

require_once __DIR__ . '/../tabele/Grupa.php';

Grupa::changeGroup($id, $naziv);

header('Location: ../rukovodilac_main.php');

die();
