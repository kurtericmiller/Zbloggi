<?php
class Admin_CommentController extends Zend_Controller_Action
{
    private $_auth;
    private $_form;
    private $_formCnt;
    private $_mapper;
    private $_comment_id = null;
    private $_home = '/admin/comment';
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
        $this->_mapper = new Local_Domain_Mappers_CommentMapper();
        $this->_comment_id = $this->_request->getParam('id');
    }
    public function indexAction()
    {
        $am = new Local_Domain_Mappers_ArticleMapper();
        $count = $am->getTotalArticlesWithComments();
        $localReg = Zend_Registry::get('local');
        $items = $localReg->get('admComCnt');
        $this->page = $this->_getParam('page', 1);
        $this->view->paginator = $this->_helper->Pager($count, $items);
        $this->view->limit = $this->_helper->Pager->getLimit($this->page);
    }
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $comment = $this->_mapper->find($id);
                $comment->finder()->delete($comment);
            }
            $this->_redirect($this->_home);
        } else {
            $id = $this->_getParam('id', 0);
            $comment = $this->_mapper->find($id);
            $this->view->id = $id;
            $this->view->title = $comment->get('comment_text');
        }
    }
}
