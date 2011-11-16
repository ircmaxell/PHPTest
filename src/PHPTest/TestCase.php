<?php

namespace PHPTest;

class TestCase {

    protected $name = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public function assert($test, $message = '') {
        if (!$test) {
            throw new \PHPTest\Exception\AssertionFailure($message);
        }
    }

    public function setUp() {

    }

    public function tearDown() {

    }

    public function run(TestResult $result) {
        $result->testStarted();
        $this->setUp();
        $this->installErrorHandler();
        try {
            $this->{$this->name}();
        } catch (\PHPTest\Exception\ErrorException $e) {
            $result->testError($e);
        } catch (\Exception $e) {
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