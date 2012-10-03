<?php

define('HASH_PATH_RELATIVE_PATH', basename(dirname(__FILE__)));

Object::add_extension('ContentController', 'HashPathExtension');
