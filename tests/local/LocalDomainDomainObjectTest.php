<?php
if (!defined("PHPUnit_MAIN_METHOD")) {
  define("PHPUnit_MAIN_METHOD", "LocalDomainDomainObjectTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalDomainDomainObjectTest extends TestInit
{
  public static function main()
  {
    require_once 'PHPUnit/Autoload.php';
    require_once 'bootstrap.php';
    $suite = new PHPUnit_Framework_TestSuite("LocalDomainDomainObjectTest");
    $result = PHPUnit_TextUI_TestRunner::run($suite);
  }
  /* Begin Actual Setup */
  private $watcher;
  private $table;
  private $model;
  private $mapper;
  private $field;
  private $concrete = array(array('Local_Domain_Models_Article', 'Local_Domain_Mappers_ArticleMapper', 'article_text'), array('Local_Domain_Models_Comment', 'Local_Domain_Mappers_CommentMapper', 'comment_text'), array('Local_Domain_Models_Section', 'Local_Domain_Mappers_SectionMapper', 'section_text'), array('Local_Domain_Models_Avatar', 'Local_Domain_Mappers_AvatarMapper', 'image_name'), array('Local_Domain_Models_Keyword', 'Local_Domain_Mappers_KeywordMapper', 'keyword'), array('Local_Domain_Models_Profile', 'Local_Domain_Mappers_ProfileMapper', 'first'), array('Local_Domain_Models_Registration', 'Local_Domain_Mappers_RegistrationMapper', 'reg_string'));
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
      $this->setTable($data[0]);
      $this->model = new $data[0];
      $this->mapper = new $data[1];
      $this->field = $data[2];
      //echo "Testing: $data[0]\n";
      $this->tst_markNew($data[0]);
      $this->tst_markDirty($data[0]);
      $this->tst_markDeleted($data[0]);
      $this->tst_markClean($data[0]);
      $this->tst_getLastId();
      $this->tst_getDefaults();
      $this->tst_getId();
      $this->tst_finder();
      $this->tst_collection();
    }
  }
  public function tst_markNew($model)
  {
    $this->model->markNew();
    $id = $this->model->getId();
    $obj = $this->watcher->key_exists('new', $model, $id);
    $this->assertInternalType('object', $obj, $message = 'ObjectWatcher did not return an object');
  }
  public function tst_markDirty($model)
  {
    $this->mapper->doStatement("insert into $this->table ($this->field) values ('test')");
    $last = $this->model->getLastId();
    $this->model = $this->mapper->find($last);
    $this->model->markDirty();
    $id = $this->model->getId();
    $obj = $this->watcher->key_exists('dirty', $model, $id);
    $this->assertInternalType('object', $obj, $message = 'ObjectWatcher did not return an object');
  }
  public function tst_markDeleted($model)
  {
    $this->mapper->doStatement("insert into $this->table ($this->field) values ('test')");
    $last = $this->model->getLastId();
    $this->model = $this->mapper->find($last);
    $this->model->markDeleted();
    $id = $this->model->getId();
    $obj = $this->watcher->key_exists('delete', $model, $id);
    $this->assertInternalType('object', $obj, $message = 'ObjectWatcher did not return an object');
  }
  public function tst_markClean($model)
  {
    $this->model->markNew();
    $this->model->markDirty();
    $this->model->markDeleted();
    $this->model->markClean();
    $id = $this->model->getId();
    $obj = $this->watcher->key_exists('new', $model, $id);
    $this->assertNull($obj, $message = 'ObjectWatcher did not return null');
    $obj = $this->watcher->key_exists('dirty', $model, $id);
    $this->assertNull($obj, $message = 'ObjectWatcher did not return null');
    $obj = $this->watcher->key_exists('delete', $model, $id);
    $this->assertNull($obj, $message = 'ObjectWatcher did not return null');
  }
  public function tst_getLastId()
  {
    $this->assertInternalType('object', $this->mapper, $message = 'finder did not return an object');
    $this->mapper->doStatement("insert into $this->table ($this->field) values ('test')");
    $last = $this->model->getLastId();
    $this->assertNotNull($last, $message = 'getLastId was null');
    $this->assertInternalType('string', $last, $message = 'getLastId did not return a string');
  }
  public function tst_getDefaults()
  {
    $defaults = $this->model->getDefaults();
    $this->assertInternalType('array', $defaults, $message = 'getDefaults did not return an array');
    $this->assertArrayHasKey("_$this->field", $defaults, $message = 'defaults array missing expected key');
    $val = $defaults["_$this->field"];
    $this->assertEquals($val, 'NULL', $message = 'defaults array missing expected value');
  }
  public function tst_getId()
  {
    $id = $this->model->getId();
    $this->assertNotNull($id, $message = 'Id was null');
    $this->assertInternalType('string', $id, $message = 'getId did not return a string');
  }
  public function tst_finder()
  {
    $this->assertInternalType('object', $this->mapper, $message = 'finder did not return an object');
  }
  public function tst_collection()
  {
    $coll = $this->model->collection();
    $this->assertInternalType('object', $coll, $message = 'collection did not return an object');
  }
  /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalDomainDomainObjectTest::main') {
  LocalDomainDomainObjectTest::main();
}
