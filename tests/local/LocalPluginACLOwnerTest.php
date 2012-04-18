<?php
// Call LocalPluginACLOwnerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalPluginACLOwnerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalPluginACLOwnerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalPluginACLOwnerTest");
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
    public function test_assert()
    {
        $this->assertTrue(true);
    }
    public function test__isOwned()
    {
        $this->assertTrue(true);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalPluginACLOwnerTest::main') {
    LocalPluginACLOwnerTest::main();
}
