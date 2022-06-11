<?php namespace App\Models;

// Autor: Dimitrije Vujčić 2019/0341

use CodeIgniter\Model;

/**
 * PlayedGame_model - model za rad sa tabelom playedgame
 * 
 * @version 1.0
 */
class PlayedGame_model extends Model {

    /**
     * @var String $table   // naziv tabele kojoj se pristupa
     */
    protected $table = 'playedgame';

    /**
     * @var arr[String] $allowedFields  // Polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['timePlayed', 'points', 'ID_user', 'ID_game', 'maxLevel',
        'on_tournament'];

    /*
    $exists = $this->table('user')->select('blocked')->where('username', $user)
        ->where('password', $pass)->paginate(2);
    */

    /**
     * Funkcija koja dohvata poslednjih $cnt odigranih partija igrice $game korisnika $id_user
     * 
     * @param String $game
     * @param Integer $id_user
     * @param Integer $cnt
     * 
     * @return arr[]    // niz struktura {name, timePlayed, points}
     */
    public function getHistory($game, $id_user, $cnt) {
        $result = new \stdClass();

        $game_model = new Game_model();
        $id_game = $game_model->getID($game);
        
        $res = $this->table('playedgame')->select('name, timePlayed, points')
            ->join('game', 'game.ID = playedgame.ID_game', 'left')
            ->where('ID_user', $id_user)
            ->where('ID_game', $id_game)->paginate(/*$cnt*/);
        return $res;
    }

    /**
     * Funkcija koja dohvata najviše osvojenih poena i najviši dostignut nivo korisnika $id_iser na igrici $game. 
     * Takođe dohvata 10 najboljih partija svih korisnika na toj igrici 
     * 
     * @param String $game
     * @param Integer $id_user
     * 
     * @return Object    // Object koji sadrzi polja maxLevel, maxPoints i niz struktura {username, points}
     */
    public function get_max_level_and_points($id_user, $game) {
        $result = new \stdClass();

        $game_model = new Game_model();
        $id_game = $game_model->getID($game);

        $maxLevel = $this->table('playedgame')->select('maxLevel')->where('ID_user', $id_user)
            ->where('ID_game', $id_game)->orderBy('maxLevel', 'desc')->paginate(2);

        $maxPoints = $this->table('playedgame')->select('points')
            ->where('ID_user', $id_user)->where('ID_game', $id_game)->orderBy('points', 'desc')->paginate(2);

        $result->level = $maxLevel;
        if(count($result->level) > 0) $result->level = $result->level[0]['maxLevel'];
        else $result->level = 0;
        $result->points = $maxPoints;
        if(count($result->points) > 0) $result->points = $result->points[0]['points'];
        else $result->points = 0;

        $list = [];
        $list = $this->table('playedgame')->select('username, points, timePlayed')
            ->join('user', 'playedgame.ID_user=user.ID', 'left')
            ->where('ID_game', $id_game)->orderBy('points', 'desc')->orderBy('timePlayed', 'asc')->paginate(10);
        $result->list = $list;

        return $result;
    }

    /**
     * Funkcija koja dohvata $cnt najboljih igrača u igrici $game
     * 
     * @param String $game
     * @param Integer $cnt
     * 
     * @return arr[]    // niz struktura {ID_game, username, timePlayed, points}
     */
    public function getTopPlayers($game, $cnt) {
        $game_model = new Game_model();
        $id_game = $game_model->getID($game);
        $res = $this->table('playedgame')->select('ID_game, username, timePlayed, points')
            ->join('user', 'playedgame.ID_user = user.ID', 'left')
            ->orderBy('points', 'desc')
            ->where('ID_game', $id_game)->paginate($cnt);
        return $res;
    }

    /**
     * Funkcija koja beleži u bazi podatke o odigranoj partiji
     * 
     * @param Integer $game
     * @param Integer $points
     * @param Integer $level
     * @param Integer $id_user
     * @param Integer $id_game
     * @param Boolean $on_tournament
     * 
     */
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
        return 0;
    }

}