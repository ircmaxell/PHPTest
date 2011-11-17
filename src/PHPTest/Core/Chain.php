<?php

namespace PHPTest\Core;

class Chain {

    protected $queue = null;

    public function __construct() {
        $this->queue = new \SplQueue;
    }

    public function __clone() {
        $this->queue = clone $this->queue;
    }

    public function append(Chainable $element) {
        $this->queue->push($element);
    }

    public function prepend(Chainable $element) {
        $this->queue->unshift($element);
    }

    public function call(array $arguments) {
        $this->queue->rewind();
        $chain = clone $this;
        if ($this->queue->valid()) {
            $this->queue->current()->call($arguments, $chain);
        }
    }

    public function next(array $arguments) {
        $this->queue->next();
        if ($this->queue->valid()) {
            $this->queue->current()->call($arguments, $this);
        }
    }
}