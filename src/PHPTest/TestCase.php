<?php

namespace PHPTest;

class TestCase extends TestBase {

    protected $test = null;
    protected $method = '';
    protected $arguments = array();

    public function __construct(Core\Test $test, $method, array $arguments = array()) {
        $this->test = $test;
        $this->method = $method;
        $this->arguments = $arguments;
    }

    public function run(TestResult $result) {
        $result->testStarted();
        $this->test->setUp();
        $this->installErrorHandler();
        try {
            $this->test->assertPreConditions();
            $this->updateObservers('beforeTest', $this->method, $result);
            call_user_func_array(array($this->test, $this->method), $this->arguments);
            $this->updateObservers('afterTest', $this->method, $result);
            $this->test->assertPostConditions();
            $result->testCompleted();
        } catch (\PHPTest\Exception\ErrorException $e) {
            $this->updateObservers('errorTest', $this->method, $result, $e);
            $this->test->onNotSuccessfulTest();
            $result->testError($e);
        } catch (\Exception $e) {
            $this->updateObservers('failedTest', $this->method, $result, $e);
            $this->test->onNotSuccessfulTest();
            $result->testFailed($e);
        }
        $this->uninstallErrorHandler();
        $this->test->tearDown();
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