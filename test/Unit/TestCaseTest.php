<?php

namespace PHPTest\test\Unit;

class TestCaseTest extends \PHPTest\TestCase {

    public function testTemplateMethod() {
        $test = new WasRunTest('testMethod');
        $test->run();
        $this->assert($test->log == 'setUp testMethod ', 'Was Not Run');
        echo "Passed";
    }

    public function assert($test, $message = '') {
        if (!$test) {
            throw new \Exception($message);
        }
    }

}
