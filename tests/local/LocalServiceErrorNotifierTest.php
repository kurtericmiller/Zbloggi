<?php
// Call LocalServiceNotifierErrorTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "LocalServiceErrorNotifierTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalServiceErrorNotifierTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("LocalServiceErrorNotifierTest");
    $result = PHPUnit_TextUI_TestRunner::run($suite);
  }
  /* Begin Actual Setup */
  public function setUp()
  {
    parent::setUp();
  }
  public function tearDown()
  {
    parent::tearDown();
  }
  /* End Actual Setup */
  /* Begin Actual Tests */
  // TODO this class heavily dependent on _server which is anathema to unit testing
  // except it does get passed in as an array so may be spoofed.
  public function test___construct()
  {
    $this->dispatch('/asdfasdf');
    $error = $this->getRequest()->getParam('error_handler');
    $database = Zend_Registry::get('db');
    $profiler = $database->getProfiler();
    $mailer = new Zend_Mail();
    $session = new Zend_Session_Namespace();
    $environment = 'bogus';
    $notifier = new Local_Service_Error_Notifier($environment, $error, $mailer, $session, $profiler, $_SERVER);
    // for getFullErrorMessage test
    $full = $notifier->getFullErrorMessage();
    $this->assertRegExp('/.*Invalid controller.*/', $full);
    $this->assertRegExp('/.*Request data:.*/', $full);
    // for getShortErrorMessage test
    $short = $notifier->getShortErrorMessage();
    $this->assertRegExp('/.*Invalid controller.*/', $short);
    // notify should be false
    $result = $notifier->notify();
    $this->assertFalse($result);
    // try it with a 'production' environment
    $environment = 'production';
    $notifier = new Local_Service_Error_Notifier($environment, $error, $mailer, $session, $profiler, $_SERVER);
    // for getFullErrorMessage test
    $full = $notifier->getFullErrorMessage();
    $this->assertRegExp('/.*Invalid controller.*/', $full);
    $this->assertRegExp('/.*Request data:.*/', $full);
    // for getShortErrorMessage test
    $short = $notifier->getShortErrorMessage();
    $this->assertRegExp('/.*Our admin has been notified.*/', $short);
    // notify should be Zend_Mail
    $result = $notifier->notify();
    $this->assertInstanceOf('Zend_Mail', $result);
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalServiceErrorNotifierTest::main') {
  LocalServiceErrorNotifierTest::main();
}
