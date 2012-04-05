<?php
// Call ViewHelperLoggedInAsTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ViewHelperLoggedInAsTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class ViewHelperLoggedInAsTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ViewHelperLoggedInAsTest");
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
    public function test_loggedInAs()
    {
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('LoggedInAs');
        $return = $view->loggedInAs();
        $this->assertRegExp('/.*Login.*/', $return);
    }
    public function test_loggedInAsLoggedIn()
    {
        $this->loginUser();
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('LoggedInAs');
        $return = $view->loggedInAs();
        $this->assertRegExp('/.*Welcome.*/', $return);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ViewHelperLoggedInAsTest::main') {
    ViewHelperLoggedInAsTest::main();
}
