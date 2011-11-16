<?php

namespace PHPTest;

class TestSuite {
    protected $tests = array();

    public function add(TestCase $test) {
        $this->tests[] = $test;
    }

    public function run(TestResult $result) {
        foreach ($this->tests as $test) {
            $test->run($result);
        }
    }

}