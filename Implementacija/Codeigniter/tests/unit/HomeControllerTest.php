<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use Tests\Support\Database\Seeds\MainSeeder;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class HomeControllerTest extends CIUnitTestCase {

    use ControllerTestTrait;
    use DatabaseTestTrait;

    protected $refresh = true;

    protected $seed = MainSeeder::class;

    public function testIndex() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Home::class)
            ->execute('index');
    
            //$this->assertTrue($result->see('Log in', 'h1'));
            $this->assertTrue($result->isOK());
    }

    public function testSignOut() {
        //$_SESSION['newTournamentUsers'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Home::class)
            ->execute('signOut');
    
        //$this->assertTrue($result->see('Log in', 'h1'));
        $this->assertFalse($result->isOK());
        //$this->assertIsInt($result);
    }

    public function testRegister() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('register');

        $this->assertTrue($result->isOK());

    }

    public function testRegister_() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('register_');

        $this->assertFalse($result->isOK());
    }

    public function testLogin() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('login');

        $this->assertTrue($result->isOK());
    }

    public function testLogin_() {
        $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('login_');

        $this->assertTrue($result->isOK());

        $_SESSION['ID'] = 6;
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('login_');

        $this->assertTrue($result->isOK());

        $_SESSION['ID'] = 1;
        $_POST['username'] = 'gildraus';
        $_POST['password'] = '12345';
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('login_');

        $this->assertTrue($result->isOK());
    }

    public function testHome() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('home');

        $this->assertTrue($result->isOK());

        $_SESSION['role'] = 0;
        $_SESSION['ID'] = 1;

        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('home');

        $this->assertTrue($result->isOK());
    }

    public function provide_roles() {
        return [
            [-1],
            [0],
            [1],
            [2]
        ];
    }

    /**
     * @dataProvider provide_roles
     */
    public function testAllow($role) {

        $_SESSION['role'] = $role;

        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('allow');

        $this->assertTrue($result->see('Allow/block user', 'h1'));
    }
    
    public function testAllow_() {
        $_SESSION['ID'] = 1;
        $_SESSION['role'] = 0;

        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('allow_');

        $this->assertTrue($result->see('Allow/block user', 'h1'));
    }

    public function testSettings_() {
        $_SESSION['ID'] = 1;
        $_FILES['file']['name'] = 'usersImages/guest.png';
        $_FILES['file']['tmp_name'] = 'usersImages/guest.png';
        $_SESSION['role'] = 0;
        //$_SESSION['role'] = 0;
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('settings_');

        $this->assertTrue($result->isOK());
    }

    public function provide_ids_roles() {
        return [
            [1, 0]
        ];
    }

    /**
     * @dataProvider provide_ids_roles
     */
    public function testRoles($id, $role) {
        $_SESSION['ID'] = $id;
        $_SESSION['role'] = $role;
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('roles');

        $this->assertTrue($result->isOK());
    }

    /**
     * @dataProvider provide_ids_roles
     */
    public function testRoles_($id, $role) {
        $_SESSION['ID'] = $id;
        $_SESSION['role'] = $role;
        $_POST['username'] = 'gildraus';
        $_POST['roles'] = 0;
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('roles_');

        $this->assertTrue($result->isOK());
    }

    public function testSettings() {
        $_SESSION['ID'] = 1;
        $_SESSION['role'] = 0;

        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('settings');

        $this->assertTrue($result->isOK());
    }

}
