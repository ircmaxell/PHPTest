<?php

namespace PHPTest;

class TestSuiteTest extends TestCase {

    public function testCount() {
        $suite = new TestSuite;
        $suite->add(new WasRunTest());
        $this->assert(4 == count($suite));
        $suite->add(new WasRunTest());
        $this->assert(8 == count($suite));
    }

    public function testSuite() {
        $suite = new TestSuite;
        $suite->add(new WasRunTest());
        $result = new TestResult;
        $suite->run($result);
        $this->assert(2 == $result->getSuccessfulCount(), 'Suite Failed');
        $this->assert(1 == $result->getFailedCount(), 'Suite Failed, Too Many Errors');
    }

    public function testSuiteWithSuite() {
        $suite = new TestSuite;
        $suite->add(new WasRunTest());
        $suite2 = new TestSuite;
        $suite2->add(new WasRunTest());
        $suite->add($suite2);
        $result = new TestResult;
        $suite->run($result);
        $this->assert(4 == $result->getSuccessfulCount(), 'Suite Failed');
        $this->assert(2 == $result->getFailedCount(), 'Suite Failed, Too Many Errors');
    }

}
