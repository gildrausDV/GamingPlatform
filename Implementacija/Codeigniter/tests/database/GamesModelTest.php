<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\GamesSeeder;
//use Tests\Support\Models\ExampleModel;
use App\Models\Game_model;

final class GamesModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = GamesSeeder::class;

    public function testModelFindAll()
    {
        $model = new Game_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(2, $objects);
    }
    
}
