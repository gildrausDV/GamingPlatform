<?php namespace App\Models;

use CodeIgniter\Model;

class Level_model extends Model {

    protected $table = 'level';

    protected $allowedFields = ['level_desc', 'ID_game', 'lvl'];

    public function getLevel($lvl, $id_game) {
        $result = new \stdClass();

        $level = $this->table('level')->select('level_desc')
            ->where('lvl', $lvl)->where('ID_game', $id_game)->paginate(1);

        if(count($level) == 0) {
            $result->error = "true";
            $result->level_desc = "";
            return $result;
        }

        $result->error = "false";
        $result->level_desc = $level[0]['level_desc'];

        return $result;
    }

    public function addLevel($id_game, $level_desc) {

        $lvl = 1;
        $levels = $this->table('level')->select('lvl')
            ->where('ID_game', $id_game)->orderBy('lvl', 'desc')->paginate(1);
        if(count($levels) == 1) $lvl = $levels[0]['lvl'] + 1;

        $data = [
            "level_desc" => $level_desc,
            "ID_game" => $id_game,
            "lvl" => $lvl
        ];

        $this->table('level')->insert($data);

    }

}