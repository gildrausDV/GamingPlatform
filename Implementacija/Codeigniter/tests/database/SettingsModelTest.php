<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\UserSeeder;
use App\Models\Settings_model;

final class SettingsModelTest extends \Tests\Support\DbTestCase
{
    //use DatabaseTestTrait;

    protected $seed = UserSeeder::class;

    public function testModelFindAll()
    {
        $model = new Settings_model();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(3, $objects);
    }

    public function testSettingsStoreData() {

        $model = new Settings_model();

        $_POST['pass'] = '12345';
        $_POST['date'] = '2021-08-06';

        $result = $model->settingsStoreData(1, "neka\putanja");
        $this->assertIsInt($result);

        $_POST['pass'] = '123';
        $_POST['date'] = '2021-08-06';

        $result = $model->settingsStoreData(1, "neka\putanja");
        $this->assertIsInt($result);

    }

    public function testSettingsLoadData() {

        $model = new Settings_model();

        $result = $model->settingsLoadData(1);
        $this->assertIsArray($result);
    }
    
    public function testSettingsLoadPicture() {

        $model = new Settings_model();

        $result = $model->settingsLoadPicture(1);
        $this->assertIsString($result);

        $result = $model->settingsLoadPicture(2);
        $this->assertIsString($result);

    }

}
