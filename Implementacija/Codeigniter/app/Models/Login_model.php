<?php namespace App\Models;

use CodeIgniter\Model;


class Login_model extends Model {

    protected $table = 'user';
    
    public function login() {
        $user = $_POST['username'];//$this->session->userdata('username'); 
        $pass = $_POST['password'];

        //$this->db->select('*');
        //$this->db->from('user');
        //$this->db->where('username', $user);
        //$this->db->where('password', $pass);
        $exists = $this->table('user')->select()->where('username', $user)
        ->where('password', $pass)->paginate(2);

        if(count($exists) == 1) {
            return true;
        } else {
            return false;
        }
    }

}