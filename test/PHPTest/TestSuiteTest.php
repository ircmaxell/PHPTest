<?php

namespace PHPTest;

class TestSuiteTest extends TestCase {

    public function testSuite() {
        $suite = new TestSuite;
        $suite->add(new WasRunTest());
        $result = new TestResult;
        $suite->run($result);
        $this->assert(2 == $result->getSuccessfulCount(), 'Suite Failed');
        $this->assert(1 == $result->getFailedCount(), 'Suite Failed, Too Many Errors');
    }

}
