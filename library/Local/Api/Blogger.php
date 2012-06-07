<?php
class Local_Api_Blogger extends Local_Api_XmlRpc
{
    protected $_user;
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
        $localReg = Zend_Registry::get('local');
        $bi = array(
            'blogid' => 'ZBL',
            'xmlrpc' => $localReg->get('site_url') . '/xmlrpc',
            'url' => $localReg->get('site_url'),
            'blogName' => $localReg->get('site_title'));
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
        $localReg = Zend_Registry::get('local');
        $userInfo = array(
            'userid' => $this->_user->id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $this->_user->username,
            'email' => $this->_user->email,
            'url' => $localReg->get('site_url') . '/profile/' . $this->_user->id);
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
