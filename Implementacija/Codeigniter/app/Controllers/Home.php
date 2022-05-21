<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;
use App\Models\Register_model;
use App\Models\Allow_model;
use App\Models\Roles_model;
use App\Models\Settings_model;
use App\Config\autoload;

class Home extends BaseController
{

    public function index()
    {
        return view('welcome_message');
    }

    public function signOut() {
        $session = session();
        $ses_data = [
            'ID' => -1,
            'isLoggedIn' => false
        ];
        $session->set($ses_data);
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
            $session = session();
            $ses_data = [
                'ID' => $model->getID($_POST['username']),
                'isLoggedIn' => true
            ];
            $session->set($ses_data);
            return view('Rayman/rayman', $data);
        }
        $session = session();
        $ses_data = [
            'ID' => -1,
            'isLoggedIn' => false
        ];
        $session->set($ses_data);
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

    public function home() {
        return view('home');
    }

    public function allow() {
        helper('form');
        $data['allow'] = '0';
        //echo session()->get('ID');
        return view('allow', $data);
    }

    public function allow_() {
        $model = new Allow_model();
        $res = $model->allow();
        $data['allow'] = "".$res;
        return view('allow', $data);
    }

    public function settings() {
        helper('form');
        $data['settings'] = '0';
        return view('settings', $data);
    }

    public function settingsLoadData() {
        $model = new Settings_model();
        //$id = session()->get('id');
        $id = session()->get('id');
        $proba = [
            'bogdan' => 'dimitrije'
        ];
        echo json_encode($id['ID']);
        return;
        $res = $model->settingsLoadData($id);
        //$res['pass'] = $data[0]['password'];
        //$res['picture'] = $data[0]['picture'];
        echo json_encode($res);
    }

    public function roles() {
        helper('form');
        $data['roles'] = '0';
        return view('roles', $data);
    }

    public function roles_() {
        $model = new Roles_model();
        $res = $model->roles();
        $data['roles'] = "".$res;
        return view('roles', $data);
    }

}
