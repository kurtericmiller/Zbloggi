<?php
/**
 * Profile Mapper object definition
 * @package Mapper
 */
/**
 * ProfileMapper class
 * Maps Profile objects to database
 */
class Local_Domain_Mappers_ProfileMapper extends Local_Domain_Mapper implements ProfileFinder
{
  /** Instantiate - prepares object specific sql statements*/
  function __construct()
  {
    parent::__construct(); //locates DB handle
    //Prepare sql statements specific to this object
    $this->selectStmt = 'SELECT * FROM profiles WHERE id = ?';
    $this->selectAllStmt = 'SELECT * FROM profiles';
    $this->updateStmt = 'UPDATE profiles SET user_id=?,first=?,last=?,middle=?,occupation=?,website=?,bio_text=?,avatar=?,created_at=?,updated_at=? WHERE id=?';
    $this->insertStmt = 'INSERT into profiles (user_id,first,last,middle,occupation,website,bio_text,avatar,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?)';
    $this->deleteStmt = 'DELETE FROM profiles WHERE id = ?';
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
    $obj = new Local_Domain_Models_Profile($array['id']);
    $obj->set('id', ($array['id']));
    $obj->set('user_id', ($array['user_id']));
    $obj->set('first', ($array['first']));
    $obj->set('last', ($array['last']));
    $obj->set('middle', ($array['middle']));
    $obj->set('occupation', ($array['occupation']));
    $obj->set('website', ($array['website']));
    $obj->set('bio_text', ($array['bio_text']));
    $obj->set('avatar', ($array['avatar']));
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
    $values = array($obj->get('user_id'), $obj->get('first'), $obj->get('last'), $obj->get('middle'), $obj->get('occupation'), $obj->get('website'), $obj->get('bio_text'), $obj->get('avatar'), $obj->get('created_at'), $obj->get('updated_at'));
    return $this->doStatement($this->insertStmt, $values);
  }
  /** Update existing object
   *  @param object DomainObject
   *  @return boolean
   */
  function doUpdate(Local_Domain_DomainObject $obj)
  {
    $values = array($obj->get('user_id'), $obj->get('first'), $obj->get('last'), $obj->get('middle'), $obj->get('occupation'), $obj->get('website'), $obj->get('bio_text'), $obj->get('avatar'), $obj->get('created_at'), $obj->get('updated_at'), $obj->getId());
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
    return new Local_Domain_Mappers_DeferredProfileCollection($this, $sql, array());
  }
  /** return boolean result for query
   *  @param array $options
   *  @return boolean
   */
  function exists(array $options)
  {
    $sql = 'select count(*) from profiles' . ' where ' . $options['field'] . ' = ' . $options['value'];
    $result = $this->doStatement($sql, array(), SINGLETON);
    return ($result == 0) ? false : true;
  }
  /**  Return class identifier */
  protected function targetClass()
  {
    return "Profile";
  }
  //===============================
  // Begin Customizations
  //===============================
  function findByUser($id)
  {
    $options['field'] = 'user_id';
    $options['value'] = $id;
    if ($this->exists($options)) {
      $profile = $this->doStatement('select id from profiles WHERE user_id = ?', array($id), SINGLETON);
      if (isset($profile)) {
        $result = $this->doStatement($this->selectStmt, $profile);
        return $this->load($result);
      }
    }
    return null;
  }
}
