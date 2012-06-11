<?php
class Xmlrpc_ClientController extends Zend_Controller_Action
{
  private $_form;
  private $_result;
  private $_env;
  private $_login;
  private $_uid;
  private $_pw;
  public function indexAction()
  {
    $this->_form = $this->_helper->formLoader('client');
    $this->view->form = $this->_form;
  }
  public function resultAction()
  {
    if ($this->_request->isPost()) {
      if (array_key_exists('cancel', $_POST)) {
        $this->_redirect('/');
      }
      $formData = $this->_request->getPost();
      $this->_result = $formData["radio_group"];
    }
    $this->_env = 'http://' . $_SERVER['HTTP_HOST'] . '/xmlrpc/';
    $this->_login = 'miller_kurt_e@yahoo.com';
    $this->_pw = (strpos($this->_env,'tst') ? 'testing' : '1p1eqtwo');
    $um = new Local_Domain_Mappers_UserMapper();
    $this->_uid = $um->findByEmail($this->_login);
    $client = new Zend_XmlRpc_Client($this->_env);
    switch ($this->_result) {
    case 1:
      $test = "metaWeblog.test blogger.test wp.test";
      $data = 'metaWeblog->' . $client->call('metaWeblog.test');
      $data.= ' blogger->' . $client->call('blogger.test');
      $data.= ' wp->' . $client->call('wp.test');
      break;

    case 2:
      $test = "metaWeblog.testLogin blogger.testLogin wp.testLogin";
      $data = 'metaWeblog->' . $client->call('metaWeblog.testLogin', array($this->_login, $this->_pw));
      $data.= ' blogger->' . $client->call('blogger.testLogin', array($this->_login, $this->_pw));
      $data.= ' wp->' . $client->call('wp.testLogin', array($this->_login, $this->_pw));
      break;

    case 3:
      $test = "metaWeblog.getRecentPosts";
      $data = $client->call('metaWeblog.getRecentPosts', array('0', $this->_login, $this->_pw, 20));
      break;

    case 4:
      $data = array();
      $test = "metaWeblog.getPost";
      $post = array('title' => 'New Test Post to test getPost', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Test getPost Header</h3><p>If you see me then getPost worked.</p>', 'categories' => array('new', 'key', 'words'), 'userid' => $this->_uid);
      $id = $client->call('metaWeblog.newPost', array('ZBL', $this->_login, $this->_pw, $post, 1));
      $data[0] = "Created post id: $id";
      $data[1] = $client->call('metaWeblog.getPost', array("$id", $this->_login, $this->_pw));
      $result = $client->call('blogger.deletePost', array('ZBL', "$id", $this->_login, $this->_pw, true));
      $data[2] = "Deleted post id: $id, returned code: $result";
      break;

    case 5:
      $data = array();
      $test = "metaWeblog.newPost";
      $post = array('title' => 'New Test Post', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Test Header</h3><p>Test body. That should do it.</p>', 'categories' => array('new', 'key', 'words'), 'userid' => $this->_uid);
      $id = $client->call('metaWeblog.newPost', array('ZBL', $this->_login, $this->_pw, $post, 1));
      $data[0] = "Created post id: $id";
      $data[1] = $client->call('metaWeblog.getPost', array("$id", $this->_login, $this->_pw));
      $result = $client->call('blogger.deletePost', array('ZBL', "$id", $this->_login, $this->_pw, true));
      $data[2] = "Deleted post id: $id, returned code: $result";
      break;

    case 6:
      $data = array();
      $test = "metaWeblog.editPost";
      $post = array('title' => 'New Test Post', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Test Header</h3><p>Test body. That should do it.</p>', 'categories' => array('new', 'key', 'words'), 'userid' => $this->_uid);
      $id = $client->call('metaWeblog.newPost', array('ZBL', $this->_login, $this->_pw, $post, 1));
      $data[0] = "Created post id: $id";
      $data[1] = $client->call('metaWeblog.getPost', array("$id", $this->_login, $this->_pw));
      $post = array('title' => 'Edited New Test Post', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Edited Test Header</h3><p>Edited Test body. That should have done it.</p>', 'categories' => array('new', 'key', 'words'), 'userid' => $this->_uid);
      $result = $client->call('metaWeblog.editPost', array("$id", $this->_login, $this->_pw, $post, 1));
      $data[2] = $client->call('metaWeblog.getPost', array("$id", $this->_login, $this->_pw));
      $result = $client->call('blogger.deletePost', array('ZBL', "$id", $this->_login, $this->_pw, true));
      $data[3] = "Deleted post id: $id, returned code: $result";
      break;

    case 7:
      $data = array();
      $test = "blogger.deletePost";
      $post = array('title' => 'New Test Post to Delete', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Test Header</h3><p>Test body. Now delete it...</p>', 'categories' => array('delete', 'this', 'post'), 'userid' => $this->_uid);
      $id = $client->call('metaWeblog.newPost', array('ZBL', $this->_login, $this->_pw, $post, 1));
      $data[0] = "Created post id: $id";
      $data[1] = $client->call('metaWeblog.getPost', array("$id", $this->_login, $this->_pw));
      $result = $client->call('blogger.deletePost', array('ZBL', "$id", $this->_login, $this->_pw, true));
      $data[2] = "Deleted post id: $id, returned code: $result";
      break;

    case 8:
      $test = "blogger.getCategories";
      $data = $client->call('metaWeblog.getCategories', array('0', $this->_login, $this->_pw));
      break;

    case 9:
      $data = array();
      $test = "metaWebLog.newMediaObject";
      $bits = new Zend_XmlRpc_Value_Base64('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', true);
      $mediaObject = array('name' => 'test.jpg', 'type' => 'image/jpeg', 'bits' => $bits);
      $src = $client->call('metaWeblog.newMediaObject', array('0', $this->_login, $this->_pw, $mediaObject));
      $data[0] = $src["url"];
      $img = "http://" . $_SERVER['HTTP_HOST'] . '/images/uploads/test.jpg';
      $post = array('title' => 'Showing New Media Object', 'dateCreated' => '2011-01-01 12:34:56', 'description' => "<h3>Test Media Object Header</h3><p>Testing Media Object.</p><img src='$img' alt='Test Image' height='100' width='100'/><p>That should do it.</p>", 'categories' => array('new', 'image', 'test'), 'userid' => $this->_uid);
      $id = $client->call('metaWeblog.newPost', array('ZBL', $this->_login, $this->_pw, $post, 1));
      $data[1] = "Created post id: $id";
      $data[2] = $client->call('metaWeblog.getPost', array("$id", $this->_login, $this->_pw));
      $result = $client->call('blogger.deletePost', array('ZBL', "$id", $this->_login, $this->_pw, true));
      $data[3] = "Deleted post id: $id, returned code: $result";
      break;

    case 10:
      $test = "blogger.getUsersBlogs";
      $data = $client->call('blogger.getUsersBlogs', array('0', $this->_login, $this->_pw));
      break;

    case 11:
      $test = "wp.getTags";
      $data = $client->call('wp.getTags', array('34', $this->_login, $this->_pw));
      break;

    case 12:
      $test = "blogger.getUserInfo";
      $data = $client->call('blogger.getUserInfo', array('ZBL', $this->_login, $this->_pw));
    }
    $this->view->test = $test;
    $this->view->data = $data;
    $this->view->env = $this->_env;
  }
}
