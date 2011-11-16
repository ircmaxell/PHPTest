<?php

namespace PHPTest;

//Register both autoloaders
require_once '../src/PHPTest/bootstrap.php';
require_once 'bootstrap.php';

$suite = new \PHPTest\TestSuite;
$suite->add(new \PHPTest\TestCaseTest());
$suite->add(new \PHPTest\TestResultTest());
$suite->add(new \PHPTest\TestSuiteTest());
$suite->add(new \PHPTest\Report\CLITest());

$result = new \PHPTest\TestResult;

$suite->run($result);

$renderer = new \PHPTest\Report\CLI;
echo $renderer->render($result);