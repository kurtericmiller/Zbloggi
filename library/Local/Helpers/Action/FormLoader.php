<?php
/**
 * Action Helper for loading forms
 *
 * @uses Zend_Controller_Action_Helper_Abstract
 */
class Action_Helper_FormLoader extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var Zend_Loader_PluginLoader
     */
    public $pluginLoader;
    /**
     * Constructor: initialize plugin loader
     *
     * @return void
     */
    public function __construct()
    {
        $this->pluginLoader = new Zend_Loader_PluginLoader();
    }
    /**
     * Load a form with the provided options
     *
     * @param  string $name
     * @param  array|Zend_Config $options
     * @return Zend_Form
     */
    public function loadForm($name, $options = null)
    {
        $hasModule = (isset($options) && array_key_exists('module', $options)) ? true : false;
        $module = ($hasModule) ? $options['module'] : $this->getRequest()->getModuleName();
        $front = $this->getFrontController();
        $default = $front->getDispatcher()->getDefaultModule();
        if (empty($module)) {
            $module = $default;
        }
        $moduleDirectory = $front->getControllerDirectory($module);
        $formsDirectory = dirname($moduleDirectory) . '/forms';
        $prefix = (('default' == $module) ? '' : ucfirst($module) . '_') . 'Form_';
        $this->pluginLoader->addPrefixPath($prefix, $formsDirectory);
        $name = ucfirst((string)$name);
        $formClass = $this->pluginLoader->load($name);
        return new $formClass($options);
    }
    /**
     * Strategy pattern: call helper as broker method
     *
     * @param  string $name
     * @param  array|Zend_Config $options
     * @return Zend_Form
     */
    public function direct($name, $options = null)
    {
        return $this->loadForm($name, $options);
    }
}
