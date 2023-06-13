<?php

$id = $_POST['id'];

require_once __DIR__ . '/../tabele/Zadatak.php';

if(Zadatak::obrisi_zadatak($id)){
    header('Location: ../rukovodilac_main.php');
    die();
}
else{
    die();
}