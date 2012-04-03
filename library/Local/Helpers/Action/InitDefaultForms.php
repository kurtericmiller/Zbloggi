<?php
class Action_Helper_InitDefaultForms extends Zend_Controller_Action_Helper_Abstract
{
  public function preDispatch()
  {
    $ac = $this->getActionController();
    $view = $ac->view;
    $options['module'] = 'search';
    $view->searchForm = $ac->getHelper('formLoader')->loadForm('search', $options);
    $options['module'] = 'default';
    $view->contactform = $ac->getHelper('formLoader')->loadForm('contact', $options);
    $view->consoleMessages = $ac->getHelper('FlashMessenger')->getMessages();
  }
}
