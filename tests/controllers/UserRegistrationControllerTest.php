<?php
// Call UserRegistrationControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "UserRegistrationControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class UserRegistrationControllerTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("UserRegistrationControllerTest");
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
    $this->dispatch('/user/registration');
    $html = $this->response->getBody();
    $this->assertQuery('form[name="registerForm"]');
  }
  public function test_indexActionCancel()
  {
    $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
    $this->dispatch('/user/registration');
    $this->assertRedirectTo('/');
  }
  public function test_indexActionSubmit()
  {
    $this->dispatch('/user/registration');
    $captcha = $this->getCaptcha();
    $this->resetRequest()->resetResponse();
    $postreq = array('username' => 'regtest', 'email' => 'rt@mail.com', 'password' => 'asdfasdf', 'pwmatch' => 'asdfasdf', 'captcha' => $captcha, 'submit' => 'submit');
    $this->request->setMethod('POST')->setPost($postreq);
    $this->dispatch('/user/registration');
    $this->assertRedirectTo('/user/registration');
  }
  public function test_confirmActionBadNumber()
  {
    $this->dispatch('/user/registration/confirm?reg=asdfasdf');
    $this->assertRedirectTo('/');
  }
  public function test_confirmActionNoNumber()
  {
    $this->dispatch('/user/registration/confirm');
    $this->assertRedirectTo('/');
  }
  public function test_confirmAction()
  {
    $this->dispatch('/user/registration/confirm?reg=fV75ypryAmTqtuxEUwh3');
    $this->assertQueryContentContains('h2', 'Congratulations');
  }
  private function getCaptcha()
  {
    foreach ($_SESSION as $key => $value) {
      if (preg_match('/.*Zend_Form_Captcha.*/', $key, $regs)) {
        $id = ltrim($regs[0], 'Zend_Form_Captch_');
        return array('id' => $id, 'input' => $value['word']);
      }
    }
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'UserRegistrationControllerTest::main') {
  UserRegistrationControllerTest::main();
}
