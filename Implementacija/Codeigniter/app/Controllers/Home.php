<?php

namespace App\Controllers;

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
        $a = new Login_model();

        return view('Rayman/rayman');
    }

}
