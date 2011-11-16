<?php

namespace PHPTest;

//Register both autoloaders
require_once '../src/PHPTest/bootstrap.php';
require_once 'PHPTest/bootstrap.php';

$suite = new \PHPTest\TestSuite;
$suite->add(new \PHPTest\TestCaseTest('testTemplateMethod'));
$suite->add(new \PHPTest\TestCaseTest('testResult'));
$suite->add(new \PHPTest\TestCaseTest('testFailedResult'));
$suite->add(new \PHPTest\TestResultTest('testFailedResultFormatting'));
$suite->add(new \PHPTest\TestSuiteTest('testSuite'));
$result = new \PHPTest\TestResult;

$suite->run($result);

echo $result->summary();