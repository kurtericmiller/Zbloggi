<?php
class Admin_ArticleController extends Zend_Controller_Action
{
    private $_auth;
    private $_form;
    private $_formCnt;
    private $_article_mapper;
    private $_keyword_mapper;
    private $_article_id = null;
    private $_user_id = null;
    private $_user_role = null;
    private $_home = '/admin/article';
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
        $this->_user_role = $this->_auth->getIdentity()->role;
        $this->_article_mapper = new Local_Domain_Mappers_ArticleMapper();
        $this->_keyword_mapper = new Local_Domain_Mappers_KeywordMapper();
        $this->_article_id = $this->_request->getParam('id');
        $this->view->headLink()->appendStylesheet('/stylesheets/shCore.css')->appendStylesheet('/stylesheets/shThemeDefault.css');
        $this->view->headScript()->appendFile('/javascripts/shCore.js')->appendFile('/javascripts/shBrushes.js');
        $this->view->headScript()->appendScript("SyntaxHighlighter.defaults['toolbar'] = false;
SyntaxHighlighter.all();", 'text/javascript');
    }
    public function indexAction()
    {
        $localReg = Zend_Registry::get('local');
        $items = $localReg->get('admArtCnt');
        $article_filter = $this->_request->getParam('article_filter');
        $options['sort'] = 'created_at desc';
        switch ($article_filter) {
        case ("published"):
            $options['where'] = 'published = 1';
            break;

        case ("pending"):
            $options['where'] = 'published = 0';
            break;

        default:
        }
        if ($this->_user_role == 'author') {
            if (array_key_exists('where', $options)) {
                $options['where'].= ' and user_id = ' . $this->_user_id;
            } else {
                $options['where'] = 'user_id = ' . $this->_user_id;
            }
        }
        $ac = $this->_article_mapper->findAll($options);
        $ac->notifyAccess();
        $acount = $ac->count();
        $this->view->paginator = $this->_helper->Pager($acount, $items);
        $page = $this->_getParam('page', 1);
        $limit = $this->_helper->Pager->getLimit($page);
        $options['offset'] = $limit['offset'];
        $options['count'] = $limit['items'];
        $this->view->ac = $this->_article_mapper->findAll($options);
        $this->view->select = 'article_filter=' . $article_filter . '&';
        $this->view->user = $this->_user_id;
        $this->view->article_filter = $article_filter;
    }
    public function publishAction()
    {
        $mode = $this->_request->getParam('mode');
        $article = $this->_article_mapper->find($this->_article_id);
        $mode = ($mode == 'true') ? 1 : 0;
        $article->set('published', $mode);
        $article->finder()->update($article);
        $this->_redirect($this->_home);
    }
    public function previewAction()
    {
        $this->view->article_id = $this->_article_id;
    }
    public function addAction()
    {
        $pm = new Local_Domain_Mappers_ProfileMapper();
        if (null === $pm->findByUser($this->_user_id)) {
            $flasher = $this->_helper->getHelper('FlashMessenger');
            $flasher->setNameSpace('profile');
            $flasher->addMessage('Please create your profile before adding articles.');
            $this->_redirect('/user/profiles');
        }
        $this->view->headScript()->appendFile('/javascripts/tiny_mce/tiny_mce.js', 'text/javascript');
        $this->initMce();
        $this->_form = $this->_helper->formLoader('article');
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($this->validatePost($formData)) {
                $article = new Local_Domain_Models_Article();
                $this->setArticle($article, $formData, $this->_user_id);
                $article->finder()->insert($article);
                $this->_keyword_mapper->addKeywords($article->getLastId(), explode(' ', $formData['keywords']));
                $this->_redirect($this->_home);
            }
        }
        $this->view->form = $this->_form;
    }
    public function editAction()
    {
        $this->view->headScript()->appendFile('/javascripts/tiny_mce/tiny_mce.js', 'text/javascript');
        $this->initMce();
        $options['id'] = $this->_article_id;
        $this->_form = $this->_helper->formLoader('article', $options);
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($this->validatePost($formData)) {
                $article = $this->_article_mapper->find($formData['article_id']);
                $this->setArticle($article, $formData, $article->get('user_id'));
                $article->finder()->update($article);
                $this->_keyword_mapper->addKeywords($article->getId(), explode(' ', $formData['keywords']));
                if (array_key_exists('preview', $_POST)) {
                    $url = "/admin/article/preview?id=" . $formData['article_id'];
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
                $article = $this->_article_mapper->find($id);
                $article->finder()->delete($article);
            }
            $this->_redirect($this->_home);
        } else {
            $id = $this->_getParam('id', 0);
            $article = $this->_article_mapper->find($id);
            $this->view->id = $id;
            $this->view->title = $article->get('article_title');
        }
    }
    private function setArticle($article, $values, $uid)
    {
        $article->set('user_id', $uid);
        $article->set('article_title', $values['article_title']);
        $article->set('article_text', $values['article_text']);
    }
    private function validatePost($formData)
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
        $article = $this->_article_mapper->find($this->_article_id);
        $keywords = $this->_article_mapper->getKeywords($article);
        $formData['article_title'] = $article->get('article_title');
        $formData['article_text'] = $article->get('article_text');
        $formData['keywords'] = implode(' ', $keywords);
        $this->_form->populate($formData);
    }
    private function initMce()
    {
        $this->view->headScript()->appendScript('
    tinyMCE.init({
        mode:"exact",
        elements : "article_text",
        theme : "advanced",
        relative_urls : false,
        plugins : "emotions,spellchecker,advhr,insertdatetime,preview,jbimages,ccSimpleUploader,pagebreak", 
        file_browser_callback : "ccSimpleUploader",
        pagebreak_separator : "<!--more-->",
        plugin_ccSimpleUploader_upload_path : "../../../../attachments",                 
        plugin_ccSimpleUploader_upload_substitute_path : "/attachments/",
        
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,formatselect,|,pagebreak",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,jbimages,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions,|,ccSimpleUploader",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_blockformats : "p,pre,code,h1,h2,h3,h4,h5,h6,blockquote",
        theme_advanced_resizing : true
    });', 'text/javascript');
    }
}
