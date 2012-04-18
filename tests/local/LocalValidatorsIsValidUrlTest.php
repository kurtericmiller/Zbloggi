<?php
// Call LocalValidatorsIsValidUrlTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalValidatorsIsValidUrlTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalValidatorsIsValidUrlTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalValidatorsIsValidUrlTest");
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
    public function test_isValid()
    {
        $val = new Local_Validators_IsValidUrl();
        $result = $val->isValid('google.com');
        $this->assertTrue($result, '"google.com" has somehow been evaluated as bogus.');
        $result = $val->isValid('http://google.com');
        $this->assertTrue($result, '"http://google.com" has somehow been evaluated as bogus.');
        $result = $val->isValid('asdfasdf');
        $this->assertFalse($result, '"asdfasdf" has somehow been evaluated as legit.');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalValidatorsIsValidUrlTest::main') {
    LocalValidatorsIsValidUrlTest::main();
}
