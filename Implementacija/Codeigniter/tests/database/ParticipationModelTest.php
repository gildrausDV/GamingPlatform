<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\ParticipationSeeder;
//use Tests\Support\Models\ExampleModel;
use App\Models\Participation_model;

final class ParticipationModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = ParticipationSeeder::class;

    public function testModelFindAll()
    {
        $model = new Participation_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(1, $objects);
    }

    public function testGetTop5() {
        $model = new Participation_model();
        $this->assertIsArray($model->getTop5(1));
    }

    public function testJoinTournament() {
        $model = new Participation_model();
        $this->assertIsInt($model->joinTournament(1, 2));
    }

    public function testJoined() {
        $model = new Participation_model();
        $this->assertIsBool($model->joined(1, 2));
    }

}
