<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlayedgameSeeder extends Seeder {

    public function run() {

        $games = [
            [
                'ID' => 1,
                'timePlayed' => 10,
                'points' => 85,
                'ID_user' => 1,
                'ID_game' => 1,
                'maxLevel' => 3,
                'on_tournament' => 1
            ]
        ];

        $builder = $this->db->table('playedgame');
        foreach($games as $game) {
            $builder->insert($game);
        }

    }

}