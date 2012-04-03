<?php
class Admin_BookController extends Zend_Controller_Action
{
  private $_auth;
  private $_form;
  private $_formCnt;
  private $_book_mapper;
  private $_book_id = null;
  private $_user_id = null;
  private $_home = '/admin/book';
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
    $this->_user_id = $this->_auth->getIdentity()->id;
    $this->_book_mapper = new Local_Domain_Mappers_BookMapper();
    $this->_book_id = $this->_request->getParam('id');
  }
  public function indexAction()
  {
    $options['sort'] = 'created_at desc';
    $this->view->bc = $this->_book_mapper->findAll($options);
  }
  public function addAction()
  {
    $this->_form = $this->_helper->formLoader('book');
    if ($this->_request->isPost()) {
      $formData = $this->_request->getPost();
      if ($this->validatePost($formData)) {
        $book = new Local_Domain_Models_Book();
        $this->setBook($book, $formData);
        $book->finder()->insert($book);
        $this->_redirect($this->_home);
      }
    }
    $this->view->form = $this->_form;
  }
  public function editAction()
  {
    $options['id'] = $this->_book_id;
    $this->_form = $this->_helper->formLoader('book', $options);
    if ($this->_request->isPost()) {
      $formData = $this->_request->getPost();
      if ($this->validatePost($formData)) {
        $book = $this->_book_mapper->find($formData['books_id']);
        $this->setBook($book, $formData);
        $book->finder()->update($book);
        if (array_key_exists('preview', $_POST)) {
          $url = "/admin/book/preview?id=" . $formData['books_id'];
          $this->_redirect($url);
        } else {
          $this->_redirect($this->_home);
        }
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
        $book = $this->_book_mapper->find($id);
        $book->finder()->delete($book);
      }
      $this->_redirect($this->_home);
    } else {
      $id = $this->_getParam('id', 0);
      $book = $this->_book_mapper->find($id);
      $this->view->id = $id;
      $this->view->title = $book->get('title');
    }
  }
  private function setBook($book, $values)
  {
    $book->set('title', $values['books_title']);
    $book->set('author', $values['books_author']);
    $book->set('image', $values['books_image']);
    $book->set('link', $values['books_link']);
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
    $book = $this->_book_mapper->find($this->_book_id);
    $formData['books_title'] = $book->get('title');
    $formData['books_author'] = $book->get('author');
    $formData['books_image'] = $book->get('image');
    $formData['books_link'] = $book->get('link');
    $this->_form->populate($formData);
  }
}
