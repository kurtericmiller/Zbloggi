<?php
class Admin_Form_Setting extends Zend_Form
{
    public function init()
    {
        // initialize form
        $this->setAction('/admin/setting')->setMethod('post');
        $this->setName('settingForm');
        $site_title = new Zend_Form_Element_Text('site_title');
        $site_title->setLabel('Site Title:')->setOptions(array('size' => '30'))->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $site_tagline = new Zend_Form_Element_Text('site_tagline');
        $site_tagline->setLabel('Site Tagline:')->setOptions(array('size' => '30'))->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $site_url = new Zend_Form_Element_Text('site_url');
        $site_url->setLabel('Site URL:')->setOptions(array('size' => '20'))->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $headline = new Zend_Form_Element_Text('headlineId');
        $headline->setLabel('Headline Article ID:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $articles = new Zend_Form_Element_Text('articleCount');
        $articles->setLabel('Number of Articles per Page:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $books = new Zend_Form_Element_Text('bookCount');
        $books->setLabel('Sidebar Books to Display:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $latest = new Zend_Form_Element_Text('latestArticleCount');
        $latest->setLabel('Sidebar Latest Articles to Show:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $amazon = new Zend_Form_Element_Text('amazonLU');
        $amazon->setLabel('Amazon Lookup Keywords:')->setOptions(array('size' => '30'))->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $artCnt = new Zend_Form_Element_Text('admArtCnt');
        $artCnt->setLabel('Admin Articles per Page:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $comCnt = new Zend_Form_Element_Text('admComCnt');
        $comCnt->setLabel('Admin Comment Articles per Page:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $userCnt = new Zend_Form_Element_Text('admUserCnt');
        $userCnt->setLabel('Admin Users per Page:')->setOptions(array('size' => '4'))->setRequired(true)->addValidator('Int')->addFilter('HtmlEntities')->addFilter('StringTrim');
        $defemail = new Zend_Form_Element_Text('defemail');
        $defemail->setLabel('Default Admin email:')->setOptions(array('size' => '30'))->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $this->addElement($site_title)->addElement($site_tagline)->addElement($site_url)->addElement($headline)->addElement($articles)->addElement($books)->addElement($latest)->addElement($amazon);
        $this->addElement($artCnt)->addElement($comCnt)->addElement($userCnt)->addElement($defemail);
        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('submit',), 'submitButtons', array('order' => 6, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
        $this->addDisplayGroup(array('site_title', 'site_tagline', 'site_url', 'headlineId', 'articleCount', 'bookCount', 'latestArticleCount', 'amazonLU',), 'globals', array('legend' => 'Global Settings', 'decorators' => array('FormElements', array('Fieldset', array('class' => 'globalFields')),),));
        $this->addDisplayGroup(array('admArtCnt', 'admComCnt', 'admUserCnt', 'defemail'), 'admin', array('legend' => 'Admin Settings', 'decorators' => array('FormElements', array('Fieldset', array('class' => 'adminFields')),),));
    }
}
