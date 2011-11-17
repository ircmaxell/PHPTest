<?php

namespace PHPTest;

require_once 'PHP/CodeCoverage.php';
require_once 'PHP/CodeCoverage/Filter.php';

class TestCoverage {

    protected $phpCC = null;

    public function __construct() {
        $filter = new \PHP_CodeCoverage_Filter;
        $filter->addDirectoryToWhitelist(__DIR__);
        $this->phpCC = new \PHP_CodeCoverage(null, $filter);
    }

    public function add(Core\Testable $test) {
        if (!function_exists('xdebug_start_code_coverage')) return;
        $cov = $this;
        $test->attachObserver(function($name, $arg1, $arg2 = null, $arg3 = null) use ($cov) {
            if (method_exists($cov, $name)) {
                $cov->{$name}($arg1, $arg2, $arg3);
            }
        });
    }

    public function getCoverage() {
        return $this->phpCC;
    }

    public function beforeTest($test, $result) {
        $this->phpCC->start($test);
    }

    public function afterTest($test, $result) {
        $this->phpCC->stop();
    }

    public function failedTest($test, $result) {
        $this->afterTest($test, $result);
    }

    public function errorTest($test, $result) {
        $this->afterTest($test, $result);
    }

}