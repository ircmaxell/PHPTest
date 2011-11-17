<?php

namespace PHPTest\Core;

interface Test {

    public function assertPreConditions();

    public function assertPostConditions();

    public function onNotSuccessfulTest();

    public function setUp();

    public function tearDown();

}