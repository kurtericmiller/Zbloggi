<?php
class Xmlrpc_ClientController extends Zend_Controller_Action
{
    private $_form;
    private $_result;

    public function indexAction()
    {
        $this->_form = $this->_helper->formLoader('client');
        $this->view->form = $this->_form;
    }

    public function resultAction()
    {
        if ($this->_request->isPost()) {
            if (array_key_exists('cancel', $_POST)) {
                $this->_redirect('/');
            } 
            $formData = $this->_request->getPost();
            $this->_result = $formData["radio_group"];
        }   

        $client = new Zend_XmlRpc_Client('http://ymozend.tst/xmlrpc/');
        switch ($this->_result) {
        case 1:
            $test = "metaWeblog.test blogger.test wp.test";
            $data = 'metaWeblog->' . $client->call('metaWeblog.test');
            $data .= ' blogger->' . $client->call('blogger.test');
            $data .= ' wp->' . $client->call('wp.test');
            break;
        case 2:
            $test = "metaWeblog.testLogin blogger.testLogin wp.testLogin";
            $data = 'metaWeblog->' . $client->call('metaWeblog.testLogin',array('miller_kurt_e@yahoo.com','testing'));
            $data .= ' blogger->' . $client->call('blogger.testLogin',array('miller_kurt_e@yahoo.com','testing'));
            $data .= ' wp->' . $client->call('wp.testLogin',array('miller_kurt_e@yahoo.com','testing'));
            break;
        case 3:
            $test = "metaWeblog.getRecentPosts";
            $data = $client->call('metaWeblog.getRecentPosts',array('0','miller_kurt_e@yahoo.com','testing', 20));
            break;
        case 4:
            $test = "metaWeblog.getPost";
            $data = $client->call('metaWeblog.getPost',array('34','miller_kurt_e@yahoo.com','testing'));
            break;
        case 5:
            $test = "metaWeblog.newPost";
            $post = array('title' => 'New Test Post', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Test Header</h3><p>Test body. That should do it.</p>', 'categories' => array('new', 'key', 'words'), 'userid' => '11');
            $data = $client->call('metaWeblog.newPost',array('ZBL','miller_kurt_e@yahoo.com','testing', $post, 1));
            break;
        case 6:
            $test = "metaWeblog.editPost";
            $post = array('title' => 'Just Another Test Post', 'dateCreated' => '2011-01-01 12:34:56', 'description' => '<h3>Test Header</h3><p>Test body. That should do it.</p>', 'categories' => array('new', 'key', 'words'), 'userid' => '11');
            $data = $client->call('metaWeblog.editPost',array('34','miller_kurt_e@yahoo.com','testing', $post, 1));
            break;
        case 7:
            $test = "blogger.deletePost";
            $data = $client->call('blogger.deletePost',array('ZBL','256','miller_kurt_e@yahoo.com','testing', true));
            break;
        case 8:
            $test = "blogger.getCategories";
            $data = $client->call('metaWeblog.getCategories',array('0','miller_kurt_e@yahoo.com','testing'));
            break;
        case 9:
            $test = "metaWebLog.newMediaObject";
            $bits = new Zend_XmlRpc_Value_Base64('/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCAAeAAEDAREAAhEBAxEB/8QATAABAQAAAAAAAAAAAAAAAAAAAAcBAQEAAAAAAAAAAAAAAAAAAAADEAEAAAAAAAAAAAAAAAAAAAAAEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwCDpJAAAP/Z');
            $mob1 = array('name' => 'test.jpg', 'type' => 'image/jpeg', 'bits' => $bits);
            $data = $client->call('metaWeblog.newMediaObject',array('0','miller_kurt_e@yahoo.com','testing',$mob1));
            break;
        case 10:
            $test = "blogger.getUsersBlogs";
            $data = $client->call('blogger.getUsersBlogs',array('0','miller_kurt_e@yahoo.com','testing'));
            break;
        case 11:
            $test = "wp.getTags";
            $data = $client->call('wp.getTags',array('34','miller_kurt_e@yahoo.com','testing'));
            break;
        case 12:
            $test = "blogger.getUserInfo";
            $data = $client->call('blogger.getUserInfo',array('ZBL','miller_kurt_e@yahoo.com','testing'));
        }
        $this->view->test = $test;
        $this->view->data = $data;
    }
}
