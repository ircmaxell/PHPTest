<?php

namespace PHPTest;

interface Observable {

    public function attachObserver($callback);

    public function updateObservers();
    
}