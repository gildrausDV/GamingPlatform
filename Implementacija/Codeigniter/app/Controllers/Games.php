<?php

namespace App\Controllers;

use App\Models\PlayedGame_model;
use App\Models\Level_model;
use App\Models\Game_model;
use App\Models\Login_model;
use App\Models\Tournament_model;
use App\Models\Participation_model;

class Games extends BaseController
{
    public function index()
    {
        return view('welcome_message'); // ovde treba da vodi na default stranicu za biranje igrica
    }

    public function history($game) {
        $data['game'] = $game;
        return view('history', $data);
    }

    public function getHistory($game) {
        $session = session();
        $model = new PlayedGame_model();
        $id_user = $session->get('ID');
        $ret['list'] = $model->getHistory($game, $id_user, 20);
        echo json_encode($ret);
    }

    public function topPlayers($game) {
        $data['game'] = $game;
        return view('topPlayers', $data);
    }

    public function game($game) {
        if($game == "Rayman") {
            return view('Rayman/rayman');
        } else if($game == "FlappyBird") {
            return view('flappyBird/flappyBird');
        }
    }

    public function addLevel_default() {
        return view('addLevel');
    }

    public function addLevel($game) {
        if($game == "Rayman") {
            return view('Rayman/addLevel');
        } else if($game == "FlappyBird") {
            return view('FlappyBird/addLevel');
        }
    }

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

    public function getList($game) {
        header('Content-Type: application/json');
        
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

    public function save_data($game) {
        if(!isset($_POST['arguments'])) return;

        $session = session();
        $id_user = $session->get('ID');
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

        $year = $_POST['arguments'][3];
        $month = $_POST['arguments'][4];
        $day = $_POST['arguments'][5];
        $hours = $_POST['arguments'][6];
        $minutes = $_POST['arguments'][7];
        $seconds = $_POST['arguments'][8];

        $on_tournament = 0;
        // dodaj proveru da li je na takmicenju... dohvati sve trenutne turnire i proveri da li je joined($id_tournament, $id_user);
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
