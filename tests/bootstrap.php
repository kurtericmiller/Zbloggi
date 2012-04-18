<?php
defined('SINGLETON') || define('SINGLETON', true);
error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
defined('APPLICATION_ROOT') || define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/../'));
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'testing');
$library = realpath(APPLICATION_ROOT . '/library');
$domain = realpath(APPLICATION_ROOT . '/library/Local/Domain');
$tests = realpath(APPLICATION_ROOT . '/tests');
$path = array($library, $domain, $tests, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
unset($library, $domain);
