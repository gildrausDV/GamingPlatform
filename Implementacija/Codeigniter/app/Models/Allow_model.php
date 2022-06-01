<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * Allow_model - model za rad sa bazom kod dozvole/zabrane pristupa
 * 
 * @version 1.0
 */
class Allow_model extends Model {

    /**
     * @var String $table // naziv tabele kojoj se pristupa
     */
    protected $table = 'user';

    /**
     * @var arr[String] $allowedFields // polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['blocked'];
    
    /**
     * Funkcija koja ažurira polje 'blocked' u tabeli 'user' u zavisnosti od toga 
     * da li se korisniku dozvoljava/zabranjuje pristup
     * 
     * @return Integer      // identifikator greške/uspešnosti 
     */
    public function allow() {

        $user = $_POST['username'];
        $allow = $_POST['allow/block'];

        $exists = $this->table('user')->where('username', $user)->paginate(1);

        if (count($exists) == 0) {
            return 1;
        }
        
        if ($allow == "allow") {
            $data = [
                'blocked' => 0
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else {
            $data = [
                'blocked' => 1
            ];
            $this->update($exists[0]['ID'], $data);
        }

        return 2;
    }

}