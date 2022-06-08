<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class GamesControllerTest extends CIUnitTestCase {

    use ControllerTestTrait;
    use DatabaseTestTrait;
    
    /*public function testHistory() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('index');
    
        $this->assertTrue($result->isOK());
    }*/

    public function testGetHistory() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getHistory', 1);
    
        $this->assertTrue($result->isOK());
    }
    
    /*public function testTopPlayersRayman() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('topPlayers', 'Rayman');
    
        $this->assertTrue($result->isOK());
    }

    public function testTopPlayersFlappyBird() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('topPlayers', 'FlappyBird');
    
        $this->assertTrue($result->isOK());
    }*/

    public function testGames() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('game', 'Rayman');
    
        $this->assertTrue($result->isOK());

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('game', 'FlappyBird');
    
        $this->assertTrue($result->isOK());
    }

    /*public function testAddLevel_default() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('addLevel_default');

        $this->assertTrue($result->isOK());
    }*/

    public function testMyNPoints() {
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

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('getLevel', 'FlappyBird');

        $this->assertTrue($result->isOK());
    }

    /*public function testAddLevel() {
        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('add_level', 'Rayman');

        $this->assertTrue($result->isOK());

        $result = $this//->withURI('http://localhost:8080/...')
            ->controller(\App\Controllers\Games::class)
            ->execute('add_level', 'FlappyBird');

        $this->assertTrue($result->isOK());
    }*/

}
