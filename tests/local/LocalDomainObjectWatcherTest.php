<?php
// Call LocalDomainObjectWatcherTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalDomainObjectWatcherTest::main");
}
require_once 'TestInit.php';
/**
 * @group Local
 */
class LocalDomainObjectWatcherTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalDomainObjectWatcherTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }
    /* Begin Actual Setup */
    private $watcher;
    private $model;
    private $id;
    public function setUp()
    {
        parent::setUp();
        $this->watcher = Local_Domain_ObjectWatcher::instance();
        $this->model = new Local_Domain_Models_Article();
        $this->id = $this->model->getId();
    }
    public function tearDown()
    {
        parent::tearDown();
        if (isset($this->watcher)) {
            $this->watcher->clear();
        }
    }
    /* End Actual Setup */
    /* Begin Actual Tests */
    public function test_instance()
    {
        $this->assertInternalType('object', $this->watcher, $message = 'ObjectWatcher instance did not return an object');
    }
    public function test_globalKey()
    {
        $key = $this->watcher->globalKey($this->model);
        $this->assertRegExp('/Local_Domain_Models_Article/', $key, $message = 'ObjectWatcher globalKey did not return an expected value');
    }
    public function test_add()
    {
        $this->watcher->add($this->model);
        $obj = $this->watcher->key_exists('new', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher add did not return an object');
        $this->watcher->clear();
        $this->watcher->add($this->model);
        $obj = $this->watcher->key_exists('all', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher add did not return an object');
    }
    public function test_addNew()
    {
        $this->watcher->addNew($this->model);
        $obj = $this->watcher->key_exists('new', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher addNew did not return an object');
    }
    public function test_addDirty()
    {
        $this->watcher->clear();
        $this->watcher->addDirty($this->model);
        $obj = $this->watcher->key_exists('dirty', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher addDirty did not return an object');
    }
    public function test_addDelete()
    {
        $this->watcher->addDelete($this->model);
        $obj = $this->watcher->key_exists('delete', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher addDelete did not return an object');
    }
    public function test_addClean()
    {
        $this->watcher->clear();
        $this->watcher->addDirty($this->model);
        $obj = $this->watcher->key_exists('dirty', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher addClean (dirty) did not return an object');
        $this->watcher->addNew($this->model);
        $obj = $this->watcher->key_exists('new', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher addClean (new) did not return an object');
        $this->watcher->addDelete($this->model);
        $obj = $this->watcher->key_exists('delete', 'Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher addClean (delete) did not return an object');
        $this->watcher->addClean($this->model);
        $obj = $this->watcher->key_exists('dirty', 'Local_Domain_Models_Article', $this->id);
        $this->assertNull($obj, $message = 'ObjectWatcher addClean (dirty) did not return null');
        $obj = $this->watcher->key_exists('new', 'Local_Domain_Models_Article', $this->id);
        $this->assertNull($obj, $message = 'ObjectWatcher addClean (new) did not return null');
        $obj = $this->watcher->key_exists('delete', 'Local_Domain_Models_Article', $this->id);
        $this->assertNull($obj, $message = 'ObjectWatcher addClean (delete) did not return null');
    }
    public function test_exists()
    {
        $this->watcher->clear();
        $this->watcher->add($this->model);
        $obj = $this->watcher->exists('Local_Domain_Models_Article', $this->id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher exists did not return an object');
    }
    public function test_clearPending()
    {
        $this->model->set('article_title', 'test data');
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher clearPending (insert) did not return an object');
        $title = $obj->get('article_title');
        $this->assertEquals('test data', $title, $message = 'ObjectWatcher clearPending (post insert) did not return an expected value');
        $obj->set('article_title', 'new test data');
        $this->watcher->clearPending();
        $obj = $this->model->finder()->find($id);
        $title = $obj->get('article_title');
        $this->assertEquals('new test data', $title, $message = 'ObjectWatcher clearPending (update) did not return an expected value');
        $this->model->finder()->delete($obj);
        $this->watcher->clearPending();
        $result = $this->model->finder()->doStatement("select count(id) from articles where id = ?", array($id), SINGLETON);
        $this->assertEquals(0, $result, $message = 'ObjectWatcher (delete) did not return the expected value');
    }
    public function test___destruct()
    {
        $this->model->set('article_title', 'destroy watcher');
        $this->watcher->__destruct();
        $id = $this->model->getLastId();
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'ObjectWatcher destruct (insert) did not return an object');
    }
}
if (PHPUnit_MAIN_METHOD == 'LocalDomainObjectWatcherTest::main') {
    LocalDomainObjectWatcherTest::main();
}
