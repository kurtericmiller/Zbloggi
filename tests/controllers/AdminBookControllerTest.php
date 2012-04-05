<?php
// Call AdminBookControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AdminBookControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AdminBookControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AdminBookControllerTest");
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
    /* indexAction tests */
    public function test_indexAction()
    {
    }
    public function test_indexActionNotLoggedIn()
    {
        $params = array('action' => 'index', 'controller' => 'book', 'module' => 'admin');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        $this->assertQueryContentContains('h2', 'Exception Class: ACL Error');
    }
    public function test_indexActionLoggedIn()
    {
        $this->loginUser();
        $params = array('action' => 'index', 'controller' => 'book', 'module' => 'admin');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        $this->assertQueryContentContains('span.title', 'New: ');
    }
    /* editAction tests */
    public function test_editAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/book/edit?id=6');
        $this->assertQuery('form[name="booksForm"]');
    }
    public function test_editActionCancel()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/admin/book/edit?id=6');
        $this->assertRedirectTo('/admin/book');
    }
    public function test_editActionCommit()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('books_title' => 'The Proverbial Test Book', 'books_image' => '/image/amz/ZFBG.jpg', 'books_link' => '/store', 'books_author' => 'Schwartz', 'books_id' => 6, 'submit' => ''));
        $this->dispatch('/admin/book/edit?id=6');
        $this->assertRedirectTo('/admin/book');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/book';
        $this->dispatch($url);
        $this->assertQueryContentRegex('span.author', '/.*Schwartz.*/');
    }
    /* addAction tests */
    public function test_addActionCancel()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/admin/book/add');
        $this->assertRedirectTo('/admin/book');
    }
    public function test_addActionCommit()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('books_title' => 'The Proverbial Test Book', 'books_image' => '/image/amz/ZFBG.jpg', 'books_link' => '/store', 'books_author' => 'Schwartz', 'submit' => ''));
        $this->dispatch('/admin/book/add');
        $this->assertRedirectTo('/admin/book');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/book');
        $this->assertQueryContentRegex('span.author', '/.*Schwartz.*/');
    }
    /* deleteAction tests */
    public function test_deleteAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/book/delete?id=6');
        $this->assertQueryContentContains('div', 'Confirm Deletion', 'Confirmation not reached.');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('id' => '6', 'del' => 'Yes'));
        $this->dispatch('/admin/book/delete');
        $this->assertRedirectTo('/admin/book');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/book');
        $this->assertNotQueryContentRegex('span.author', '/.*Pope.*/');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminBookControllerTest::main') {
    AdminBookControllerTest::main();
}
