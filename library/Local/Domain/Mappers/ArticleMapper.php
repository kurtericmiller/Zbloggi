<?php
/**
* Article Mapper object definition
* @package Mapper
*/
/**
* ArticleMapper class
* Maps Article objects to database
*/
class Local_Domain_Mappers_ArticleMapper extends Local_Domain_Mapper implements ArticleFinder  {
    /** Instantiate - prepares object specific sql statements*/
    function __construct() {
        parent::__construct(); //locates DB handle
        //Prepare sql statements specific to this object
        $this->selectStmt = 'SELECT * FROM articles WHERE id = ?';
        $this->selectAllStmt = 'SELECT * FROM articles';
        $this->updateStmt = 'UPDATE articles SET user_id=?,published=?,read_count=?,article_title=?,article_text=?,created_at=?,updated_at=? WHERE id=?';
        $this->insertStmt = 'INSERT into articles (user_id,published,read_count,article_title,article_text,created_at,updated_at) values (?,?,?,?,?,?,?)';
        $this->deleteStmt = 'DELETE FROM articles WHERE id = ?';
    }

    /** Locate stored object by primary key
     *  @param integer $id
     *  @return mixed DomainObject or null */
    function doFind($id) {
        $result = $this->doStatement($this->selectStmt,$id);
        return $this->load($result);
    }

    /** Set object properties with retrieved values
     *  @param array $array of properties
     *  @return object DomainObject */
    protected function doLoad($array) {
        $obj = new Local_Domain_Models_Article($array['id']);
        $obj->set('id',($array['id']));
        $obj->set('user_id',($array['user_id']));
        $obj->set('published',($array['published']));
        $obj->set('read_count',($array['read_count']));
        $obj->set('article_title',($array['article_title']));
        $obj->set('article_text',($array['article_text']));
        $obj->set('created_at',($array['created_at']));
        $obj->set('updated_at',($array['updated_at']));
        $obj->markClean();
        return $obj;
    }

    /** Store new object
     *  @param object DomainObject
     *  @return boolean */
    protected function doInsert(Local_Domain_DomainObject $obj) {
        $values = array (
            $obj->get('user_id'),
            $obj->get('published'),
            $obj->get('read_count'),
            $obj->get('article_title'),
            $obj->get('article_text'),
            $obj->get('created_at'),
            $obj->get('updated_at')
        );
        return $this->doStatement($this->insertStmt, $values);
    }

    /** Update existing object
     *  @param object DomainObject
     *  @return boolean */
    function doUpdate(Local_Domain_DomainObject $obj) {
        $values = array (
           $obj->get('user_id'),
           $obj->get('published'),
           $obj->get('read_count'),
           $obj->get('article_title'),
           $obj->get('article_text'),
           $obj->get('created_at'),
           $obj->get('updated_at'),
           $obj->getId()
        );
        return $this->doStatement($this->updateStmt, $values);
    }

    /** Delete existing object
     *  @param object DomainObject
     *  @return boolean */
    function doDelete(Local_Domain_DomainObject $obj) {
        return $this->doStatement($this->deleteStmt,array($obj->getId()));
    }

    /** Retrieve all objects - limited - with options for where and sort
    *  @return mixed Collection object */
    function findAll($options=null) {
      $where = (isset($options['where'])) ? ' where ' . $options['where'] : null;
      $sort = (isset($options['sort'])) ? ' order by ' . $options['sort'] : null;
      $limit = (isset($options['offset']) && isset($options['count'])) ? ' limit ' . $options['offset'] . ',' . $options['count'] : null;
      $sql = $this->selectAllStmt . $where . $sort . $limit;
      return new Local_Domain_Mappers_DeferredArticleCollection($this, $sql, array());
    }

    /** return boolean result for query
    *  @param array $options
    *  @return boolean */
    function exists(array $options) {
      $sql = 'select count(*) from articles' . ' where ' . $options['field'] . ' = ' . $options['value'];
      $result =  $this->doStatement($sql, array(), SINGLETON);
      return ($result == 0) ? false : true;
    }

    /**  Return class identifier */
    protected function targetClass() {
        return "Article";
    }
    //===============================
    // Begin Customizations
    //===============================
    
    /** Return list of articles associated with this tag */
    function getTagArticles($tag, $options = null)
    {
        $limit = (isset($options['offset']) && isset($options['count'])) ? ' limit ' . $options['offset'] . ',' . $options['count'] : null;
        $sql = 'select c.* from keywords a, tag_join b, articles c where a.keyword = ? and a.id = b.keyword_id and b.article_id = c.id order by c.created_at desc' . $limit;
        return new Local_Domain_Mappers_DeferredArticleCollection($this, $sql, array($tag));
    }
    /** Return list of articles associated with this author */
    function getAuthorArticles($author_id)
    {
        $sql = 'select * from articles where user_id = ? order by created_at desc';
        return new Local_Domain_Mappers_DeferredArticleCollection($this, $sql, array($author_id));
    }
    /** Return keywords for this article */
    function getKeywords(Local_Domain_DomainObject $obj)
    {
        $sql = 'select a.keyword as keyword from keywords a, tag_join b where b.article_id = ? and b.keyword_id = a.id';
        $result = $this->doStatement($sql, array($obj->getId()));
        $keywords = $result->fetchAll();
        $values = array();
        foreach ($keywords as $keyword) {
            $tag = $keyword['keyword'];
            array_push($values, $tag);
        }
        return $values;
    }
    /** Return the count of comments for this article */
    function getCommentCount(Local_Domain_DomainObject $obj)
    {
        return $this->doStatement('select count(*) from comments where article_id = ?', array($obj->getId()), SINGLETON);
    }
    /** Return the id of the latest published article */
    function getLatestArticleId()
    {
        return $this->doStatement('select max(id) from articles where published = 1', array(), SINGLETON);
    }
    /** Return the count of comments for all articles */
    function getTotalArticlesWithComments()
    {
        return $this->doStatement('select count(*) as "" from articles a where published = 1 and (select count(*) from comments where article_id = a.id) > 0', array(), SINGLETON);
    }
    function scrubKeywords(Local_Domain_DomainObject $obj)
    {
        $id = $obj->getId();
        /* handle article */
        $sql = "delete from tag_join where article_id = ?";
        $this->doStatement($sql, array($id));
        /* handle orphans */
        $sql = "delete from keywords where id not in (select keyword_id from tag_join)";
        $this->doStatement($sql, array());
    }
}
