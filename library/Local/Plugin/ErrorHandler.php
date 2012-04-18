<?php
class Local_Plugin_ErrorHandler extends Zend_Controller_Plugin_ErrorHandler
{
    const EXCEPTION_SQL = 'EXCEPTION_SQL';
    const EXCEPTION_ACL = 'EXCEPTION_ACL';
    const EXCEPTION_APPLICATION = 'EXCEPTION_APPLICATION';
    private $_action;
    protected function _handleError(Zend_Controller_Request_Abstract $request)
    {
        $frontController = Zend_Controller_Front::getInstance();
        $response = $this->getResponse();
        if ($this->_isInsideErrorHandlerLoop) {
            $exceptions = $response->getException();
            if (count($exceptions) > $this->_exceptionCountAtFirstEncounter) {
                // TODO: Not sure if I agree with this behaviour
                // Exception thrown by error handler; tell the front controller
                // to throw it
                //$frontController->throwExceptions(true);
                //throw array_pop($exceptions);
                
            }
        }
        // check for an exception AND allow the error handler controller the
        // option to forward
        if (($response->isException()) && (!$this->_isInsideErrorHandlerLoop)) {
            $this->_isInsideErrorHandlerLoop = true;
            // Get exception information
            $error = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
            $exceptions = $response->getException();
            $exception = $exceptions[0];
            $exceptionType = get_class($exception);
            $error->exception = $exception;
            $this->_action = 'error';
            switch ($exceptionType) {
            case 'Zend_Controller_Router_Exception':
                if (404 == $exception->getCode()) {
                    $error->type = self::EXCEPTION_NO_ROUTE;
                } else {
                    $error->type = self::EXCEPTION_OTHER;
                }
                break;

            case 'Zend_Controller_Dispatcher_Exception':
                $error->type = self::EXCEPTION_NO_CONTROLLER;
                break;

            case 'Zend_Controller_Action_Exception':
                if (404 == $exception->getCode()) {
                    $error->type = self::EXCEPTION_NO_ACTION;
                } else {
                    $error->type = self::EXCEPTION_OTHER;
                }
                break;

            case 'Local_Exceptions_SqlException':
                $error->type = self::EXCEPTION_SQL;
                $this->_action = 'sqlerror';
                break;

            case 'Local_Exceptions_AclException':
                $error->type = self::EXCEPTION_ACL;
                $this->_action = 'aclerror';
                break;

            case 'Local_Exceptions_AppException':
                $error->type = self::EXCEPTION_APPLICATION;
                $this->_action = 'apperror';
                break;

            default:
                $error->type = self::EXCEPTION_OTHER;
                break;
            }
            // Keep a copy of the original request
            $error->request = clone $request;
            // get a count of the number of exceptions encountered
            $this->_exceptionCountAtFirstEncounter = count($exceptions);
            // Forward to the error handler
            $request->setParam('error_handler', $error)->setModuleName('error')->setControllerName($this->getErrorHandlerController())->setActionName($this->_action)->setDispatched(false);
        }
    }
}
