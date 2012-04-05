<?php
class Local_Api_Wp
{
    protected $_user;
    /**
     * This is the function login
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    private function login($username, $password)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $adapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $opts = Zend_Registry::getInstance();
        $salt = $opts['config']['salt'];
        $adapter->setTableName('users')->setIdentityColumn('email')->setCredentialColumn('password')->setCredentialTreatment("SHA1(CONCAT(?,'" . $salt . "'))");
        $adapter->setIdentity($username);
        $adapter->setCredential($password);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $_user = $user;
            return true;
        } else {
            throw new Local_Api_Exception('Authorization failed', 401);
            return false;
        }
    }
    /**
     * This is the metaWeblog function test
     *
     * @return boolean
     */
    public function test()
    {
        return true;
    }
    /**
     * This is the metaWeblog function getCategories
     *
     * @param string $blogid
     * @param string $username
     * @param string $password
     * @return array of struct
     */
    public function getTags($blogid, $username, $password)
    {
        $tags = array();
        if (!$this->login($username, $password)) {
            return $tags;
        }
        $km = new Local_Domain_Mappers_KeywordMapper();
        $kc = $km->findAll();
        $kw = $km->countKeyword();
        foreach ($kw as $k) {
            $keyword = $k['keyword'];
            $count = $k['rank'];
            $id = $km->findByKeyword($keyword);
            $tag = array('tag_id' => new Zend_XmlRpc_Value_Integer($$id), 'name' => $keyword, 'slug' => $keyword, 'html_url' => 'http://ymozend.com/blog/tag?tag=' . $keyword, 'rss_url' => '', 'count' => new Zend_XmlRpc_Value_Integer($count));
            $tags[] = $tag;
        }
        return $tags;
    }
}
