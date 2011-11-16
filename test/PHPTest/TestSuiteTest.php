<?php

namespace PHPTest;

class TestSuiteTest extends TestCase {

    public function testSuite() {
        $suite = new TestSuite;
        $suite->add(new WasRunTest('testMethod'));
        $suite->add(new WasRunTest('testBrokenMethod'));
        $result = new TestResult;
        $suite->run($result);
        $this->assert('2 run, 1 failed' == $result->summary(), 'Suite Failed');
    }

}
