<?php

namespace PHPTest;

class BootstrapTest extends TestClass {

    public function testLoadClassFailure() {
        $this->assertFalse(class_exists('foo\\bar\\baz', true));
    }

}