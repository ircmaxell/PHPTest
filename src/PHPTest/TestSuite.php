<?php

namespace PHPTest;

class TestSuite implements Testable {
    protected $tests = array();

    public function add(Testable $test) {
        $this->tests[] = $test;
    }

    public function count() {
        $sum = 0;
        foreach ($this->tests as $test) {
            $sum += $test->count();
        }
        return $sum;
    }

    public function run(TestResult $result) {
        foreach ($this->tests as $test) {
            $test->run($result);
        }
    }

}