<?php
//uzimanje podataka iz forme
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$ponovi_password = $_POST['ponovi_password'];
$full_name = $_POST['full_name'];
//hashiranje passworda
$password = hash('sha512', $password);
require_once __DIR__ . '/../tabele/Korisnik.php';
$korisnik_id = Korisnik::register($username, $email, $password, 8, $full_name);

if($korisnik_id !== false){
    header('Location: ../prijava.php');
}
else {
    header('Location: ../registration.php?error=podaci');
}


