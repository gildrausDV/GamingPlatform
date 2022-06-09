<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class HomeControllerTest extends CIUnitTestCase {

    use ControllerTestTrait;
    use DatabaseTestTrait;

    /*public function testIndex() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Home::class)
            ->execute('index');
    
            $this->assertTrue($result->see('Log in', 'h1'));
    }*/

    /*public function testSignOut() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Home::class)
            ->execute('signOut');
    
        $this->assertTrue($result->see('Log in', 'h1'));
    }*/

    public function testRegister() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('register');

        $this->assertTrue($result->isOK());

    }

    public function testLogin() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('login');

        $this->assertTrue($result->isOK());
    }

    public function testHome() {
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
        //if(!isset($_SESSION['role'])) {
            $_SESSION['role'] = $role;
        //}
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('allow');

        $this->assertTrue($result->see('Allow/block user', 'h1'));
    }

    /*public function testSettings() {
        $result = $this//->withURI('http://localhost:8080/...')
        ->controller(\App\Controllers\Home::class)
        ->execute('settings');

        $this->assertTrue($result->isOK());
    }*/
    


}
