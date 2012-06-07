<?php
// Call ViewHelperUserIsAllowedTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ViewHelperUserIsAllowedTest::main");
}
require_once 'TestInit.php';
/**
 * @group ViewHelper
 */
class ViewHelperUserIsAllowedTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ViewHelperUserIsAllowedTest");
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
    public function test_UserIsAllowed()
    {
        $this->loginUser();
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('UserIsAllowed');
        $return = $view->UserIsAllowed('25', '32');
        $this->assertTrue($return);
    }
    public function test_UserIsAllowedAuthor()
    {
        $this->loginUser('gussy', 'password');
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('UserIsAllowed');
        $return = $view->UserIsAllowed('25', '25');
        $this->assertTrue($return);
    }
    public function test_UserIsAllowedNotAuthor()
    {
        $this->loginUser('gussy', 'password');
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('UserIsAllowed');
        $return = $view->UserIsAllowed('32', '25');
        $this->assertFalse($return);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ViewHelperUserIsAllowedTest::main') {
    ViewHelperUserIsAllowedTest::main();
}
