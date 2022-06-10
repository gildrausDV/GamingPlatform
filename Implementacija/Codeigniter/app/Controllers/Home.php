<?php

// Autor: Bogdan Jovanović 2019/0335

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login_model;
use App\Models\Register_model;
use App\Models\Allow_model;
use App\Models\Roles_model;
use App\Models\Settings_model;
use App\Config\autoload;

/**
 * Home - kontroler za rad sa registracijom, logovanjem, podešavanjem naloga,
 * dozvolom/zabranom pristupa nalogu i dodeljivanjem/oduzimanjem uloge 
 * moderatora/administratora
 * 
 * @version 1.0
 */

class Home extends BaseController
{

    public function index()
    {
        return view('home', ['picture' => 'usersImages/guest.png']);
    }

    /**
     * Funckcija koja odjavljuje korisnika
     */
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

    /**
     * Funkcija koja prikazuje stranicu za logovanje
     * 
     * @return view
     */
    public function login() {
        helper('form');
        $data['log'] = '0';
        return view('login', $data);
    }

    /**
     * Funcija koja preko model-a proverava podatke unete sa login forme i ukoliko
     * su podaci validni preusmerava korisnika na home stranicu
     * 
     * @return view
     */
    public function login_() {
        $model = new Login_model();
        $res = $model->login();
        $data['log'] = "".$res;
        if($res == 0) {
            $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
            return view('home', $data);
        }
        return view('login', $data);
    }

    /**
     * Funkcija koja prikazuje stranicu za registrovanje
     * 
     * @return view
     */
    public function register() {
        helper('form');
        $data['reg'] = '0';
        return view('register', $data);
    }

    /**
     * Funkcija koja preko model-a proverava validnost unetih podataka sa register forme
     */
    public function register_() {
        $model = new Register_model();
        $res = $model->register();
        echo $res;
    }

    /**
     * Funkcija koja prikazuje početnu (home) stranicu
     * 
     * @return view
     */
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

    /**
     * Funkcija koja prikazuje stranicu za dozvolu/zabranu pristupa nalogu
     * 
     * @return view
     */
    public function allow() {
        helper('form');
        $data['allow'] = '0';
        if(isset($_SESSION['ID'])) $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('allow', $data);
    }

    /**
     * Funkcija koja preko model-a radi dozvolu/zabranu pristupa nalogu
     * određenom korisniku
     * 
     * @return view
     */
    public function allow_() {
        $model = new Allow_model();
        $res = $model->allow();
        $data['allow'] = "".$res;
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('allow', $data);
    }

    /**
     * Funkcija koja prikazuje stranicu za podešavanje naloga
     * 
     * @return view
     */
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

    /**
     * Funkcija koja preko model-a čuva promene unete od strane korisnika sa forme
     * za podešavanje naloga
     * 
     * @return view
     */
    public function settings_() {
        $model = new Settings_model();
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

    /**
     * Funkcija koja prikazuje stranicu za dodavanje/oduzimanje uloge administratora/moderatora
     * 
     * @return view
     */
    public function roles() {
        helper('form');
        $data['roles'] = '0';
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('roles', $data);
    }

    /**
     * Funkcija koja preko model-a čuva promene unete na stranici za dozvolu
     * zabranu pristupa
     * 
     * @return view
     */
    public function roles_() {
        $model = new Roles_model();
        $res = $model->roles();
        $data['roles'] = "".$res;
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('roles', $data);
    }

}
