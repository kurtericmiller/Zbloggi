<?php
// Call ViewHelperGetNearArticleTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ViewHelperGetNearArticleTest::main");
}
require_once 'TestInit.php';
/**
 * @group ViewHelper
 */
class ViewHelperGetNearArticleTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ViewHelperGetNearArticleTest");
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
    public function test_getNearArticle()
    {
        $view = new Zend_View();
        $view->addHelperPath(APPLICATION_ROOT . '/library/Local/Helpers/View', 'View_Helper_');
        $gna = $view->getHelper('GetNearArticle');
        $return = $view->GetNearArticle('25', 'next');
        $this->assertArrayHasKey('id', $return);
        $this->assertArrayHasKey('title', $return);
        $this->assertEquals('28', $return['id']);
        $this->assertEquals('(Testing) The Hits Just Keep Coming', $return['title']);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ViewHelperGetNearArticleTest::main') {
    ViewHelperGetNearArticleTest::main();
}
