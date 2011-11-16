<?php

namespace PHPTest;

class TestCase {

    protected $name = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public function run() {
        $this->{$this->name}();
    }
}