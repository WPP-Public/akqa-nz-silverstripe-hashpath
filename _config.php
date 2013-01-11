<?php

if (file_exists(__DIR__ . '../vendor/autoload.php')) {
    require_once __DIR__ . '../vendor/autoload.php';
}

define('HASH_PATH_RELATIVE_PATH', basename(dirname(__FILE__)));

Object::add_extension('ContentController', 'HashPathExtension');
