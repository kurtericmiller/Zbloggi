<?php
class Admin_SectionController extends Zend_Controller_Action
{
    private $_auth;
    private $_form;
    private $_formCnt;
    private $_section_mapper;
    private $_section_id = null;
    private $_user_id = null;
    private $_home = '/admin/section';
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
        $this->_section_mapper = new Local_Domain_Mappers_SectionMapper();
        $this->_section_id = $this->_request->getParam('id');
    }
    public function indexAction()
    {
        $smapper = new Local_Domain_Mappers_SettingMapper();
        $sid = $smapper->getMaxId();
        $setting = $smapper->find($sid);
        $items = $setting->get('admArtCnt');
        $section_filter = $this->_request->getParam('section_filter');
        $options['sort'] = 'created_at desc';
        switch ($section_filter) {
        case ("published"):
            $options['where'] = 'published = 1';
            break;

        case ("pending"):
            $options['where'] = 'published = 0';
            break;

        default:
        }
        $ac = $this->_section_mapper->findAll($options);
        $ac->notifyAccess();
        $acount = $ac->count();
        $this->view->paginator = $this->_helper->Pager($acount, $items);
        $page = $this->_getParam('page', 1);
        $limit = $this->_helper->Pager->getLimit($page);
        $options['offset'] = $limit['offset'];
        $options['count'] = $limit['items'];
        $this->view->ac = $this->_section_mapper->findAll($options);
        $this->view->select = 'section_filter=' . $section_filter . '&';
        $this->view->section_filter = $section_filter;
    }
    public function publishAction()
    {
        $mode = $this->_request->getParam('mode');
        $section = $this->_section_mapper->find($this->_section_id);
        $mode = ($mode == 'true') ? 1 : 0;
        $section->set('published', $mode);
        $section->finder()->update($section);
        $this->_redirect($this->_home);
    }
    public function previewAction()
    {
        $this->view->section_id = $this->_section_id;
    }
    public function addAction()
    {
        $this->view->headScript()->appendFile('/javascripts/tiny_mce/tiny_mce.js', 'text/javascript');
        $this->initMce();
        $this->_form = $this->_helper->formLoader('section');
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($this->validatePost($formData)) {
                $section = new Local_Domain_Models_Section();
                $this->setSection($section, $formData);
                $section->finder()->insert($section);
                $this->_redirect($this->_home);
            }
        }
        $this->view->form = $this->_form;
    }
    public function editAction()
    {
        $this->view->headScript()->appendFile('/javascripts/tiny_mce/tiny_mce.js', 'text/javascript');
        $this->initMce();
        $options['id'] = $this->_section_id;
        $this->_form = $this->_helper->formLoader('section', $options);
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($this->validatePost($formData)) {
                $section = $this->_section_mapper->find($formData['section_id']);
                $this->setSection($section, $formData);
                $section->finder()->update($section);
                if (array_key_exists('preview', $_POST)) {
                    $url = "/admin/section/preview?id=" . $formData['section_id'];
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
                $section = $this->_section_mapper->find($id);
                $section->finder()->delete($section);
            }
            $this->_redirect($this->_home);
        } else {
            $id = $this->_getParam('id', 0);
            $section = $this->_section_mapper->find($id);
            $this->view->id = $id;
            $this->view->title = $section->get('section_title');
        }
    }
    private function setSection($section, $values)
    {
        $section->set('section_title', $values['section_title']);
        $section->set('section_text', $values['section_text']);
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
        $section = $this->_section_mapper->find($this->_section_id);
        $formData['section_title'] = $section->get('section_title');
        $formData['section_text'] = $section->get('section_text');
        $this->_form->populate($formData);
    }
    private function initMce()
    {
        $this->view->headScript()->appendScript('
    tinyMCE.init({
        mode:"exact",
        elements : "section_text",
        theme : "advanced",
        relative_urls : false,
        plugins : "emotions,spellchecker,advhr,insertdatetime,preview,jbimages,ccSimpleUploader,pagebreak", 
        file_browser_callback : "ccSimpleUploader",
        pagebreak_separator : "<!--more-->",
        plugin_ccSimpleUploader_upload_path : "../../../../attachments",                 
        plugin_ccSimpleUploader_upload_substitute_path : "/attachments/",
        
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,formatselect,|,pagebreak",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,jbimages,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions,|,ccSimpleUploader",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
    });', 'text/javascript');
    }
}
