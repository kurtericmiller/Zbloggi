<?php
// Call LocalPluginACLAclTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalPluginACLAclTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalPluginACLAclTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalPluginACLAclTest");
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
        $aa = new Local_Plugin_ACL_Acl();
        $this->assertTrue(true);
    }
    public function test_setOwner()
    {
        $aa = new Local_Plugin_ACL_Acl();
        $this->loginUser('gussy', 'password');
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $aa->setOwner($user, 34);
        $this->assertTrue(true);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalPluginACLAclTest::main') {
    LocalPluginACLAclTest::main();
}
