<?php

namespace PHPTest;

interface TestReport {

    public function render(TestResult $result);
    
}