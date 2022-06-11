<?php namespace App\Models;

// Autor: Dimitrije Vujčić 2019/0341

use CodeIgniter\Model;

use App\Models\Login_model;

/**
 * Tournament_model - model za rad sa takmičenjima
 * 
 * @version 1.0
 */
class Tournament_model extends Model {

    /**
     * @var String $table   // naziv tabele kojoj se pristupa
     * 
     */
    protected $table = 'tournament';

    /**
     * @var arr[String] $allowedFields  // Polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['ID_game', 'maxNumOfPlayers', 'date', 'timeStart', 'timeEnd', 'numOfPlayers', 'ended'];

    /**
     * Funkcija koja dohvata podatke o odigranim partijama na takmičenju $id_tournament
     * 
     * @param $id_tournament
     * 
     * @return arr[]    // niz struktura [ID, username, points, maxLevel]
     * 
     */
    public function getPlayersList($id_tournament) {
        $res = $this->table('tournament')
            ->select('tournament.ID as id, user.username as username, points, maxLevel')
            ->where('tournament.ID', $id_tournament)
            ->join('playedgame', 'tournament.ID = playedgame.on_tournament', 'left')
            ->join('user', 'playedgame.ID_user = user.ID', 'left')
            ->orderBy('points', 'desc')
            ->paginate();
        return $res;
    }

    /**
     * Funkcija koja dohvata sva takmičenja
     * 
     * @return arr[]   // niz struktura {ID, name, date, timeStart, timeEnd, numOfPlayers, maxNumOfPlayers, ended}
     * 
     */
    public function getTournaments() {
        $res = $this->table('tournament')
            ->select('tournament.ID as id, name, date, timeStart, timeEnd, numOfPlayers, maxNumOfPlayers, ended')
            ->join('game', 'tournament.ID_game = game.ID', 'left')
            ->paginate();
        return $res;
    }

    /**
     * Funkcija koja proverava da li postoji takmičenje u datom terminu
     * 
     * @param String $game
     * @param String $date
     * @param String $timeStart
     * @param String $timeEnd
     * 
     * @return Boolean
     * 
     */
    public function alreadyExists($game, $date, $timeStart, $timeEnd) {
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);
        $res = $this->table('tournament')
            ->select('timeStart, timeEnd')
            ->where("ID_game", $id_game)
            ->where('date', $date)
            ->paginate();
        foreach($res as $tournament) {
            if(strcmp($tournament['timeStart'], $timeStart) < 0 && strcmp($timeStart, $tournament['timeEnd']) < 0) return 1;
            if(strcmp($tournament['timeStart'], $timeEnd) < 0 && strcmp($timeEnd, $tournament['timeEnd']) < 0) return 1;
            if(strcmp($tournament['timeStart'], $timeEnd) == 0 && strcmp($timeEnd, $tournament['timeEnd']) == 0) return 1;
        }
        return 0;
    }

    /**
     * Funkcija koja dodaje novo takmičenje u bazu
     * 
     * @param arr[] $arr    // $arr = [ID, maxNumOfPlayers, date, timeStart, timeEnd, ended] 
     * 
     */
    public function addTournament($arr) {
        $game_model = new Game_model();
        $id_game = $game_model->getID($arr[0]);
        $data = [
            "ID_game" => $id_game,
            "maxNumOfPlayers" => $arr[1],
            "date" => $arr[2],
            "timeStart" => $arr[3],
            "timeEnd" => $arr[4],
            "ended" => false
        ];
        $this->insert($data);
        
        $users = (new Login_model())->getAllUsers();
        $session = session();
        $ses_data = [
            'newTournamentUsers' => $users
        ];
        $session->set($ses_data);

    }

    /**
     * Funkcija koja dohvata sva aktivna takmičenja u datom terminu za igricu $id_game
     * 
     * @param Integer $id_game
     * @param String $year
     * @param Integer $month
     * @param Integer $day
     * @param Integer $hours
     * @param Integer $minutes
     * @param Integer $seconds
     * 
     * @return arr[]    // niz struktura [ID, date, timeStart, timeEnd, maxNumOfPlayers, numOfPlayers, ID_game, ended]
     * 
     */
    public function getActiveTournaments($id_game, $year, $month, $day, $hours, $minutes, $seconds) {
        if($month < 10) $month = "0".$month;
        if($day < 10) $day = "0".$day;
        if($hours < 10) $hours = "0".$hours;
        if($minutes < 10) $minutes = "0".$minutes;
        if($seconds < 10) $seconds = "0".$seconds;
        $date = $year."-".$month."-".$day;
        $time = $hours.":".$minutes.":".$seconds;
        $tournaments = $this->table('tournament')->select('*')
            ->where('ID_game', $id_game)->paginate();
        $ret = array();
        foreach($tournaments as $tournament) {
            //$tournament['timeStart'] = $time;
            if(strcmp($tournament['date'], $date) != 0) continue;
            if(!(strcmp($tournament['timeStart'], $time) < 0 && strcmp($time, $tournament['timeEnd']) < 0)) continue;
            array_push($ret, $tournament);
        }
        return $ret;
    }

    /**
     * Funkcija koja u bazi beleži završetak takmičenja $id_tournament
     * 
     * @param $id_tournament
     * 
     */
    public function endTournament($id_tournament) {
        $this->update($id_tournament, ['ended' => true]);
        return 0;
    }

    /**
     * Funkcija koja inkrementira broj učesnika na takmičenju $id_tournament
     * 
     * @param Integer $id_tournament
     * 
     */
    public function addPlayer($id_tournament) {
        $num = $this->table('tournament')->select()->where('ID', $id_tournament)->paginate(1);
        if(count($num) != 1) return -1;
        $data = [
            'numOfPlayers' => $num[0]['numOfPlayers'] + 1
        ];
        $this->update($id_tournament, $data);
        return 0;
    }

}