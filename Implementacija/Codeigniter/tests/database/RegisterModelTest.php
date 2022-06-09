<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\UserSeeder;
use App\Models\Register_model;

final class RegisterModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = UserSeeder::class;

    public function testModelFindAll()
    {
        $model = new Register_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(3, $objects);
    }

    public function testRegister() {
        $model = new Register_model();

        $_POST['f'] = 'ime';
        $_POST['s'] = 'prezime';
        $_POST['e'] = 'mejl';
        $_POST['u'] = 'username';
        $_POST['p'] = 'password';
        $_POST['d'] = '2022-05-04';

        $result = $model->register();
        $this->assertIsInt($result);

        $_POST['f'] = 'ime';
        $_POST['s'] = 'prezime';
        $_POST['e'] = 'mejl';
        $_POST['u'] = 'gildraus';
        $_POST['p'] = 'password';
        $_POST['d'] = '2022-05-04';

        $result = $model->register();
        $this->assertIsInt($result);
    }
    
}
