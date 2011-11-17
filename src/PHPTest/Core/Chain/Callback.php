<?php

namespace PHPTest\Core\Chain;

class Callback implements \PHPTest\Core\Chainable {

    protected $callback = null;

    public function __construct($callback) {
        $this->callback = $callback;
    }

    public function call($arguments, \PHPTest\Core\Chain $chain) {
        call_user_func($this->callback, $arguments, $chain);
    }

}