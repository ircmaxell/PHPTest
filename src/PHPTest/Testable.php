<?php

namespace PHPTest;

interface Testable extends \Countable, Observable {

    public function addPlugin($plugin);
    
    public function run(TestResult $result);

}