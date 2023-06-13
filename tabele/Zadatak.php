<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';


class Zadatak{
    public int $id;
    public string $naslov;
    public string $opis;
    public int $izvrsilac_id;
    public int $rukovodilac_id;
    public string $rok_izvrsenja;
    public int $prioritet;
    public int $id_grupe;


public static function getAll($izvrsilac_id){
    $db = Database::getInstance();
    $query = 'SELECT * FROM zadatak ' . 'WHERE izvrsilac_id = :izvrsilac_id';
    $params = [':izvrsilac_id' => $izvrsilac_id];

    return $db->select('Zadatak', $query, $params);
}

public static function getAllByIzvrsilac(){
    $db = Database::getInstance();
    $z = $db->select('Zadatak', 'SELECT * FROM zadatak');
    return $z;
}

public static function newZadatak($naslov, $opis, $izvrsilac_id, $rukovodilac_id, $rok_izvrsenja, $prioritet, $id_grupe){
    $db = Database::getInstance();
    $query = 'INSERT INTO zadatak(naslov, opis, izvrsilac_id, rukovodilac_id, rok_izvrsenja, prioritet, id_grupe)' 
    . 'VALUES (:naslov, :opis, :izvrsilac_id, :rukovodilac_id, :rok_izvrsenja, :prioritet, :id_grupe)';
    $params = [
        ':naslov' => $naslov,
        ':opis' => $opis,
        ':izvrsilac_id' => $izvrsilac_id,
        ':rukovodilac_id' => $rukovodilac_id,
        ':rok_izvrsenja' => $rok_izvrsenja,
        ':prioritet' => $prioritet,
        ':id_grupe' => $id_grupe
        ];
    $db->insert('Zadatak', $query, $params);
    return $db->lastInsertId();
}

public static function obrisi_zadatak($id){
    $db = Database::getInstance();
    $query = 'DELETE FROM zadatak WHERE id = :id';
    $params = [
        ':id' => $id
    ];

    return $db->delete($query, $params);
}

}