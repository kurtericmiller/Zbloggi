<?php
class Admin_Form_Menu extends Zend_Form
{
  private $_id;
  private $_action = "/admin/menu/add";
  public function init()
  {
    $options = $this->getAttribs();
    if (isset($options['id'])) {
      $this->_id = $options['id'];
      $this->_action = "/admin/menu/edit?id=$this->id";
    }
    $this->setAction($this->_action);
    $this->setName('menusForm');
    $menus_menu = new Zend_Form_Element_Text('menus_menu');
    $menus_menu->setLabel('Menu:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($menus_menu);
    $menus_title = new Zend_Form_Element_Text('menus_title');
    $menus_title->setLabel('Title:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($menus_title);
    $menus_link = new Zend_Form_Element_Text('menus_link');
    $menus_link->setLabel('Link:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($menus_link);
    $menus_ordering = new Zend_Form_Element_Text('menus_ordering');
    $menus_ordering->setLabel('Order:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($menus_ordering);
    $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addDisplayGroup(array('submit', 'cancel'), 'submitButtons', array('order' => 4, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
    if (isset($this->_id)) {
      $this->addElement('hidden', 'menus_id', array('value' => $this->_id));
    }
  }
}
