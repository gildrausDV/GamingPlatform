<?php namespace App\Models;

// Autor: Bogdan Jovanović 2019/0335

use CodeIgniter\Model;

/**
 * Register_model - model za rad sa bazom prilikom registracije
 * 
 * @version 1.0
 */
class Register_model extends Model {

    /**
     * @var String $table // naziv tabele kojoj se pristupa
     */
    protected $table = 'user';

    /**
     * @var arr[String] $allowedFields // polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['username', 'password', 'role', 'blocked', 'NP', 'name', 'surname', 'email', 'picture', 'date'];
    
    /**
     * Funkcija koja proverava podatke unete prilikom registracije i ukoliko je sve
     * u redu, ubacuje novog korisnika u bazu
     * 
     * @return Integer // identifikator greške/uspešnosti
     */
    public function register() {

        $forename = $_POST['f'];
        $surname = $_POST['s'];
        $email = $_POST['e'];
        $user = $_POST['u'];
        $pass = $_POST['p'];
        $date = $_POST['d'];

        $exists = $this->table('user')->select()->where('username', $user)->paginate(1);
        if(count($exists) == 1) {
            return 0;
        }

        $data = [
            'username' => $user,
            'password'  => $pass,
            'date' => $date,
            'role'  => 0,
            'blocked' => 0,
            'NP' => 0,
            'name' => $forename,
            'surname' => $surname,
            'email' => $email,
            'picture' => "/usersImages/guest.png"
        ];

        $this->insert($data);
    
        return 1;
    }

}