<?php
class Auth_IndexController extends Zend_Controller_Action
{
  // TODO: Have to provide Github version with salt and admin credentials
  private $_originalUrl = '/';
  public function preDispatch()
  {
    $session = new Zend_Session_Namespace('lastRequest');
    if (isset($session->lastRequestUri)) {
      $this->_originalUrl = $session->lastRequestUri;
    }
  }
  public function indexAction()
  {
    $logflash = $this->_helper->getHelper('FlashMessenger');
    $logflash->setNameSpace('log');
    $this->view->messages = $logflash->getMessages();
    $form = $this->_helper->formLoader('login');
    if ($this->_request->isPost()) {
      if (array_key_exists('cancel', $_POST)) {
        $this->_redirect('/');
      }
      if (array_key_exists('register', $_POST)) {
        $this->_redirect('/user/registration');
      }
      $formData = $this->_request->getPost();
      if ($form->isValid($formData)) {
        if ($this->_process($_POST)) {
          $this->_redirect($this->_originalUrl);
        } else {
          $logflash->addMessage('<a href="/auth/reset">I forgot my password. Please send me a new one.</a>');
          $this->_redirect('/auth');
        }
      }
      $form->populate($formData);
    }
    $this->view->form = $form;
  }
  protected function _process($values)
  {
    // Get our authentication adapter and check credentials
    if ($this->isValidEmail($values['email'])) {
      $adapter = $this->_getAuthAdapter('email');
    } else {
      $adapter = $this->_getAuthAdapter('username');
    }
    $adapter->setIdentity($values['email']);
    $adapter->setCredential($values['password']);
    $auth = Zend_Auth::getInstance();
    $result = $auth->authenticate($adapter);
    if ($result->isValid()) {
      $user = $adapter->getResultRowObject();
      $auth->getStorage()->write($user);
      return true;
    }
    return false;
  }
  protected function _getAuthAdapter($identCol)
  {
    $dbAdapter = Zend_Db_Table::getDefaultAdapter();
    $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    $opts = $this->getInvokeArg('bootstrap')->getOptions();
    $salt = $opts['salt'];
    $authAdapter->setTableName('users')->setIdentityColumn($identCol)->setCredentialColumn('password')->setCredentialTreatment("SHA1(CONCAT(?,'" . $salt . "'))");
    return $authAdapter;
  }
  public function logoutAction()
  {
    Zend_Auth::getInstance()->clearIdentity();
    $session = new Zend_Session_Namespace('lastRequest');
    if (isset($session->lastRequestUri)) {
      $session->lastRequestUri = null;
    }
    $this->_redirect('/'); // back to index
    
  }
  /* Courtesy of www.webtoolkit.info */
  protected function isValidEmail($email)
  {
    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
  }
}
