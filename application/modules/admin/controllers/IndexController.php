<?php
class Admin_IndexController extends Zend_Controller_Action
{
    private $_auth;
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
    public function indexAction()
    {
    }
    public function searchAction()
    {
        $this->view->messages = $this->_helper->getHelper('FlashMessenger')->getMessages();
        if ($this->_request->getParam('start')) {
            $config = $this->getInvokeArg('bootstrap')->getOption('indexes');
            $index = Zend_Search_Lucene::create($config['indexPath']);
            $am = new Local_Domain_Mappers_ArticleMapper();
            $um = new Local_Domain_Mappers_UserMapper();
            $cm = new Local_Domain_Mappers_CommentMapper();
            $ac = $am->findAll();
            $count = 0;
            foreach ($ac as $a) {
                if (0 == $a->get('published')) {
                    continue;
                }
                $doc = new Zend_Search_Lucene_Document();
                $uid = $a->get('user_id');
                $u = $um->find($uid);
                $user = $u->get('username');
                $title = $a->get('article_title');
                $text = $a->get('article_text');
                $pubdate = $a->get('created_at');
                $a_id = $a->get('id');
                $cc = $cm->getArticleComments($a_id);
                $comments = "";
                foreach ($cc as $c) {
                    $comments.= $c->get('comment_text');
                }
                $doc->addField(Zend_Search_Lucene_Field::Text('Title', $title));
                $doc->addField(Zend_Search_Lucene_Field::UnStored('Text', $text));
                $doc->addField(Zend_Search_Lucene_Field::UnStored('Comments', $comments));
                $doc->addField(Zend_Search_Lucene_Field::UnIndexed('Author', $user));
                $doc->addField(Zend_Search_Lucene_Field::UnIndexed('Published', $pubdate));
                $doc->addField(Zend_Search_Lucene_Field::UnIndexed('RecordID', $a_id));
                $index->addDocument($doc);
                $count++;
            }
            $this->_helper->getHelper('FlashMessenger')->addMessage("The index was successfully created with $count documents.");
            $this->view->messages = $this->_helper->getHelper('FlashMessenger')->getMessages();
            $this->_redirect("/admin/index/search");
        }
    }
}
