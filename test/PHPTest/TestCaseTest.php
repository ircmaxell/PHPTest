<?php

namespace PHPTest;

class TestCaseTest extends TestCase {
    protected $result = null;

    public function setUp() {
        $this->result = new TestResult;
    }

    public function testTemplateMethod() {
        $test = new WasRunTest('testMethod');
        $test->run($this->result);
        $this->assert($test->log == 'setUp testMethod tearDown ', 'Was Not Run Correctly');
    }

    public function testResult() {
        $test = new WasRunTest('testMethod');
        $test->run($this->result);
        $this->assert('1 run, 0 failed' == $this->result->summary());
    }

    public function testFailedResult() {
        $test = new WasRunTest('testBrokenMethod');
        $test->run($this->result);
        $this->assert('1 run, 1 failed' == $this->result->summary());
    }

}
