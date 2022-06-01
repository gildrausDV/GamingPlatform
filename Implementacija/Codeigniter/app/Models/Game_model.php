<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * Game_model - model za rad sa igricama u bazi
 * 
 * @version 1.0
 */
class Game_model extends Model {

    /**
     * @var String $table   // naziv tabele kojoj se pristupa
     */
    protected $table = 'game';

    /**
     * Funkcija koja dohvata ID igrice $game
     * 
     * @param String $game
     * 
     * @return Integer $id_game     // ID igrice
     */
    public function getID($game) {
        $id_game = $this->table('game')->select('*')->where('Name', $game)->paginate(1);
        if(count($id_game) == 0) $id_game = 0;
        else $id_game = $id_game[0]['ID'];
        return $id_game;
    }

}