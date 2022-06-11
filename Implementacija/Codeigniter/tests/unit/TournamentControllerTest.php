<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\MainSeeder;

/**
 * @internal
 */
final class TournamentControllerTest extends CIUnitTestCase {

    use ControllerTestTrait;
    use DatabaseTestTrait;

    protected $refresh = true;

    protected $seed = MainSeeder::class;
    
    public function testIndex() {
        
        $_SESSION['role'] = 0;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('index');
    
        $this->assertTrue($result->isOK());

        $_SESSION['role'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('index');
    
        $this->assertTrue($result->isOK());

        $_SESSION['role'] = 2;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('index');
    
        $this->assertTrue($result->isOK());
    }

    public function provide_ids_roles() {
        return [
            [1, 2],
            [2, 1],
            [3, 0]
        ];
    }

    /**
     * @dataProvider provide_ids_roles
     */
    public function testTournament($id, $role) {
        $_SESSION['ID'] = $id;
        $_SESSION['role'] = $role;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('tournament');
    
        $this->assertTrue($result->isOK());
    }

    public function testAddTournament() {
        $_SESSION['role'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('addTournament');
    
        $this->assertTrue($result->isOK());

        $_SESSION['role'] = 2;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('addTournament');
    
        $this->assertTrue($result->isOK());
    }

    public function provide_ids_roles_tournaments() {
        return [
            [1, 2, 1],
            [1, 2, 2],
            [1, 2, 3],
            [2, 1, 1],
            [2, 1, 2],
            [2, 1, 3],
            [3, 0, 1],
            [3, 0, 2],
            [3, 0, 3]
        ];
    }

    /**
     * @dataProvider provide_ids_roles_tournaments
     */
    public function testPlayerList($id, $role, $tournament) {
        $_SESSION['ID'] = $id;
        $_SESSION['role'] = $role;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('playerList', $tournament);
    
        $this->assertTrue($result->isOK());
    }

    public function testEndTournament() {
        $_POST['argument'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('endTournament');
    
        $this->assertTrue($result->isOK());
    }

    public function testIsActive() {
        $_POST['arguments'][0] = 1;
        $_POST['arguments'][1] = 1;
        $_POST['arguments'][2] = 1;
        $_POST['arguments'][3] = 1;
        $_POST['arguments'][4] = 1;
        $_POST['arguments'][5] = 1;

        if(!isset($_SESSION['ID'])) $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('isActive', 'Rayman');
    
        $this->assertTrue($result->isOK());

        $_POST['arguments'] = [
            2021, 3, 4, 13, 30, 0
        ];
        if(!isset($_SESSION['ID'])) $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('isActive', 'Rayman');
    
        $this->assertTrue($result->isOK());
    }

    public function testGetJoined() {
        if(!isset($_SESSION['ID'])) $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('getJoined');
    
        $this->assertTrue($result->isOK());
    }

    public function testGetPlayersList() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('getPLayersList', 1);
    
        $this->assertTrue($result->isOK());
    }

    public function testGetTournament() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('getTournaments');
    
        $this->assertTrue($result->isOK());
    }

    public function testAdd_tournament() {
        /*$_POST['arguments'][0] = "Rayman";
        $_POST['arguments'][1] = 5;
        $_POST['arguments'][2] = "2023-02-02";
        $_POST['arguments'][3] = "19:00:00";
        $_POST['arguments'][4] = "21:00:00";*/

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('add_tournament');
    
        $this->assertFalse($result->isOK());

        $_POST['arguments'] = [
            "Rayman", 5, "2023-02-02", "19:00:00", "21:00:00"
        ];
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('add_tournament');
    
        $this->assertTrue($result->isOK());

        $_POST['arguments'] = [
            "Rayman", 5, "2021-03-04", "13:30:00", "13:50:00"
        ];
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('add_tournament');
    
        $this->assertTrue($result->isOK());
    }

    public function testJoinTournament() {
        $_POST['argument'] = 1;
        $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('joinTournament');
    
        $this->assertTrue($result->isOK());
    }

}
