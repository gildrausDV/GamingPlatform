<?php namespace App\Models;

use CodeIgniter\Model;

class PlayedGame_model extends Model {

    protected $table = 'playedgame';

    protected $allowedFields = ['timePlayed', 'points', 'ID_user', 'ID_game', 'maxLevel',
        'on_tournament'];

    /*
    $exists = $this->table('user')->select('blocked')->where('username', $user)
        ->where('password', $pass)->paginate(2);
    */

    public function getHistory($game, $id_user, $cnt) {
        $result = new \stdClass();

        $game_model = new Game_model();
        $id_game = $game_model->getID($game);
        
        $res = $this->table('playedgame')->select('name, timePlayed, points')
            ->join('game', 'game.ID = playedgame.ID_game', 'left')
            ->where('ID_user', $id_user)
            ->where('ID_game', $id_game)->paginate($cnt);
        return $res;
    }

    public function get_max_level_and_points($id_user, $game) {
        $result = new \stdClass();

        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

        $maxLevel = $this->table('playedgame')->select('maxLevel')->where('ID_user', $id_user)
            ->where('ID_game', $id_game)->paginate(2);

        $maxPoints = $this->table('playedgame')->select('points')
            ->where('ID_user', $id_user)->where('ID_game', $id_game)->paginate(2);

        $result->level = $maxLevel;
        if(count($result->level) > 0) $result->level = $result->level[0]['maxLevel'];
        else $result->level = 0;
        $result->points = $maxPoints;
        if(count($result->points) > 0) $result->points = $result->points[0]['points'];
        else $result->points = 0;

        $list = [];
        $list = $this->table('playedgame')->select('username, points')
            ->join('user', 'playedgame.ID_user=user.ID', 'left')
            ->where('ID_game', $id_game)->orderBy('points', 'desc')->paginate(10);
        $result->list = $list;

        return $result;
    }

    public function getTopPlayers($game, $cnt) {
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);
        $res = $this->table('playedgame')->select('ID_game, username, timePlayed, points')
            ->join('user', 'playedgame.ID_user = user.ID', 'left')
            ->where('ID_game', $id_game)->paginate($cnt);
        return $res;
    }

    public function save_data($time, $points, $level, $id_user, 
                $id_game, $on_tournament) {
        $data = [
            "timePlayed" => $time,
            "points" => $points,
            "ID_user" => $id_user,
            "ID_game" => $id_game,
            "maxLevel" => $level,
            "on_tournament" => $on_tournament
        ];
        $this->insert($data);
    }

}