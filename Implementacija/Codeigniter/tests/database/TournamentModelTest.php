<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\TournamentSeeder;
use App\Models\Tournament_model;

final class TournamentModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = TournamentSeeder::class;

    public function testModelFindAll()
    {
        $model = new Tournament_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(1, $objects);
    }

    public function testAlreadyExists() {
        $model = new Tournament_model();

        $game = 'Rayman';
        $date = '2021-03-04';
        $timeStart = '13:00:00';
        $timeEnd = '14:00:00';

        $this->assertIsInt($model->alreadyExists($game, $date, $timeStart, $timeEnd));
    }
    
}
