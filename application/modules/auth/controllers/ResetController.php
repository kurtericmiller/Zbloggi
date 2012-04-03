<?php
class Auth_ResetController extends Zend_Controller_Action
{
  private $_originalUrl = '/';
  public function preDispatch()
  {
    $session = new Zend_Session_Namespace('lastRequest');
    if (isset($session->lastRequestUri)) {
      $this->_originalUrl = $session->lastRequestUri;
    }
  }
  public function indexAction()
  {
    $logflash = $this->_helper->getHelper('FlashMessenger');
    $logflash->setNameSpace('log');
    $this->view->messages = $logflash->getMessages();
    $form = $this->_helper->formLoader('reset');
    if ($this->_request->isPost()) {
      if (array_key_exists('cancel', $_POST)) {
        $this->_redirect($this->_originalUrl);
      }
      $formData = $this->_request->getPost();
      if ($form->isValid($formData)) {
        if ($this->_process($_POST)) {
          $logflash->addMessage('<span class="fmessage">New password sent.</span>');
        } else {
          $logflash->addMessage('<span class="fmessage">Unknown email address, try again.</span>');
        }
        $this->_redirect('/auth/reset');
      }
    }
    $this->view->form = $form;
  }
  private function _process($values)
  {
    $user = new Local_Domain_Mappers_UserMapper();
    if ($user->exists(array('field' => 'email', 'value' => '"' . $values['email'] . '"'))) {
      $id = $user->findByEmail($values['email']);
      $u = $user->find($id);
      $newpw = $this->_helper->rand_string(8, false, true);
      $opts = $this->getInvokeArg('bootstrap')->getOptions();
      $salt = $opts['salt'];
      $pw = SHA1($newpw . $salt);
      $u->set('password', $pw);
      $body = 'Your request for a new access code has been received. Please use "' . $newpw . '" to log in. Note: There are no numbers in this new code.';
      $this->_helper->mailer('noreply@ymozend.com', $values['email'], $body, 'Information from YMOZ');
      return true;
    } else {
      return false;
    }
  }
}
