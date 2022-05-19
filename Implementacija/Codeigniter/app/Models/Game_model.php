<?php namespace App\Models;

use CodeIgniter\Model;

class Game_model extends Model {

    protected $table = 'game';

    public function getID($game) {
        $id_game = $this->table('game')->select('*')->where('Name', $game)->paginate(1);
        if(count($id_game) == 0) $id_game = 0;
        else $id_game = $id_game[0]['ID'];
        return $id_game;
    }

}