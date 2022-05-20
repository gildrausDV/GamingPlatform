<?php namespace App\Models;

use CodeIgniter\Model;

class Tournament_model extends Model {

    protected $table = 'tournament';

    protected $allowedFields = ['ID_game', 'maxNumOfPlayers', 'date', 'timeStart', 'timeEnd'];

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

}