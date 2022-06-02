<?php namespace App\Models;

// Autor: Bogdan Jovanović 2019/0335

use CodeIgniter\Model;

/**
 * Roles_model - model za rad sa bazom prilikom dodeljivanja/oduzimanja uloge 
 * administratora/moderatora
 * 
 * @version 1.0
 */
class Roles_model extends Model {

    /**
     * @var String $table // naziv tabele kojoj se pristupa
     */
    protected $table = 'user';

    /**
     * @var arr[String] $allowedFields // polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['role'];
    
    /**
     * Funkcija koja ažurira polje 'role' u tabeli 'user' u zavisnosti od toga da li
     * se korisniku postavlja/oduzima uloga administratora/moderatora
     * 
     * @return Integer // identifikator greške/uspešnosti
     */
    public function roles() {

        $user = $_POST['username'];
        $roles = $_POST['roles'];

        $exists = $this->table('user')->where('username', $user)->paginate(1);

        if (count($exists) == 0) {
            return 1;
        }
        
        if ($roles == "setAdmin") {
            $data = [
                'role' => 2
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else if ($roles == "setModerator") {
            $data = [
                'role' => 1
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else if ($roles == "removeAdmin") {
            $data = [
                'role' => 1
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else {
            $data = [
                'role' => 0
            ];
            $this->update($exists[0]['ID'], $data);
        }

        return 2;
    }

}