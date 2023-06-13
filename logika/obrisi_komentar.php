<?php

$id = $_POST['id'];
$korisnik = $_POST['korisnik'];
require_once __DIR__ . '/../tabele/Komentar.php';
session_start();

if($korisnik !=  $_SESSION['korisnik']){
    header('Location: ../izvrsilac_main.php?ovdejegreska');
    die();
}

if(Komentar::obrisi_komentar($id)){
    header('Location: ../izvrsilac_main.php');
    die();
}
else{
    die();
}