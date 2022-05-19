<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;
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

    public function process() {
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
        return view('register');
    }

}
