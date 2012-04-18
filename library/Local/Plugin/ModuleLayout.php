<?php
class Local_Plugin_ModuleLayout extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $front = Zend_Controller_Front::getInstance();
        $layout = $front->getParam('bootstrap')->getResource('layout');
        $module = strtolower($request->getModuleName());
        if ($module !== 'default') {
            $layout->nestedLayout = $module;
        }
    }
}
