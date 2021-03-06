<?php

namespace PHPTest\Report;

class CLI implements \PHPTest\Core\Report {

    public function update(\PHPTest\TestResult $result, $name, $arg1 = null) {
        switch ($name) {
            case 'testCompleted':
                return '.';
            case 'testFailure':
                return 'F';
            case 'testError':
                return 'E';
            default:
                return '';
        }
    }

    public function render(\PHPTest\TestResult $result) {
        $output = $result->summary();
        foreach ($result->getErrors() as $key => $error) {
            $output .= "\n\nError " . ($key + 1) . ":\n  " . $error->getMessage() . "\n" . $error->getTraceAsString() . "\n\n";
        }
        foreach ($result->getFailures() as $key => $failure) {
            $output .= "\n\nFailure " . ($key + 1) . ":\n  " . $failure->getMessage() . "\n" . $failure->getTraceAsString() . "\n\n";
        }
        return $output;
    }

}