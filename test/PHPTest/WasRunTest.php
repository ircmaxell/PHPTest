<?php

namespace PHPTest;

class WasRunTest extends TestCase {

    public $log = '';

    protected function assertPreConditions() {
        $this->log .= 'assertPreConditions ';
    }

    protected function assertPostConditions() {
        $this->log .= 'assertPostConditions ';
    }

    protected function onNotSuccessfulTest() {
        $this->log .= 'onNotSuccessfulTest ';
    }

    protected function setUp() {
        $this->log .= 'setUp ';
    }

    protected function tearDown() {
        $this->log .= 'tearDown ';
    }

    protected function setUpBeforeClass() {
        $this->log .= 'setUpBeforeClass ';
    }

    protected function tearDownAfterClass() {
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
