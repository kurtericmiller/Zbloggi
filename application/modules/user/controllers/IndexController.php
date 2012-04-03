<?php
class User_IndexController extends Zend_Controller_Action
{
  public function indexAction()
  {
    $auth = Zend_Auth::getInstance();
    if ($auth->hasIdentity()) {
      $uid = $auth->getIdentity()->id;
      $form = $this->_helper->formLoader('password', array('id' => $uid));
    } else {
      $this->_redirect('/');
    }
    if ($this->_request->isPost()) {
      if (array_key_exists('cancel', $_POST)) {
        $this->_redirect('/user/profiles');
      }
      $formData = $this->_request->getPost();
      if ($form->isValid($formData)) {
        $this->updateUser($formData);
        $this->_redirect('/user/profiles');
      } else {
        $form->populate($formData);
      }
    }
    $this->view->form = $form;
  }
  private function updateUser($values)
  {
    $opts = $this->getInvokeArg('bootstrap')->getOptions();
    $salt = $opts['salt'];
    $pw = SHA1($values['password'] . $salt);
    $user = new Local_Domain_Mappers_UserMapper();
    $u = $user->find($values['user_id']);
    $u->set('password', $pw);
    $u->finder()->update($u);
  }
}
