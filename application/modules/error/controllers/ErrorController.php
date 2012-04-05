<?php
class Error_ErrorController extends Zend_Controller_Action
{
    private $_environment;
    private $_error;
    private $_notifier;
    private $_exception;
    private $_message;
    public function init()
    {
        parent::init();
        $bootstrap = $this->getInvokeArg('bootstrap');
        $database = Zend_Registry::get('db');
        $profiler = $database->getProfiler();
        $mailer = new Zend_Mail();
        $session = new Zend_Session_Namespace();
        $this->_environment = $bootstrap->getEnvironment();
        $this->_error = $this->_getParam('error_handler');
        $this->_exception = preg_replace('/#/', '<br>#', $this->_error->exception);
        $this->_message = preg_replace('/#/', '<br>#', $this->_error->exception->getMessage());
        $this->_notifier = new Local_Service_Error_Notifier($this->_environment, $this->_error, $mailer, $session, $profiler, $_SERVER);
        $this->_helper->layout()->nestedLayout = 'error';
        $this->view->message = $this->_message;
    }
    public function errorAction()
    {
        switch ($this->_error->type) {
        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            $this->view->type = 'Navigation Error';
            $this->view->advice = 'Please enter a valid URL...';
            break;

        default:
            $this->_applicationError();
            break;
        }
        if ($log = $this->_getLog()) {
            $log->crit($this->_exception, $this->_message);
        }
    }
    public function sqlerrorAction()
    {
        $this->view->type = 'SQL Error';
        $this->view->advice = 'The administrator was notified of this error. We apologize for any inconvenience';
        $this->render('error');
        if ($log = $this->_getLog()) {
            $log->crit($this->_exception, $this->_message);
        }
    }
    public function aclerrorAction()
    {
        $this->_message.= " ( ACL:" . $this->_request->getRequestUri() . " )";
        $this->view->message = $this->_message;
        $this->view->type = 'ACL Error';
        $this->view->advice = 'This URL is protected.  Please contact the administrator for further assistance...';
        $this->render('error');
        if ($log = $this->_getLog()) {
            $log->crit($this->_exception, $this->_message);
        }
    }
    public function apperrorAction()
    {
        $this->view->type = 'Application Error';
        $this->view->advice = 'The administrator was notified of this error. We apologize for any inconvenience';
        $this->render('error');
        if ($log = $this->_getLog()) {
            $log->crit($this->_exception, $this->_message);
        }
    }
    private function _applicationError()
    {
        $fullMessage = $this->_notifier->getFullErrorMessage();
        $shortMessage = $this->_notifier->getShortErrorMessage();
        $errors = $this->_getParam('error_handler');
        $this->view->error = $errors->type;
        switch ($this->_environment) {
        case 'production':
            $this->view->message = $shortMessage;
            break;

        case 'staging':
            $this->view->message = $shortMessage;
            break;

        case 'test':
            $this->_helper->viewRenderer->setNoRender();
            $this->getResponse()->appendBody($fullMessage);
            break;

        default:
            $this->getResponse()->clearBody();
            $this->view->message = nl2br($fullMessage);
        }
        $this->_notifier->notify();
    }
    private function _getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasPluginResource('log')) {
            return false;
        }
        $log = $bootstrap->getResource('log');
        return $log;
    }
}
