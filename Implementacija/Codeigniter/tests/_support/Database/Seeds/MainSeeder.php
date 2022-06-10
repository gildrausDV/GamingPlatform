<?php
namespace Tests\Support\Database\Seeds;
//use Tests\Support\Database\Seeds\UserSeeder;
use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder {

    public function run() {
        $sql = file_get_contents('tests\_support\Database\gamingplatform_test.sql');
        $this->db->query($sql);
        //$this->call('GamesSeeder');
        //$this->call('UserSeeder');
        $this->call('Tests\Support\Database\Seeds\UserSeeder');
        $this->call('Tests\Support\Database\Seeds\GamesSeeder');
        $this->call('Tests\Support\Database\Seeds\LevelSeeder');
        $this->call('Tests\Support\Database\Seeds\ParticipationSeeder');
        $this->call('Tests\Support\Database\Seeds\PlayedgameSeeder');
        $this->call('Tests\Support\Database\Seeds\TournamentSeeder');
        

    }

}