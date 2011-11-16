<?php

namespace PHPTest\test\Unit;

class WasRunTest extends \PHPTest\TestCase {
    public $wasRun = 0;
    public $wasSetUp = 0;

    public function setUp() {
        $this->wasSetUp = 1;
    }

    public function testMethod() {
        $this->wasRun = 1;
    }

}
