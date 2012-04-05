<?php
// Call DefaultIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "DefaultIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class DefaultIndexControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("DefaultIndexControllerTest");
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
        $this->dispatch('/');
        $this->assertQuery('div.sidebarLt');
        $this->assertQuery('div.sidebarRt');
        $this->assertQuery('form[name="loginForm"]');
        $this->assertQueryCount('div.articleItem', 3);
    }
    public function test_indexActionLoggedIn()
    {
        $this->loginUser('gussy', 'password');
        $this->dispatch('/');
        $this->assertNotQuery('form[name="loginForm"]');
        $this->assertQueryCount('div.articleItem', 3);
        $this->assertQueryCount('div.arty', 2);
        $this->assertNotQueryContentContains('a', 'Admin');
    }
    public function test_indexActionLoggedInAdmin()
    {
        $this->loginUser();
        $this->dispatch('/');
        $this->assertNotQuery('form[name="loginForm"]');
        $this->assertQueryCount('div.articleItem', 3);
        $this->assertQueryCount('div.arty', 2);
        $this->assertQueryContentContains('a', 'Admin');
    }
    public function test_contactAction()
    {
        $this->request->setMethod('POST')->setPost(array('email' => 'bobbalaban@bbb.com', 'bodytext' => 'More and more body text.', 'submit' => ''));
        $this->dispatch('/default/index/contact');
        // TODO controller uses _SERVER, chokes phpunit
        $this->assertRedirectTo('/', 'Uses _SERVER for redirect, messes up phpunit');
    }
    public function test_aboutAction()
    {
        $this->dispatch('/about');
        $this->assertQueryContentContains('h2', 'About');
    }
    public function test_faqAction()
    {
        $this->dispatch('/faq');
        $this->assertQueryContentContains('h2', 'FAQ');
    }
    public function test_privacyAction()
    {
        $this->dispatch('/privacy');
        $this->assertQueryContentContains('h2', 'Privacy');
    }
    public function test_termsAction()
    {
        $this->dispatch('/terms');
        $this->assertQueryContentContains('h2', 'Terms');
    }
    public function test_creditsAction()
    {
        $this->dispatch('/credits');
        $this->assertQueryContentContains('h2', 'Credits');
    }
    public function test_helpAction()
    {
        $this->dispatch('/help');
        $this->assertQueryContentContains('h2', 'Help');
    }
    public function test_profileAction()
    {
        $this->dispatch('/profile/14');
        $this->assertQueryContentRegex('h2', '/.*Findleton.*/');
    }
    public function test_booksAction()
    {
        $this->dispatch('/books');
        $this->assertQuery('iframe');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'DefaultIndexControllerTest::main') {
    DefaultIndexControllerTest::main();
}
