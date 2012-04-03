<?php
class Blog_CommentController extends Zend_Controller_Action
{
  private $_auth;
  private $_user;
  private $_commentForm;
  private $_article_id;
  public function preDispatch()
  {
    $this->_auth = Zend_Auth::getInstance();
    if (!$this->_auth->hasIdentity()) {
      $requestUri = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
      $session = new Zend_Session_Namespace('lastRequest');
      $session->lastRequestUri = $requestUri;
    }
  }
  public function init()
  {
    $this->view->headLink()->appendStylesheet('/stylesheets/shCore.css')->appendStylesheet('/stylesheets/shThemeDefault.css');
    $this->view->headScript()->appendFile('/javascripts/shCore.js')->appendFile('/javascripts/shBrushes.js')->appendFile('http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f6107897913656f', 'text/javascript');
    $this->view->headScript()->appendScript("SyntaxHighlighter.defaults['toolbar'] = false;
SyntaxHighlighter.all();", 'text/javascript');
    $this->_auth = Zend_Auth::getInstance();
    $this->_article_id = $this->_request->getParam('id');
    $this->view->article_id = $this->_article_id;
  }
  public function indexAction()
  {
    $localReg = Zend_Registry::get('local');
    $lc = $localReg->get('latestArticleCount');
    $this->view->lc = $lc;
    //Refactor
    if (!$this->_auth->hasIdentity()) {
      $options['module'] = 'auth';
      $this->_commentForm = $this->_helper->formLoader('login', $options);
    } else {
      $options['id'] = $this->_article_id;
      $this->_commentForm = $this->_helper->formLoader('comment', $options);
      $this->_user = $this->_auth->getIdentity()->email;
      $this->view->user = $this->_user;
    }
    $this->_helper->SetArticleReadCount($this->_article_id);
    if ($this->_request->isPost()) {
      if (array_key_exists('cancel', $_POST)) {
        $this->_redirect('/blog');
      }
      $formData = $this->_request->getPost();
      if ($this->_commentForm->isValid($formData)) {
        $this->addComment($formData);
      } else {
        $this->_commentForm->populate($formData);
      }
    }
    $this->view->comform = $this->_commentForm;
  }
  private function addComment($values)
  {
    $um = new Local_Domain_Mappers_UserMapper();
    $c = new Local_Domain_Models_Comment();
    if (APPLICATION_ENV !== 'testing') {
      $akismet = new Zend_Service_Akismet('eac1c60a2b8b', 'http://www.ymozend.com/blog/');
      $data = array('user_ip' => $_SERVER['REMOTE_ADDR'], 'user_agent' => $_SERVER['HTTP_USER_AGENT'], 'comment_content' => $values['comment_text']);
      $result = $akismet->isSpam($data);
    } else {
      $result = false;
    }
    if ($result) {
      echo "SPAM SPAM SPAM";
    } else {
      $c->set('article_id', $this->_article_id);
      $c->set('user_id', $um->findByEmail($this->_user));
      $c->set('comment_text', $values['comment_text']);
      $c->finder()->insert($c);
    }
  }
}
