<?php namespace App\Controllers;

use App\Models\Tournament_model;
use App\Models\Participation_model;

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