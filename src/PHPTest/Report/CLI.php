<?php

namespace PHPTest\Report;

class CLI implements \PHPTest\TestReport {

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