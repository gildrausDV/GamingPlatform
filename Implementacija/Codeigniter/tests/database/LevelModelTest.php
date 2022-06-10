<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\LevelSeeder;
//use Tests\Support\Models\ExampleModel;
use App\Models\Level_model;

final class LevelModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = LevelSeeder::class;

    public function testModelFindAll()
    {
        $model = new Level_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(1, $objects);
    }

    public function testGetLevel() {
        
        $model = new Level_model();
        
        $this->assertIsObject($model->getLevel(1, 1));
        $this->assertIsObject($model->getLevel(1, 3));
    }

    public function testAddLevel() {
        
        $model = new Level_model();
        
        $this->assertIsInt($model->addLevel(1, '
        {"rows":"5","cols":"5","wood":[{"y":"1","x":"1","len":"2"},{"y":"2","x":"2","len":"2"},{"y":"3","x":"3","len":"1"},{"y":"1","x":"0","len":"1"}],"coins":[{"y":"1","x":"1"},{"y":"2","x":"2"},{"y":"1","x":"0"}]}
        '));
    }
    
}
