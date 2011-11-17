<?php

namespace PHPTest;

class TestClass extends TestBase implements Test {

    public function __construct() {
        $reflector = new \ReflectionObject($this);
        foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (stripos($method->getName(), 'test') === 0) {
                $this->addTestMethod($method);
            }
        }
    }

    public function assertPreConditions() {
    }

    public function assertPostConditions() {
    }

    public function setUpBeforeClass() {
    }

    public function onNotSuccessfulTest() {
    }

    public function setUp() {
    }

    public function tearDown() {
    }

    public function tearDownAfterClass() {
    }

    public function run(TestResult $result) {
        $this->setUpBeforeClass();
        foreach ($this->tests as $test) {
            $test->run($result);
        }
        $this->tearDownAfterClass();
    }

    protected function addTestMethod(\ReflectionMethod $method) {
        $comment = $method->getDocComment();
        $providerData = $this->getDataProviderData($comment);
        if ($providerData) {
            foreach ($providerData as $call) {
                $this->tests[] = new TestCase($this, $method->getName(), $call);
            }
        } else {
            $this->tests[] = new TestCase($this, $method->getName());
        }
    }

    protected function getDataProviderData($comment) {
        if (preg_match('(\s*@dataProvider\s*(\S+))m', $comment, $match)) {
            $method = trim($match[1]);
            if (method_exists($this, $method)) {
                $class = get_class($this);
                return $class::$method();
            }
        }
        return array();
    }
}