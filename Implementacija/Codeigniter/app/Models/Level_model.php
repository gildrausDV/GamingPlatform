<?php namespace App\Models;

use CodeIgniter\Model;

class Level_model extends Model {

    protected $table = 'level';

    /*
    $exists = $this->table('user')->select('blocked')->where('username', $user)
        ->where('password', $pass)->paginate(2);
    */

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

}