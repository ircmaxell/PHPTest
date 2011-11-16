<?php

namespace PHPTest\Report;

class CLITest extends \PHPTest\TestCase {

    public function testRender() {
        $result = new \PHPTest\TestResult;
        $result->testStarted();
        $renderer = new CLI;
        $output = $renderer->render($result);
        $this->assert($output == $result->summary());
    }

    public function testRenderErrorsAndFailures() {
        $result = new \PHPTest\TestResult;
        $result->testStarted();
        $result->testError(new \Exception('Test Error'));
        $result->testFailed(new \Exception('Test Failed'));
        $errors = $result->getErrors();
        $failures = $result->getFailures();
        $expected = $result->summary();
        $expected .= "\n\nError 1:\n  " . $errors[0]->getMessage() . "\n" . $errors[0]->getTraceAsString() . "\n\n";
        $expected .= "\n\nFailure 1:\n  " . $failures[0]->getMessage() . "\n" . $failures[0]->getTraceAsString() . "\n\n";
        $renderer = new CLI;
        $output = $renderer->render($result);
        $this->assert($output == $expected, 'Renderer Failure');
    }
}