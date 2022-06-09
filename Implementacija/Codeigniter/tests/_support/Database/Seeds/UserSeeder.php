<?php
namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder {

    public function run() {

        $users = [
            [
                'ID' => '1',
                'username' => 'gildraus',
                'password' => '12345',
                'date' => '2001-01-12',
                'role' => 0,
                'blocked' => 0,
                'NP' => 20,
                'name' => 'Dimitrije',
                'surname' => 'Vujcic',
                'email' => 'vujcic.dimitrije@gmail.com',
                'picture' => '/images/kirby.jpg'
            ],
            [
                'ID' => '2',
                'username' => 'luka',
                'password' => '12345',
                'date' => '2001-01-12',
                'role' => 0,
                'blocked' => 1,
                'NP' => 60,
                'name' => 'Luka',
                'surname' => 'Vlajic',
                'email' => 'vlajic.luka@gmail.com',
                'picture' => '/images/kirby.jpg'
            ],
            [
                'ID' => '3',
                'username' => 'niki',
                'password' => '12345',
                'date' => '2001-01-12',
                'role' => 0,
                'blocked' => 0,
                'NP' => 60,
                'name' => 'Luka',
                'surname' => 'Vlajic',
                'email' => 'vlajic.luka@gmail.com',
                'picture' => '/images/kirby.jpg'
            ]
        ];

        $builder = $this->db->table('user');
        foreach($users as $user) {
            $builder->insert($user);
        }

    }

}