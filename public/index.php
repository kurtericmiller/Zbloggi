<?php
defined('SINGLETON') || define('SINGLETON', true);
// Define path to app root directory
defined('APPLICATION_ROOT') || define('APPLICATION_ROOT', realpath(dirname(__FILE__) . '/..'));
// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
// Ensure library/ is on include_path
$library = realpath(APPLICATION_ROOT . '/library');
$domain = realpath(APPLICATION_ROOT . '/library/Local/Domain');
$path = array($library, $domain, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));
require_once ('Zend/Loader/Autoloader.php');
Zend_Loader_Autoloader::getInstance();
$writer = new Zend_Log_Writer_Firebug();
$logger = new Zend_Log($writer);
$application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
$application->bootstrap()->run();
