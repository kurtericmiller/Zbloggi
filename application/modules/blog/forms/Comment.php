<?php
class Blog_Form_Comment extends Zend_Form
{
  public function init()
  {
    $options = $this->getAttribs();
    $this->setAction("/blog/comment?id=" . $options['id'])->setMethod('post');
    $this->setName('commsForm');
    $comment_text = new Zend_Form_Element_Textarea('comment_text');
    $comment_text->setLabel('Comment:')->setRequired(true)->setAttrib('rows', 8)->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringToLower')->addFilter('StringTrim');
    $this->addElement($comment_text);
    $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
    $this->addDisplayGroup(array('submit',), 'submitButtons', array('order' => 4, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
  }
}
