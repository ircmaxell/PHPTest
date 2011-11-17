<?php

namespace PHPTest;

abstract class TestBase implements Testable {

    protected $tests = array();

    protected $observers = array();

    protected $plugins = array();

    public function __call($method, $args) {
        foreach ($this->plugins as $plugin) {
            if (method_exists($plugin, $method)) {
                return call_user_func_array(array($plugin, $method), $args);
            }
        }
        throw new \BadMethodCallException('Method does not exist in plugins: ' . $method);
    }

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

    public function count() {
        return count($this->tests);
    }

}