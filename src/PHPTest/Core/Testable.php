<?php

namespace PHPTest\Core;

interface Testable extends \Countable, Observable {

    public function addPlugin(Plugin $plugin);

    public function run(\PHPTest\TestResult $result);

}