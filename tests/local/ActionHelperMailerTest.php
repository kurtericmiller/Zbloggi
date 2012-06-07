<?php
// Call ActionHelperMailerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ActionHelperMailerTest::main");
}
require_once 'TestInit.php';
/**
 * @group ActionHelper
 */
class ActionHelperMailerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ActionHelperMailerTest");
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
    public function test_mailer()
    {
        $helperName = 'mailer';
        $this->request->setMethod('POST')->setPost(array('email' => 'gs@mail.com', 'submit' => 'submit'));
        $this->dispatch('/auth/reset');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $helper->$helperName('b@bob.com', 'c@carol.com', 'This is Ted.', 'Alice');
            $this->assertTrue(true, $helperName . ' blew up.');
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    public function test_direct()
    {
        $helperName = 'mailer';
        $this->request->setMethod('POST')->setPost(array('email' => 'gs@mail.com', 'submit' => 'submit'));
        $this->dispatch('/auth/reset');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $helper->direct('b@bob.com', 'c@carol.com', 'This is Ted.', 'Alice');
            $this->assertTrue(true, $helperName . ' blew up.');
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ActionHelperMailerTest::main') {
    ActionHelperMailerTest::main();
}
