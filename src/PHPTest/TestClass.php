<?php

namespace PHPTest;

class TestClass extends TestBase implements Test {

    public function __construct() {
        $reflector = new \ReflectionObject($this);
        foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (stripos($method->getName(), 'test') === 0) {
                $this->tests[] = new TestCase($this, $method->getName());
            }
        }
    }

    public function assertPreConditions() {
    }

    public function assertPostConditions() {
    }

    public function setUpBeforeClass() {
    }

    public function onNotSuccessfulTest() {
    }

    public function setUp() {
    }

    public function tearDown() {
    }

    public function tearDownAfterClass() {
    }

    public function run(TestResult $result) {
        $this->setUpBeforeClass();
        foreach ($this->tests as $test) {
            $test->run($result);
        }
        $this->tearDownAfterClass();
    }

}