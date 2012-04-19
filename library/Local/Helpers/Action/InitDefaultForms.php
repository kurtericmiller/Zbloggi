<?php
class Action_Helper_InitDefaultForms extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {

        $ac = $this->getActionController();
        $view = $ac->view;
        /* 
          KEM: 04/19/12 This patch prevents the dojo helper from unintentionally loading 
          NOTE: required to prevent a conflict with syntaxHighlighter
        */
        $loader = $view->getPluginLoader('helper');
        if ($loader->getPaths('Zend_Dojo_View_Helper')) {
          $loader->removePrefixPath('Zend_Dojo_View_Helper');
        }   
        $options['module'] = 'search';
        $view->searchForm = $ac->getHelper('formLoader')->loadForm('search', $options);
        $options['module'] = 'default';
        $view->contactform = $ac->getHelper('formLoader')->loadForm('contact', $options);
        $view->consoleMessages = $ac->getHelper('FlashMessenger')->getMessages();
    }
}
