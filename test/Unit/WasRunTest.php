<?php

namespace PHPTest\test\Unit;

require_once '../../src/PHPTest/TestCase.php';

class WasRunTest extends \PHPTest\TestCase {
    public $wasRun = 0;

    public function testMethod() {
        $this->wasRun = 1;
    }

}
