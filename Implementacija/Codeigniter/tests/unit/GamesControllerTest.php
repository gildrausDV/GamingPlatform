<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\MainSeeder;

/**
 * @internal
 */
final class GamesControllerTest extends CIUnitTestCase {

    use ControllerTestTrait;
    use DatabaseTestTrait;

    protected $refresh = true;

    protected $seed = MainSeeder::class;
    
    public function testIndex() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('index');
    
        $this->assertTrue($result->isOK());
    }

    public function testHistory() {
        $_SESSION['role'] = 0;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('history', 'Rayman');
    
        $this->assertTrue($result->isOK());

        $_SESSION['role'] = -1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('history', 'Rayman');
    
        $this->assertTrue($result->isOK());
    }

    public function testGetHistory() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getHistory', 1);
    
        $this->assertTrue($result->isOK());
    }

    public function provide_ids() {
        return [
            [1, 2],
            [2, 1]
        ];
    }
    
    /**
     * @dataProvider provide_ids
     */
    public function testTopPlayersRayman($id, $role) {
        $_SESSION['ID'] = $id;
        $_SESSION['role'] = $role;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('topPlayers', 'Rayman');
    
        $this->assertTrue($result->isOK());
    }

    /**
     * @dataProvider provide_ids
     */
    public function testTopPlayersFlappyBird($id, $role) {
        $_SESSION['ID'] = $id;
        $_SESSION['role'] = $role;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('topPlayers', 'FlappyBird');
    
        $this->assertTrue($result->isOK());
    }

    public function testGames() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('game', 'Rayman');
    
        $this->assertTrue($result->isOK());

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('game', 'FlappyBird');
    
        $this->assertTrue($result->isOK());

        $_SESSION['role'] = 0;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('game', 'FlappyBird');
    
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

    // header greska...
    /*public function testAddLevel_default() {
        unset($_POST['argument']);
        unset($_POST['arguments']);
        unset($_GET['argument']);
        unset($_GET['arguments']);
        $_SESSION['ID'] = 1;
        $_SESSION['role'] = 0;
        
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('addLevel_default');

        $this->assertTrue($result->isOK());
    }*/

    // header greska...
    /*public function testAddLevel() {
        $_SESSION['ID'] = 1;
        $_POST['arguments'] = '{"rows":"5","cols":"5","wood":[{"y":"1","x":"1","len":"2"},{"y":"2","x":"2","len":"2"},{"y":"3","x":"3","len":"1"},{"y":"1","x":"0","len":"1"}],"coins":[{"y":"1","x":"1"},{"y":"2","x":"2"},{"y":"1","x":"0"}]}';
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('addLevel', 'Rayman');

        $this->assertFalse($result->isOK());
    }*/

    public function testMyNPoints() {
        $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('myNPoints');

        $this->assertTrue($result->isOK());
    }

    public function testGetTopPlayersGlobal() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getTopPlayers', 'Global');

        $this->assertTrue($result->isOK());
    }

    public function testGetTopPlayersGames() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getTopPlayers', 'Rayman');

        $this->assertTrue($result->isOK());

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getTopPlayers', 'FlappyBird');

        $this->assertTrue($result->isOK());
    }

    public function testGetListGames() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getList', 'Rayman');

        $this->assertTrue($result->isOK());

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getList', 'FlappyBird');

        $this->assertTrue($result->isOK());
    }

    public function testGetLevelGames() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getLevel', 'Rayman');

        $this->assertTrue($result->isOK());

        $_GET['arguments'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getLevel', 'FlappyBird');

        $this->assertTrue($result->isOK());

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getLevel', 'Rayman');

        $this->assertTrue($result->isOK());
    }

    public function testSave_data() {
        $_SESSION['ID'] = 1;

        $_POST['arguments'] = [
            10, 10, 3, 2021, 3, 4, 13, 30, 0
        ];

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('save_data', 'Rayman');

        $this->assertFalse($result->isOK());
        unset($_POST['arguments']);
    }

    public function testAdd_level() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('add_level', 'Rayman');

        $this->assertFalse($result->isOK());
        
        $_POST['arguments'] = '';
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('add_level', 'Rayman');

        $this->assertFalse($result->isOK());
        unset($_POST['arguments']);
    }

}
