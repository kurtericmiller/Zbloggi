<?php
// Call AdminUserControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "AdminUserControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AdminUserControllerTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("AdminUserControllerTest");
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
    $this->dispatch('/admin/user');
    $this->assertQueryContentContains('.entity', 'User Admin:');
  }
  public function test_deleteAction()
  {
    $this->loginUser();
    $this->dispatch('/admin/user/delete?id=29');
    $this->assertQueryContentContains('div', 'Confirm Deletion', 'Confirmation not reached.');
    $this->resetRequest()->resetResponse();
    $this->request->setPost(array());
    $this->loginUser();
    $this->request->setMethod('POST')->setPost(array('id' => '29', 'del' => 'Yes'));
    $this->dispatch('/admin/user/delete');
    $this->assertRedirectTo('/admin/user');
    $this->resetRequest()->resetResponse();
    $this->request->setPost(array());
    $this->loginUser();
    $this->dispatch('/admin/user');
    $this->assertNotQueryContentRegex('.user', '/.*nancy.*/');
  }
  public function test_roleActionCancel()
  {
    $this->loginUser();
    $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
    $this->dispatch('/admin/user/role?id=29');
    $this->assertRedirectTo('/admin/user');
  }
  public function test_roleAction()
  {
    $this->loginUser();
    $this->request->setMethod('POST')->setPost(array('user_id' => 29, 'role' => 'admin', 'submit' => 'submit'));
    $this->dispatch('/admin/user/role?id=29');
    $this->assertRedirectTo('/admin/user');
    $this->resetRequest()->resetResponse();
    $this->request->setPost(array());
    $this->loginUser();
    $this->dispatch('/admin/user');
    $this->assertQueryContentRegex('.user', '/.*nancy.*admin.*/');
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminUserControllerTest::main') {
  AdminUserControllerTest::main();
}
