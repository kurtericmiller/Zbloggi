<?php
/**
 * Comment Mapper object definition
 * @package Mapper
 */
/**
 * CommentMapper class
 * Maps Comment objects to database
 */
class Local_Domain_Mappers_CommentMapper extends Local_Domain_Mapper implements CommentFinder
{
    /** Instantiate - prepares object specific sql statements*/
    function __construct()
    {
        parent::__construct(); //locates DB handle
        //Prepare sql statements specific to this object
        $this->selectStmt = 'SELECT * FROM comments WHERE id = ?';
        $this->selectAllStmt = 'SELECT * FROM comments';
        $this->updateStmt = 'UPDATE comments SET user_id=?,article_id=?,comment_text=?,created_at=?,updated_at=? WHERE id=?';
        $this->insertStmt = 'INSERT into comments (user_id,article_id,comment_text,created_at,updated_at) values (?,?,?,?,?)';
        $this->deleteStmt = 'DELETE FROM comments WHERE id = ?';
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
        $obj = new Local_Domain_Models_Comment($array['id']);
        $obj->set('id', ($array['id']));
        $obj->set('user_id', ($array['user_id']));
        $obj->set('article_id', ($array['article_id']));
        $obj->set('comment_text', ($array['comment_text']));
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
        $values = array($obj->get('user_id'), $obj->get('article_id'), $obj->get('comment_text'), $obj->get('created_at'), $obj->get('updated_at'));
        return $this->doStatement($this->insertStmt, $values);
    }
    /** Update existing object
     *  @param object DomainObject
     *  @return boolean
     */
    function doUpdate(Local_Domain_DomainObject $obj)
    {
        $values = array($obj->get('user_id'), $obj->get('article_id'), $obj->get('comment_text'), $obj->get('created_at'), $obj->get('updated_at'), $obj->getId());
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
        return new Local_Domain_Mappers_DeferredCommentCollection($this, $sql, array());
    }
    /** return boolean result for query
     *  @param array $options
     *  @return boolean
     */
    function exists(array $options)
    {
        $sql = 'select count(*) from comments' . ' where ' . $options['field'] . ' = ' . $options['value'];
        $result = $this->doStatement($sql, array(), SINGLETON);
        return ($result == 0) ? false : true;
    }
    /**  Return class identifier */
    protected function targetClass()
    {
        return "Comment";
    }
    //===============================
    // Begin Customizations
    //===============================
    
    /** Return comments associated with article */
    function getArticleComments($article_id)
    {
        $select = "select * from comments where article_id = ?";
        return new Local_Domain_Mappers_DeferredCommentCollection($this, $select, array($article_id));
    }
}
