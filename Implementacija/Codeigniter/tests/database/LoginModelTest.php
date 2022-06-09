<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\UserSeeder;
//use Tests\Support\Models\ExampleModel;
use App\Models\Login_model;

final class LoginModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = UserSeeder::class;

    public function testModelFindAll()
    {
        $model = new Login_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(3, $objects);
    }
    
    public function testAddPoints() {
        $model = new Login_model();

        $this->assertIsInt($model->addPoints(1, 50));
        $this->assertIsInt($model->addPoints(2, 50));
    }

    public function testGetAllUsers() {
        $model = new Login_model();

        $this->assertIsArray($model->getAllUsers());
    }

    public function testSetModerator() {
        $model = new Login_model();

        $this->assertIsInt($model->setModerator(1));
        $this->assertIsInt($model->setModerator(2));
        $this->assertIsInt($model->setModerator(3));
    }

    public function testLogin() {
        $model = new Login_model();

        $_POST['username'] = 'gildraus';
        $_POST['password'] = '12345';

        $this->assertIsInt($model->login());

        $_POST['username'] = 'luka';
        $_POST['password'] = '';

        $this->assertIsInt($model->login());

        $_POST['username'] = 'luka';
        $_POST['password'] = '12345';

        $this->assertIsInt($model->login());

        $_POST['username'] = 'niki';
        $_POST['password'] = '12345';

        $this->assertIsInt($model->login());
    }

    public function testGetTopPlayers() {
        $model = new Login_model();

        $this->assertIsArray($model->getTopPlayers(1));
        $this->assertIsArray($model->getTopPlayers(10));
        $this->assertIsArray($model->getTopPlayers(30));
    }

    public function testGetID() {
        $model = new Login_model();

        $this->assertIsInt($model->getID('gildraus'));
        $this->assertIsInt($model->getID('luka'));
        $this->assertIsInt($model->getID('niki'));
    }

    public function testGetRole() {
        $model = new Login_model();

        $this->assertIsInt($model->getRole('gildraus'));
        $this->assertIsInt($model->getRole('luka'));
        $this->assertIsInt($model->getRole('niki'));
    }

    public function testGetNPoints() {
        $model = new Login_model();

        $this->assertIsInt($model->getNPoints(1));
        $this->assertIsInt($model->getNPoints(2));
        $this->assertIsInt($model->getNPoints(3));
    }

}
