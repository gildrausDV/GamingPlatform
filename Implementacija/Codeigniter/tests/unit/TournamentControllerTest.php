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
    
    /*public function testIndex() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('index');
    
        $this->assertTrue($result->isOK());
    }*/   

    /*public function testTournament() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('tournament');
    
        $this->assertTrue($result->isOK());
    }*/

    /*public function testAddTournament() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('addTournament');
    
        $this->assertTrue($result->isOK());
    }*/

    /*public function testPlayerList() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('playerList', 1);
    
        $this->assertTrue($result->isOK());
    }*/

    /*public function testEndTournament() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Tournament::class)
            ->execute('endTournament');
    
        $this->assertTrue($result->isOK());
    }*/

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
