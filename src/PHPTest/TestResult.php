<?php

namespace PHPTest;

class TestResult {

    protected $errors = array();
    protected $failures = array();
    protected $runCount = 0;
    protected $completedCount = 0;

    protected $observers = array();

    public function attachObserver($callback) {
        $this->observers[] = $callback;
    }

    public function updateObservers() {
        foreach ($this->observers as $callback) {
            call_user_func_array($callback, func_get_args());
        }
    }

    public function getRunCount() {
        return $this->runCount;
    }

    public function getErrorCount() {
        return count($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getFailedCount() {
        return count($this->failures);
    }

    public function getFailures() {
        return $this->failures;
    }

    public function getSuccessfulCount() {
        return $this->completedCount;
    }

    public function testCompleted() {
        $this->completedCount++;
        $this->updateObservers('testCompleted');
    }

    public function testError(\Exception $error) {
        $this->errors[] = $error;
        $this->updateObservers('testError', $error);
    }

    public function testFailed(\Exception $failure) {
        $this->failures[] = $failure;
        $this->updateObservers('testFailure', $failure);
    }

    public function testStarted() {
        $this->runCount++;
        $this->updateObservers('testStarted');
    }

    public function report() {
        return 'This is a failed message';
    }

    public function summary() {
        return sprintf("%d run, %d failed, %d errors", $this->runCount, $this->getFailedCount(), $this->getErrorCount());
    }

}