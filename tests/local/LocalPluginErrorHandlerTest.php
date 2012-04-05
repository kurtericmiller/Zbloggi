<?php
// Call LocalPluginErrorHandlerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalPluginErrorHandlerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalPluginErrorHandlerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalPluginErrorHandlerTest");
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
    public function test__handleError()
    {
        $eh = new Local_Plugin_ErrorHandler();
        $this->assertInstanceOf('Local_Plugin_ErrorHandler', $eh);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalPluginErrorHandlerTest::main') {
    LocalPluginErrorHandlerTest::main();
}
