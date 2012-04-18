<?php
/**
* Setting Mapper object definition
* @package Mapper
*/
/**
* SettingMapper class
* Maps Setting objects to database
*/
class Local_Domain_Mappers_SettingMapper extends Local_Domain_Mapper implements SettingFinder  {
    /** Instantiate - prepares object specific sql statements*/
    function __construct() {
        parent::__construct(); //locates DB handle
        //Prepare sql statements specific to this object
        $this->selectStmt = 'SELECT * FROM settings WHERE id = ?';
        $this->selectAllStmt = 'SELECT * FROM settings';
        $this->updateStmt = 'UPDATE settings SET site_title=?,site_tagline=?,site_url=?,headlineId=?,homeArticleCount=?,articleCount=?,bookCount=?,latestArticleCount=?,amazonLU=?,admArtCnt=?,admComCnt=?,admUserCnt=?,defemail=?,created_at=?,updated_at=? WHERE id=?';
        $this->insertStmt = 'INSERT into settings (site_title,site_tagline,site_url,headlineId,homeArticleCount,articleCount,bookCount,latestArticleCount,amazonLU,admArtCnt,admComCnt,admUserCnt,defemail,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $this->deleteStmt = 'DELETE FROM settings WHERE id = ?';
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
        $obj = new Local_Domain_Models_Setting($array['id']);
        $obj->set('id',($array['id']));
        $obj->set('site_title',($array['site_title']));
        $obj->set('site_tagline',($array['site_tagline']));
        $obj->set('site_url',($array['site_url']));
        $obj->set('headlineId',($array['headlineId']));
        $obj->set('homeArticleCount',($array['homeArticleCount']));
        $obj->set('articleCount',($array['articleCount']));
        $obj->set('bookCount',($array['bookCount']));
        $obj->set('latestArticleCount',($array['latestArticleCount']));
        $obj->set('amazonLU',($array['amazonLU']));
        $obj->set('admArtCnt',($array['admArtCnt']));
        $obj->set('admComCnt',($array['admComCnt']));
        $obj->set('admUserCnt',($array['admUserCnt']));
        $obj->set('defemail',($array['defemail']));
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
            $obj->get('site_title'),
            $obj->get('site_tagline'),
            $obj->get('site_url'),
            $obj->get('headlineId'),
            $obj->get('homeArticleCount'),
            $obj->get('articleCount'),
            $obj->get('bookCount'),
            $obj->get('latestArticleCount'),
            $obj->get('amazonLU'),
            $obj->get('admArtCnt'),
            $obj->get('admComCnt'),
            $obj->get('admUserCnt'),
            $obj->get('defemail'),
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
           $obj->get('site_title'),
           $obj->get('site_tagline'),
           $obj->get('site_url'),
           $obj->get('headlineId'),
           $obj->get('homeArticleCount'),
           $obj->get('articleCount'),
           $obj->get('bookCount'),
           $obj->get('latestArticleCount'),
           $obj->get('amazonLU'),
           $obj->get('admArtCnt'),
           $obj->get('admComCnt'),
           $obj->get('admUserCnt'),
           $obj->get('defemail'),
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
      return new Local_Domain_Mappers_DeferredSettingCollection($this, $sql, array());
    }

    /** return boolean result for query
    *  @param array $options
    *  @return boolean */
    function exists(array $options) {
      $sql = 'select count(*) from settings' . ' where ' . $options['field'] . ' = ' . $options['value'];
      $result =  $this->doStatement($sql, array(), SINGLETON);
      return ($result == 0) ? false : true;
    }

    /**  Return class identifier */
    protected function targetClass() {
        return "Setting";
    }
    //===============================
    // Begin Customizations
    //===============================
    public function getMaxId()
    {
        $sql = 'select MAX(id) from settings';
        $result = $this->doStatement($sql, array(), SINGLETON);
        return $result;
    }
}
