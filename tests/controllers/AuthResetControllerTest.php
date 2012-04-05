<?php
// Call AuthResetControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AuthResetControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AuthResetControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AuthResetControllerTest");
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
    public function test_indexActionCancel()
    {
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/auth/reset');
        $this->assertRedirectTo('/');
    }
    public function test_indexActionBadID()
    {
        $this->request->setMethod('POST')->setPost(array('email' => 'xxx@xx.com', 'submit' => 'submit'));
        $this->dispatch('/auth/reset');
        $this->assertRedirectTo('/auth/reset');
        // TODO unit test flashmessages
        
    }
    public function test_indexAction()
    {
        $this->request->setMethod('POST')->setPost(array('email' => 'gs@mail.com', 'submit' => 'submit'));
        $this->dispatch('/auth/reset');
        $this->assertRedirectTo('/auth/reset');
        // TODO unit test flashmessages
        
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AuthResetControllerTest::main') {
    AuthResetControllerTest::main();
}
