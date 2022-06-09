<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\UserSeeder;
use App\Models\Roles_model;

final class RolesModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = UserSeeder::class;

    public function testModelFindAll()
    {
        $model = new Roles_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(3, $objects);
    }

    public function testRoles() {
        $model = new Roles_model();

        $_POST['username'] = 'gildraus';
        $_POST['roles'] = 'setModerator';

        $result = $model->roles();
        $this->assertIsInt($result);

        $_POST['username'] = 'gildraus';
        $_POST['roles'] = 'setAdmin';

        $result = $model->roles();
        $this->assertIsInt($result);

        $_POST['username'] = 'gildraus';
        $_POST['roles'] = 'removeAdmin';

        $result = $model->roles();
        $this->assertIsInt($result);

        $_POST['username'] = 'gildraus';
        $_POST['roles'] = '';

        $result = $model->roles();
        $this->assertIsInt($result);

        $_POST['username'] = '';
        $_POST['roles'] = 'removeAdmin';

        $result = $model->roles();
        $this->assertIsInt($result);
    }
    
}
