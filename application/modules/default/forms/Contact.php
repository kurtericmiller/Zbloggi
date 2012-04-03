<?php
class Form_Contact extends Zend_Form
{
  public function init()
  {
    $this->setAction('/default/index/contact');
    $this->setMethod('post');
    $this->setName('contactForm');
    $email = new Zend_Form_Element_Text('email');
    $email->setLabel('Email:')->setRequired(true)->addValidator('NotEmpty', true)->addValidator('EmailAddress')->addFilter('HtmlEntities')->addFilter('StringTrim');
    $bodytext = new Zend_Form_Element_Textarea('bodytext');
    $bodytext->setLabel('Message:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($email)->addElement($bodytext);
    $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Send', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addDisplayGroup(array('submit'), 'submitButtons', array('order' => 3, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
  }
}
