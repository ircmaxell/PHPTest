<?php

namespace PHPTest;

class TestSuiteTest extends TestClass {

    protected $suite = null;

    public function setUp() {
        $this->suite = new TestSuite();
    }

    public function testCount() {
        $this->suite->add(new Mocks\WasRunTest());
        $this->assert(4 == count($this->suite));
        $this->suite->add(new Mocks\WasRunTest());
        $this->assert(8 == count($this->suite));
    }

    public function testSuite() {
        $this->suite = new TestSuite;
        $this->suite->add(new Mocks\WasRunTest());
        $result = new TestResult;
        $this->suite->run($result);
        $this->assert(2 == $result->getSuccessfulCount(), 'Suite Failed');
        $this->assert(1 == $result->getFailedCount(), 'Suite Failed, Too Many Errors');
    }

    public function testSuiteWithSuite() {
        $this->suite = new TestSuite;
        $this->suite->add(new Mocks\WasRunTest());
        $this->suite2 = new TestSuite;
        $this->suite2->add(new Mocks\WasRunTest());
        $this->suite->add($this->suite2);
        $result = new TestResult;
        $this->suite->run($result);
        $this->assert(4 == $result->getSuccessfulCount(), 'Suite Failed');
        $this->assert(2 == $result->getFailedCount(), 'Suite Failed, Too Many Errors');
    }

    public function testAddPlugin() {

        $test = new Mocks\WasRunTest();
        $this->suite->add($test);
        $this->suite->addPlugin(new \PHPTest\Plugins\Assert($this->suite));
        //Test to see if plugin cascaded
        $test->assertEquals(true, true);
        //Test to see if later added tests get cascaded as well
        $test2 = new Mocks\WasRunTest();
        $this->suite->add($test2);
        $test2->assertEquals(true, true);
    }

}
