<?php

namespace PHPTest\test\Unit;

class WasRunTest extends \PHPTest\TestCase {

    public $log = '';

    public function setUp() {
        $this->log = 'setUp ';
    }

    public function testMethod() {
        $this->log .= 'testMethod ';
    }

}
