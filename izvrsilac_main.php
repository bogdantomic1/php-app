<?php
session_start();
if(isset($_SESSION['korisnik_id']) && $_SESSION['korisnik_id']!= 8){
    $var = $_SESSION['korisnik_id'];
    if($var == 1){
        header('Location: admin_main.php');
    }
    else if($var == 2){
        header('Location: rukovodilac_main.php');
    }
    else{
        header('Location: izvrsilac_main.php');
    }
}
if(!isset($_SESSION['korisnik_id'])){
    header("Location: prijava.php");
}

require_once __DIR__ . '/tabele/Zadatak.php';
$var = $_SESSION['korisnik'];
$zadatak = Zadatak::getAll($var);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izvrsilac</title>
    <link rel="stylesheet" href="css/izvrsilac_main.css">
</head>
<body>
    <?php require_once __DIR__ . '/tabele/Korisnik.php';
    $kor = Korisnik::getById($_SESSION['korisnik']);
    ?>
    <h1>Izvrsilac</h1>
    <span class="izvrsilac"><?= $kor->ime_prezime ?></span><br>


    <div class="input">
        <form action="logika/postavi_komentar.php" method="POST">
            <input type="text" name="naslov" placeholder="Naslov"><br>
            <textarea name="text"> </textarea><br>
            <select name="zadatak" id="zadatak">
            <?php foreach ($zadatak as $z): ?>
                <option value ='<?= $z->id ?>'> <?=$z->naslov?> </option>
            <?php endforeach ?>   
            </select><br>
            <button type="submit">Postavi komentar</button>
        </form>
    </div>

    <div class="zadaci-container">
    <?php foreach ($zadatak as $z): ?>
        <div class="zadatak">
            <span class="naslov"><?= $z->naslov ?></span> <br>
            <span class="opis"><?= $z->opis ?></span><br>

            <?php $izvrsilac_je = $z->izvrsilac_id; ?>
            <?php $rukovodilac_je = $z->rukovodilac_id; ?>
            <?php require_once __DIR__ . '/tabele/Korisnik.php'; 
            require_once __DIR__ . '/tabele/Grupa.php';
            $korisnik_izvr = Korisnik::getById($izvrsilac_je);
            $korisnik_ruko = Korisnik::getById($rukovodilac_je);
            $grupa = Grupa::getGroupById($z->id_grupe);
            ?>
            <p>Izvrsilac: </p>
            <span class="izvrsilac"><?= $korisnik_izvr->ime_prezime ?></span><br>
            <p>Rukovodilac: </p>
            <span class="rukovodilac"><?= $korisnik_ruko->ime_prezime ?></span><br>
            <p>Rok: </p>
            <span class="rok"><?= $z->rok_izvrsenja ?></span><br>
            <p>Prioritet: </p>
            <span class="prioritet"><?= $z->prioritet ?></span><br>
            <p>Grupa: </p>
            
            <span class="grupa"><?= $grupa->naziv ?></span><br>
            <hr>

            <p>Komentari: </p>


            <?php require_once __DIR__ . '/tabele/Komentar.php'; 
                $komentari = Komentar::getKomentari($z->id);
                
            ?>
            <?php foreach ($komentari as $k): ?>
                <?php $komentator_je = Korisnik::getById($k->korisnik_id); ?>
                
                <span class="naslov"><?= $k->naslov ?></span> <br>
                <span class="tekst"><?= $k->tekst ?></span><br>
                <span class="vreme"><?= $k->vreme ?></span> <br>
                <span class="komentator"><?= $komentator_je->ime_prezime ?></span> <br>
                
                <form action="logika/obrisi_komentar.php" method="POST">
                    <input type="hidden" id="korisnik" name="korisnik" value='<?= $k->korisnik_id ?>'>
                    <button type="submit" value="<?= $k->id ?>" name="id">Obrisi komentar</button>
                
                </form>
                <hr>
                
                <?php endforeach ?>
            
            
        </div>
    <?php endforeach ?>
</div>

    

   <a href="logika/izlogujse.php">Odjavi se</a>
</body>
</html>