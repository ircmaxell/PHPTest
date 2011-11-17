<?php

namespace PHPTest;

interface Plugin {

    public function __construct(\PHPTest\Testable $test);

}