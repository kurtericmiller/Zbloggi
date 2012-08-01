<?php
class Default_IndexController extends Zend_Controller_Action
{
    private $_auth;
    private $_localReg;

    public function init()
    {
        $this->_auth = Zend_Auth::getInstance();
        if (!$this->_auth->hasIdentity()) {
            $options['module'] = 'auth';
            $this->view->form = $this->_helper->formLoader('login', $options);
        }
        $this->_localReg = Zend_Registry::get('local');
        $items = $this->_localReg->get('bookCount');
        $bm = new Local_Domain_Mappers_BookMapper();
        $option['sort'] = 'created_at desc';
        $bc = $bm->findAll($option);
        $bc->notifyAccess();
        $bcount = $bc->count();
        if ($this->_localReg->get('headlineId') > 0) {
            $headlineId = $this->_localReg->get('headlineId');
        } else {
            $am = new Local_Domain_Mappers_ArticleMapper();
            $headlineId = $am->getLatestArticleId();
        }
        $lc = $this->_localReg->get('latestArticleCount');
        $page = $this->_getParam('page', 1);
        $this->view->paginator = $this->_helper->Pager($bcount, $items);
        $limit = $this->_helper->Pager->getLimit($page);
        $this->view->limit = $limit;
        $options['offset'] = $limit['offset'];
        $options['count'] = $limit['items'];
        $this->view->bc = $bm->findAll($options);
        $this->view->lc = $lc;
        $this->view->headlineId = $headlineId;
        $this->view->num_articles = $this->_localReg->get('homeArticleCount');
    }
    public function indexAction()
    {
    }
    public function contactAction()
    {
        $options['module'] = 'default';
        $this->_form = $this->_helper->formLoader('contact', $options);
        if ($this->getRequest()->isPost()) {
            if ($this->_form->isValid($this->getRequest()->getPost())) {
                $values = $this->_form->getValues();
                $defemail = $this->_localReg->get('defemail');
                $sender = $values['email'];
                $sendee = $defemail;
                $body = $values['bodytext'];
                $body.= "\n\nThis email sent by: " . $sender . "\n";
                $subject = $this->_localReg->get('site_title') . ' Contact';
                $this->_helper->mailer($sender, $sendee, $body, $subject);
                $this->_helper->getHelper('FlashMessenger')->addMessage('<span class="fmessage">Thank you. Message sent.</span>');
            } else {
                $this->_helper->getHelper('FlashMessenger')->addMessage('<span class="fmessage">Sorry. Message not sent.</span>');
            }
        }
        if (APPLICATION_ENV === 'testing') {
            $this->_redirect('/');
        } else {
            $this->_redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function dojoAction()
    {
    }
    public function aboutAction()
    {
    }
    public function faqAction()
    {
    }
    public function privacyAction()
    {
    }
    public function termsAction()
    {
    }
    public function creditsAction()
    {
    }
    public function booksAction()
    {
    }
    public function helpAction()
    {
    }
    public function versionAction()
    {
        $this->_helper->layout->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender(true);
        echo Zend_Registry::get('local.version');
    }
    public function profileAction()
    {
        $user = $this->_getParam('user');
        $pm = new Local_Domain_Mappers_ProfileMapper();
        if ($pm->exists(array('field' => 'user_id', 'value' => $user)) && $user !== null) {
            $p = $pm->findByUser($user);
            $this->view->first = $p->get('first');
            $this->view->middle = $p->get('middle');
            $this->view->last = $p->get('last');
            $this->view->occupation = $p->get('occupation');
            $this->view->bio_text = $p->get('bio_text');
            $this->view->avatar = $p->get('avatar');
            $this->view->website = $p->get('website');
        } else {
            $this->_redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function sqlerrorAction()
    {
        if ('654' === $this->_getParam('test')) {
            $am = new Local_Domain_Mappers_CommentMapper();
            $a = $am->getArticleComments('user');
        }
    }
}
