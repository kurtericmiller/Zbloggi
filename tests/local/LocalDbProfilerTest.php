<?php
// Call LocalDbProfilerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "LocalDbProfilerTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalDbProfilerTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("LocalDbProfilerTest");
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
  public function test_queryStart()
  {
    $this->markTestIncomplete();
  }
  public function test_queryEnd()
  {
    $this->markTestIncomplete();
  }
  public function test_getQueryProfile()
  {
    $this->markTestIncomplete();
  }
  public function test_getLastQueryProfile()
  {
    $this->markTestIncomplete();
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalDbProfilerTest::main') {
  LocalDbProfilerTest::main();
}
