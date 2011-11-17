<?php

namespace PHPTest\Plugins;

class AssertTest extends \PHPTest\TestCase {

    protected $base = null;

    protected function setUp() {
        $this->base = new Assert;
    }

    public function testAssert() {
        try {
            $this->base->assert(false);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assert(true);
    }

    public function testAssertEquals() {
        try {
            $this->base->assertEquals(false, true);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertEquals(true, true);
    }

    public function testAssertSame() {
        try {
            $this->base->assertSame(1, '1');
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertSame(array(1), array(1));
    }

    public function testAssertSameWithObjects() {
        try {
            $this->base->assertSame(new \StdClass, new \StdClass);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $obj1 = new \StdClass;
        $obj2 = $obj1;
        $this->base->assertSame($obj1, $obj2);
    }

    public function testAssertArrayHasKey() {
        $array = array();
        try {
            $this->base->assertArrayHasKey('foo', $array);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {}
        $array['foo'] = 'bar';
        $this->base->assertArrayHasKey('foo', $array);
    }

    public function testAssertGreaterThan() {
        try {
            $this->base->assertGreaterThan(2, 1);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        try {
            $this->base->assertGreaterThan(1, 1);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertGreaterThan(1, 2);
    }

    public function testAssertGreaterThanOrEqual() {
        try {
            $this->base->assertGreaterThanOrEqual(2, 1);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertGreaterThanOrEqual(1, 1);
        $this->base->assertGreaterThanOrEqual(1, 2);
    }

    public function testAssertLessThan() {
        try {
            $this->base->assertLessThan(1, 2);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        try {
            $this->base->assertLessThan(1, 1);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertLessThan(2, 1);
    }

    public function testAssertLessThanOrEqual() {
        try {
            $this->base->assertLessThanOrEqual(1, 2);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertLessThanOrEqual(1, 1);
        $this->base->assertLessThanOrEqual(2, 1);
    }

    public function testAssertTrue() {
        try {
            $this->base->assertTrue(false);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        try {
            $this->base->assertTrue(1);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertTrue(true);
    }

    public function testAssertFalse() {
        try {
            $this->base->assertFalse(true);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        try {
            $this->base->assertFalse(0);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertFalse(false);
    }

    public function testAssertNull() {
        try {
            $this->base->assertNull(false);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        try {
            $this->base->assertNull(0);
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertNull(null);
    }

    public function testAssertStringStartsWith() {
        try {
            $this->base->assertStringStartsWith('prefix', 'foo');
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        try {
            $this->base->assertStringStartsWith('prefix', 'PREFIX1');
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertStringStartsWith('prefix', 'prefix1');
    }

    public function testAssertStringNotStartsWith() {
        try {
            $this->base->assertStringNotStartsWith('prefix', 'prefix2');
            throw new \Exception('Assertion Was Not Thrown');
        } catch (\PHPTest\Exception\AssertionFailure $e) {
        }
        $this->base->assertStringNotStartsWith('prefix', 'prefi');
        $this->base->assertStringNotStartsWith('prefix', 'PREFIX2');
    }

}
