<?php

namespace PHPTest;

class TestCaseTest extends TestCase {

    protected $result = null;

    public function setUp() {
        $this->result = new TestResult;
    }

    public function testAssert() {
        $this->assert(true, 'Assert(true) failed!!!');
    }

    public function testAssertFailure() {
        try {
            $this->assert(false, 'Assert(false) worked');
            throw new \Exception('Assert(false) Did Not Work');
        } catch(\PHPTest\Exception\AssertionFailure $e) {

        }
    }

    public function testTemplateMethod() {
        $test = new WasRunTest();
        $test->run($this->result);
        $expected = 'setUpBeforeClass ';
        $expected .= 'setUp assertPreConditions testErrorMethod onNotSuccessfulTest tearDown ';
        $expected .= 'setUp assertPreConditions testMethod assertPostConditions tearDown ';
        $expected .= 'setUp assertPreConditions testBrokenMethod onNotSuccessfulTest tearDown ';
        $expected .= 'setUp assertPreConditions testCalled assertPostConditions tearDown ';
        $expected .= 'tearDownAfterClass ';
        $this->assert($test->log == $expected, 'Was Not Run Correctly');
    }

    public function testResult() {
        $test = new WasRunTest();
        $test->runTest('testMethod', $this->result);
        $this->assert(1 == $this->result->getSuccessfulCount());
    }

    public function testFailedResult() {
        $test = new WasRunTest();
        $test->runTest('testBrokenMethod', $this->result);
        $this->assert(1 == $this->result->getFailedCount());
    }

    public function testErrorResult() {
        $test = new WasRunTest();
        $test->runTest('testErrorMethod', $this->result);
        $this->assert(1 == $this->result->getErrorCount());
    }

    public function testRunAllTests() {
        $test = new WasRunTest();
        $test->run($this->result);
        $this->assert(4 == $this->result->getRunCount());
    }

    public function testSingleTestCase() {
        $test = new WasRunTest('testMethod');
        $test->run($this->result);
        $this->assert(1 == $this->result->getRunCount());
    }

}
