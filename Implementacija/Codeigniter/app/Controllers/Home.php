<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;

class Home extends BaseController
{

    public function index()
    {
        return view('welcome_message');
    }

    public function login() {
        return view("login");
    }

    public function process() {

        //$this->load->model('Login_model');
        //$this->$db      = \Config\Database::connect();
        //$builder = $this->$db->table('user');
        $a = new Login_model();
        if($a->login()) {
            return view('Rayman/rayman');
        }
        return view('login');
    }

}
