<?php
// Call SearchIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "SearchIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Search
 */
class SearchIndexControllerTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("SearchIndexControllerTest");
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
        $this->dispatch('/search?search_text=zend&submit=Search');
        $this->assertQueryContentContains('h2', 'Results');
        $this->assertQueryCount('tr', 4);
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'SearchIndexControllerTest::main') {
    SearchIndexControllerTest::main();
}
