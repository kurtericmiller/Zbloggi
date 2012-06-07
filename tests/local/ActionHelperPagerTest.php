<?php
// Call ActionHelperPagerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ActionHelperPagerTest::main");
}
require_once 'TestInit.php';
/**
 * @group ActionHelper
 */
class ActionHelperPagerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ActionHelperPagerTest");
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
    public function test_pager()
    {
        $helperName = 'pager';
        $this->dispatch('/');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $class = $helper->$helperName(10, 3);
            $this->assertInstanceOf('Zend_Paginator', $class);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    public function test_pager_as_mapper()
    {
        $helperName = 'pager';
        $this->dispatch('/');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $sections = new Local_Domain_Mappers_SectionMapper();
            $class = $helper->$helperName($sections, 3);
            $this->assertInstanceOf('Zend_Paginator', $class);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    public function test_getLimit()
    {
        $helperName = 'pager';
        $this->dispatch('/');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $sections = new Local_Domain_Mappers_SectionMapper();
            $class = $helper->$helperName(10, 3);
            $return = $helper->getLimit(3);
            $this->assertArrayHasKey('offset', $return);
            $this->assertArrayHasKey('items', $return);
            $this->assertEquals(6, $return['offset']);
            $this->assertEquals(3, $return['items']);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    public function test_direct()
    {
        $helperName = 'pager';
        $this->dispatch('/');
        if (Zend_Controller_Action_HelperBroker::hasHelper($helperName)) {
            $helper = Zend_Controller_Action_HelperBroker::getExistingHelper($helperName);
            $class = $helper->direct(10, 3);
            $this->assertInstanceOf('Zend_Paginator', $class);
        } else {
            $this->assertTrue(false, $helperName . ' not found.');
        }
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ActionHelperPagerTest::main') {
    ActionHelperPagerTest::main();
}
