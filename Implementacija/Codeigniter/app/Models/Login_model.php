<?php namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model {

    protected $table = 'user';
    
    protected $allowedFields = ['NP', 'ID', 'role'];

    public function addPoints($id_user, $points) {
        $NP = $this->table('user')->select('NP')->where('ID', $id_user)->paginate(1);
        if(count($NP) != 1) return;
        $NP = $NP[0]['NP'];
        $this->table('user')->update($id_user, ['NP' => $NP + $points]);
    }

    public function getAllUsers() {
        $users = $this->select('ID')->paginate();
        $ret = [];
        foreach($users as $user) {
            array_push($ret, $user['ID']);
        }
        return $ret;
    }

    public function setModerator($id_user) {
        $NP = $this->table('user')->select('NP, role')->where('ID', $id_user)->paginate(1);
        if(count($NP) != 1) return;
        $role = $NP[0]['role'];
        $NP = $NP[0]['NP'];
        if($NP < 50 || $role != 0) return;
        $this->table('user')->update($id_user, ['role' => 1]);
    }

    public function login() {
        //if($this->input == NULL) return 0;
        $user = $_POST['username'];//$this->session->userdata('username'); 
        $pass = $_POST['password'];

        //$this->db->select('*');
        //$this->db->from('user');
        //$this->db->where('username', $user);
        //$this->db->where('password', $pass);
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

    public function getTopPlayers($cnt) {
        $res = $this->table('user')->select('username, NP')
            ->orderBy('NP', 'desc')
            ->paginate($cnt);
        return $res;
    }

    public function getID($user) {
        $res = $this->table('user')->select('ID')
            ->where('username', $user)->paginate(1);
        if(count($res) == 0) return -1;
        return $res[0]['ID'];
    }

    public function getRole($user) {
        $res = $this->table('user')->select('role')
            ->where('username', $user)->paginate(1);
        if(count($res) == 0) return -1;
        return $res[0]['role'];
    }

}