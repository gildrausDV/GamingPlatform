<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;
use App\Models\Register_model;
use App\Config\autoload;

class Home extends BaseController
{

    public function index()
    {
        return view('welcome_message');
    }

    public function login() {
        helper('form');
        $data['log'] = '0';
        return view('login', $data);
    }

    public function login_() {
        $model = new Login_model();
        $res = $model->login();
        //print_r($res);
        $data['log'] = "".$res;
        if($res == 0) {
            return view('Rayman/rayman', $data);
        }
        
        return view('login', $data);
    }

    public function register() {
        helper('form');
        $data['reg'] = '0';
        return view('register', $data);
    }

    public function register_() {
        $model = new Register_model();
        $res = $model->register();
        $data['reg'] = "".$res;
        return view('register', $data);
    }

}
