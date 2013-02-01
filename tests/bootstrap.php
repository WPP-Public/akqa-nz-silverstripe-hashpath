<?php

$dir = __DIR__ . '/..';

if (file_exists($dir . '/vendor/autoload.php')) {

    $loader = require $dir . '/vendor/autoload.php';

    $loader->addClassMap(Composer\Autoload\ClassMapGenerator::createMap($dir . '/framework'));
    $loader->addClassMap(Composer\Autoload\ClassMapGenerator::createMap($dir . '/code'));
}

define('BASE_PATH', dirname(__DIR__));