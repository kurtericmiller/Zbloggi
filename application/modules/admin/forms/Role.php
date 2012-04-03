<?php
class Admin_Form_Role extends Zend_Form
{
  private $_action = "/admin/user/role";
  public function init()
  {
    $options = $this->getAttribs();
    if (isset($options['id'])) {
      $action = "/admin/user/role?id=" . $options['id'];
      $this->addElement('hidden', 'user_id', array('value' => $options['id']));
    }
    $this->setAction($this->_action);
    $this->setMethod('post');
    $role = new Zend_Form_Element_Select('role');
    $role->setLabel('Role:')->addMultiOptions(array('admin' => 'administrator', 'author' => 'article author', 'user' => 'registered user'));
    $this->addElement($role);
    $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addDisplayGroup(array('submit', 'cancel',), 'submitButtons', array('order' => 3, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
  }
}
