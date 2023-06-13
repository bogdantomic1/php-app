<?php

$id = $_POST['id_obrisi'];


require_once __DIR__ . '/../tabele/Grupa.php';

if(Grupa::deleteGroup($id)){
header('Location: ../rukovodilac_main.php');
die();
}

else(header('Location: ../rukovodilac_main.php?greska'));

