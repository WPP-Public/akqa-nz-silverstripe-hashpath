<?php

$dir = dirname(__DIR__);

if (file_exists($dir . '/vendor/autoload.php')) {

    $loader = require $dir . '/vendor/autoload.php';

    $loader->addClassMap(Composer\Autoload\ClassMapGenerator::createMap($dir . '/sapphire'));
    $loader->addClassMap(Composer\Autoload\ClassMapGenerator::createMap($dir . '/code'));
}

define('BASE_PATH', $dir);