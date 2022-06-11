<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\MainSeeder;
use App\Models\Tournament_model;

final class TournamentModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = MainSeeder::class;

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
        $timeStart = '13:30:00';
        $timeEnd = '13:45:00';

        $this->assertIsInt($model->alreadyExists($game, $date, $timeStart, $timeEnd));

        $game = 'Rayman';
        $date = '2021-03-04';
        $timeStart = '12:30:00';
        $timeEnd = '13:45:00';

        $this->assertIsInt($model->alreadyExists($game, $date, $timeStart, $timeEnd));

        $game = 'Rayman';
        $date = '2021-03-04';
        $timeStart = '13:00:00';
        $timeEnd = '14:00:00';

        $this->assertIsInt($model->alreadyExists($game, $date, $timeStart, $timeEnd));
    }

    public function testEndTournament() {
        $model = new Tournament_model();

        $this->assertIsInt($model->endTournament(1));
    }

    public function testAddPlayer() {
        $model = new Tournament_model();

        $this->assertIsInt($model->addPLayer(1));
    }

    public function testAddTournament() {
        $model = new Tournament_model();

        $this->assertNull($model->addTournament([
            1, 3, '2021-03-04', '13:00:00', '14:00:00', false
        ]));
    }
    
    public function testGetActiveTournament() {
        $model = new Tournament_model();

        $this->assertIsArray($model->getActiveTournaments(
            1, 2021, 3, 4, 13, 30, 0 
        ));
    }

}
