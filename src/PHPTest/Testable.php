<?php

namespace PHPTest;

interface Testable extends \Countable, Observable {

    public function addPlugin(Plugin $plugin);

    public function run(TestResult $result);

}