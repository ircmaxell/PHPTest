<?php

namespace PHPTest;

class TestResult {

    protected $errors = array();
    protected $failures = array();
    protected $runCount = 0;
    protected $failedCount = 0;

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
        return $this->runCount - ($this->getErrorCount() + $this->getFailedCount());
    }

    public function testError(\Exception $error) {
        $this->errors[] = $error;
    }

    public function testFailed(\Exception $failure) {
        $this->failures[] = $failure;
    }

    public function testStarted() {
        $this->runCount++;
    }

    public function report() {
        return 'This is a failed message';
    }

    public function summary() {
        return sprintf("%d run, %d failed, %d errors", $this->runCount, $this->getFailedCount(), $this->getErrorCount());
    }

}