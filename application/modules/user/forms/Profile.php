<?php
class User_Form_Profile extends Zend_Form
{
    public function init()
    {
        $options = $this->getAttribs();
        $action = "/user/profiles";
        if (isset($options['id'])) {
            $action = "/user/profiles?id=" . $options['id'];
            $this->addElement('hidden', 'user_id', array('value' => $options['id']));
        }
        $this->setAction($action);
        $this->setName('profileForm');
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $first = new Zend_Form_Element_Text('first');
        $first->setLabel('First:')->setRequired(true)->addValidator('NotEmpty', true)->addValidator('StringLength', true, array(0, 30))->addErrorMessage("An entry between 0-30 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $last = new Zend_Form_Element_Text('last');
        $last->setLabel('Last:')->setRequired(true)->addValidator('NotEmpty', true)->addValidator('StringLength', true, array(0, 30))->addErrorMessage("An entry between 0-30 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $middle = new Zend_Form_Element_Text('middle');
        $middle->setLabel('Middle:')->setRequired(false)->addValidator('NotEmpty', true)->addValidator('StringLength', true, array(0, 30))->addErrorMessage("An entry between 0-30 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $occupation = new Zend_Form_Element_Text('occupation');
        $occupation->setLabel('Occupation:')->setRequired(false)->addValidator('NotEmpty', true)->addValidator('StringLength', true, array(0, 50))->addErrorMessage("An entry between 0-50 in length is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $website = new Zend_Form_Element_Text('website');
        $website->setLabel('Website:')->setRequired(false)->addValidator(new Local_Validators_IsValidUrl())->addErrorMessage("A valid http: URL is required.")->addFilter('HtmlEntities')->addFilter('StringTrim');
        $bio_text = new Zend_Form_Element_TextArea('bio_text');
        $bio_text->setLabel('Bio:')->setRequired(false)->addFilter('HtmlEntities')->addFilter('StringTrim');
        $avatar = new Zend_Form_Element_Radio('avatar', array('escape' => false));
        $avatar->setLabel('Either Select an Avatar:')->setRequired(false)->setSeparator('')->addFilter('StringTrim');
        $am = new Local_Domain_Mappers_AvatarMapper();
        $ac = $am->findAll();
        foreach ($ac as $a) {
            $img = '<img src="/images/avatars/' . $a->get('image_name') . '" width="100px" height="100px">' . $a->get('image_name') . '</img>';
            $avatar->addMultiOption($a->get('image_name'), $img);
        }
        $upavatar = new Zend_Form_Element_File('upavatar');
        $upavatar->setLabel('Or Upload Your Own: (Maximum: 100K, 125px x 125px)')->setRequired(false)->setDestination(APPLICATION_ROOT . '/public/images/upavatars')->addValidator('Count', false, 1)->addValidator('Size', false, 102400)->addValidator('Extension', false, 'jpg,png,gif');
        $this->addElement($first)->addElement($middle)->addElement($last)->addElement($occupation)->addElement($website)->addElement($bio_text)->addElement($avatar);
        $this->addElement($upavatar);
        $this->addElement('button', 'cancel', array('type' => 'submit', 'label' => 'Cancel', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addElement('button', 'submit', array('type' => 'submit', 'label' => 'Submit', 'class' => 'button', 'decorators' => array('ViewHelper',),));
        $this->addDisplayGroup(array('first', 'middle', 'last', 'occupation', 'website', 'bio_text', 'avatar'), 'fields', array('legend' => 'Enter profile Info for ' . $options['username'] . ' at ' . $options['email'], 'decorators' => array('FormElements', array('Fieldset', array('class' => 'formFields')),),));
        $this->addDisplayGroup(array('upavatar'), 'upload', array('decorators' => array('FormElements', array('Fieldset', array('class' => 'upavatar')),),));
        $this->addDisplayGroup(array('submit', 'cancel'), 'submitButtons', array('order' => 6, 'decorators' => array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'element')),),));
    }
}
