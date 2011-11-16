<?php

namespace PHPTest;

spl_autoload_register(function ($class) {
    $nslen = strlen(__NAMESPACE__);
    if (substr($class, 0, $nslen) != __NAMESPACE__) {
        //Only autoload libraries from this package
        return;
    }
    $path = substr(str_replace('\\', '/', $class), $nslen);
    $path = __DIR__ . $path . '.php';
    if (file_exists($path)) {
        require $path;
    }
});