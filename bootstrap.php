<?php

define('APPROOT', __DIR__);
putenv('DEVENV=true');
define('DEVENV', getenv('DEVENV'));
define('CONFIGPATH', APPROOT . '/resources/config.json');
require APPROOT . '/vendor/autoload.php';
