<?php
// Call AdminSettingControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "AdminSettingControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class AdminSettingControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("AdminSettingControllerTest");
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
        $this->request->setMethod('POST')->setPost(array('site_title' => 'Your Moment of Zend', 'site_tagline' => 'Walk this way', 'site_url' => 'http://ymozend.com', 'headlineId' => '33', 'articleCount' => '3', 'bookCount' => '3', 'latestArticleCount' => '6', 'amazonLU' => 'zendX', 'admArtCnt' => '5', 'admComCnt' => '4', 'admUserCnt' => '10', 'defemail' => 'admin@mail.com', 'submit' => ''));
        $this->dispatch('/admin/setting');
        $this->assertRedirectTo('/admin/setting');
        $this->resetRequest()->resetResponse();
        $this->request->setPost(array());
        $this->loginUser();
        $this->dispatch('/admin/setting');
        $this->assertQuery('input#amazonLU[value="zendX"]');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'AdminSettingControllerTest::main') {
    AdminSettingControllerTest::main();
}
