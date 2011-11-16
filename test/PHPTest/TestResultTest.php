<?php

namespace PHPTest;

class TestResultTest extends TestCase {

    public function testFailedResultFormatting() {
        $result = new TestResult;
        $result->testStarted();
        $result->testFailed();
        $this->assert('1 run, 1 failed' == $result->summary());
    }

}
