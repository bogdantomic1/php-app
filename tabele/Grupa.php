<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Grupa {

    public int $id;
    public string $naziv;

    public static function getGroupById($id){
        
        $db = Database::getInstance();
        $grupa = $db->select('Grupa', 'SELECT * FROM grupa_zadatka WHERE id = :id', [
            ':id' => $id
        ]);

        foreach ($grupa as $grup) {
            return $grup;
        }

        return null;
    }

    public static function newGroup($naziv){
        $db = Database::getInstance();
        $query = 'INSERT INTO grupa_zadatka(naziv)' . 'VALUES (:naziv)';
        $params = [
        ':naziv' => $naziv
        ];
        $db->insert('Grupa',$query, $params);
        return $db->lastInsertId();
    }

    public static function getAll(){
        $db = Database::getInstance();
        $grupa = $db->select('Grupa', 'SELECT * FROM grupa_zadatka');
        return $grupa;
    }

    public static function changeGroup($id, $naziv){
        $db = Database::getInstance();
    
        $query = 'UPDATE grupa_zadatka  ' . 
        'SET naziv = :naziv '. 
        'WHERE id = :id';
        $params = [
            ':id' => $id,
            ':naziv' => $naziv
        ];
        $db->update('Grupa', $query, $params);
    }

    public static function deleteGroup($id){
        $db = Database::getInstance();
        $query = 'DELETE FROM grupa_zadatka WHERE id = :id';
        $params = [
            ':id' => $id
        ];

        return $db->delete($query, $params);
    }
}