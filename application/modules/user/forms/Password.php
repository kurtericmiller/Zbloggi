<?php
class User_Form_Password extends Zend_Form
{
  private $_id;
  public function init()
  {
    $options = $this->getAttribs();
    $action = "/user";
    if (isset($options['id'])) {
      $this->_id = $options['id'];
      $action = "/user";
      $this->addElement('hidden', 'user_id', array('value' => $this->_id));
    }
    $this->setAction($action);
    $this->setName('passwordForm');
    $this->setMethod('post');
    $password = new Zend_Form_Element_Password('password');
    $password->setLabel('Password:')->setRequired(true)->addValidator('StringLength', true, array(6, 20))->addErrorMessage("A password between 6-20 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
    $pwmatch = new Zend_Form_Element_Password('pwmatch');
    $pwmatch->setLabel('Confirm Password:')->setRequired(true)->addValidator('NotEmpty', true)->addValidator('Identical', false, array('token' => 'password'))->addErrorMessage("Password must match")->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($password)->addElement($pwmatch);
    $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addDisplayGroup(array('username', 'email', 'password', 'pwmatch'), 'fields', array('legend' => 'Change Password:', 'decorators' => array('FormElements', array('Fieldset', array('class' => 'formFields')),),));
    $this->addDisplayGroup(array('submit', 'cancel'), 'submitButtons', array('order' => 3, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
  }
}
