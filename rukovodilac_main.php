<?php
session_start();
if(isset($_SESSION['korisnik_id']) && $_SESSION['korisnik_id'] != 2){
    $var = $_SESSION['korisnik_id'];
    if($var == 1){
        header('Location: admin_main.php');
    }
    else{
        header('Location: izvrsilac_main.php');
    }
}
if(!isset($_SESSION['korisnik_id'])){
    header("Location: prijava.php");
}

require_once __DIR__ . '/tabele/Grupa.php';
$grupe = Grupa::getAll();

require_once __DIR__ . '/tabele/Zadatak.php';
$zadatak = Zadatak::getAllByIzvrsilac();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rukovodilac_main.css">
    <title>Rukovodilac</title>
    
</head>
<body>
<a href="logika/izlogujse.php">Odjavi se</a>
<h1>Rukovodilac konzola</h1>

<form action="logika/dodaj_grupu.php" method="POST"> 
    <input type="text" name="naziv"  placeholder="Naziv Grupe"><br>
    <input type="submit" value="Dodaj Grupu">
</form>
<hr>

<form action="logika/promeni_grupu.php" method="POST"> 
    <input name="id" id = "id" placeholder="ovde ce se pojaviti id grupe" readonly><br>
    <input type="text" name="naziv_nove_grupe" id="naziv_nove_grupe" placeholder="Novi Naziv Grupe"><br>
    <input type="submit" value="Promeni Grupu">
    <select name="grupe" id="grupe" onchange="update_grupe()">
            <?php foreach ($grupe as $g): ?>
                <option value ='<?= $g->id ?>'> <?=$g->naziv?> </option>
            <?php endforeach ?>   
    </select><br>
</form>

<form action="logika/obrisi_grupu.php" method="POST">
    <input hidden id = "id_obrisi" name = "id_obrisi" readonly><br>
    <button type="submit" id="delete">Obrisi</button>
</form>
<hr>

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
                
                <form action="logika/obrisi_komentar_nadredjeni.php" method="POST">
                    <input type="hidden" id="korisnik" name="korisnik" value='<?= $k->korisnik_id ?>'>
                    <button type="submit" value="<?= $k->id ?>" name="id">Obrisi komentar</button>
                
                </form>
                
                <hr>
                
                <?php endforeach ?>

                <form action="logika/obrisi_zadatak.php" method="POST">
                    <button type="submit" value="<?= $z->id ?>" name="id">Obrisi zadatak</button>
                
                </form>
       
        </div>

        <?php endforeach ?>
    
        <div class="dodaj-zadatak">
        
        <?php require_once __DIR__ . '/tabele/Korisnik.php'; 
            require_once __DIR__ . '/tabele/Grupa.php'; 
            $sviKorisnici = Korisnik::getOnlyIzvrisilac(8);    
        ?>
            <form action="logika/dodaj_zadatak.php" method="POST">
                <input type="text" name="naslov" placeholder="Naslov"><br>
                <input type="text" name="opis" placeholder="Opis"><br>
                <input type="text" name="rok" placeholder="Rok"><br>
                <input type="number" name="prioritet" min="1" max="10" value="1"><br>
                <select name="grupe" id="grupe" onchange="update_grupe()">
                    <?php foreach ($grupe as $g): ?>
                    <option value ='<?= $g->id ?>'> <?=$g->naziv?> </option>
                    <?php endforeach ?>   
                </select><br>
                <select name="izvrsilac" id="izvrsilac">
                    <?php foreach ($sviKorisnici as $user): ?>
                    <option value ='<?= $user->id ?>'> <?=$user->ime_prezime?> </option>
                    <?php endforeach ?>   
                </select><br>
                <button type="submit" id="dugme">Dodaj Zadatak</button>

            </form>
        
        </div>
    


</div>
<script>
        function update_grupe(){
            var select =document.getElementById("grupe");
            var input =document.getElementById("id");
            input.value = select.value;
            var del = document.getElementById("id_obrisi");
            del.value = select.value;
        };
       

</script>
</body>
</html>