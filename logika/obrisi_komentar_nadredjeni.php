<?php

$id = $_POST['id'];

require_once __DIR__ . '/../tabele/Komentar.php';
if(Komentar::obrisi_komentar($id)){
    header('Location: ../rukovodilac_main.php');
    die();
}
else{
    die();
}