<?php

namespace PHPTest;

interface Testable extends \Countable {

    public function run(TestResult $result);

}