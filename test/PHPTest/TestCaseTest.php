<?php

namespace PHPTest;

class TestCaseTest extends TestClass {

    protected $mock = null;
    protected $result = null;

    public function setUp() {
        $this->result = new TestResult;
        $this->mock = new Mocks\WasRunTest;
    }

    public function testTemplateMethod() {
        $this->mock->run($this->result);
        $expected = 'setUpBeforeClass ';
        $expected .= 'setUp assertPreConditions testErrorMethod onNotSuccessfulTest tearDown ';
        $expected .= 'setUp assertPreConditions testMethod assertPostConditions tearDown ';
        $expected .= 'setUp assertPreConditions testBrokenMethod onNotSuccessfulTest tearDown ';
        $expected .= 'setUp assertPreConditions testCalled assertPostConditions tearDown ';
        $expected .= 'tearDownAfterClass ';
        $this->assert($this->mock->log == $expected, 'Was Not Run Correctly');
    }

    public function testResult() {
        $test = new TestCase($this->mock, 'testMethod');
        $test->run($this->result);
        $this->assert(1 == $this->result->getSuccessfulCount());
    }

    public function testFailedResult() {
        $test = new TestCase($this->mock, 'testBrokenMethod');
        $test->run($this->result);
        $this->assert(1 == $this->result->getFailedCount());
    }

    public function testErrorResult() {
        $test = new TestCase($this->mock, 'testErrorMethod');
        $test->run($this->result);
        $this->assert(1 == $this->result->getErrorCount());
    }
}
