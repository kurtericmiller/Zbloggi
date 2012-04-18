<?php
// Call LocalDomainHelperFactoryTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalDomainHelperFactoryTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalDomainHelperFactoryTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalDomainHelperFactoryTest");
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
    /* End Actual Tests */
    private $models = array('Local_Domain_Models_Article', 'Local_Domain_Models_Comment', 'Local_Domain_Models_Section', 'Local_Domain_Models_Avatar', 'Local_Domain_Models_Keyword', 'Local_Domain_Models_Profile', 'Local_Domain_Models_Registration');
    public function test_helper()
    {
        foreach ($this->models as $model) {
            $this->tst_getFinder($model);
            $this->tst_getCollection($model);
        }
    }
    public function tst_getFinder($model)
    {
        $finder = Local_Domain_HelperFactory::getFinder($model);
        $this->assertInternalType('object', $finder, $message = 'getFinder did not return an object');
    }
    public function tst_getCollection($model)
    {
        $collection = Local_Domain_HelperFactory::getCollection($model);
        $this->assertInternalType('object', $collection, $message = 'getCollection did not return an object');
    }
}
if (PHPUnit_MAIN_METHOD == 'LocalDomainHelperFactoryTest::main') {
    LocalDomainHelperFactoryTest::main();
}
