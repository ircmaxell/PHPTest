<?php

namespace PHPTest;

class TestResultTest extends TestCase {

    public function testFailedResultFormatting() {
        $result = new TestResult;
        $result->testStarted();
        $result->testFailed(new \Exception);
        $this->assert(1 == $result->getFailedCount());
    }

    public function testErrorResultFormatting() {
        $result = new TestResult;
        $result->testStarted();
        $result->testError(new \Exception);
        $this->assert(1 == $result->getErrorCount());
    }

    public function testGetErrors() {
        $result = new TestResult;
        $result->testStarted();
        $e = new \Exception('foo');
        $result->testError($e);
        $this->assert(array($e) === $result->getErrors(), 'Could not get errors');
    }

    public function testGetFailures() {
        $result = new TestResult;
        $result->testStarted();
        $e = new \Exception('foo');
        $result->testFailed($e);
        $this->assert(array($e) === $result->getFailures(), 'Could not get failures');
    }

}
