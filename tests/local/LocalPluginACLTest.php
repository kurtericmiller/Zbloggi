<?php
// Call LocalPluginACLTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "LocalPluginACLTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalPluginACLTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("LocalPluginACLTest");
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
  public function test_preDispatch()
  {
    $acl = new Local_Plugin_ACL();
    $this->request->setModuleName('default');
    $this->request->setControllerName('index');
    $this->request->setActionName('index');
    try {
      $acl->preDispatch($this->request);
      $this->assertTrue(true, 'No exceptions');
    }
    catch(Local_Exceptions_AclException $e) {
      if ('Local_Exceptions_AclException' === get_class($e)) {
        $this->assertTrue(false, 'ACL exception');
      } else {
        $this->assertTrue(false, 'Not an ACL exception');
      }
    }
  }
  public function test_preDispatchNotLoggedIn()
  {
    $acl = new Local_Plugin_ACL();
    $this->request->setModuleName('admin');
    $this->request->setControllerName('article');
    $this->request->setActionName('index');
    try {
      $acl->preDispatch($this->request);
      $this->assertTrue(false, 'No exceptions');
    }
    catch(Local_Exceptions_AclException $e) {
      if ('Local_Exceptions_AclException' === get_class($e)) {
        $this->assertTrue(true, 'ACL exception');
      } else {
        $this->assertTrue(false, 'Not an ACL exception');
      }
    }
  }
  public function test_preDispatchLoggedInNotAdmin()
  {
    $this->loginUser('gussy', 'password');
    $acl = new Local_Plugin_ACL();
    $this->request->setModuleName('admin');
    $this->request->setControllerName('comment');
    $this->request->setActionName('index');
    try {
      $acl->preDispatch($this->request);
      $this->assertTrue(false, 'No exceptions');
    }
    catch(Local_Exceptions_AclException $e) {
      if ('Local_Exceptions_AclException' === get_class($e)) {
        $this->assertTrue(true, 'ACL exception');
      } else {
        $this->assertTrue(false, 'Not an ACL exception');
      }
    }
  }
  public function test_preDispatchAdmin()
  {
    $this->loginUser();
    $acl = new Local_Plugin_ACL();
    $this->request->setModuleName('admin');
    $this->request->setControllerName('comment');
    $this->request->setActionName('index');
    try {
      $acl->preDispatch($this->request);
      $this->assertTrue(true, 'No exceptions');
    }
    catch(Local_Exceptions_AclException $e) {
      if ('Local_Exceptions_AclException' === get_class($e)) {
        $this->assertTrue(false, 'ACL exception');
      } else {
        $this->assertTrue(false, 'Not an ACL exception');
      }
    }
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalPluginACLTest::main') {
  LocalPluginACLTest::main();
}
