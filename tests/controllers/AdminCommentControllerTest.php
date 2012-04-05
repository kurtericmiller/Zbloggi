<?php
// Call AdminCommentControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AdminCommentControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AdminCommentControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AdminCommentControllerTest");
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
        $url = '/admin/comment';
        $this->dispatch($url);
        $this->assertQueryContentContains('h2', 'Comment Admin:');
    }
    public function test_deleteAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/comment/delete?id=60');
        $this->assertQueryContentContains('div', 'Confirm Deletion', 'Confirmation not reached.');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('id' => '60', 'del' => 'Yes'));
        $this->dispatch('/admin/comment/delete');
        $this->assertRedirectTo('/admin/comment');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/comment');
        $this->assertNotQueryContentContains('p.delComment', 'I just love that gussy.');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminCommentControllerTest::main') {
    AdminCommentControllerTest::main();
}
