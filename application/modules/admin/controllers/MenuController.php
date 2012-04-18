<?php
class Admin_MenuController extends Zend_Controller_Action
{
    private $_auth;
    private $_form;
    private $_formCnt;
    private $_menu_mapper;
    private $_menu_id = null;
    private $_home = '/admin/menu';
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
        $this->_auth = Zend_Auth::getInstance();
        $this->_menu_mapper = new Local_Domain_Mappers_MenuMapper();
        $this->_menu_id = $this->_request->getParam('id');
    }
    public function indexAction()
    {
        $options['sort'] = 'menu, ordering asc';
        $this->view->mc = $this->_menu_mapper->findAll($options);
    }
    public function addAction()
    {
        $this->_form = $this->_helper->formLoader('menu');
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($this->validatePost($formData)) {
                $menu = new Local_Domain_Models_Menu();
                $this->setMenu($menu, $formData);
                $menu->finder()->insert($menu);
                $this->_redirect($this->_home);
            }
        }
        $this->view->form = $this->_form;
    }
    public function editAction()
    {
        $options['id'] = $this->_menu_id;
        $this->_form = $this->_helper->formLoader('menu', $options);
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($this->validatePost($formData)) {
                $menu = $this->_menu_mapper->find($formData['menus_id']);
                $this->setMenu($menu, $formData);
                $menu->finder()->update($menu);
                $this->_redirect($this->_home);
            }
        } else {
            $this->loadForm();
        }
        $this->view->form = $this->_form;
    }
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $menu = $this->_menu_mapper->find($id);
                $menu->finder()->delete($menu);
            }
            $this->_redirect($this->_home);
        } else {
            $id = $this->_getParam('id', 0);
            $menu = $this->_menu_mapper->find($id);
            $this->view->id = $id;
            $this->view->title = $menu->get('title');
        }
    }
    private function setMenu($menu, $values)
    {
        $menu->set('title', $values['menus_title']);
        $menu->set('ordering', $values['menus_ordering']);
        $menu->set('menu', $values['menus_menu']);
        $menu->set('link', $values['menus_link']);
    }
    public function validatePost($formData)
    {
        if (array_key_exists('cancel', $_POST)) {
            $this->_redirect($this->_home);
        }
        if ($this->_form->isValid($formData)) {
            return true;
        } else {
            $this->_form->populate($formData);
            return false;
        }
    }
    private function loadForm()
    {
        $menu = $this->_menu_mapper->find($this->_menu_id);
        $formData['menus_title'] = $menu->get('title');
        $formData['menus_ordering'] = $menu->get('ordering');
        $formData['menus_menu'] = $menu->get('menu');
        $formData['menus_link'] = $menu->get('link');
        $this->_form->populate($formData);
    }
}
