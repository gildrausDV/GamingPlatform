<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GamesSeeder extends Seeder {

    public function run() {

        $games = [
            [
                'ID' => '1',
                'name' => 'Rayman'
            ],
            [
                'ID' => '2',
                'name' => 'FlappyBird'
            ]
        ];

        $builder = $this->db->table('game');
        foreach($games as $game) {
            $builder->insert($game);
        }

    }

}