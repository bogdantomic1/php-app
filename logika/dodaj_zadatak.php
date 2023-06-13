<?php

$naslov = $_POST['naslov'];
$opis = $_POST['opis'];
$rok = $_POST['rok'];
$prioritet = $_POST['prioritet'];
$id_grupe = $_POST['grupe'];
$id_izvr = $_POST['izvrsilac'];
session_start();
$id_ruko = $_SESSION['korisnik'];
require_once __DIR__ . '/../tabele/Zadatak.php';

$zadatak = Zadatak::newZadatak($naslov, $opis, $id_izvr, $id_ruko, $rok, $prioritet, $id_grupe);

header('Location: ../rukovodilac_main.php');

die();