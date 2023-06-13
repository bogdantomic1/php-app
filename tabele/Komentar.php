<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';


class Komentar{
    public int $id;
    public string $naslov;
    public string $tekst;
    public string $vreme;
    public int $zadatak_id;
    public int $korisnik_id;



public static function getKomentari($zadatak_id){
    $db = Database::getInstance();
    $query = 'SELECT * FROM komentar WHERE zadatak_id = :zadatak_id';
    $params = [
        ':zadatak_id' => $zadatak_id
    ];
    return $db->select('Komentar', $query, $params);
}

public  static function postavi_komentar($naslov, $text, $zadatak, $korisnik, $vreme){
    $db = Database::getInstance();
    $query = 'INSERT INTO komentar(naslov, tekst, zadatak_id, korisnik_id, vreme)' .
     'VALUES (:naslov, :tekst, :zadatak_id, :korisnik_id, :vreme)';
    $params = [
        ':naslov' => $naslov,
        ':tekst' => $text,
        ':zadatak_id' => $zadatak,
        ':korisnik_id' => $korisnik,
        ':vreme' => $vreme
    ];

    $db->insert('Komentar',$query, $params);
    return $db->lastInsertId();
}

public static function obrisi_komentar($id){
    $db = Database::getInstance();
    $query = 'DELETE FROM komentar WHERE id = :id';
    $params = [
        ':id' => $id
    ];

    return $db->delete($query, $params);
}

}