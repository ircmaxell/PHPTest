<?php

namespace PHPTest;

class TestCase implements Testable {

    protected $tests = array();

    protected $observers = array();

    protected $plugins = array();

    public function __call($method, $args) {
        foreach ($this->plugins as $plugin) {
            if (method_exists($plugin, $method)) {
                return call_user_func_array(array($plugin, $method), $args);
            }
        }
        throw new \BadMethodCallException('Method does not exist in plugins');
    }

    public function addPlugin($plugin) {
        $this->plugins[] = $plugin;
    }

    public function attachObserver($callback) {
        $this->observers[] = $callback;
    }

    public function updateObservers() {
        foreach ($this->observers as $callback) {
            call_user_func_array($callback, func_get_args());
        }
    }

    public function __construct($name = '') {
        $reflector = new \ReflectionObject($this);
        foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $test = $name ? strcasecmp($method->getName(), $name) : stripos($method->getName(), 'test');
            if ($test === 0) {
                $this->tests[] = $method->getName();
            }
        }
    }

    public function count() {
        return count($this->tests);
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
            $this->updateObservers('beforeTest', $name, $result);
            $this->{$name}();
            $this->updateObservers('afterTest', $name, $result);
            $this->assertPostConditions();
            $result->testCompleted();
        } catch (\PHPTest\Exception\ErrorException $e) {
            $this->updateObservers('errorTest', $name, $result, $e);
            $this->onNotSuccessfulTest();
            $result->testError($e);
        } catch (\Exception $e) {
            $this->updateObservers('failedTest', $name, $result, $e);
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