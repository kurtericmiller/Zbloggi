<?php
require_once 'Zend/Application.php';
require_once 'Zend/Test/PHPUnit/ControllerTestCase.php';
class TestInit extends Zend_Test_PHPUnit_ControllerTestCase
{
  public function setUp()
  {
    $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
    parent::setUp();
    $frontController = $this->getFrontController();
    $frontController->setParam('bootstrap', $this->bootstrap->getBootstrap());
    $router = $frontController->getRouter();
    $router->addDefaultRoutes();
  }
  public function tearDown()
  {
    $sql_dir = APPLICATION_ROOT . "/sql";
    system(APPLICATION_ROOT . "/library/Local/Domain/Utils/clear_testdb $sql_dir");
  }
  public function loginUser($user = 'testing', $password = 'testing')
  {
    $this->request->setMethod('POST')->setPost(array('email' => $user, 'password' => $password));
    $this->dispatch('/auth');
    $this->resetRequest()->resetResponse();
    $this->request->setPost(array());
  }
}
