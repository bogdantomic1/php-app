<?php
session_start();
if(isset($_SESSION['korisnik_id']) && $_SESSION['korisnik_id'] != 1){
    $var = $_SESSION['korisnik_id'];
    if($var == 2){
        header('Location: rukovodilac_main.php');
    }
    else{
        header('Location: izvrsilac_main.php');
    }
}
if(!isset($_SESSION['korisnik_id'])){
    header("Location: prijava.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
</head>
<body>
<a href="logika/izlogujse.php">Odjavi se</a>
<h1>Admin konzola</h1>
</body>
</html>