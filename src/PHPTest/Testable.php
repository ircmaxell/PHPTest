<?php

namespace PHPTest;

interface Testable extends \Countable, Observable {

    public function run(TestResult $result);

}