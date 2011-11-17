<?php

namespace PHPTest;

//Register both autoloaders
require_once '../src/PHPTest/bootstrap.php';
require_once 'bootstrap.php';

$suite = new \PHPTest\TestSuite;
$suite->add(new \PHPTest\TestClassTest);
$suite->add(new \PHPTest\TestResultTest);
$suite->add(new \PHPTest\TestSuiteTest);
$suite->add(new \PHPTest\Report\CLITest);
$suite->add(new \PHPTest\Plugins\AssertTest);

$suite->addPlugin(new \PHPTest\Plugins\Assert);

$coverage = new \PHPTest\TestCoverage;
$coverage->add($suite);

$result = new \PHPTest\TestResult;
$renderer = new \PHPTest\Report\CLI;
$result->attachObserver(function($name, $arg1 = null) use ($result, $renderer, $suite) {
    static $n = 0;
    static $m = 0;
    $out = $renderer->update($result, $name, $arg1);
    if ($out) {
        echo $out;
        $n++;
        if ($n > 5) {
            $m += $n;
            $n = 0;
            echo " ($m/".count($suite).") \n";
        }
    }
});
$suite->run($result);

echo "\n\n" . $renderer->render($result);

$phpCC = $coverage->getCoverage();

require_once 'PHP/CodeCoverage/Report/HTML.php';
$writer = new \PHP_CodeCoverage_Report_HTML;
$writer->process($phpCC, __DIR__ . '/coverage');
