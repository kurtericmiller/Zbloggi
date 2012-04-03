<?php
class Admin_SettingController extends Zend_Controller_Action
{
  private $_form;
  private $_auth;
  private $_setting_mapper;
  private $_home = '/admin/setting';
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
  public function init()
  {
    $this->view->doctype('XHTML1_STRICT');
    $this->_setting_mapper = new Local_Domain_Mappers_SettingMapper();
  }
  public function indexAction()
  {
    $flasher = $this->_helper->getHelper('FlashMessenger');
    $flasher->setNameSpace('setting');
    $this->view->messages = $flasher->getMessages();
    $this->_form = $this->_helper->formLoader('setting');
    $sid = $this->_setting_mapper->getMaxId();
    $setting = $this->_setting_mapper->find($sid);
    if ($this->getRequest()->isPost()) {
      $formData = $this->_request->getPost();
      if ($this->_form->isValid($formData)) {
        $setting->set('site_title', $formData['site_title']);
        $setting->set('site_tagline', $formData['site_tagline']);
        $setting->set('site_url', $formData['site_url']);
        $setting->set('headlineId', $formData['headlineId']);
        $setting->set('articleCount', $formData['articleCount']);
        $setting->set('bookCount', $formData['bookCount']);
        $setting->set('latestArticleCount', $formData['latestArticleCount']);
        $setting->set('amazonLU', $formData['amazonLU']);
        $setting->set('admArtCnt', $formData['admArtCnt']);
        $setting->set('admComCnt', $formData['admComCnt']);
        $setting->set('admUserCnt', $formData['admUserCnt']);
        $setting->set('defemail', $formData['defemail']);
        $setting->finder()->update($setting);
        $flasher->addMessage('Thank you. Configuration was saved.');
        $this->_redirect($this->_home);
      }
    } else {
      $data['site_title'] = $setting->get('site_title');
      $data['site_tagline'] = $setting->get('site_tagline');
      $data['site_url'] = $setting->get('site_url');
      $data['headlineId'] = $setting->get('headlineId');
      $data['articleCount'] = $setting->get('articleCount');
      $data['bookCount'] = $setting->get('bookCount');
      $data['latestArticleCount'] = $setting->get('latestArticleCount');
      $data['amazonLU'] = $setting->get('amazonLU');
      $data['admArtCnt'] = $setting->get('admArtCnt');
      $data['admComCnt'] = $setting->get('admComCnt');
      $data['admUserCnt'] = $setting->get('admUserCnt');
      $data['defemail'] = $setting->get('defemail');
      $this->_form->populate($data);
    }
    $this->view->form = $this->_form;
  }
}
