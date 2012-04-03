<?php
// Call ActionHelperRandStringTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "ActionHelperRandStringTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class ActionHelperRandStringTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("ActionHelperRandStringTest");
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
  public function test_rand_string()
  {
    $helperName = 'rand_string';
    $this->request->setMethod('POST')->setPost(array('email' => 'gs@mail.com', 'submit' => 'submit'));
    $this->dispatch('/auth/reset');
    if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
      $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
      $result = $helper->$helperName();
      $this->assertEquals(strlen($result), 8);
    } else {
      $this->assertTrue(false, $helperName . ' not found.');
    }
  }
  public function test_rand_string_32()
  {
    $helperName = 'rand_string';
    $this->request->setMethod('POST')->setPost(array('email' => 'gs@mail.com', 'submit' => 'submit'));
    $this->dispatch('/auth/reset');
    if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
      $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
      $result = $helper->$helperName(32);
      $this->assertEquals(strlen($result), 32);
    } else {
      $this->assertTrue(false, $helperName . ' not found.');
    }
  }
  public function test_direct()
  {
    $helperName = 'rand_string';
    $this->request->setMethod('POST')->setPost(array('email' => 'gs@mail.com', 'submit' => 'submit'));
    $this->dispatch('/auth/reset');
    if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
      $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
      $result = $helper->direct();
      $this->assertEquals(strlen($result), 8);
    } else {
      $this->assertTrue(false, $helperName . ' not found.');
    }
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ActionHelperRandStringTest::main') {
  ActionHelperRandStringTest::main();
}
