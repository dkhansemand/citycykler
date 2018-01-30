<?php
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
    session_start();
    ob_start();
    ## Auto class loader from folder '/lib/Classes'
    ## Class autoloader
	function classLoader($className){
		$className = str_replace('\\', '/', $className);
		if(file_exists(__DIR__ . DS  . 'lib' . DS . $className . '-class.php')){
			require_once __DIR__  . DS . 'lib'. DS . $className . '-class.php';
		} else {
			throw new Exception('ERROR: '. __DIR__ . DS . 'lib' . DS .  $className . '-class.php');
		}
	}
    spl_autoload_register('classLoader');

    $GET  = Filter::CheckMethod('GET')  ? Filter::SanitizeArray(INPUT_GET)  : null;
    $POST = Filter::CheckMethod('POST') ? Filter::SanitizeArray(INPUT_POST) : null;
