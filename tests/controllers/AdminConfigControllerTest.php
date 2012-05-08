<?php
// Call AdminConfigControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "AdminConfigControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AdminConfigControllerTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("AdminConfigControllerTest");
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
    $this->request->setMethod('POST')->setPost(array('headlineId' => '33', 'articleCount' => '3', 'bookCount' => '3', 'latestArticleCount' => '6', 'amazonLU' => '143022925X || 007163939X || 1933988320 || 0470887346 || 1430231149 || 1847194222', 'admArtCnt' => '5', 'admComCnt' => '4', 'admUserCnt' => '9', 'defemail' => 'admin@mail.com', 'submit' => 'submit'));
    $this->dispatch('/admin/config');
    $this->assertRedirectTo('/admin/config');
    $this->resetRequest()->resetResponse();
    $this->request->setPost(array());
    $this->loginUser();
    $this->dispatch('/admin/config');
    // TODO defualt is 10, manually reset after testing
    $this->assertQuery('input#admUserCnt[value="9"]');
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminConfigControllerTest::main') {
  AdminConfigControllerTest::main();
}
