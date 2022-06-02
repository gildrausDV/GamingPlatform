<?php namespace App\Models;

// Autor: Bogdan Jovanović 2019/0335

use CodeIgniter\Model;

/**
 * Settings_model - model za rad sa bazom prilikom podešavanja naloga
 * 
 * @version 1.0
 */
class Settings_model extends Model {

    /**
     * @var String $table // naziv tabele kojoj se pristupa
     */
    protected $table = 'user';

    /**
     * @var arr[String] $allowedFields // polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['password', 'picture', 'date'];
    
    /**
     * Funkcija koja u bazi čuva podatke unete u formi na stranici za podešavanje naloga
     * 
     * @param Integer $id
     * @param String $file
     * 
     * @return Integer // identifikator greške/uspešnosti
     */
    public function settingsStoreData($id, $file) {

        $pass = $_POST['pass'];
        $date = $_POST['date'];

        $exists = $this->table('user')->select()->where('ID', $id)->paginate(1);
        
        if (strlen($pass) < 5) {
            return 1;
        }    

        $data = [
            'password' => $pass,
            'date' => $date
        ];
        if ($file != "") {
            $data['picture'] = $file;
        }
        $this->update($exists[0]['ID'], $data);

        return 2;
    }

    /**
     * Funkcija koja učitava podatke iz baze sa korisnika sa prosleđenim id
     * 
     * @param Integer $id
     * 
     * @return Object  // {password, date, profilePicture}
     */
    public function settingsLoadData($id) {
        $data = $this->table('user')->select()->where('ID', $id)->paginate(1);
        
        $res['password'] = $data[0]['password'];
        $res['date'] = $data[0]['date'];
        $res['profilePicture'] = $data[0]['picture'];
        return $res;
    }

    /**
     * Funkcija koja učitava sliku iz baze za korisnika sa prosleđenim id
     * 
     * @param Integer $id
     * 
     * @return String // putanja do profilne slike korisnika
     */
    public function settingsLoadPicture($id) {
        $data = $this->table('user')->select()->where('ID', $id)->paginate(1);
        $res['profilePicture'] = $data[0]['picture'];
        return $data[0]['picture'];
    }

}