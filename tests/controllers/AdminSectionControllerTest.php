<?php
// Call AdminSectionControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AdminSectionControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Admin
 */
class AdminSectionControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AdminSectionControllerTest");
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
        $params = array('action' => 'index', 'controller' => 'section', 'module' => 'admin');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        $this->assertQueryContentContains('h2', 'Exception Class: ACL Error');
    }
    public function test_indexActionLoggedIn()
    {
        $this->loginUser();
        $params = array('action' => 'index', 'controller' => 'section', 'module' => 'admin');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        $this->assertQueryContentContains('span.title', 'New: ');
    }
    public function test_indexActionPublishedOnly()
    {
        $this->loginUser();
        $url = '/admin/section?section_filter=published';
        $this->dispatch($url);
        $this->assertNotQueryContentContains('.entity', '[Pending]');
    }
    public function test_indexActionPendingOnly()
    {
        $this->loginUser();
        $url = '/admin/section?section_filter=pending';
        $this->dispatch($url);
        $this->assertNotQueryContentContains('.entity', '[Published]');
    }
    public function test_indexActionAll()
    {
        $this->loginUser();
        $url = '/admin/section?section_filter=all';
        $this->dispatch($url);
        $this->assertQueryContentContains('em', 'Displaying All Sections');
    }
    /* previewAction tests */
    public function test_previewAction()
    {
    }
    public function test_previewActionCount()
    {
        $this->loginUser();
        $url = '/admin/section/preview?&id=36';
        $this->dispatch($url);
        $this->assertQueryCount('.entity', 1);
    }
    public function test_previewActionBadID()
    {
        $this->loginUser();
        $url = '/admin/section/preview?&id=0';
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
        $url = '/admin/section/publish?&id=36&mode=false';
        $this->dispatch($url);
        $this->assertRedirectTo('/admin/section');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/section/preview?&id=36';
        $this->dispatch($url);
        $this->assertQueryContentRegex('.entity', '/.*Pending.*/');
    }
    public function test_publishActionSetPublish()
    {
        $this->loginUser();
        $url = '/admin/section/publish?&id=99&mode=true';
        $this->dispatch($url);
        $this->assertRedirectTo('/admin/section');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/section/preview?&id=99';
        $this->dispatch($url);
        $this->assertQueryContentRegex('.entity', '/.*Published.*/');
    }
    /* editAction tests */
    public function test_editAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/section/edit?id=36');
        $this->assertQuery('form[name="sectionForm"]');
    }
    public function test_editActionCancel()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/admin/section/edit?id=36');
        $this->assertRedirectTo('/admin/section');
    }
    public function test_editActionCommit()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('section_title' => 'The Proverbial Test Post', 'section_text' => 'Test section update. Update: ' . $newdate, 'section_id' => 36, 'keywords' => '', 'submit' => 'submit'));
        $this->dispatch('/admin/section/edit?id=36');
        $this->assertRedirectTo('/admin/section');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $url = '/admin/section/preview?&id=36';
        $this->dispatch($url);
        $this->assertQueryContentContains('.entity', $newdate);
    }
    public function test_editActionPreview()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('section_title' => 'The Proverbial Test Post', 'section_text' => 'Test section update. Update: ' . $newdate, 'section_id' => 36, 'keywords' => '', 'preview' => 'submit'));
        $this->dispatch('/admin/section/edit?id=36');
        $this->assertRedirectTo('/admin/section/preview?id=36');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/section/preview?id=36');
        $this->assertQueryContentContains('.entity', $newdate);
    }
    /* addAction tests */
    public function test_addActionCancel()
    {
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/admin/section/add');
        $this->assertRedirectTo('/admin/section');
    }
    public function test_addActionCommit()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('section_title' => 'Update: ' . $newdate, 'section_text' => 'Adding text here.', 'keywords' => '', 'submit' => 'submit'));
        $this->dispatch('/admin/section/add');
        $this->assertRedirectTo('/admin/section');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/section');
        $this->assertQueryContentContains('.entity', $newdate);
    }
    public function test_addActionPreview()
    {
        $newdate = date('Y/m/d H:i:s');
        $this->loginUser();
        $this->request->setMethod('POST')->setPost(array('section_title' => 'Update: ' . $newdate, 'section_text' => 'Adding text here.', 'keywords' => '', 'preview' => 'submit'));
        $this->dispatch('/admin/section/add');
        $this->assertRedirectTo('/admin/section');
    }
    /* deleteAction tests */
    public function test_deleteAction()
    {
        $this->loginUser();
        $this->dispatch('/admin/section/delete?id=39');
        $this->request->setMethod('POST')->setPost(array('id' => '39', 'del' => 'Yes', 'submit' => 'submit'));
        $this->resetRequest()->resetResponse();
        $this->loginUser();
        $this->dispatch('/admin/section');
        $this->assertNotQueryContentRegex('span.title', '/.*Terms.*/');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminSectionControllerTest::main') {
    AdminSectionControllerTest::main();
}
