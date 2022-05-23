<?php namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model {

    protected $table = 'user';
    
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
        $ses_data = [
            'ID' => $this->getID($user),
            'username' => $user,
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