<?php
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "LocalDomainCollectionTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalDomainCollectionTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("LocalDomainCollectionTest");
    $result = PHPUnit_TextUI_TestRunner::run($suite);
  }
  /* Begin Actual Setup */
  private $watcher;
  private $table;
  private $model;
  private $collection;
  private $concrete = array(array('Local_Domain_Models_Article'), array('Local_Domain_Models_Comment'), array('Local_Domain_Models_Section'), array('Local_Domain_Models_Avatar'), array('Local_Domain_Models_Keyword'), array('Local_Domain_Models_Profile'), array('Local_Domain_Models_Registration'));
  public function setTable($model)
  {
    $table = split('_', strtolower($model));
    $this->table = $table[3] . 's';
  }
  public function setUp()
  {
    parent::setUp();
    $this->watcher = Local_Domain_ObjectWatcher::instance();
    $this->watcher->clear();
  }
  public function tearDown()
  {
    parent::tearDown();
    $this->model->markClean();
  }
  /* End Actual Setup */
  /* Begin Actual Tests */
  public function test_concrete()
  {
    foreach ($this->concrete as $data) {
      //echo "Testing: $data[0]\n";
      $this->setTable($data[0]);
      $this->model = new $data[0];
      $this->assertInternalType('object', $this->model, $message = 'Collection: model creation did not return an object');
      $this->collection = $this->model->finder()->findAll();
      $this->assertInternalType('object', $this->collection, $message = 'Collection::collection creation did not return an object');
      $this->tst_notifyAccess();
      $this->tst_add();
      $this->tst_delete($data[0]);
      $this->tst_count();
      $this->tst_rewind();
      $this->tst_current();
      $this->tst_key();
      $this->tst_next();
      /*
            $this->tst_valid();
      */
    }
  }
  public function tst_notifyAccess()
  {
    /* count() calls notifyAccess internally to load raw data */
    $rows = $this->model->finder()->doStatement("select count(*) from $this->table", array(), SINGLETON);
    $cnt = $this->collection->count();
    $this->assertEquals($rows, $cnt, $message = 'Collection::notifyAccess did not return an expected value');
  }
  public function tst_add()
  {
    $cnt1 = $this->collection->count();
    $this->collection->add($this->model);
    $cnt2 = $this->collection->count();
    $this->assertEquals($cnt1 + 1, $cnt2, $message = 'Collection::add did not return an expected value');
    /* modifies collection internals - reinitialize */
    $this->collection = $this->model->finder()->findAll();
  }
  public function tst_delete($model)
  {
    $cnt = $this->collection->count();
    $obj1 = $this->collection->current();
    $this->assertInternalType('object', $obj1, $message = 'Collection::delete - current() did not return an object');
    $id1 = $obj1->getId();
    $key = $this->collection->key($obj1);
    $this->collection->delete($key);
    $obj2 = $this->watcher->key_exists('delete', $model, $id1);
    $this->assertInternalType('object', $obj2, $message = 'Collection::delete - ObjectWatcher did not return an object');
    $id2 = $obj2->getId();
    $this->assertEquals($id1, $id2, $message = 'Collection::delete did not return an expected value');
    /* modifies collection internals - reinitialize */
    $this->collection = $this->model->finder()->findAll();
  }
  public function tst_count()
  {
    $rows = $this->model->finder()->doStatement("select count(*) from $this->table", array(), SINGLETON);
    $this->assertInternalType('object', $this->collection, $message = 'Collection::count did not return an object');
    $cnt = $this->collection->count();
    $this->assertEquals($rows, $cnt, $message = 'Collection::count did not return an expected value');
  }
  public function tst_rewind()
  {
    $cnt = $this->collection->count();
    if ($cnt > 0) {
      $key1 = $this->collection->key($this->collection->current());
      $this->assertEquals(0, $key1, $message = 'Collection::rewind current did not return an expected value');
      $key2 = $this->collection->key($this->collection->next());
      $this->assertEquals($key1 + 1, $key2, $message = 'Collection::rewind next did not return an expected value');
      $key3 = $this->collection->key($this->collection->rewind());
      $this->assertEquals(0, $key3, $message = 'Collection::rewind did not return an expected value');
    } else {
      /* untestable */
      $this->assertTrue(true);
    }
  }
  public function tst_current()
  {
    $cnt = $this->collection->count();
    if ($cnt > 0) {
      $key1 = $this->collection->key($this->collection->current());
      $this->assertEquals(0, $key1, $message = 'Collection::current did not return an expected value');
      $key2 = $this->collection->key($this->collection->next());
      $this->assertEquals($key1 + 1, $key2, $message = 'Collection::current next did not return an expected value');
      $key3 = $this->collection->key($this->collection->current());
      $this->assertEquals(1, $key3, $message = 'Collection::current did not return an expected value');
    } else {
      /* untestable */
      $this->assertTrue(true);
    }
  }
  public function tst_key()
  {
    $key = $this->collection->key($this->collection->rewind());
    $this->assertEquals(0, $key, $message = 'Collection::key did not return an expected value');
  }
  public function tst_next()
  {
    $this->collection->rewind();
    $cnt = $this->collection->count();
    $lastkey = 0;
    while ($lastkey < $cnt) {
      $key = $this->collection->key($this->collection->next());
      $this->assertEquals($lastkey + 1, $key, $message = 'Collection::current next did not return an expected value');
      $lastkey = $key;
    }
    $key = $this->collection->key($this->collection->next());
    $this->assertEquals($key, $cnt, $message = 'Collection::current next did not return an expected value');
  }
  public function tst_valid()
  {
    $this->collection->rewind();
    $obj = $this->collection->current();
    $id1 = $obj->getId();
    $this->assertInternalType('object', $obj, $message = 'Collection::valid current - did not return an object');
    $obj = $this->collection->valid();
    $this->assertInternalType('object', $obj, $message = 'Collection::valid did not return an object');
    $id2 = $obj->getId();
    $this->assertEquals($id1, $id2, $message = 'Collection::valid next did not return an expected value');
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalDomainCollectionTest::main') {
  LocalDomainCollectionTest::main();
}
