<?php
class Admin_ConfigController extends Zend_Controller_Action
{
  private $_localConfigPath;
  private $_form;
  public function init()
  {
    // set doctype
    $this->view->doctype('XHTML1_STRICT');
    // retrieve path to local config file
    $config = $this->getInvokeArg('bootstrap')->getOption('configs');
    $this->_localConfigPath = $config['localConfigPath'];
  }
  // action to handle admin URLs
  public function preDispatch()
  {
    $this->_auth = Zend_Auth::getInstance();
    if (!$this->_auth->hasIdentity()) {
      $requestUri = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
      $session = new Zend_Session_Namespace('lastRequest');
      $session->lastRequestUri = $requestUri;
      $this->_forward('index', 'index', 'auth');
    }
  }
  // action to save configuration data
  public function indexAction()
  {
    $flasher = $this->_helper->getHelper('FlashMessenger');
    $flasher->setNameSpace('config');
    $this->view->messages = $flasher->getMessages();
    // generate input form
    $options['module'] = 'admin';
    $this->_form = $this->_helper->formLoader('config', $options);
    // if config file exists
    // read config values
    // pre-populate form with values
    if (file_exists($this->_localConfigPath)) {
      $config = new Zend_Config_Ini($this->_localConfigPath);
      $data['headlineId'] = $config->global->headlineId;
      $data['articleCount'] = $config->global->articleCount;
      $data['bookCount'] = $config->global->bookCount;
      $data['latestArticleCount'] = $config->global->latestArticleCount;
      $data['amazonLU'] = $config->global->amazonLU;
      $data['admArtCnt'] = $config->admin->admArtCnt;
      $data['admComCnt'] = $config->admin->admComCnt;
      $data['admUserCnt'] = $config->admin->admUserCnt;
      $data['defemail'] = $config->admin->defemail;
      $this->_form->populate($data);
    }
    // test for valid input
    // if valid, create new config object
    // create config sections
    // save config values to file,
    // overwriting previous version
    if ($this->getRequest()->isPost()) {
      if ($this->_form->isValid($this->getRequest()->getPost())) {
        $values = $this->_form->getValues();
        $config = new Zend_Config(array(), true);
        $config->global = array();
        $config->admin = array();
        $config->user = array();
        $config->global->headlineId = $values['headlineId'];
        $config->global->articleCount = $values['articleCount'];
        $config->global->bookCount = $values['bookCount'];
        $config->global->latestArticleCount = $values['latestArticleCount'];
        $config->global->amazonLU = $values['amazonLU'];
        $config->admin->admArtCnt = $values['admArtCnt'];
        $config->admin->admComCnt = $values['admComCnt'];
        $config->admin->admUserCnt = $values['admUserCnt'];
        $config->admin->defemail = $values['defemail'];
        $writer = new Zend_Config_Writer_Ini();
        $writer->write($this->_localConfigPath, $config);
        $flasher->addMessage('Thank you. Configuration was saved.');
        $this->_redirect("/admin/config");
      }
    }
    $this->view->form = $this->_form;
  }
}
