<?php
class Auth_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setAction('/auth')->setMethod('post');
        $this->setName('loginForm');
        $email = new Zend_Form_Element_Text('email');
        //$email->setLabel('Email:')->setRequired(true)->addValidator('EmailAddress')->addErrorMessage("Valid Email is required")->addFilter('HtmlEntities')->addFilter('StringToLower')->addFilter('StringTrim');
        $email->setLabel('Email or Username:')->setRequired(true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')->setRequired(true)->addErrorMessage("Password is required")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $this->addElement($email)->addElement($password);
        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Login', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addElement('button', 'register', array('type' => 'submit', 'label' => 'Register', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('submit', 'register',), 'submitButtons', array('order' => 4, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
        $this->addDisplayGroup(array('email', 'password'), 'fields', array('legend' => 'Login', 'decorators' => array('FormElements', array('Fieldset', array('class' => 'formFields')),),));
    }
}
