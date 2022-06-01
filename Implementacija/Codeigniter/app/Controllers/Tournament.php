<?php 

// Autor: Dimitrije Vujčić 2019/0341

namespace App\Controllers;

use App\Models\Tournament_model;
use App\Models\Participation_model;
use App\Models\Game_model;
use App\Models\Settings_model;
use App\Models\Login_model;

/**
 * Tournament - kontroler za rad sa takmičenjima
 * 
 * @version 1.0
 */
class Tournament extends BaseController
{
    public function index() {
        return view('Tournament/tournament');
    }

    /**
     * Funkcija koja prikazuje stranicu sa takmičenjima
     * 
     * @return view
     * 
     */
    public function tournament() {
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('Tournament/tournament', $data);
    }

    /**
     * Funkcija koja prikazuje stranicu za dodavanje takmičenja
     * 
     * @return view
     * 
     */
    public function addTournament() {
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        return view('Tournament/addTournament', $data);
    }

    /**
     * Funkcija koja prikazuje stranicu sa podacima o odigranim partijama za turnir $id_tournament
     * 
     * @param Integer $id_tournament
     * 
     * @return view
     * 
     */
    public function playerList($id_tournament) {
        $data['picture'] = (new Settings_model())->settingsLoadPicture(session()->get('ID'));
        $data['id_tournament'] = $id_tournament;
        return view('Tournament/playerList', $data);
    }

    /**
     * Funkcija koja preko model-a zatvara takmičenje i dodaje poene najboljim učesnicima
     * 
     * 
     */
    public function endTournament() {
        if(!isset($_POST['argument'])) return;
        $id_tournament = $_POST['argument'];
        $top5 = (new Participation_model)->getTop5($id_tournament);
        $cnt = 5;
        $model = new Login_model();
        foreach($top5 as $player) {
            $model->addPoints($player['ID'], $cnt);
            $cnt = $cnt - 1;
            $model->setModerator($player['ID']);
        }
        (new Tournament_model())->endTournament($id_tournament);
        echo json_encode($top5);
    }

    /**
     * Funkcija koja proverava da li ulogovan korisnik učestvuje na takmičenju u igrici koju trenutno igra
     * 
     * @param String $game
     * 
     * @return json_encode(boolean)
     * 
     */
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

    /**
     * Funkcija koja preko model-a dohvata sva učešća ulogovanog korisnika na takmičenjima
     * 
     */
    public function getJoined() {
        $model = new Participation_model();
        $ret['list'] = $model->getJoined();
        echo json_encode($ret);
    }

    /**
     * Funkcija koja dohvata sve igrače koji učestvuju na takmičenju $id_tournament
     * 
     * @param Integer $id_tournament
     */
    public function getPlayersList($id_tournament) {
        $model = new Tournament_model();
        $ret['list'] = $model->getPlayersList($id_tournament);
        echo json_encode($ret);
    }

    /**
     * Funkcija koja dohvata sva takmičenja
     * 
     * 
     */
    public function getTournaments() {
        $model = new Tournament_model();
        $res['list'] = $model->getTournaments();
        echo json_encode($res);
    }

    /**
     * Funkcija koja proverava da li postoji takmičenje u istom terminu kao takmičenje koje se dodaje. Ukoliko ne postoji dodaje se novo takmičenje
     * 
     * 
     */
    public function add_tournament() {
        if(!isset($_POST['arguments']) || count($_POST['arguments']) != 5) {
            return;
        }
        $model = new Tournament_model();
        if($model->alreadyExists($_POST['arguments'][0], $_POST['arguments'][2], $_POST['arguments'][3], $_POST['arguments'][4])) {
            echo "error";
            return;
        }
        $model->addTournament($_POST['arguments']);
        $res['list'] = "abc";
        echo json_encode($res);
    }

    /**
     * Funkcija koja ažurira broj učesnika na takmičenju i dodaje u bazu učešće ulogovanog korisnika za to takmičenje
     * 
     * 
     */
    public function joinTournament() {
        if(!isset($_POST['argument'])) return;

        $id_tournament = $_POST['argument'];

        $model_tournament = new Tournament_model();
        $model_tournament->addPlayer($id_tournament);

        $session = session();
        $id_user = $session->get('ID');
        $model = new Participation_model();
        $model->joinTournament($id_tournament, $id_user);
        $res['list'] = "abc";

        echo json_encode($res);
    }

}