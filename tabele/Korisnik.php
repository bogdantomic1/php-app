<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Korisnik {
    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public int $tip_korisnika_id;
    public string $ime_prezime;

    
    
    //funckija za registraciju

    public static function register($username, $email, $password, $tip_korisnika_id, $ime_prezime){
            $db = Database::getInstance();
            $query = 'INSERT INTO korisnici'.
            '(username, password, email, tip_korisnika_id, ime_prezime)'.
            'VALUES (:username, :password, :email, :tip_korisnika_id, :ime_prezime)';
            $params = [
                ':username' => $username,
                ':password' => $password,
                ':email' => $email,
                ':tip_korisnika_id' => $tip_korisnika_id,
                ':ime_prezime' => $ime_prezime
            ];

            try{
                $db->insert('Korisnik', $query, $params);
            }
            catch(Exception $e){
                return false;
            }
            return $db->lastInsertId();

    }

    public static function login($username, $password){
        $db = Database::getInstance();
        $query = 'SELECT * FROM korisnici ' . 'WHERE username = :username AND password = :password';
        $params = [
            ':username' => $username,
            ':password' => $password
        ];
           
        $korisnici = $db->select('Korisnik', $query, $params);
        foreach($korisnici as $korisnik){
            return $korisnik;
        }
        return null;

    }

    public static function change_password($username, $new_password){
        $db = Database::getInstance();
        $query = 'UPDATE korisnici ' . 
        'SET password = :new_password '. 
        'WHERE username = :username';
        $params = [
            ':new_password' => $new_password,
            ':username' => $username
        ];
        $db->update('Korisnik', $query, $params);
        
        
    }

    public static function getById($id){
        $db = Database::getInstance();

        $korisnici = $db->select('Korisnik', 'SELECT * FROM korisnici WHERE id = :id', [
            ':id' => $id
        ]);

        foreach ($korisnici as $korisnik) {
            return $korisnik;
        }

        return null;
    }

    public static function getAll(){
        $db = Database::getInstance();
        $korisnici = $db->select('Korisnik', 'SELECT * FROM korisnici');
        return $korisnici;
    }

    public static function getOnlyIzvrisilac($tip_korisnika_id){
        $db= Database::getInstance();
        $query = 'SELECT * FROM korisnici WHERE tip_korisnika_id = :tip_korisnika_id';
        $params = [
            ':tip_korisnika_id' => $tip_korisnika_id
        ];
        $korisnici = $db->select('Korisnik', $query, $params);
        return $korisnici;
    }
    
    
}
		
