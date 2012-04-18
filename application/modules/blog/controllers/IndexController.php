<?php
class Blog_IndexController extends Zend_Controller_Action
{
    private $_page;
    private $_items;
    private $_options;
    public function init()
    {
        $this->_auth = Zend_Auth::getInstance();
        if (!$this->_auth->hasIdentity()) {
            $options['module'] = 'auth';
            $this->view->form = $this->_helper->formLoader('login', $options);
        }
        $localReg = Zend_Registry::get('local');
        $this->view->lc = $localReg->get('latestArticleCount');
        $this->_items = $localReg->get('articleCount');
        $this->_page = $this->_getParam('page', 1);
        $this->_options['offset'] = null;
        $this->_options['count'] = null;
        $this->_options['sort'] = 'created_at desc';
        $this->_options['where'] = 'published = 1';
    }
    public function indexAction()
    {
        $am = new Local_Domain_Mappers_ArticleMapper();
        $this->_options['where'] = 'published = 1';
        $ac = $am->findAll($this->_options);
        $ac->notifyAccess();
        $acount = $ac->count();
        $this->view->paginator = $this->_helper->Pager($acount, $this->_items);
        $_limit = $this->_helper->Pager->getLimit($this->_page);
        $this->_options['offset'] = $_limit['offset'];
        $this->_options['count'] = $_limit['items'];
        $this->view->ac = $am->findAll($this->_options);
    }
    public function tagAction()
    {
        $this->_helper->viewRenderer->setRender('index');
        $am = new Local_Domain_Mappers_ArticleMapper();
        $tag = $this->_getParam('tag');
        $ac = $am->getTagArticles($tag);
        $ac->notifyAccess();
        $tcount = $ac->count();
        $this->view->selector = "<h2>Articles matching tag: $tag</h2>";
        $this->view->paginator = $this->_helper->Pager($tcount, $this->_items);
        $_limit = $this->_helper->Pager->getLimit($this->_page);
        $this->_options['offset'] = $_limit['offset'];
        $this->_options['count'] = $_limit['items'];
        $this->view->ac = $am->getTagArticles($tag, $this->_options);
        $this->view->select = 'tag=' . $tag . '&';
    }
    public function authorAction()
    {
        $this->_helper->viewRenderer->setRender('index');
        $am = new Local_Domain_Mappers_ArticleMapper();
        $um = new Local_Domain_Mappers_UserMapper();
        $authorID = $this->_getParam('author');
        $u = $um->find($authorID);
        $username = $u->get('username');
        $this->view->selector = "<h2>Articles matching author: $username</h2>";
        $this->_options['where'] = 'published = 1 and user_id = ' . $authorID;
        $ac = $am->findAll($this->_options);
        $ac->notifyAccess();
        $acount = $ac->count();
        $this->view->paginator = $this->_helper->Pager($acount, $this->_items);
        $_limit = $this->_helper->Pager->getLimit($this->_page);
        $this->_options['offset'] = $_limit['offset'];
        $this->_options['count'] = $_limit['items'];
        $this->view->ac = $am->findAll($this->_options);
        $this->view->select = 'author=' . $authorID . '&';
    }
}
