<?php

if (file_exists(__DIR__ . '../vendor/autoload.php')) {
    require_once __DIR__ . '../vendor/autoload.php';
}

if (!class_exists('SS_Object')) class_alias('Object', 'SS_Object');

if (class_exists('ContentController')) {
    SS_Object::add_extension('ContentController', 'HashPathExtension');
}
