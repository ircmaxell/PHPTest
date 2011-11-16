<?php

namespace PHPTest;

class TestSuite implements Testable {
    protected $tests = array();

    public function add(Testable $test) {
        $this->tests[] = $test;
    }

    public function run(TestResult $result) {
        foreach ($this->tests as $test) {
            $test->run($result);
        }
    }

}