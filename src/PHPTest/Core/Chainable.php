<?php

namespace PHPTest\Core;

interface Chainable {

    public function call($arguments, \PHPTest\Core\Chain $chain);
    
}