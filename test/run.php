<?php

namespace PHPTest\test;

require_once '../src/PHPTest/TestCase.php';
require_once 'Unit/WasRunTest.php';
require_once 'Unit/TestCaseTest.php';

$test = new \PHPTest\test\Unit\TestCaseTest('testTemplateMethod');
$test->run();