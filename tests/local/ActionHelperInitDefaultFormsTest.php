<?php
// Call ActionHelperInitDefaultFormsTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "ActionHelperInitDefaultFormsTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class ActionHelperInitDefaultFormsTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("ActionHelperInitDefaultFormsTest");
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
  public function test_preDispatch()
  {
    $helperName = 'initDefaultForms';
    $this->dispatch('/');
    if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
      $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
      $helper->preDispatch();
      $this->assertTrue(true, $helperName . ' couldn\'t preDispatch.');
    } else {
      $this->assertTrue(false, $helperName . ' not found.');
    }
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ActionHelperInitDefaultFormsTest::main') {
  ActionHelperInitDefaultFormsTest::main();
}
