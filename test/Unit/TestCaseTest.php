<?php

namespace PHPTest\test\Unit;

require_once 'WasRunTest.php';
require_once '../../src/PHPTest/TestCase.php';

class TestCaseTest extends \PHPTest\TestCase {

    public function testRunning() {
        $test = new WasRunTest('testMethod');
        if ($test->wasRun) {
            throw new \Exception('Was Run Already');
        }
        $test->run();
        if (!$test->wasRun) {
            throw new \Exception('Was Not Run');
        }
        echo "Passed";
    }

}


$test = new TestCaseTest('testRunning');
$test->run();