<?php
// Call UserIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "UserIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group User
 */
class UserIndexControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("UserIndexControllerTest");
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
    public function test_indexActionNotLoggedIn()
    {
        $this->dispatch('/user');
        $this->assertRedirectTo('/');
    }
    public function test_indexAction()
    {
        $this->loginUser();
        $this->dispatch('/user');
        $this->assertQuery('form[name="passwordForm"]');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('user_id' => '32', 'password' => 'gnitset', 'pwmatch' => 'gnitset', 'submit' => ''));
        $this->dispatch('/user');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser('testing', 'gnitset');
        $this->dispatch('/user');
        $this->assertQuery('form[name="passwordForm"]');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'UserIndexControllerTest::main') {
    UserIndexControllerTest::main();
}
