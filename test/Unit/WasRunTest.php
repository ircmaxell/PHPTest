<?php

namespace PHPTest\test\Unit;

$test = new WasRun('testMethod');
echo $test->wasRun;
$test->run();
echo $test->wasRun;

class WasRun {
    public $wasRun = 0;
    public $name = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public function testMethod() {
        $this->wasRun = 1;
    }

    public function run() {
        $this->{$this->name}();
    }
}