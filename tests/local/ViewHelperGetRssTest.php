<?php
// Call ViewHelperGetRssTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ViewHelperGetRssTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class ViewHelperGetRssTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ViewHelperGetRssTest");
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
    public function test_getRss()
    {
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('GetRss');
        ob_start();
        $view->getRss();
        $return = ob_get_contents();
        ob_end_clean();
        $this->assertSelectCount('li', 5, $return);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ViewHelperGetRssTest::main') {
    ViewHelperGetRssTest::main();
}
