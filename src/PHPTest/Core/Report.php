<?php

namespace PHPTest\Core;

interface Report {

    public function render(\PHPTest\TestResult $result);

}