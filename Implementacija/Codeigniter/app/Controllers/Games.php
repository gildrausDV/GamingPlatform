<?php

namespace App\Controllers;

use App\Models\PlayedGame_model;
use App\Models\Level_model;
use App\Models\Game_model;

class Games extends BaseController
{
    public function index()
    {
        return view('welcome_message'); // ovde treba da vodi na default stranicu za biranje igrica
    }

    public function game($game) {
        if($game == "Rayman") {
            return view('Rayman/rayman');
        } else if($game == "FlappyBird") {
            return view('flappyBird/flappyBird');
        }
    }

    public function addLevel($game) {
        if($game == "Rayman") {
            return view('Rayman/addLevel');
        } else if($game == "FlappyBird") {
            return view('FlappyBird/addLevel');
        }
    }

    public function getList($game) {
        header('Content-Type: application/json');
        
        $id_user = 1;

        $model = new PlayedGame_model();
        $result = $model->get_max_level_and_points($id_user, $game);

        $ret = array();
        $ret['result'] = $result;

        echo json_encode($ret);
    }

    public function save_data($game) {
        if(!isset($_POST['arguments'])) return;

        $on_tournament = 0;
        // dodaj proveru da li je na takmicenju

        $id_user = 1;
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

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

}
