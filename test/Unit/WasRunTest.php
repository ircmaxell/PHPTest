<?php

namespace PHPTest\test\Unit;

$test = new WasRun();
echo $test->wasRun;
$test->testMethod();
echo $test->wasRun;

class WasRun {
    public $wasRun = 0;

    public function testMethod() {
        $this->wasRun = 1;
    }
}