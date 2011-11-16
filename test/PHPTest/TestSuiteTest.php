<?php

namespace PHPTest;

class TestSuiteTest extends TestCase {

    public function testSuite() {
        $suite = new TestSuite;
        $suite->add(new WasRunTest('testMethod'));
        $suite->add(new WasRunTest('testBrokenMethod'));
        $result = new TestResult;
        $suite->run($result);
        $this->assert(1 == $result->getSuccessfulCount(), 'Suite Failed');
        $this->assert(1 == $result->getFailedCount(), 'Suite Failed');
    }

}
