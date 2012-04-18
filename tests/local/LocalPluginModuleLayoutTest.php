<?php
// Call LocalPluginModuleLayoutTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalPluginModuleLayoutTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalPluginModuleLayoutTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalPluginModuleLayoutTest");
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
    public function test_dispatchLoopStartup()
    {
        $this->request->setModuleName('auth');
        $pi = new Local_Plugin_ModuleLayout();
        $pi->dispatchLoopStartup($this->request);
        $lo = new Zend_Layout();
        $mod = $lo->nestedLayout;
        $this->assertRegExp('/.*auth.*/', $mod);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalPluginModuleLayoutTest::main') {
    LocalPluginModuleLayoutTest::main();
}
