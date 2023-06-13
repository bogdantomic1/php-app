<?php

$naziv = $_POST['naziv'];

require_once __DIR__ . '/../tabele/Grupa.php';

session_start();
$korisnik = $_SESSION['korisnik_id']; // tip korisnika

$grupa = Grupa::newGroup($naziv);

header('Location: ../rukovodilac_main.php');

die();

