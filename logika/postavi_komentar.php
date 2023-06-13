<?php

$naslov = $_POST['naslov'];
$text =  $_POST['text'];
$zadatak = $_POST['zadatak'];

require_once __DIR__ . '/../tabele/Komentar.php';
session_start();
$korisnik = $_SESSION['korisnik_id'];
$vreme = date('Y-m-d H:i:s');

$komentar = Komentar::postavi_komentar($naslov, $text, $zadatak, $korisnik, $vreme);

header('Location: ../izvrsilac_main.php');

die();
