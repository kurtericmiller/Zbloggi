<?php
/**
 * Avatar Mapper object definition
 * @package Mapper
 */
/**
 * AvatarMapper class
 * Maps Avatar objects to database
 */
class Local_Domain_Mappers_AvatarMapper extends Local_Domain_Mapper implements AvatarFinder
{
    /** Instantiate - prepares object specific sql statements*/
    function __construct()
    {
        parent::__construct(); //locates DB handle
        //Prepare sql statements specific to this object
        $this->selectStmt = 'SELECT * FROM avatars WHERE id = ?';
        $this->selectAllStmt = 'SELECT * FROM avatars';
        $this->updateStmt = 'UPDATE avatars SET image_name=?,created_at=?,updated_at=? WHERE id=?';
        $this->insertStmt = 'INSERT into avatars (image_name,created_at,updated_at) values (?,?,?)';
        $this->deleteStmt = 'DELETE FROM avatars WHERE id = ?';
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
        $obj = new Local_Domain_Models_Avatar($array['id']);
        $obj->set('id', ($array['id']));
        $obj->set('image_name', ($array['image_name']));
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
        $values = array($obj->get('image_name'), $obj->get('created_at'), $obj->get('updated_at'));
        return $this->doStatement($this->insertStmt, $values);
    }
    /** Update existing object
     *  @param object DomainObject
     *  @return boolean
     */
    function doUpdate(Local_Domain_DomainObject $obj)
    {
        $values = array($obj->get('image_name'), $obj->get('created_at'), $obj->get('updated_at'), $obj->getId());
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
        return new Local_Domain_Mappers_DeferredAvatarCollection($this, $sql, array());
    }
    /** return boolean result for query
     *  @param array $options
     *  @return boolean
     */
    function exists(array $options)
    {
        $sql = 'select count(*) from avatars' . ' where ' . $options['field'] . ' = ' . $options['value'];
        $result = $this->doStatement($sql, array(), SINGLETON);
        return ($result == 0) ? false : true;
    }
    /**  Return class identifier */
    protected function targetClass()
    {
        return "Avatar";
    }
    //===============================
    // Begin Customizations
    //===============================
    
}
