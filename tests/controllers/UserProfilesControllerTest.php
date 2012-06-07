<?php
// Call UserProfilesControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "UserProfilesControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group User
 */
class UserProfilesControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("UserProfilesControllerTest");
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
    public function test_indexActionNotLoggedIn()
    {
        $this->dispatch('/user/profiles');
        $this->assertRedirectTo('/');
    }
    public function test_indexAction()
    {
        $this->loginUser('gussy', 'password');
        $this->dispatch('/user/profiles');
        $this->assertQuery('div.userProfile');
        $this->assertQueryContentRegex('p', '/.*Gus.*Schwartz.*/');
    }
    public function test_indexActionFirstTime()
    {
        $this->loginUser('nancy', 'password');
        $this->dispatch('/user/profiles');
        $this->assertQuery('form[name="profileForm"]');
    }
    public function test_indexActionEdit()
    {
        $this->loginUser('nancy', 'password');
        $this->dispatch('/user/profiles?id=29');
        $this->assertQueryContentRegex('legend', '/.*nancy.*/');
    }
    public function test_indexActionEditCancel()
    {
        $this->loginUser('nancy', 'password');
        $this->request->setMethod('POST')->setPost(array('cancel' => 'cancel'));
        $this->dispatch('/user/profiles?id=29');
        $this->assertRedirectTo('/');
    }
    public function test_indexActionEditSubmit()
    {
        $this->loginUser('gussy', 'password');
        $this->request->setMethod('POST')->setPost(array('user_id' => '25', 'first' => 'Mari', 'middle' => '', 'last' => 'Celeste', 'occupation' => '', 'website' => '', 'bio_text' => '', 'avatar' => '11.jpg', 'MAX_FILE_SIZE' => '2097152', 'submit' => ''));
        $this->dispatch('/user/profiles?id=25');
        $this->assertRedirectTo('/user/profiles');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser('gussy', 'password');
        $this->dispatch('/user/profiles');
        $this->assertQueryContentRegex('p', '/.*Celeste.*/');
    }
    public function test_indexActionEditNotLoggedIn()
    {
        $this->dispatch('/user/profiles?id=29');
        $this->assertRedirectTo('/');
    }
    public function test_indexActionEditOtherUser()
    {
        $this->loginUser('nancy', 'password');
        $this->dispatch('/user/profiles?id=14');
        // should be no change
        $this->assertQueryContentRegex('legend', '/.*nancy.*/');
    }
    public function test_deleteActionNotLoggedIn()
    {
        $this->dispatch('/user/profiles/delete?id=14');
        $this->assertRedirectTo('/');
    }
    public function test_websiteurl()
    {
        $this->loginUser('gussy', 'password');
        $this->request->setMethod('POST')->setPost(array('user_id' => '25', 'first' => 'Mari', 'middle' => '', 'last' => 'Celeste', 'occupation' => '', 'website' => 'www.google.com', 'bio_text' => '', 'avatar' => '11.jpg', 'MAX_FILE_SIZE' => '2097152', 'submit' => ''));
        $this->dispatch('/user/profiles?id=25');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser('gussy', 'password');
        $this->dispatch('/user/profiles');
        $this->assertQueryContentRegex('a', '#http://www.google.com#');
    }
    public function test_deleteAction()
    {
        $this->loginUser('gussy', 'password');
        $this->dispatch('/user/profiles/delete');
        $this->assertQueryContentContains('div', 'Confirm Deletion', 'Confirmation not reached.');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser('gussy', 'password');
        $this->request->setMethod('POST')->setPost(array('id' => '25', 'del' => 'Yes'));
        $this->dispatch('/user/profiles/delete');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser('gussy', 'password');
        $this->dispatch('/user/profiles');
        $this->assertQueryContentRegex('h2', '/User Profile/');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'UserProfilesControllerTest::main') {
    UserProfilesControllerTest::main();
}
