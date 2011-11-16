<?php

namespace PHPTest;

class TestCase {

    protected $name = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public function assert($test, $message = '') {
        if (!$test) {
            throw new \Exception($message);
        }
    }

    public function setUp() {

    }

    public function tearDown() {

    }

    public function run(TestResult $result) {
        $result->testStarted();
        $this->setUp();
        try {
            $this->{$this->name}();
        } catch (\Exception $e) {
            $result->testFailed();
        }
        $this->tearDown();
    }
}