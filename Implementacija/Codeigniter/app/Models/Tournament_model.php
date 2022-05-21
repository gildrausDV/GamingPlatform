<?php namespace App\Models;

use CodeIgniter\Model;

class Tournament_model extends Model {

    protected $table = 'tournament';

    protected $allowedFields = ['ID_game', 'maxNumOfPlayers', 'date', 'timeStart', 'timeEnd'];

    public function getPlayersList($id_tournament) {
        $res = $this->table('tournament')
            ->select('tournament.ID as id, user.username as username, points, maxLevel')
            ->where('tournament.ID', $id_tournament)
            ->join('playedgame', 'tournament.ID = playedgame.on_tournament', 'left')
            ->join('user', 'playedgame.ID_user = user.ID', 'left')
            ->paginate();
        return $res;
    }

    public function getTournaments() {
        $res = $this->table('tournament')
            ->select('tournament.ID as id, name, date, timeStart, timeEnd')
            ->join('game', 'tournament.ID_game = game.ID', 'left')
            ->paginate();
        return $res;
    }

    public function addTournament($arr) {
        $game_model = new Game_model();
        $id_game = $game_model->getID($arr[0]);
        $data = [
            "ID_game" => $id_game,
            "maxNumOfPlayers" => $arr[1],
            "date" => $arr[2],
            "timeStart" => $arr[3],
            "timeEnd" => $arr[4]
        ];
        $this->insert($data);
    }

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

}