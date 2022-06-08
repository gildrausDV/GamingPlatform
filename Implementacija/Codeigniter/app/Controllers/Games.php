<?php

// Autor: Dimitrije Vujčić 2019/0341

namespace App\Controllers;

use App\Models\PlayedGame_model;
use App\Models\Level_model;
use App\Models\Game_model;
use App\Models\Login_model;
use App\Models\Tournament_model;
use App\Models\Settings_model;
use App\Models\Participation_model;

/**
 * Games - kontroler za rad sa igricama
 * 
 * @version 1.0
 */
class Games extends BaseController
{
    public function index()
    {
        return view('home');
    }

    /**
     * Funkcija koja prikazuje stranicu za pregled istorije za igricu $game
     * 
     * @param String $game
     * 
     * @return view
     * 
     */
    public function history($game) {
        $data['game'] = $game;
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('history', $data);
    }

    /**
     * Funkcija koja preko model-a iz baze dohvata istoriju odigranih igara za ulogovanog korisnika
     * (getHistory se poziva metodom iz ajax bliblioteke kojoj se rezultat vraća korišćenjem echo funkcije)
     * 
     * @param String $game
     * 
     * @return void
     * 
     */
    public function getHistory($game) {
        $session = session();
        $model = new PlayedGame_model();
        $id_user = $session->get('ID');
        $ret['list'] = $model->getHistory($game, $id_user, 20);
        echo json_encode($ret);
    }

    /**
     * Funkcija koja prikazuje stranicu sa najboljim igračima za igricu $game
     * 
     * @param String $game
     * 
     * @return view
     * 
     */
    public function topPlayers($game) {
        $data['game'] = $game;
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('topPlayers', $data);
    }

    /**
     * Funkcija koja prikazuje stranicu za igranje igrice $game
     * 
     * @param String $game
     * 
     * @return view
     * 
     */
    public function game($game) {
        $role = -1;
        if(isset($_SESSION['role'])) {
            $role = session()->get('role');
        }
        if ($role == -1 || isset($_SESSION['role']) == false) {
            $data['picture'] = "/usersImages/guest.png";
        }
        else {
            $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        }
        if($game == "Rayman") {
            return view('Rayman/rayman', $data);
        } else if($game == "FlappyBird") {
            return view('flappyBird/flappyBird', $data);
        }
    }

    /**
     * Funkcija koja prikazuje stranicu na kojoj se bira konkretna igrica za dodavanje nivoa
     * 
     * @return view
     * 
     */
    public function addLevel_default() {
        if(isset($_SESSION['ID'])) {
            $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        } else {
            $data['picture'] = "/usersImages/guest.png";
        }
        return view('addLevel', $data);
    }

    /**
     * Funkcija koja prikazuje stranicu za dodavanje nivoa za igricu $game
     * 
     * @param String $game
     * 
     * @return view
     * 
     */
    public function addLevel($game) {
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        if($game == "Rayman") {
            return view('Rayman/addLevel', $data);
        } else if($game == "FlappyBird") {
            return view('FlappyBird/addLevel', $data);
        }
    }

    public function myNPoints() {
        $session = session();
        $id_user = $session->get('ID');
        $model = new Login_model();
        echo $model->getNPoints($id_user);
    }

    /**
     * Funkcija koja preko model-a iz baze dohvata najbolje igrače za igricu $game
     * (getTopPlayers se poziva metodom iz ajax bliblioteke kojoj se rezultat vraća korišćenjem echo funkcije)
     * 
     * @param String $game
     * 
     * @return void
     * 
     */
    public function getTopPlayers($game) {
        if($game == "Global") {
            $model = new Login_model();
            $ret['list'] = $model->getTopPlayers(20);
            echo json_encode($ret);
        } else {
            $model = new PlayedGame_model();
            $ret['list'] = $model->getTopPlayers($game, 20);
            echo json_encode($ret);
        }
    }

    /**
     * Funkcija koja preko model-a iz baze dohvata 10 najboljih igrača za igricu $game i najviše osvojenih poena i 
     * najviši dostignut nivo na toj igrici za ulogovanog igraca
     * (getList se poziva metodom iz ajax bliblioteke kojoj se rezultat vraća korišćenjem echo funkcije)
     * 
     * @param String $game
     * 
     * @return void
     * 
     */
    public function getList($game) {
        //header('Content-Type: application/json');
        
        $session = session();
        $id_user = $session->get('ID');

        $model = new PlayedGame_model();
        $result = $model->get_max_level_and_points($id_user, $game);

        $ret = array();
        $ret['result'] = $result;

        echo json_encode($ret);
    }

    public function test() {
        $model = new Tournament_model();
        $year = $_POST['arguments'][0];
        $month = $_POST['arguments'][1];
        $day = $_POST['arguments'][2];
        $hours = $_POST['arguments'][3];
        $minutes = $_POST['arguments'][4];
        $seconds = $_POST['arguments'][5];
        $ret['list'] = $model->getActiveTournaments(1, $year, $month, $day, $hours, $minutes, $seconds);
        echo json_encode($ret);
    }

    /**
     * Funkcija koja u pozivanjem metode iz model-a u bazi čuva podatke o odigranoj igrici
     * (pre čuvanja podataka o odigranoj igri se proverava da li je igra odigrana na takmičenju i u zavisnosti od toga
     *      se postavlja vrednost $on_tournament promenljive)
     * 
     * @param String $game
     * 
     */
    public function save_data($game) {
        if(!isset($_POST['arguments'])) return;

        $session = session();
        if(!isset($_SESSION['ID'])) return;
        $id_user = $session->get('ID');
        if($id_user == -1) return;
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

        $year = $_POST['arguments'][3];
        $month = $_POST['arguments'][4];
        $day = $_POST['arguments'][5];
        $hours = $_POST['arguments'][6];
        $minutes = $_POST['arguments'][7];
        $seconds = $_POST['arguments'][8];

        $on_tournament = 0;

        // PROVERA DA LI JE NA TAKMICENJU
        $activeTournaments = (new Tournament_model())->getActiveTournaments($id_game, $year, $month, $day, $hours, $minutes, $seconds);
        $participation_model = new Participation_model();
        foreach($activeTournaments as $tournament) {
            if($participation_model->joined($tournament['ID'], $id_user)) {
                $on_tournament = $tournament['ID'];
                break;
            }
        }
        // ZAVRSENA PROVERA

        $time = $_POST['arguments'][0];
        $points = $_POST['arguments'][1];
        $level = $_POST['arguments'][2];

        $model = new PlayedGame_model();
        $model->save_data($time, $points, $level, 
            $id_user, $id_game, $on_tournament);

    }

    /**
     * Funkcija dohvata sledeći nivo za igricu $game
     * 
     * @param String $game
     * 
     */
    public function getLevel($game) {
        if(!isset($_GET['arguments'])) {
            echo "asd";
            return;
        }

        $ret = array();
        $ret['error'] = "false";

        $level = $_GET['arguments'];
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

        $model = new Level_model();
        $result = $model->getLevel($level, $id_game);
        
        if($result->error == "true") {
            $ret['error'] = "true";
            return;
        }
        
        $ret['result'] = $result;
        echo json_encode($ret);
        return;
    }

    /**
     * Funkcija dodaje novi nivo igrici $game
     * 
     * @param String $game
     * 
     */
    public function add_level($game) {
        if(!isset($_POST['arguments'])) {
            return;
        }

        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

        $model = new Level_model();
        $model->addLevel($id_game, $_POST['arguments']);
    }

}
