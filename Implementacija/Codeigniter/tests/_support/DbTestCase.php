<?php

namespace Tests\Support;

class DbTestCase extends \CodeIgniter\Test\CIDatabaseTestCase {
    
    protected $refresh = true;

    protected $basePath = SUPPORTPATH.'Database/';

    protected $migrate = false;

    protected function regressDatabase() {
        $sql = file_get_contents($this->basePath.'gamingplatform_test.sql');
        $this->db->query($sql);
    }

    public function setUp() : void {
        parent :: setUp();
    }

    public function tearDown() : void {
        parent :: tearDown();
    }

}