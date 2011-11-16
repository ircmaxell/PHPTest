<?php

namespace PHPTest;

class WasRunTest extends TestCase {

    public $log = '';

    public function assertPreConditions() {
        $this->log .= 'assertPreConditions ';
    }

    public function assertPostConditions() {
        $this->log .= 'assertPostConditions ';
    }

    public function onNotSuccessfulTest() {
        $this->log .= 'onNotSuccessfulTest ';
    }

    public function setUp() {
        $this->log .= 'setUp ';
    }

    public function tearDown() {
        $this->log .= 'tearDown ';
    }

    public function setUpBeforeClass() {
        $this->log .= 'setUpBeforeClass ';
    }

    public function tearDownAfterClass() {
        $this->log .= 'tearDownAfterClass ';
    }

    public function testErrorMethod() {
        $this->log .= 'testErrorMethod ';
        trigger_error('testing errors', E_USER_WARNING);
    }

    public function testMethod() {
        $this->log .= 'testMethod ';
    }

    public function testBrokenMethod() {
        $this->log .= 'testBrokenMethod ';
        throw new \Exception('Broken');
    }

    public function testCalled() {
        $this->log .= 'testCalled ';
    }

    public function notCalled() {
        $this->log .= 'notCalled ';
        throw new \Exception('Should not be called!');
    }

}
