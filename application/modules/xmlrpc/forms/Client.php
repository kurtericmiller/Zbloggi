<?php 
class Xmlrpc_Form_Client extends Zend_Form
{
    private $_action = "/xmlrpc/client/result";
     
    public function init() {
        $this->setAction($this->_action);
        $this->setName('XMLRPC Tests');
        $this->addElement('radio', 'radio_group', array(
            'label' => 'Tests:',
            'multioptions' => array(
                1 => '(All) Basic Connectivity',
                2 => '(All) Login',
                3 => '(Metaweblog) Get Recent Posts',
                4 => '(Metaweblog) Get Post',
                5 => '(Metaweblog) New Post',
                6 => '(Metaweblog) Edit Post',
                7 => '(Blogger) Delete Post',
                8 => '(Metaweblog) Get Categories',
                9 => '(Metaweblog) New Media Object',
                10 => '(Blogger) Get Users Blogs',
                11 => '(WP) Get Tags',
                12 => '(Blogger) Get User Info',
            ),
            'required' => true,
        ));

        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Run Test', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('submit', 'cancel'), 'submitButtons', array('order' => 2, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
 
    }
}
?>
