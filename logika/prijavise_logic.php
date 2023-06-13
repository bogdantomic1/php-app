<?php 

$username = $_POST['username'];
$password = $_POST['password'];

$password = hash('sha512', $password);
require_once __DIR__ . '/../tabele/Korisnik.php';
$korisnik = Korisnik::login($username, $password);

if($korisnik !== null) {
    session_start();
    $_SESSION['korisnik_id'] = $korisnik->tip_korisnika_id;
    $_SESSION['korisnik'] = $korisnik->id;
    if($korisnik -> tip_korisnika_id == 1){
        header('Location: ../admin_main.php');
    }
    else if($korisnik -> tip_korisnika_id == 2){
        header('Location: ../rukovodilac_main.php');
    }
    else{
        header('Location: ../izvrsilac_main.php');
    }
}

else{
    header('Location: ../prijava.php?error=1');
}
die();
