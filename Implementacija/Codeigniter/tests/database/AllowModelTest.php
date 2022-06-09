<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\UserSeeder;
use App\Models\Allow_model;

final class AllowModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = UserSeeder::class;

    public function testModelFindAll()
    {
        $model = new Allow_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(3, $objects);
    }

    public function testAllow() {

        $model = new Allow_model();

        $_POST['username'] = 'gildraus';
        $_POST['allow/block'] = 'allow';
        $this->assertIsInt($model->allow());

        $_POST['username'] = 'luka';
        $_POST['allow/block'] = 'block';
        $this->assertIsInt($model->allow());

        $_POST['username'] = 'luka';
        $_POST['allow/block'] = '';
        $this->assertIsInt($model->allow());

        $_POST['username'] = 'lukaa';
        $_POST['allow/block'] = '';
        $this->assertIsInt($model->allow());

    }
    
}
