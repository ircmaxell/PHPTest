<?php

namespace PHPTest\test\Unit;

class TestCaseTest extends \PHPTest\TestCase {

    public function testRunning() {
        $test = new WasRunTest('testMethod');
        $this->assert(!$test->wasRun, 'Was Run Already');
        $test->run();
        $this->assert($test->wasRun, 'Was Not Run');
        echo "Passed";
    }

    public function testSetUp() {
        $test = new WasRunTest('testMethod');
        $test->run();
        $this->assert($test->wasSetUp, 'Was Not Set Up');
    }

    public function assert($test, $message = '') {
        if (!$test) {
            throw new \Exception($message);
        }
    }

}
