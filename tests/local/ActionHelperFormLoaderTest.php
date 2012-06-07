<?php
// Call ActionHelperFormLoaderTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ActionHelperFormLoaderTest::main");
}
require_once 'TestInit.php';
/**
 * @group ActionHelper
 */
class ActionHelperFormLoaderTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ActionHelperFormLoaderTest");
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
    /* Candidate Tests */
    /* Begin Actual Tests */
    public function test_loadForm()
    {
        $helperName = 'formLoader';
        $this->dispatch('/');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $options = array('module' => 'auth');
            $class = $helper->loadForm('login', $options);
            $this->assertInstanceOf('Auth_Form_Login', $class);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    public function test_direct()
    {
        $helperName = 'formLoader';
        $this->dispatch('/');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $options = array('module' => 'auth');
            $class = $helper->direct('login', $options);
            $this->assertInstanceOf('Auth_Form_Login', $class);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ActionHelperFormLoaderTest::main') {
    ActionHelperFormLoaderTest::main();
}
