<?php namespace App\Models;

use CodeIgniter\Model;


class Login_model extends Model {

    
    public function login() {
        $user = $this->input->post('username');  
        $pass = $this->input->post('password'); 
        if($user == 'dimi' && $pass == 'car') {
            return true;
        } else {
            return false;
        }
    }

}