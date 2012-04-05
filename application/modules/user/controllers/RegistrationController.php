<?php
class User_RegistrationController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $flasher = $this->_helper->getHelper('FlashMessenger');
        $flasher->setNameSpace('user');
        $this->view->messages = $flasher->getMessages();
        $form = $this->_helper->formLoader('register');
        if ($this->_request->isPost()) {
            if (array_key_exists('cancel', $_POST)) {
                $this->_redirect('/');
            }
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $this->addUser($formData);
                $flasher->addMessage('Thank you. An email has been sent to complete your registration.');
                $this->_redirect('/user/registration');
            } else {
                $form->populate($formData);
            }
        }
        $this->view->form = $form;
    }
    private function addUser($values)
    {
        $opts = $this->getInvokeArg('bootstrap')->getOptions();
        $salt = $opts['salt'];
        $pw = SHA1($values['password'] . $salt);
        $user = new Local_Domain_Models_User();
        $user->set('email', $values['email']);
        $user->set('username', $values['username']);
        $user->set('password', $pw);
        $user->set('role', 'guest');
        $user->finder()->insert($user);
        $reg_string = $this->_helper->rand_string(20);
        $body = "Welcome to 'Your Moment of Zend'. Thank you for registering.\n" . "\n" . "Please complete the registration process by clicking on the following link:\n" . "\n" . "http://www.ymozend.com/user/registration/confirm?reg=" . $reg_string . "\n" . "\n" . "or cut and paste the above in to your browser.\n" . "\n" . "Be sure to fill out your profile once you've logged in. See you soon.\n";
        $this->_helper->mailer('noreply@www.ymozend.com', $values['email'], $body, 'Your Moment of Zend');
        $reg = new Local_Domain_Models_Registration();
        $um = new Local_Domain_Mappers_UserMapper();
        $uid = $um->findByEmail($values['email']);
        $reg->set('user_id', $uid);
        $reg->set('reg_string', $reg_string);
        $reg->finder()->insert($reg);
    }
    public function confirmAction()
    {
        $reg_string = $this->_getParam('reg', null);
        if (null !== $reg_string) {
            $rm = new Local_Domain_Mappers_RegistrationMapper();
            $um = new Local_Domain_Mappers_UserMapper();
            $rid = $rm->findByReg($reg_string);
            if ($rid == 0) {
                $this->_redirect('/');
            }
            $r = $rm->find($rid);
            $u = $um->find($r->get('user_id'));
            $u->set('role', 'user');
            $r->finder()->delete($r);
        } else {
            $this->_redirect('/');
        }
    }
}
