<?php
// Call ErrorErrorControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ErrorErrorControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Error
 */
class ErrorErrorControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("ErrorErrorControllerTest");
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
    public function test_errorActionNoRoute()
    {
        $this->dispatch('/asdfasdf');
        $this->assertQueryContentRegex('h3', '/.*Invalid controller specified.*asdfasdf.*/');
    }
    public function test_errorActionNoController()
    {
        $this->dispatch('/default/asdfasdf');
        $this->assertQueryContentRegex('h3', '/.*Invalid controller specified.*asdfasdf.*/');
    }
    public function test_errorActionNoAction()
    {
        $this->dispatch('/default/index/asdfasdf');
        $this->assertQueryContentRegex('h3', '/.*Action.*asdfasdf.*does not exist.*/');
    }
    public function test_sqlerrorAction()
    {
        // TODO figure out how to generate a SQL exception
        //$this->dispatch('/default/index/sqlerror?test=654');
        //$this->assertQueryContentRegex('h2','/.*SQL Error.*/');
        
    }
    public function test_aclerrorAction()
    {
        $this->dispatch('/admin/article/add');
        $this->assertQueryContentRegex('h2', '/.*ACL Error.*/');
    }
    public function test_apperrorAction()
    {
        $this->dispatch('/blog/comment?id=999');
        $this->assertQueryContentRegex('h2', '/.*Application Error.*/');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'ErrorErrorControllerTest::main') {
    ErrorErrorControllerTest::main();
}
