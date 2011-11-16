<?php

namespace PHPTest;

//Register both autoloaders
require_once '../src/PHPTest/bootstrap.php';
require_once 'bootstrap.php';

$suite = new \PHPTest\TestSuite;
$suite->add(new \PHPTest\TestCaseTest('testTemplateMethod'));
$suite->add(new \PHPTest\TestCaseTest('testResult'));
$suite->add(new \PHPTest\TestCaseTest('testFailedResult'));
$suite->add(new \PHPTest\TestCaseTest('testErrorResult'));
$suite->add(new \PHPTest\TestResultTest('testFailedResultFormatting'));
$suite->add(new \PHPTest\TestResultTest('testErrorResultFormatting'));
$suite->add(new \PHPTest\TestResultTest('testGetErrors'));
$suite->add(new \PHPTest\TestResultTest('testGetFailures'));
$suite->add(new \PHPTest\TestSuiteTest('testSuite'));
$suite->add(new \PHPTest\Report\CLITest('testRender'));
$suite->add(new \PHPTest\Report\CLITest('testRenderErrorsAndFailures'));
$result = new \PHPTest\TestResult;

$suite->run($result);

$renderer = new \PHPTest\Report\CLI;
echo $renderer->render($result);