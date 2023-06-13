<?php

$username = $_POST['username'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$new_password_repeat = $_POST['new_password_repeat'];

$old_password = hash('sha512', $old_password);
$new_password = hash('sha512', $new_password);
require_once __DIR__ . '/../tabele/Korisnik.php';
$korisnik = Korisnik::login($username, $old_password);

if($korisnik != null) {
    Korisnik::change_password($username, $new_password);
    header('Location: prijava.php');
}
else{
    header('Location: promeni_lozinku.php?error=1');
}
