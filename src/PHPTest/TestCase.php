<?php

namespace PHPTest;

class TestCase implements Testable {

    protected $tests = array();

    public function __construct($name = '') {
        $reflector = new \ReflectionObject($this);
        foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $test = $name ? strcasecmp($name, $method->getName()) : stripos($method->getName(), 'test');
            if ($test === 0) {
                $this->tests[] = $method->getName();
            }
        }
    }

    public function assert($test, $message = '') {
        if (!$test) {
            throw new \PHPTest\Exception\AssertionFailure($message);
        }
    }

    protected function assertPreConditions() {
    }

    protected function assertPostConditions() {
    }

    protected function setUpBeforeClass() {
    }

    protected function onNotSuccessfulTest() {
    }

    protected function setUp() {
    }

    protected function tearDown() {
    }

    protected function tearDownAfterClass() {
    }

    public function run(TestResult $result) {
        $this->setUpBeforeClass();
        foreach ($this->tests as $test) {
            $this->runTest($test, $result);
        }
        $this->tearDownAfterClass();
    }

    public function runTest($name, TestResult $result) {
        $result->testStarted();
        $this->setUp();
        $this->installErrorHandler();
        try {
            $this->assertPreConditions();
            $this->{$name}();
            $this->assertPostConditions();
        } catch (\PHPTest\Exception\ErrorException $e) {
            $this->onNotSuccessfulTest();
            $result->testError($e);
        } catch (\Exception $e) {
            $this->onNotSuccessfulTest();
            $result->testFailed($e);
        }
        $this->uninstallErrorHandler();
        $this->tearDown();
    }

    protected function installErrorHandler() {
        set_error_handler(
            function($errno, $errstr, $errfile, $errline) {
                throw new \PHPTest\Exception\ErrorException($errstr, 0, $errno, $errfile, $errline);
            }
        );
    }

    protected function uninstallErrorHandler() {
        restore_error_handler();
    }
}