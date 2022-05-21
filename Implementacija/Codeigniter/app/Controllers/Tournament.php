<?php namespace App\Controllers;

use App\Models\Tournament_model;
use App\Models\Participation_model;
use App\Models\Game_model;

class Tournament extends BaseController
{
    public function index() {
        return view('Tournament/tournament');
    }

    public function tournament() {
        return view('Tournament/tournament');
    }

    public function addTournament() {
        return view('Tournament/addTournament');
    }

    public function playerList($id_tournament) {
        $data['id_tournament'] = $id_tournament;
        return view('Tournament/playerList', $data);
    }

    public function isActive($game) {
        $session = session();
        $id_user = $session->get('ID');
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);
        $joined = (new Participation_model())->getJoined();
        $year = $_POST['arguments'][0];
        $month = $_POST['arguments'][1];
        $day = $_POST['arguments'][2];
        $hours = $_POST['arguments'][3];
        $minutes = $_POST['arguments'][4];
        $seconds = $_POST['arguments'][5];
        $active = (new Tournament_model())->getActiveTournaments($id_game, $year, $month, $day, $hours, $minutes, $seconds);
        foreach($joined as $jTournament) {
            foreach($active as $aTournament) {
                if($jTournament['ID_tournament'] == $aTournament['ID']) {
                    return json_encode(true);
                }
            }
        }
        return json_encode(false);
    }

    public function getJoined() {
        $model = new Participation_model();
        $ret['list'] = $model->getJoined();
        echo json_encode($ret);
    }

    public function getPlayersList($id_tournament) {
        $model = new Tournament_model();
        $ret['list'] = $model->getPlayersList($id_tournament);
        echo json_encode($ret);
    }

    public function getTournaments() {
        $model = new Tournament_model();
        $res['list'] = $model->getTournaments();
        echo json_encode($res);
    }

    public function add_tournament() {
        if(!isset($_POST['arguments']) || count($_POST['arguments']) != 5) {
            return;
        }
        $model = new Tournament_model();
        $model->addTournament($_POST['arguments']);
        $res['list'] = "abc";
        echo json_encode($res);
    }

    public function joinTournament() {
        if(!isset($_POST['argument'])) return;
        $session = session();
        $id_user = $session->get('ID');
        $model = new Participation_model();
        $model->joinTournament($_POST['argument'], $id_user);
        $res['list'] = "abc";
        echo json_encode($res);
    }

}