<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    define('_DEBUG_', true);
    define('DS', DIRECTORY_SEPARATOR);
    define('_DB_HOST_','localhost');
	define('_DB_USERNAME_', 'root');
	define('_DB_PASSWORD_', 'root');
	define('_DB_NAME_', 'citycykler');
    define('_DB_PREFIX_', '');
	define('_JWTKEY_', 'Test');
    define('_AUTOLOADER_', __DIR__ . DS . 'vendor' . DS . 'autoload.php');
