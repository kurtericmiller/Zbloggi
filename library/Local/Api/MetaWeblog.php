<?php
class Local_Api_MetaWeblog
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
   * This is the metaWeblog function test
   *
   * @return boolean
   */
  public function test()
  {
    return true;
  }
  /**
   * This is the metaWeblog function testLogin
   *
   * @param string $username
   * @param string $password
   * @return string
   */
  public function testLogin($username, $password)
  {
    if (!$this->login($username, $password)) {
      return 'Failure: name = ' . $username . ', password = ' . $password . ', result = ' . $result . ', id = ' . $this->_user->id . ', role = ' . $this->_user->role;
    } else {
      return 'Success: name = ' . $username . ', password = ' . $password . ', result = ' . $result . ', id = ' . $this->_user->id . ', role = ' . $this->_user->role;
    }
  }
  /**
   * This is the metaWeblog function getRecentPosts
   *
   * @param string $blogid
   * @param string $username
   * @param string $password
   * @param integer $numberOfPosts
   * @return array of struct Post
   */
  public function getRecentPosts($blogid, $username, $password, $numberOfPosts)
  {
    $posts = array();
    if (!$this->login($username, $password)) {
      return $posts;
    }
    switch ($this->_user->role) {
    case ("author"):
      $where = "user_id = " . $this->_user->id;
      break;

    case ("admin"):
      $where = "id > 0";
      break;

    default:
      throw new Local_Api_Exception('Bad permissions for request', 401);
      return $posts;
    }
    $am = new Local_Domain_Mappers_ArticleMapper();
    $options['where'] = $where;
    $options['sort'] = 'created_at desc';
    $options['offset'] = '0';
    $options['count'] = $numberOfPosts;
    $ac = $am->findAll($options);
    foreach ($ac as $a) {
      $ct = strtotime($a->get('created_at'));
      $xdt = new Zend_XmlRpc_Value_DateTime($ct);
      $post = array('dateCreated' => $xdt, 'title' => $a->get('article_title'), 'description' => $a->get('article_text'), 'categories' => $am->getKeywords($a), 'userid' => $a->get('user_id'), 'postid' => $a->get('id'));
      $result[] = $post;
    }
    return $result;
  }
  /**
   * This is the metaWeblog function getPost
   *
   * @param string $postid
   * @param string $username
   * @param string $password
   * @return struct Post
   */
  public function getPost($postid, $username, $password)
  {
    $post = array();
    if (!$this->login($username, $password)) {
      return $post;
    }
    switch ($this->_user->role) {
    case ("author"):
      $where = "user_id = " . $this->_user->id . " and id = " . $postid;
      break;

    case ("admin"):
      $where = "id = " . $postid;
      break;

    default:
      throw new Local_Api_Exception('Bad permissions for request', 401);
      return $post;
    }
    $am = new Local_Domain_Mappers_ArticleMapper();
    $ac = $am->findAll($options);
    // if record available
    // set entry elements
    foreach ($ac as $a) {
      $ct = strtotime($a->get('created_at'));
      $xdt = new Zend_XmlRpc_Value_DateTime($ct);
      $post = array('dateCreated' => $xdt, 'title' => $a->get('article_title'), 'description' => $a->get('article_text'), 'categories' => $am->getKeywords($a), 'userid' => $a->get('user_id'), 'postid' => $a->get('id'));
    }
    $result['struct'][] = $post;
    return $result;
  }
  /**
   * This is the metaWeblog function newPost
   *
   * @param string $blogid
   * @param string $username
   * @param string $password
   * @param struct $content
   * @param boolean $publish
   * @return string postId
   */
  public function newPost($blogid, $username, $password, $content, $publish)
  {
    $article_id = '';
    if (!$this->login($username, $password)) {
      return $article_id;
    }
    switch ($this->_user->role) {
    case ("author"):
      $pub = 0;
      break;

    case ("admin"):
      $pub = $publish;
      break;

    default:
      throw new Local_Api_Exception('Bad permissions for request', 401);
      return $article_id;
    }
    $article = new Local_Domain_Models_Article();
    $article->set('article_title', $content['title']);
    $article->set('article_text', $content['description']);
    $article->set('user_id', $this->_user->id);
    $article->set('published', $pub);
    $article->finder()->insert($article);
    $article_id = $article->getLastId();
    $keywords = '';
    while (count($content['categories']) > 0) {
      $word = array_pop($content['categories']);
      $keywords = $word . ' ' . $keywords;
    }
    $km = new Local_Domain_Mappers_KeywordMapper();
    $km->addKeywords($article_id, explode(' ', $keywords));
    return $article_id;
  }
  /**
   * This is the metaWeblog function editPost
   *
   * @param string $postid
   * @param string $username
   * @param string $password
   * @param struct $content
   * @param boolean $publish
   * @return boolean
   */
  public function editPost($postid, $username, $password, $content, $publish)
  {
    $result = true;
    if (!$this->login($username, $password)) {
      return $result;
    }
    if ($this->_user->role === "author" && $this->_user->id != $content['userid']) {
      throw new Local_Api_Exception('Bad permissions for request', 401);
      return $result;
    }
    switch ($this->_user->role) {
    case ("author"):
    case ("admin"):
      $pub = $publish;
      break;

    default:
      throw new Local_Api_Exception('Bad permissions for request', 401);
      return $result;
    }
    $am = new Local_Domain_Mappers_ArticleMapper();
    $article = $am->find($postid);
    $article->set('article_title', $content['title']);
    $article->set('article_text', $content['description']);
    $article->set('user_id', $content['userid']);
    $article->set('published', $pub);
    $article->finder()->update($article);
    $km = new Local_Domain_Mappers_KeywordMapper();
    $km->addKeywords($article->getId(), explode(' ', $content['categories']));
    return $result;
  }
  /**
   * This is the metaWeblog function getCategories
   *
   * @param string $blogid
   * @param string $username
   * @param string $password
   * @return array of struct
   */
  public function getCategories($blogid, $username, $password)
  {
    $categories = array();
    if (!$this->login($username, $password)) {
      return $categories;
    }
    $km = new Local_Domain_Mappers_KeywordMapper();
    $kc = $km->findAll();
    foreach ($kc as $k) {
      $category = array('title' => $k->get('keyword'), 'description' => $k->get('keyword'), 'htmlUrl' => 'http://ymozend.com/blog/tag?tag=' . $k->get('keyword'), 'rssUrl' => '', 'categoryName' => $k->get('keyword'), 'categoryId' => $k->get('id'));
      $categories[] = $category;
    }
    return $categories;
  }
  /**
   * This is the metaWeblog function newMediaObject
   *
   * @param string $blogid
   * @param string $username
   * @param string $password
   * @param struct $mObj
   * @return struct
   */
  public function newMediaObject($blogid, $username, $password, $mo)
  {
    if (!$this->login($username, $password)) {
      return $mediaObjectInfo = array('url' => 'blank');
    }
    $good_types = array('image/jpeg', 'image/gif', 'image/png');
    $upload_dest = $_SERVER['DOCUMENT_ROOT'] . '/images/uploads';
    $file_name = $mo['name'];
    $file_type = $mo['type'];
    $file_content = $mo['bits'];
    $upload_file = $upload_dest . '/' . $file_name;
    while (file_exists($upload_file)) {
      $file_name = substr(sha1(rand()), 0, 5) . $file_name;
      $upload_file = $upload_dest . '/' . $file_name;
    }
    if (in_array($file_type, $good_types)) {
      $handle = fopen($upload_file, 'wb');
      stream_filter_append($fp, 'convert.base64-decode');
      fwrite($handle, $file_content);
      fclose($handle);
      $mediaObjectInfo = array('url' => 'http://' . $_SERVER['SERVER_NAME'] . '/images/uploads/' . $file_name);
    } else {
      throw new Local_Api_Exception('Bad file type, jpeg/gif/png only', 415);
      return $mediaObjectInfo = array('url' => 'problem_writing');
    }
    return $mediaObjectInfo;
  }
}
