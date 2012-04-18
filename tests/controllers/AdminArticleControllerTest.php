<?php
// Call AdminArticleControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AdminArticleControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AdminArticleControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AdminArticleControllerTest");
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
        /* Tear Down Routine */
    }
    /* End Actual Setup */
    /* Begin Actual Tests */
    /* indexAction tests */
    public function test_indexAction()
    {
    }
    public function test_indexActionNotLoggedIn()
    {
        $params = array('action' => 'index', 'controller' => 'article', 'module' => 'admin');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        $this->assertQueryContentContains('h2', 'Exception Class: ACL Error');
    }
    public function test_indexActionLoggedIn()
    {
        $this->loginUser();
        $params = array('action' => 'index', 'controller' => 'article', 'module' => 'admin');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        $this->assertQueryContentContains('span.title', 'New: ');
    }
    public function test_indexActionPublishedOnly()
    {
        $this->loginUser();
        $url = '/admin/article?article_filter=published';
        $this->dispatch($url);
        $this->assertNotQueryContentContains('.entity', '[Pending]');
    }
    public function test_indexActionPendingOnly()
    {
        $this->loginUser();
        $url = '/admin/article?article_filter=pending';
        $this->dispatch($url);
        $this->assertNotQueryContentContains('.entity', '[Published]');
    }
    public function test_indexActionAll()
    {
        $this->loginUser();
        $url = '/admin/article?article_filter=all';
        $this->dispatch($url);
        $this->assertQueryContentContains('em', 'Displaying All Articles');
    }
    public function test_indexActionAuthor()
    {
        $this->loginUser('gussy', 'password');
        $url = '/admin/article';
        $this->dispatch($url);
        $this->assertNotQueryContentContains('span.author', 'bucky');
        $this->assertNotQueryContentContains('span.author', 'kmiller');
        $this->assertQueryContentContains('span.author', 'gussy');
    }
    /* previewAction tests */
    public function test_previewAction()
    {
    }
    public function test_previewActionCount()
    {
        $this->loginUser();
        $url = '/admin/article/preview?&id=34';
        $this->dispatch($url);
        $this->assertQueryCount('.entity', 1);
    }
    public function test_previewActionBadID()
    {
        $this->loginUser();
        $url = '/admin/article/preview?&id=0';
        $this->dispatch($url);
        $this->assertQueryContentContains('h1', 'It would seem that an error has occurred...');
    }
    /* publishAction tests */
    public function test_publishAction()
    {
    }
    public function test_publishActionSetPending()
    {
        $this->loginUser();
        $url = '/admin/article/publish?&id=34&mode=false';
        $this->dispatch($url);
        $this->assertRedirectTo('/admin/article');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/article/preview?&id=34';
        $this->dispatch($url);
        $this->assertQueryContentContains('.entity', '[Pending]');
    }
    public function test_publishActionSetPublish()
    {
        $this->loginUser();
        $url = '/admin/article/publish?&id=30&mode=true';
        $this->dispatch($url);
        $this->assertRedirectTo('/admin/article');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/article/preview?&id=30';
        $this->dispatch($url);
        $this->assertQueryContentContains('.entity', '[Published]');
    }
    /* editAction tests */
    public function test_editAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/article/edit?id=34');
        $this->assertQuery('form[name="articleForm"]');
    }
    public function test_editActionCancel()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/admin/article/edit?id=34');
        $this->assertRedirectTo('/admin/article');
    }
    public function test_editActionCommit()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('user_id' => 25, 'article_title' => 'The Proverbial Test Post', 'article_text' => 'The need for test posts from different users of different roles is an ongoing neccessity for testing purposes. Hence, this here post. Update: ' . $newdate, 'article_id' => 34, 'keywords' => '', 'submit' => 'submit'));
        $this->dispatch('/admin/article/edit?id=34');
        $this->assertRedirectTo('/admin/article');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/article/preview?&id=34';
        $this->dispatch($url);
        $this->assertQueryContentContains('.entity', $newdate);
    }
    public function test_editActionPreview()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('user_id' => 25, 'article_title' => 'The Proverbial Test Post', 'article_text' => 'The need for test posts from different users of different roles is an ongoing neccessity for testing purposes. Hence, this here post. Update: ' . $newdate, 'article_id' => 34, 'keywords' => '', 'preview' => 'submit'));
        $this->dispatch('/admin/article/edit?id=34');
        $this->assertRedirectTo('/admin/article/preview?id=34');
    }
    /* addAction tests */
    public function test_addActionCancel()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/admin/article/add');
        $this->assertRedirectTo('/admin/article');
    }
    public function test_addActionCommit()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('article_title' => 'Update: ' . $newdate, 'article_text' => 'Adding text here.', 'keywords' => '', 'submit' => 'submit'));
        $this->dispatch('/admin/article/add');
        $this->assertRedirectTo('/admin/article');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/article';
        $this->dispatch($url);
        $this->assertQueryContentContains('.entity', $newdate);
    }
    public function test_addActionPreview()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('article_title' => 'Update: ' . $newdate, 'article_text' => 'Adding text here.', 'keywords' => '', 'preview' => 'submit'));
        $this->dispatch('/admin/article/add');
        $this->assertRedirectTo('/admin/article');
    }
    /* deleteAction tests */
    public function test_deleteAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/article/delete?id=256');
        $this->assertQueryContentContains('div', 'Confirm Deletion', 'Confirmation not reached.');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('id' => '256', 'del' => 'Yes'));
        $this->dispatch('/admin/article/delete');
        $this->assertRedirectTo('/admin/article');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/article');
        $this->assertNotQueryContentRegex('span.titles', '/Delete Me/', 'article still present after delete');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/blog');
        $this->assertNotQueryContentContains('a', 'delete', 'keyword still present after article delete');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminArticleControllerTest::main') {
    AdminArticleControllerTest::main();
}
