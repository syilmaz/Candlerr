<?php
error_reporting(E_ALL | E_STRICT);

/**
 * File extensions
 */
define('EXT', '.php');

/**
 * Set the DOCROOT to the current one
 */
define('DOCROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/**
 * This is where the framework files are located
 */
define('SYS_PATH', DOCROOT . 'system' . DIRECTORY_SEPARATOR);

/**
 * This is where the application resides
 */
define('APP_PATH', DOCROOT . 'app' . DIRECTORY_SEPARATOR);

// Bootstrap
require_once APP_PATH . 'bootstrap' . EXT;

// The request handler
require_once SYS_PATH . 'classes' . DIRECTORY_SEPARATOR . 'request' . EXT;

// Run the app
Request::factory()->execute();