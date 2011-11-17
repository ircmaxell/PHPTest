<?php

namespace PHPTest\Core;

class ChainTest extends \PHPTest\TestClass {

    protected $chain = null;

    public function setUp() {
        $this->chain = new Chain;
    }

    public function testConstruct() {
        $chain = new Chain;
    }

    public function testAppend() {
        $counter = 1;
        $foo = new \PHPTest\Core\Chain\Callback(function($args, $chain) use (&$counter) {
            $counter++;
            $chain->next($args);
        });
        $bar = new \PHPTest\Core\Chain\Callback(function($args, $chain) use (&$counter) {
            $counter *= 4;
            $chain->next($args);
        });
        $this->chain->append($foo);
        $this->chain->append($bar);
        $this->chain->call(array());
        $this->assertEquals(8, $counter);
    }

    public function testPrepend() {
        $counter = 1;
        $foo = new \PHPTest\Core\Chain\Callback(function($args, $chain) use (&$counter) {
            $counter++;
            $chain->next($args);
        });
        $bar = new \PHPTest\Core\Chain\Callback(function($args, $chain) use (&$counter) {
            $counter *= 4;
            $chain->next($args);
        });
        $this->chain->append($foo);
        $this->chain->prepend($bar);
        $this->chain->call(array());
        $this->assertEquals(5, $counter);
    }

}