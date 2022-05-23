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
        $newTournamentUsers = [];
        if(isset($_SESSION['newTournamentUsers'])) $newTournamentUsers = $_SESSION['newTournamentUsers'];
        $ses_data = [
            'ID' => -1,
            'newTournamentUsers' => $newTournamentUsers,
            'username' => "",
            'role' => -1,
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
            /*$session = session();
            $ses_data = [
                'ID' => $model->getID($_POST['username']),
                'isLoggedIn' => true
            ];
            $session->set($ses_data);*/
            $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
            return view('home', $data);
        }
        /*$session = session();
        $ses_data = [
            'ID' => -1,
            'isLoggedIn' => false
        ];
        $session->set($ses_data);*/
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
        $role = session()->get('role');
        $id = session()->get('ID');
        if ($role == -1 || isset($_SESSION['role']) == false) {
            $data['picture'] = "/usersImages/guest.png";
            return view('home', $data);
        }
        $data['picture'] = (new Settings_model())->settingsLoadPicture($id);
        return view('home', $data);
    }

    public function allow() {
        helper('form');
        $data['allow'] = '0';
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        //echo session()->get('ID');
        return view('allow', $data);
    }

    public function allow_() {
        $model = new Allow_model();
        $res = $model->allow();
        $data['allow'] = "".$res;
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('allow', $data);
    }

    /*public function settings() {
        helper('form');
        $data['settings'] = '0';
        return view('settings', $data);
    }*/

    public function settings() {
        helper('form');
        $data['settings'] = '0';
        $id = session()->get('ID');
        $model = new Settings_model();
        $res = $model->settingsLoadData($id);
        $data['passInput'] = $res['password'];
        $data['dateInput'] = $res['date'];
        $data['picture'] = $res['profilePicture'];
        return view('settings', $data);
    }

    /*public function settingsLoadData() {
        $model = new Settings_model();
        $id = session()->get('ID');
        $res = $model->settingsLoadData($id);
        $res_ = [
            'password' => $res['password'],
            'date' => $res['date'],
            'profilePicture' => $res['profilePicture']
        ];
        echo json_encode($res_);
    }*/

    /*public function loadPicture() {
        $role = session()->get('role');
        if ($role == -1 || isset($_SESSION['role']) == false) {
            return;
        }
        $model = new Settings_model();
        $id = session()->get('ID');
        $res = $model->settingsLoadPicture($id);
        echo $res;
    }*/

    public function settings_() {
        $model = new Settings_model();
        //if (!isset($_POST['save'])) return 1;
        $file = "";
        $targetDir = "usersImages";
        if (is_array($_FILES)) {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], "$targetDir/".$_FILES['file']['name'])) {
                    $file = "/$targetDir/".$_FILES['file']['name'];
                }
            }
        }
        $id = session()->get('ID');
        $res1 = $model->settingsStoreData($id, $file);
        $res2 = $model->settingsLoadData($id);
        $data['settings'] = $res1;
        $data['passInput'] = $res2['password'];
        $data['dateInput'] = $res2['date'];
        $data['picture'] = $res2['profilePicture'];
        return view('settings', $data);
    }

    public function roles() {
        helper('form');
        $data['roles'] = '0';
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('roles', $data);
    }

    public function roles_() {
        $model = new Roles_model();
        $res = $model->roles();
        $data['roles'] = "".$res;
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('roles', $data);
    }

}
