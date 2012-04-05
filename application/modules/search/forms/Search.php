<?php
class Search_Form_Search extends Zend_Form
{
    public function init()
    {
        // initialize form
        $this->setAction('/search')->setMethod('get');
        $this->setName('searchForm');
        // create text input for search
        $search_text = new Zend_Form_Element_Text('search_text');
        $search_text->setLabel('Search')->setOptions(array('size' => '20'))->addValidator('NotEmpty', true)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $search_text->setDecorators(array(array('ViewHelper'), array('Errors'),));
        // create submit button
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search')->setOptions(array('class' => 'submit'));
        $submit->setDecorators(array(array('ViewHelper'),));
        // attach elements to form
        $this->addElement($search_text)->addElement($submit);
    }
}
