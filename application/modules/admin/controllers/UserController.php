<?php
class Admin_UserController extends Zend_Controller_Action
{
  private $_auth;
  private $_form;
  private $_mapper;
  private $_home = '/admin/user';
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
    $this->_mapper = new Local_Domain_Mappers_UserMapper();
  }
  public function indexAction()
  {
    $this->page = $this->_getParam('page', 1);
    $localReg = Zend_Registry::get('local');
    $this->view->paginator = $this->_helper->Pager($this->_mapper, $localReg->get('admUserCnt'));
    $this->view->limit = $this->_helper->Pager->getLimit($this->page);
  }
  public function roleAction()
  {
    if ($this->_request->isPost()) {
      if (array_key_exists('cancel', $_POST)) {
        $this->_redirect('/admin/user');
      }
      $formData = $this->_request->getPost();
      $user = $this->_mapper->find($formData['user_id']);
      $this->setForm($user);
      if ($this->_form->isValid($formData)) {
        $this->setRole($formData);
        $this->_redirect('/admin/user');
      }
      $this->_form->populate($formData);
    } else {
      $user = $this->_mapper->find($this->_request->getParam('id'));
      $this->setForm($user);
    }
    $this->view->form = $this->_form;
  }
  public function deleteAction()
  {
    if ($this->getRequest()->isPost()) {
      $del = $this->getRequest()->getPost('del');
      if ($del == 'Yes') {
        $id = $this->getRequest()->getPost('id');
        $user = $this->_mapper->find($id);
        $user->finder()->delete($user);
      }
      $this->_redirect($this->_home);
    } else {
      $id = $this->_getParam('id', 0);
      $user = $this->_mapper->find($id);
      $this->view->id = $id;
      $this->view->title = $user->get('username');
    }
  }
  private function setForm($user)
  {
    $options['id'] = $user->getId($user);
    $options['role'] = $user->get('role');
    $this->_form = $this->_helper->formLoader('role', $options);
    $this->view->username = $user->get('username');
    $this->view->name = $this->_mapper->getProperName($user);
  }
  private function setRole($formData)
  {
    $user = $this->_mapper->find($formData['user_id']);
    $user->set('role', $formData['role']);
    $user->finder()->update($user);
  }
}
