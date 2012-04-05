<?php
// Call ActionHelperSetArticleReadCountTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ActionHelperSetArticleReadCountTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class ActionHelperSetArticleReadCountTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ActionHelperSetArticleReadCountTest");
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
    public function test_SetArticleReadCount()
    {
        $helperName = 'SetArticleReadCount';
        $this->dispatch('/blog/comment?id=25');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $helper->$helperName('23');
            $ac = new Local_Domain_Mappers_ArticleMapper();
            $a = $ac->find('23');
            $count = $a->get('read_count');
            $this->assertEquals($count, 21);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    public function test_direct()
    {
        $helperName = 'SetArticleReadCount';
        $this->dispatch('/blog/comment?id=25');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $helper->direct('23');
            $ac = new Local_Domain_Mappers_ArticleMapper();
            $a = $ac->find('23');
            $count = $a->get('read_count');
            $this->assertEquals($count, 21);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ActionHelperSetArticleReadCountTest::main') {
    ActionHelperSetArticleReadCountTest::main();
}
