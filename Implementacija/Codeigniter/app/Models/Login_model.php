<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * Login_model - model za rad sa bazom prilikom logovanja korisnika
 * 
 * @version 1.0
 */
class Login_model extends Model {

    /**
     * @var String $table // naziv tabele kojoj se pristupa
     */
    protected $table = 'user';
    
    /**
     * @var arr[String] $allowedFields // polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['NP', 'ID', 'role'];

    /**
     * Funkcija dodaje $points NP poena korisniku $id_user
     * 
     * @param Integer $id_user
     * @param Integer $points
     * 
     */
    public function addPoints($id_user, $points) {
        $NP = $this->table('user')->select('NP')->where('ID', $id_user)->paginate(1);
        if(count($NP) != 1) return;
        $NP = $NP[0]['NP'];
        $this->table('user')->update($id_user, ['NP' => $NP + $points]);
    }

    /**
     * Funkcija vraca sve korisnike
     * 
     * @return arr[]    // niz [ID]
     * 
     */
    public function getAllUsers() {
        $users = $this->select('ID')->paginate();
        $ret = [];
        foreach($users as $user) {
            array_push($ret, $user['ID']);
        }
        return $ret;
    }

    /**
     * Funkcija proverava da li $id_user ima preko 50 NP poena i ako ima dodeljuje tom korisniku ulogu moderatora
     * 
     * @param Integer $id_user
     * 
     */
    public function setModerator($id_user) {
        $NP = $this->table('user')->select('NP, role')->where('ID', $id_user)->paginate(1);
        if(count($NP) != 1) return;
        $role = $NP[0]['role'];
        $NP = $NP[0]['NP'];
        if($NP < 50 || $role != 0) return;
        $this->table('user')->update($id_user, ['role' => 1]);
    }

    /**
     * Funkcija koja upoređuje podatke unete u login formi sa podacima iz baze
     * 
     * @return Integer // idenrifikator greške/uspešnosti
     */
    public function login() {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $exists = $this->table('user')->select('blocked')->where('username', $user)
        ->where('password', $pass)->paginate(2);

        $session = session();
        $newTournamentUsers = [];
        if(isset($_SESSION['newTournamentUsers'])) $newTournamentUsers = $_SESSION['newTournamentUsers'];
        $ses_data = [
            'ID' => $this->getID($user),
            'username' => $user,
            'newTournamentUsers' => $newTournamentUsers,
            'role' => $this->getRole($user),
            'isLoggedIn' => true
        ];
        $session->set($ses_data);

        if(count($exists) == 1 && $exists[0]['blocked'] == '0') {
            return 0;
        } else if(count($exists) == 1 && $exists[0]['blocked'] == 1) {
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * Funkcija koja dohvata $cnt najboljih igrača sortiranih po NP poenima
     * 
     * @param Integer $cnt
     * 
     * @return arr[]    // niz struktura {username, NP}
     * 
     */
    public function getTopPlayers($cnt) {
        $res = $this->table('user')->select('username, NP')
            ->orderBy('NP', 'desc')
            ->paginate($cnt);
        return $res;
    }

    /**
     * Funkcija koja dohvata ID za korisnika sa imenom $user
     * 
     * @param String $user
     * 
     * @return Integer $res[0]['ID']    // ID korisnika
     * 
     */
    public function getID($user) {
        $res = $this->table('user')->select('ID')
            ->where('username', $user)->paginate(1);
        if(count($res) == 0) return -1;
        return $res[0]['ID'];
    }

    /**
     * Funkcija koja vraća ulogu korisnika sa imenom $user
     * 
     * @param String $user
     * 
     * @return Integer $res[0]['role']  // 0 -gost, 1 -registrovani korisnik, 2 -moderator i 3 -administrator
     * 
     */
    public function getRole($user) {
        $res = $this->table('user')->select('role')
            ->where('username', $user)->paginate(1);
        if(count($res) == 0) return -1;
        return $res[0]['role'];
    }

    /**
     * Funkcija koja vraća broj NP poena za korisnika sa id-em $id_user
     * 
     * @param Integer $id_user
     * 
     * @return Integer $res[0]['NP']    // broj NP poena
     * 
     */
    public function getNPoints($id_user) {
        $ret = $this->table('user')->select("NP")->paginate(1);
        if(count($ret) == 0) return 0;
        return $ret[0]['NP'];
    }

}