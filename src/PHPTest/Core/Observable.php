<?php

namespace PHPTest\Core;

interface Observable {

    public function attachObserver($callback);

    public function updateObservers();

}