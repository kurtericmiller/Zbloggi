<?php
class Admin_Form_Section extends Zend_Form
{
    private $_id;
    private $_action = "/admin/section/add";
    public function init()
    {
        $options = $this->getAttribs();
        if (isset($options['id'])) {
            $this->_id = $options['id'];
            $this->_action = "/admin/section/edit?id=$this->id";
        }
        $this->setAction($this->_action);
        $this->setName('sectionForm');
        $section_title = new Zend_Form_Element_Text('section_title');
        $section_title->setLabel('Title:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $section_text = new Zend_Form_Element_Textarea('section_text');
        $section_text->setLabel('Header:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('StringTrim');
        $keywords = new Zend_Form_Element_Text('keywords');
        $keywords->setLabel('Keywords:')->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $this->addElement($section_title)->addElement($section_text)->addElement($keywords);
        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addElement('button', 'preview', array('type' => 'submit', 'label' => 'Preview', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('submit', 'cancel', 'preview'), 'submitButtons', array('order' => 4, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
        if (isset($this->_id)) {
            $this->addElement('hidden', 'section_id', array('value' => $this->_id));
        }
    }
}
