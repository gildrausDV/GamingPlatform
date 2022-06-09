<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\PlayedgameSeeder;
//use Tests\Support\Models\ExampleModel;
use App\Models\PlayedGame_model;

final class PlayedgameModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = PlayedgameSeeder::class;

    public function testModelFindAll()
    {
        $model = new PlayedGame_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(1, $objects);
    }

    public function testSave_data() {
        $model = new PlayedGame_model();

        $time = 10;
        $points = 50;
        $level = 5;
        $id_user = 1;
        $id_game = 1;
        $on_tournament = 0;

        $this->assertIsInt($model->save_data($time, $points, $level, $id_user, $id_game, $on_tournament));
    }

}
