<?php
class Local_Api_Blogger
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
            $this->_user = $user;
            return true;
        } else {
            throw new Local_Api_Exception('Authorization failed', 401);
            return false;
        }
    }
    /**
     * This is the Blogger function test
     *
     * @return boolean
     */
    public function test()
    {
        return true;
    }
    /**
     * This is the Blogger function getUsersBlogs
     *
     * @param string $appkey
     * @param string $username
     * @param string $password
     * @return array of struct
     */
    public function getUsersBlogs($appkey, $username, $password)
    {
        $blogInfo = array();
        if (!$this->login($username, $password)) {
            return $blogInfo;
        }
        $bi = array('blogid' => 'YMOZ', 'xmlrpc' => 'http://ymozend.com/xmlrpc', 'url' => 'http://ymozend.com', 'blogName' => 'Your Moment of Zend');
        $blogInfo[] = $bi;
        return $blogInfo;
    }
    /**
     * This is the Blogger function getUserInfo
     *
     * @param string $appkey
     * @param string $username
     * @param string $password
     * @return struct
     */
    public function getUserInfo($appkey, $username, $password)
    {
        $userInfo = array();
        if (!$this->login($username, $password)) {
            return $userInfo;
        }
        $firstname = '';
        $lastname = '';
        $pm = new Local_Domain_Mappers_ProfileMapper();
        $p = $pm->findByUser($this->_user->id);
        if ($p !== null) {
            $firstname = $p->get('first');
            $lastname = $p->get('last');
        }
        $userInfo = array('userid' => $this->_user->id, 'firstname' => $firstname, 'lastname' => $lastname, 'nickname' => $this->_user->username, 'email' => $this->_user->email, 'url' => 'http://ymozend.com/profile/' . $this->_user->id);
        return $userInfo;
    }
    /**
     * This is the Blogger function deletePost
     *
     * @param string $appkey
     * @param string $postid
     * @param string $username
     * @param string $password
     * @param boolean $publish
     * @return boolean
     */
    public function deletePost($appkey, $postid, $username, $password, $publish)
    {
        if (!$this->login($username, $password)) {
            return false;
        }
        $am = new Local_Domain_Mappers_ArticleMapper();
        $options['field'] = 'id';
        $options['value'] = $postid;
        if ($am->exists($options)) {
            $article = $am->find($postid);
            $article->finder()->delete($article);
        }
        return true;
    }
}
