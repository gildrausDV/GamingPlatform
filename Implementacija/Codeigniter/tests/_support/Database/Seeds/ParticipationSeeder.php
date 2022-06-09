<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ParticipationSeeder extends Seeder {

    public function run() {

        $parts = [
            [
                'ID' => 1,
                'ID_tournament' => 1,
                'ID_user' => 1
            ]
        ];

        $builder = $this->db->table('participation');
        foreach($parts as $part) {
            $builder->insert($part);
        }

    }

}