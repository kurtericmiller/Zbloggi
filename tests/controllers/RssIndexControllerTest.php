<?php
// Call RssIndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "RssIndexControllerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Controllers
 */
class RssIndexControllerTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("RssIndexControllerTest");
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
    $co = curl_init();
    curl_setopt($co, CURLOPT_URL, 'ymozend.tst/rss');
    curl_setopt($co, CURLOPT_RETURNTRANSFER, 1);
    $xml = curl_exec($co);
    curl_close($co);
    $this->assertSelectCount('item', 5, $xml);
  }
  public function test_listAction()
  {
    $co = curl_init();
    curl_setopt($co, CURLOPT_URL, 'ymozend.tst/rss/index/list');
    curl_setopt($co, CURLOPT_RETURNTRANSFER, 1);
    $xml = curl_exec($co);
    curl_close($co);
    $this->assertSelectCount('item', 5, $xml);
  }
  public function test_getAction()
  {
    $co = curl_init();
    curl_setopt($co, CURLOPT_URL, 'ymozend.tst/rss/index/get?id=25');
    curl_setopt($co, CURLOPT_RETURNTRANSFER, 1);
    $xml = curl_exec($co);
    curl_close($co);
    $this->assertSelectCount('item', 1, $xml);
  }
  public function test_postAction()
  {
    // TODO flesh out if this ever gets used
    $this->assertTrue(true);
  }
  public function test_putAction()
  {
    // TODO flesh out if this ever gets used
    $this->assertTrue(true);
  }
  public function test_deleteAction()
  {
    // TODO flesh out if this ever gets used
    $this->assertTrue(true);
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'RssIndexControllerTest::main') {
  RssIndexControllerTest::main();
}
