<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder {

    public function run() {

        $lvl = '{"rows":"5","cols":"5","wood":[{"y":"1","x":"1","len":"2"},{"y":"2","x":"2","len":"2"},{"y":"3","x":"3","len":"1"},{"y":"1","x":"0","len":"1"}],"coins":[{"y":"1","x":"1"},{"y":"2","x":"2"},{"y":"1","x":"0"}]}';

        $levels = [
            [
                'ID' => 1,
                'level_desc' => $lvl,
                'ID_game' => 1,
                'lvl' => 1
            ]
        ];

        $builder = $this->db->table('level');
        foreach($levels as $level) {
            $builder->insert($level);
        }

    }

}