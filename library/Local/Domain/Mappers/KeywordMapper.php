<?php
/**
 * Keyword Mapper object definition
 * @package Mapper
 */
/**
 * KeywordMapper class
 * Maps Keyword objects to database
 */
class Local_Domain_Mappers_KeywordMapper extends Local_Domain_Mapper implements KeywordFinder
{
  /** Instantiate - prepares object specific sql statements*/
  function __construct()
  {
    parent::__construct(); //locates DB handle
    //Prepare sql statements specific to this object
    $this->selectStmt = 'SELECT * FROM keywords WHERE id = ?';
    $this->selectAllStmt = 'SELECT * FROM keywords';
    $this->updateStmt = 'UPDATE keywords SET keyword=?,created_at=?,updated_at=? WHERE id=?';
    $this->insertStmt = 'INSERT into keywords (keyword,created_at,updated_at) values (?,?,?)';
    $this->deleteStmt = 'DELETE FROM keywords WHERE id = ?';
  }
  /** Locate stored object by primary key
   *  @param integer $id
   *  @return mixed DomainObject or null
   */
  function doFind($id)
  {
    $result = $this->doStatement($this->selectStmt, $id);
    return $this->load($result);
  }
  /** Set object properties with retrieved values
   *  @param array $array of properties
   *  @return object DomainObject
   */
  protected function doLoad($array)
  {
    $obj = new Local_Domain_Models_Keyword($array['id']);
    $obj->set('id', ($array['id']));
    $obj->set('keyword', ($array['keyword']));
    $obj->set('created_at', ($array['created_at']));
    $obj->set('updated_at', ($array['updated_at']));
    $obj->markClean();
    return $obj;
  }
  /** Store new object
   *  @param object DomainObject
   *  @return boolean
   */
  protected function doInsert(Local_Domain_DomainObject $obj)
  {
    $values = array($obj->get('keyword'), $obj->get('created_at'), $obj->get('updated_at'));
    return $this->doStatement($this->insertStmt, $values);
  }
  /** Update existing object
   *  @param object DomainObject
   *  @return boolean
   */
  function doUpdate(Local_Domain_DomainObject $obj)
  {
    $values = array($obj->get('keyword'), $obj->get('created_at'), $obj->get('updated_at'), $obj->getId());
    return $this->doStatement($this->updateStmt, $values);
  }
  /** Delete existing object
   *  @param object DomainObject
   *  @return boolean
   */
  function doDelete(Local_Domain_DomainObject $obj)
  {
    return $this->doStatement($this->deleteStmt, array($obj->getId()));
  }
  /** Retrieve all objects - limited - with options for where and sort
   *  @return mixed Collection object
   */
  function findAll($options = null)
  {
    $where = (isset($options['where'])) ? ' where ' . $options['where'] : null;
    $sort = (isset($options['sort'])) ? ' order by ' . $options['sort'] : null;
    $limit = (isset($options['offset']) && isset($options['count'])) ? ' limit ' . $options['offset'] . ',' . $options['count'] : null;
    $sql = $this->selectAllStmt . $where . $sort . $limit;
    return new Local_Domain_Mappers_DeferredKeywordCollection($this, $sql, array());
  }
  /** return boolean result for query
   *  @param array $options
   *  @return boolean
   */
  function exists(array $options)
  {
    $sql = 'select count(*) from keywords' . ' where ' . $options['field'] . ' = ' . $options['value'];
    $result = $this->doStatement($sql, array(), SINGLETON);
    return ($result == 0) ? false : true;
  }
  /**  Return class identifier */
  protected function targetClass()
  {
    return "Keyword";
  }
  //===============================
  // Begin Customizations
  //===============================
  function findByKeyword($keyword)
  {
    $sql = "select id from keywords where keyword = ?";
    return $this->doStatement($sql, array($keyword), SINGLETON);
  }
  function addKeywords($article_id, array $keywords)
  {
    $sql = "delete from tag_join where article_id = ?";
    $this->doStatement($sql, array($article_id));
    $keyword_ids = array();
    foreach ($keywords as $keyword) {
      if (empty($keyword)) {
        continue;
      }
      $k = new Local_Domain_Models_Keyword();
      $k->set('keyword', $keyword);
      try {
        $k->finder()->insert($k);
      }
      catch(Exception $e) { /*ignore duplicate key exceptions*/
      }
      $keyword_ids[$keyword] = $this->findByKeyword($keyword);
    }
    foreach ($keywords as $keyword) {
      if (empty($keyword)) {
        continue;
      }
      $sql = "insert ignore into tag_join (article_id,keyword_id) values (?,?)";
      $values = array($article_id, $keyword_ids[$keyword]);
      $this->doStatement($sql, $values);
    }
    //Clear any unused keywords
    $sql = "delete from keywords where id not in (select keyword_id from tag_join)";
    $this->doStatement($sql, array());
  }
  function countKeyword()
  {
    $sql = "select count(keyword_id) as rank from tag_join where keyword_id = ? group by keyword_id";
    $sql = "select k.keyword, count(j.keyword_id) as rank from keywords k, tag_join j where k.id = j.keyword_id group by k.keyword";
    return $this->doStatement($sql, array());
  }
}
