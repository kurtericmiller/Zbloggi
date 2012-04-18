<?php
class User_Form_Register extends Zend_Form
{
    private $_id;
    public function init()
    {
        //$publickey = '6LdQp80SAAAAAEspPGYjWotB2W-t3bkTqCV9Ircu';
        //$privatekey = '6LdQp80SAAAAAOXf-_jAaJXjJb6TuqiV1nv7Eq3J';
        //$_recaptcha = new Zend_Service_ReCaptcha($publickey, $privatekey);
        $options = $this->getAttribs();
        $action = "/user/registration";
        if (isset($options['id'])) {
            $this->_id = $options['id'];
            $action = "/user/registration/edit";
            $this->addElement('hidden', 'user_id', array('value' => $this->_id));
        }
        $this->setAction($action);
        $this->setName('registerForm');
        $this->setMethod('post');
        $this->setLegend('Registration Info:');
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:')->setRequired(true)->addValidator('NotEmpty', true)->addValidator('StringLength', true, array(6, 20))->addErrorMessage("A username between 6-20 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')->setRequired(true)->addValidator('EmailAddress', true, array('messages' => array('emailAddressInvalidFormat' => 'A valid email address is required')))->addValidator('Db_NoRecordExists', true, array('table' => 'users', 'field' => 'email', 'messages' => array('recordFound' => 'This email is already registered.')))->addFilter('HtmlEntities')->addFilter('StringTrim');
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')->setRequired(true)->addValidator('StringLength', true, array(6, 20))->addErrorMessage("A password between 6-20 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $pwmatch = new Zend_Form_Element_Password('pwmatch');
        $pwmatch->setLabel('Confirm Password:')->setRequired(true)->addValidator('NotEmpty', true)->addValidator('Identical', false, array('token' => 'password'))->addErrorMessage("Password must match")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $captcha = new Zend_Form_Element_Captcha('captcha', array('label' => 'Human or Bot?:', 'captcha' => 'Image', 'captchaOptions' => array('captcha' => 'Image', 'wordLen' => 4, 'fontSize' => 30, 'font' => '/font/arial.ttf', 'dotNoiseLevel' => 10, 'lineNoiseLevel' => 1)));
        $this->addElement($username)->addElement($email)->addElement($password)->addElement($pwmatch)->addElement($captcha);
        $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('username', 'email', 'password', 'pwmatch', 'captcha'), 'fields', array('legend' => 'Registration Info:', 'decorators' => array('FormElements', array('Fieldset', array('class' => 'formFields')),),));
        $this->addDisplayGroup(array('submit', 'cancel'), 'submitButtons', array('order' => 5, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element reg')),),));
    }
}
