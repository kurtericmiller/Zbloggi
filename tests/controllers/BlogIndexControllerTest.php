<?php
// Call BlogIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "BlogIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class BlogIndexControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("BlogIndexControllerTest");
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
        $this->dispatch('/blog');
        $this->assertQuery('div.sideWrap');
        $this->assertQueryCount('div.articleItem', 3);
    }
    public function test_indexActionAuthors()
    {
        $this->loginUser('gussy', 'password');
        $this->dispatch('/blog');
        $this->assertQuery('div.sideWrap');
        $this->assertQueryCount('div.articleItem', 3);
        $this->assertQueryContentRegex('div.art_link', '/.*Authors:.*/');
    }
    public function test_tagAction()
    {
        $this->dispatch('/blog/tag?tag=cloud');
        $this->assertQuery('div.sideWrap');
        $this->assertQueryCount('div.articleItem', 1);
        $this->assertQueryContentContains('h2', 'Articles matching tag: cloud');
    }
    public function test_authorAction()
    {
        $this->dispatch('/blog/author?author=11');
        $this->assertQuery('div.sideWrap');
        $this->assertQueryCount('div.articleItem', 1);
        $this->assertQueryContentContains('h2', 'Articles matching author: kmiller');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'BlogIndexControllerTest::main') {
    BlogIndexControllerTest::main();
}
