<?php
// Call AuthIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AuthIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Auth
 */
class AuthIndexControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AuthIndexControllerTest");
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
        $this->dispatch('/auth');
        $this->assertRedirectTo('/');
    }
    public function test_indexActionRegister()
    {
        $this->request->setMethod('POST')->setPost(array('register' => 'submit'));
        $this->dispatch('/auth');
        $this->assertRedirectTo('/user/registration');
    }
    public function test_indexAction()
    {
        $this->request->setMethod('POST')->setPost(array('email' => 'testing', 'password' => 'testing', 'submit' => 'submit'));
        $this->dispatch('/auth');
        $this->assertRedirectTo('/');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->dispatch('/');
        $this->assertQueryContentRegex('div#logged-in-as', '/.*Profile.*/');
    }
    public function test_logoutAction()
    {
        $this->loginUser();
        $this->dispatch('/auth/index/logout');
        $this->assertRedirectTo('/');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->dispatch('/');
        $this->assertQueryContentRegex('div#logged-in-as', '/.*Login.*/');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AuthIndexControllerTest::main') {
    AuthIndexControllerTest::main();
}
