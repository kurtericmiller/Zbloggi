<?php
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "LocalDomainMapperTest::main");
}
require_once 'TestInit.php';
/**
 * @group Domain
 */
class LocalDomainMapperTest extends TestInit
{
    public static function main()
    {
        require_once 'PHPUnit/Autoload.php';
        require_once 'bootstrap.php';
        $suite = new PHPUnit_Framework_TestSuite("LocalDomainMapperTest");
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
        $table = preg_split('/_/', strtolower($model));
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
            $this->tst_getTableDefaults();
            $this->tst_getAdapter();
            $this->tst_newId();
            $this->tst_doStatement();
            $this->tst_getCount($data[0]);
            $this->tst_load();
            $this->tst_loadArray();
            $this->tst_getFromMap();
            $this->tst_addToMap();
            $this->tst_find();
            $this->tst_insert();
            $this->tst_update();
            $this->tst_delete();
        }
    }
    public function tst_getTableDefaults()
    {
        $defaults = $this->mapper->getTableDefaults();
        $field = array_keys($defaults);
        $this->assertInternalType('array', $defaults, $message = 'Mapper::getTableDefaults() did not return an array');
        $this->assertArrayHasKey($field[1], $defaults, $message = 'Mapper::getTableDefaults() did not return an expected value');
    }
    public function tst_getAdapter()
    {
        $adapter = $this->mapper->getAdapter();
        $this->assertInternalType('object', $adapter, $message = 'Mapper::getAdapter did not return an object');
        $class = get_class($adapter);
        $this->assertRegExp('/Zend_Db_Adapter/', $class, $message = 'Mapper::getAdapter did not return a Zend DB Adapter object');
    }
    public function tst_newId()
    {
        $id = $this->mapper->newId();
        $this->assertInternalType('string', $id, $message = 'Mapper::newId() did not return a string');
    }
    public function tst_doStatement()
    {
        /* 3 modes */
        /* SINGLETON = doStatment($sql,[values],SINGLETON) returns value */
        /* VALUES = doStatment($sql,values) returns prepared statement  */
        /* RAW = doStatment($sql) returns prepared statement */
        $result = $this->mapper->doStatement("select count(*) from $this->table", array(), SINGLETON);
        $this->assertGreaterThanOrEqual(0, $result, $message = "Mapper::doStatement() did not return the expected value");
        $result = $this->mapper->doStatement("select count(*) from $this->table id where id > ?", array(0), SINGLETON);
        $this->assertGreaterThanOrEqual(0, $result, $message = "Mapper::doStatement() did not return the expected value");
        $result = $this->mapper->doStatement("select count(*) from $this->table where id > ?", array(0));
        $this->assertEquals(get_class($result), "Zend_Db_Statement_Pdo", $message = "Mapper::doStatement() did not return the expected value");
        $result = $this->mapper->doStatement("select count(*) from $this->table");
        $this->assertEquals(get_class($result), "Zend_Db_Statement_Pdo", $message = "Mapper::doStatement() did not return the expected value");
    }
    public function tst_getCount($model)
    {
        $result = $this->model->finder()->doStatement("truncate $this->table");
        $result = $this->model->finder()->getCount($this->model);
        $this->assertEquals($result, 0, $message = 'Mapper::getCount() truncate did not return the expected value');
        $this->model->set($this->field, 'test_data');
        $this->watcher->clearPending();
        $result = $this->model->finder()->getCount($this->model);
        $this->assertEquals($result, 1, $message = 'Mapper::getCount() insert did not return the expected value');
    }
    public function tst_load()
    {
        $this->model->set($this->field, 'test_data');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $result = $this->model->finder()->doStatement("select * from $this->table where id = ?", $id);
        $obj = $this->model->finder()->load($result);
        $this->assertInternalType('object', $obj, $message = 'Mapper::load() did not return an object');
    }
    public function tst_loadArray()
    {
        $this->model->set($this->field, 'test_data');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $result = $this->model->finder()->doStatement("select * from $this->table where id = ?", $id);
        $loadArray = $result->fetchAll();
        $loadArray = array_shift($loadArray);
        $obj = $this->model->finder()->loadArray($loadArray);
        $this->assertInternalType('object', $obj, $message = 'Mapper::loadArray() did not return an object');
    }
    public function tst_getFromMap()
    {
        $this->model->set($this->field, 'test_data');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $result = $this->model->finder()->doStatement("select * from $this->table where id = ?", $id);
        $obj = $this->model->finder()->load($result);
        $this->model->finder()->getFromMap($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::getFromMap() did not return an object');
    }
    public function tst_addToMap()
    {
        $this->model->set($this->field, 'test_data');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $result = $this->model->finder()->doStatement("select * from $this->table where id = ?", $id);
        $obj = $this->model->finder()->load($result);
        $id = $obj->getId();
        $this->model->finder()->addToMap($obj);
        $this->model->finder()->getFromMap($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::addToMap() did not return an object');
    }
    public function tst_find()
    {
        $this->model->set($this->field, 'test_data');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::find() did not return an object');
    }
    public function tst_insert()
    {
        $this->model->set($this->field, 'test value');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $obj = $this->model->finder()->find($id);
        $val = $obj->get($this->field);
        $this->assertEquals('test value', $val, $message = 'Mapper::insert() did not return expected value');
    }
    public function tst_update()
    {
        $this->model->set($this->field, 'test value');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $obj = $this->model->finder()->find($id);
        $obj->set($this->field, 'new test value');
        $this->model->finder()->update($obj);
        $this->watcher->clearPending();
        $val = $obj->get($this->field);
        $this->assertEquals('new test value', $val, $message = 'Mapper::insert() did not return expected value');
    }
    public function tst_delete()
    {
        $this->model->set($this->field, 'test data');
        $this->model->finder()->insert($this->model);
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $this->model = $this->model->finder()->find($id);
        $this->model->finder()->delete($this->model);
        $this->watcher->clearPending();
        $result = $this->model->finder()->doStatement("select count(id) from $this->table where id = ?", array($id), SINGLETON);
        $this->assertEquals(0, $result, $message = 'Mapper::delete() did not return the expected value');
    }
    /* ../library/Local/Domain/Mappers/Customizations/Keyword/Keyword.methods */
    public function test_findByKeyword()
    {
        $this->model = new Local_Domain_Models_Keyword();
        $this->model->set('keyword', 'test_keyword');
        $this->watcher->clearPending();
        $id = $this->model->finder()->findByKeyword('test_keyword');
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::findByKeyword() did not return an object');
    }
    public function test_addKeywords()
    {
        $this->model = new Local_Domain_Models_Article();
        $this->model->set('article_title', 'test_article');
        $this->watcher->clearPending();
        $id = $this->model->getLastId();
        $this->assertGreaterThan(0, $id, $message = 'Mapper::addKeywords() (article id) did not return the expected value');
        $this->model = new Local_Domain_Models_Keyword();
        $keywords = array('test_one', 'test_two', 'test_three');
        $this->model->finder()->addKeywords($id, $keywords);
        $id = $this->model->finder()->findByKeyword('test_one');
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::addKeywords() did not return an object');
        $id = $this->model->finder()->findByKeyword('test_two');
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::addKeywords() did not return an object');
        $id = $this->model->finder()->findByKeyword('test_three');
        $obj = $this->model->finder()->find($id);
        $this->assertInternalType('object', $obj, $message = 'Mapper::addKeywords() did not return an object');
    }
    public function test_countKeyword()
    {
        $this->model = new Local_Domain_Models_Keyword();
        $result = $this->model->finder()->countKeyword();
        $this->assertEquals(get_class($result), "Zend_Db_Statement_Pdo", $message = "Mapper::countKeyword() did not return the expected value");
    }
    /* ../library/Local/Domain/Mappers/Customizations/Section/Section.methods */
    public function test_findByTitle()
    {
        $this->model = new Local_Domain_Models_Section();
        $this->model->set('section_title', 'test_section_title');
        $this->watcher->clearPending();
        $obj = $this->model->finder()->findByTitle('test_section_title');
        $this->assertInternalType('object', $obj, $message = 'Mapper::findByTitle() did not return an object');
    }
    /* ../library/Local/Domain/Mappers/Customizations/Profile/Profile.methods */
    public function test_findByUser()
    {
        /* fixture has id:11 = Kurt Miller */
        $this->model = new Local_Domain_Models_Profile();
        $obj = $this->model->finder()->findByUser(11);
        $this->assertInternalType('object', $obj, $message = 'Mapper::findByUser() did not return an object');
        $first = $obj->get('first');
        $this->assertEquals('Kurt', $first, $message = "Mapper::findByUser() did not return the expected value");
    }
    /* ../library/Local/Domain/Mappers/Customizations/Comment/Comment.methods */
    public function test_getArticleComments()
    {
        /* fixture has article id:18 */
        $this->model = new Local_Domain_Models_Comment();
        $obj = $this->model->finder()->getArticleComments(18);
        $this->assertEquals(get_class($obj), 'Local_Domain_Mappers_DeferredCommentCollection', $message = 'Mapper::getArticleComments() did not return a comment collection');
    }
    /* ../library/Local/Domain/Mappers/Customizations/User/User.methods */
    public function test_findByEmail()
    {
        /* fixture has user id:11 -> email:miller_kurt_e@yahoo.com */
        $this->model = new Local_Domain_Models_User();
        $id = $this->model->finder()->findByEmail('miller_kurt_e@yahoo.com');
        $this->assertEquals(11, $id, $message = 'Mapper::getArticleComments() did not return the expected value');
    }
    public function test_getProperName()
    {
        /* fixture has user id:11 -> Kurt Miller */
        $this->model = new Local_Domain_Models_User();
        $obj = $this->model->finder()->find(11);
        $this->assertInternalType('object', $obj, $message = 'Mapper::getProperName() did not return an object');
        $name = $this->model->finder()->getProperName($obj);
        $this->assertEquals('Kurt Miller', $name, $message = 'Mapper::getProperName() did not return the expected value');
    }
    /* ../library/Local/Domain/Mappers/Customizations/Registration/Registration.methods */
    public function test_findByReg()
    {
        /* fixture has registrations id:4 -> reg: gg50GtOy1cs3qRkYaqcV */
        $this->model = new Local_Domain_Models_Registration();
        $id = $this->model->finder()->findByReg('gg50GtOy1cs3qRkYaqcV');
        $this->assertEquals(4, $id, $message = 'Mapper::findByReg() did not return the expected value');
    }
    /* ../library/Local/Domain/Mappers/Customizations/Article/Article.methods */
    public function test_getTagArticles()
    {
        /* fixture has article tag:AAA */
        $this->model = new Local_Domain_Models_Article();
        $obj = $this->model->finder()->getTagArticles('AAA');
        $this->assertEquals(get_class($obj), 'Local_Domain_Mappers_DeferredArticleCollection', $message = 'Mapper::getArticleComments() did not return an article collection');
    }
    public function test_getAuthorArticles()
    {
        /* fixture has author id:11 */
        $this->model = new Local_Domain_Models_Article();
        $obj = $this->model->finder()->getAuthorArticles(11);
        $this->assertEquals(get_class($obj), 'Local_Domain_Mappers_DeferredArticleCollection', $message = 'Mapper::getArticleComments() did not return an article collection');
    }
    public function test_getKeywords()
    {
        /* fixture has article id:18 */
        $this->model = new Local_Domain_Models_Article();
        $obj = $this->model->finder()->find(18);
        $keywords = $this->model->finder()->getKeywords($obj);
        $this->assertInternalType('array', $keywords, $message = 'Mapper::getKeywords() did not return an object');
    }
    public function test_getCommentCount()
    {
        /* fixture has article id:18 -> 1 comment */
        $this->model = new Local_Domain_Models_Article();
        $obj = $this->model->finder()->find(18);
        $cnt = $this->model->finder()->getCommentCount($obj);
        $this->assertEquals(1, $cnt, $message = 'Mapper::getCommentCount() did not return the expected value');
    }
    public function test_getTotalArticlesWithComments()
    {
        /* fixture has 4 articles with comments */
        $this->model = new Local_Domain_Models_Article();
        $cnt = $this->model->finder()->getTotalArticlesWithComments();
        $this->assertEquals(4, $cnt, $message = 'Mapper::getTotalArticleWithComments() did not return the expected value');
    }
    /* End Actual Tests */
}
if (PHPUnit_MAIN_METHOD == 'LocalDomainMapperTest::main') {
    LocalDomainMapperTest::main();
}
