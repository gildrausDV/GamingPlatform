<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class TournamentControllerTest extends CIUnitTestCase {

    use ControllerTestTrait;
    use DatabaseTestTrait;
    
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
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('endTournament');
    
        $this->assertTrue($result->isOK());
    }

    /*public function testIsActive() {
        if(!isset($_SESSION['ID'])) $_SESSION['ID'] = 1;
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('isActive', 'Rayman');
    
        $this->assertTrue($result->isOK());
    }*/

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

    /*public function testAdd_tournament() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('add_tournament');
    
        $this->assertTrue($result->isOK());
    }*/

    /*public function testJoinTournament() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('joinTournament');
    
        $this->assertTrue($result->isOK());
    }*/

}
