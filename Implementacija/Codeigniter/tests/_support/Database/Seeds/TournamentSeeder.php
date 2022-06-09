<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TournamentSeeder extends Seeder {

    public function run() {

        $tournaments = [
            [
                'ID' => 1,
                'date' => '2021-03-04',
                'timeStart' => '13:00:00',
                'timeEnd' => '14:00:00',
                'maxNumOfPlayers' => 3,
                'numOfPlayers' => 0,
                'ID_game' => 1,
                'ended' => 0
            ]
        ];

        $builder = $this->db->table('tournament');
        foreach($tournaments as $tournament) {
            $builder->insert($tournament);
        }

    }

}