<?php

namespace PHPTest\test;

require_once '../src/PHPTest/TestCase.php';
require_once 'PHPTest/WasRunTest.php';
require_once 'PHPTest/TestCaseTest.php';

$test = new \PHPTest\TestCaseTest('testTemplateMethod');
$test->run();