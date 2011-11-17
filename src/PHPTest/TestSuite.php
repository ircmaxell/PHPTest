<?php

namespace PHPTest;

class TestSuite implements Testable {
    protected $tests = array();

    protected $observers = array();

    protected $plugins = array();

    public function addPlugin($plugin) {
        $this->plugins[] = $plugin;
        foreach ($this->tests as $test) {
            $test->addPlugin($plugin);
        }
    }

    public function attachObserver($callback) {
        $this->observers[] = $callback;
        foreach ($this->tests as $test) {
            $test->attachObserver($callback);
        }
    }

    public function updateObservers() {
        foreach ($this->observers as $callback) {
            call_user_func_array($callback, func_get_args());
        }
    }

    public function add(Testable $test) {
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