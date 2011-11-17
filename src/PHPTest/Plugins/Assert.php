<?php

namespace PHPTest\Plugins;

class Assert implements \PHPTest\Core\Plugin {

    protected $test;

    public function __construct(\PHPTest\Core\Testable $test) {
        $this->test = $test;
    }

    public function assert($test, $message = '') {
        if (!$test) {
            $this->test->updateObservers('assertFailure', $message);
            throw new \PHPTest\Exception\AssertionFailure($message);
        }
        $this->test->updateObservers('assert', $message);
    }

    public function assertEquals($test1, $test2, $message = '') {
        $this->assert($test1 == $test2, $message);
    }

    public function assertSame($test1, $test2, $message = '') {
        if (is_object($test1) && is_object($test2)) {
            $this->assert(spl_object_hash($test1) === spl_object_hash($test2), $message);
        } else {
            $this->assert($test1 === $test2, $message);
        }
    }

    public function assertArrayHasKey($key, array $array, $message = '') {
        $this->assert(array_key_exists($key, $array), $message);
    }

    public function assertGreaterThan($expected, $actual, $message = '') {
        $this->assert($expected < $actual, $message);
    }

    public function assertGreaterThanOrEqual($expected, $actual, $message = '') {
        $this->assert($expected <= $actual, $message);
    }

    public function assertLessThan($expected, $actual, $message = '') {
        $this->assert($expected > $actual, $message);
    }

    public function assertLessThanOrEqual($expected, $actual, $message = '') {
        $this->assert($expected >= $actual, $message);
    }

    public function assertTrue($test, $message = '') {
        $this->assert($test === true, $message);
    }

    public function assertFalse($test, $message = '') {
        $this->assert($test === false, $message);
    }

    public function assertNull($test, $message = '') {
        $this->assert(is_null($test), $message);
    }

    public function assertStringStartsWith($prefix, $string, $message = '') {
        $this->assert(strpos($string, $prefix) === 0, $message);
    }

    public function assertStringNotStartsWith($prefix, $string, $message = '') {
        $this->assert(strpos($string, $prefix) !== 0, $message);
    }
}