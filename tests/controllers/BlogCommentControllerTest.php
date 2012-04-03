<?php
// Call BlogCommentControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "BlogCommentControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class BlogCommentControllerTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("BlogCommentControllerTest");
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
    $this->dispatch('/blog/comment?id=32');
    $this->assertQuery('div.sideWrap');
    $this->assertQueryCount('div.articleItem', 1);
    $this->assertQuery('form[name="loginForm"]');
  }
  public function test_indexActionLoggedIn()
  {
    $this->loginUser();
    $this->dispatch('/blog/comment?id=32');
    $this->assertQuery('div.sideWrap');
    $this->assertQueryCount('div.articleItem', 1);
    $this->assertQuery('form[name="commsForm"]');
  }
  public function test_indexActionAddComment()
  {
    $newdate = date('Y/m/d H:i:s');
    $this->loginUser();
    $this->request->setMethod('POST')->setPost(array('comment_text' => 'For the sake of this Zend post, please pass muster.', 'submit' => ''));
    $this->dispatch('/blog/comment?id=32');
    $this->resetRequest()->resetResponse();
    $this->request->setPost(array());
    $this->loginUser();
    $this->dispatch('/blog/comment?id=32');
    $this->assertQuery('div.sideWrap');
    $this->assertQueryCount('div.articleItem', 1);
    $this->assertQuery('form[name="commsForm"]');
    $this->assertQueryContentRegex('.combody', '/.*muster.*/');
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'BlogCommentControllerTest::main') {
  BlogCommentControllerTest::main();
}
