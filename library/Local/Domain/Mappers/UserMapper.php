<?php
/**
* User Mapper object definition
* @package Mapper
*/
/**
* UserMapper class
* Maps User objects to database
*/
class Local_Domain_Mappers_UserMapper extends Local_Domain_Mapper implements UserFinder  {
    /** Instantiate - prepares object specific sql statements*/
    function __construct() {
        parent::__construct(); //locates DB handle
        //Prepare sql statements specific to this object
        $this->selectStmt = 'SELECT * FROM users WHERE id = ?';
        $this->selectAllStmt = 'SELECT * FROM users';
        $this->updateStmt = 'UPDATE users SET username=?,email=?,role=?,password=?,created_at=?,updated_at=? WHERE id=?';
        $this->insertStmt = 'INSERT into users (username,email,role,password,created_at,updated_at) values (?,?,?,?,?,?)';
        $this->deleteStmt = 'DELETE FROM users WHERE id = ?';
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
        $obj = new Local_Domain_Models_User($array['id']);
        $obj->set('id',($array['id']));
        $obj->set('username',($array['username']));
        $obj->set('email',($array['email']));
        $obj->set('role',($array['role']));
        $obj->set('password',($array['password']));
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
            $obj->get('username'),
            $obj->get('email'),
            $obj->get('role'),
            $obj->get('password'),
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
           $obj->get('username'),
           $obj->get('email'),
           $obj->get('role'),
           $obj->get('password'),
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
      return new Local_Domain_Mappers_DeferredUserCollection($this, $sql, array());
    }

    /** return boolean result for query
    *  @param array $options
    *  @return boolean */
    function exists(array $options) {
      $sql = 'select count(*) from users' . ' where ' . $options['field'] . ' = ' . $options['value'];
      $result =  $this->doStatement($sql, array(), SINGLETON);
      return ($result == 0) ? false : true;
    }

    /**  Return class identifier */
    protected function targetClass() {
        return "User";
    }
    //===============================
    // Begin Customizations
    //===============================
    
    /** Return user id for this email address */
    function findByEmail($email)
    {
        return $this->doStatement('select id from users WHERE email = ?', array($email), SINGLETON);
    }
    /** Return user proper name for this user */
    function getProperName(Local_Domain_DomainObject $user)
    {
        $id = $user->getId();
        $result = $this->doStatement('select CONCAT(first," ",last) from profiles WHERE user_id = ?', array($id), SINGLETON);
        return (strlen($result) > 0) ? $result : 'anonymous user';
    }
}
