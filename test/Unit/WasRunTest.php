<?php

namespace PHPTest\test\Unit;

$test = new WasRun();
print $test->wasRun;
$test->testMethod();
print $test->wasRun;

