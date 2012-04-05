<?php
class Auth_Form_Reset extends Zend_Form
{
    public function init()
    {
        $this->setAction('/auth/reset')->setMethod('post');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')->setRequired(true)->addValidator('EmailAddress')->addErrorMessage("Valid Email is required")->addFilter('HtmlEntities')->addFilter('StringToLower')->addFilter('StringTrim');
        $this->addElement($email);
        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Send', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('submit',), 'submitButtons', array('order' => 4, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
        $this->addDisplayGroup(array('email'), 'fields', array('legend' => 'Get New Password', 'decorators' => array('FormElements', array('Fieldset', array('class' => 'formFields')),),));
    }
}
