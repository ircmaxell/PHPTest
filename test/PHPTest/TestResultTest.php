<?php

namespace PHPTest;

class TestResultTest extends TestCase {

    public function testObservers() {
        $last = '';
        $last2 = '';
        $result = new TestResult;
        $result->attachObserver(function($arg) use (&$last) {$last = $arg;});
        $result->updateObservers('foo');
        $this->assert('foo' == $last);
        $result->attachObserver(function($arg) use (&$last2) {$last2 = $arg;});
        $result->updateObservers('bar');
        $this->assert('bar' == $last);
        $this->assert('bar' == $last2);
    }

    public function testFailedResultFormatting() {
        $updated = 0;

        $result = new TestResult;
        $result->attachObserver(function() use (&$updated) {$updated++;});
        $this->assert(0 === $updated);
        $result->testStarted();
        $this->assert(1 === $updated);
        $result->testFailed(new \Exception);
        $this->assert(2 === $updated);
        $this->assert(1 == $result->getFailedCount());
        $this->assert(2 === $updated);


    }

    public function testGoodResultFormatting() {
        $result = new TestResult;
        $result->testStarted();
        $result->testCompleted();
        $this->assert(1 == $result->getSuccessfulCount());
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
