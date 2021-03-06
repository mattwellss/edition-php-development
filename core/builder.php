<?php

/*!
 * Pattern Lab Builder CLI - v0.7.12
 *
 * Copyright (c) 2013-2014 Dave Olsen, http://dmolsen.com
 * Licensed under the MIT license
 *
 */

use \PatternLab\Config;
use \PatternLab\Console;
use \PatternLab\Dispatcher;

// check to see if json_decode exists. might be disabled in installs of PHP 5.5
if (!function_exists("json_decode")) {
	print "Please check that your version of PHP includes the JSON extension. It's required for Pattern Lab to run. Aborting.\n";
	exit;
}

// set-up the project base directory
$baseDir = __DIR__."/../";

// auto-load classes
if (file_exists($baseDir."vendor/autoload.php")) {
	require($baseDir."vendor/autoload.php");
} else {
	print "it doesn't appear that pattern lab has been set-up yet...\n";
	print "please install pattern lab's dependicies by typing: php core/bin/composer.phar install...\n";
	exit;
}

// load the options
Console::init();
Config::init($baseDir);

// initialize the dispatcher & note that the config has been loaded
Dispatcher::init();
Dispatcher::$instance->dispatch("config.configLoadEnd");

// run the console
Console::run();
