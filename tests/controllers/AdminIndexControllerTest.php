<?php
// Call AdminIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AdminIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Admin
 */
class AdminIndexControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AdminIndexControllerTest");
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
    public function test_indexAction()
    {
        $this->loginUser();
        $this->dispatch('/admin');
        $this->assertNotQuery('.entity');
    }
    public function test_searchAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/index/search?start=true');
        $this->assertRedirectTo('/admin/index/search');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminIndexControllerTest::main') {
    AdminIndexControllerTest::main();
}
