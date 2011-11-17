<?php

namespace PHPTest\Mocks;

class DataProviderTest extends \PHPTest\TestClass {

    public static function provideData() {
        return array(array(1, 2, 3), array(2, 3, 5));
    }

    /**
     * @dataProvider provideData
     */
    public function testAdd($a, $b, $expect) {
        $this->assertEquals($expect, $a + $b);
    }

}
