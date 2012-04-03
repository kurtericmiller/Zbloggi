<?php
class Admin_Form_Book extends Zend_Form
{
  private $_id;
  private $_action = "/admin/book/add";
  public function init()
  {
    $options = $this->getAttribs();
    if (isset($options['id'])) {
      $this->_id = $options['id'];
      $this->_action = "/admin/book/edit?id=$this->id";
    }
    $this->setAction($this->_action);
    $this->setName('booksForm');
    $books_title = new Zend_Form_Element_Text('books_title');
    $books_title->setLabel('Title:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($books_title);
    $books_author = new Zend_Form_Element_Text('books_author');
    $books_author->setLabel('Author:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($books_author);
    $books_image = new Zend_Form_Element_Text('books_image');
    $books_image->setLabel('Image:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($books_image);
    $books_link = new Zend_Form_Element_Text('books_link');
    $books_link->setLabel('Link:')->setRequired(true)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
    $this->addElement($books_link);
    $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addDisplayGroup(array('submit', 'cancel'), 'submitButtons', array('order' => 4, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
    if (isset($this->_id)) {
      $this->addElement('hidden', 'books_id', array('value' => $this->_id));
    }
  }
}
