<?php

namespace PHPTest;

interface Test {

    public function assertPreConditions();

    public function assertPostConditions();

    public function onNotSuccessfulTest();

    public function setUp();

    public function tearDown();

}