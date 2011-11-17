<?php

namespace PHPTest;

class TestSuite extends TestBase {

    public function add(Core\Testable $test) {
        $this->tests[] = $test;
        foreach ($this->observers as $observer) {
            $test->attachObserver($observer);
        }
        foreach ($this->plugins as $plugin) {
            $test->addPlugin($plugin);
        }
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