<?php

namespace PHPTest;

class TestResult {

    protected $runCount = 0;
    protected $failedCount = 0;

    public function testFailed() {
        $this->failedCount++;
    }

    public function testStarted() {
        $this->runCount++;
    }

    public function summary() {
        return sprintf("%d run, %d failed", $this->runCount, $this->failedCount);
    }

}