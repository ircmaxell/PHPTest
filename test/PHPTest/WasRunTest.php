<?php

namespace PHPTest;

class WasRunTest extends TestCase {

    public $log = '';

    public function setUp() {
        $this->log = 'setUp ';
    }

    public function tearDown() {
        $this->log .= 'tearDown ';
    }

    public function testMethod() {
        $this->log .= 'testMethod ';
    }

    public function testBrokenMethod() {
        throw new \Exception('Broken');
    }

}
