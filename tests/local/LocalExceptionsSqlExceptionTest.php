<?php
// Call LocalExceptionsSqlExceptionTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalExceptionsSqlExceptionTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalExceptionsSqlExceptionTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalExceptionsSqlExceptionTest");
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
    public function test___construct()
    {
        $ex = new Local_Exceptions_SqlException('Message.');
        $this->assertInstanceOf('Local_Exceptions_SqlException', $ex);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalExceptionsSqlExceptionTest::main') {
    LocalExceptionsSqlExceptionTest::main();
}
