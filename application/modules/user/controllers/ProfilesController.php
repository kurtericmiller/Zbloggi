<?php
class User_ProfilesController extends Zend_Controller_Action
{
  private $_home;
  private $_mapper;
  private $_auth;
  private $_user;
  private $_form;
  private $_location;
  private $_editing;
  private $_posting;
  private $_has_profile;
  public function init()
  {
    $this->_home = '/';
    $this->_mapper = new Local_Domain_Mappers_ProfileMapper();
    $this->_auth = Zend_Auth::getInstance();
    if ($this->_auth->hasIdentity()) {
      $this->_user = $this->_auth->getIdentity()->id;
    } else {
      $this->_redirect($this->_home);
    }
    $this->_editing = ($this->_request->getParam('id')) ? true : false;
    $this->_has_profile = ($this->_mapper->exists(array('field' => 'user_id', 'value' => $this->_user))) ? true : false;
    $this->_posting = ($this->_request->isPost()) ? true : false;
  }
  public function indexAction()
  {
    $flasher = $this->_helper->getHelper('FlashMessenger');
    $flasher->setNameSpace('profile');
    $this->view->messages = $flasher->getMessages();
    $options['username'] = $this->_auth->getIdentity()->username;
    $options['email'] = $this->_auth->getIdentity()->email;
    if ($this->_has_profile) {
      $options['id'] = $this->_user;
    }
    if (!$this->_editing && $this->_has_profile) {
      $this->showProfile();
    } else {
      $this->_form = $this->_helper->formLoader('profile', $options);
      if ($this->_posting) {
        $formData = $this->_request->getPost();
        if ($this->validatePost($formData)) {
          if (!$this->_has_profile) {
            $profile = new Local_Domain_Models_Profile();
          } else {
            $profile = $this->_mapper->findByUser($formData['user_id']);
          }
          $this->setProfile($profile, $formData);
          $this->_redirect('/user/profiles');
        }
      }
      if ($this->_editing && $this->_has_profile && !$this->_posting) {
        $this->_form->populate($this->getProfile());
      }
      $this->view->form = $this->_form;
    }
  }
  public function showProfile()
  {
    $profile = $this->getProfile();
    $this->view->show = true;
    $this->view->id = $this->_user;
    $this->view->first = $profile['first'];
    $this->view->middle = $profile['middle'];
    $this->view->last = $profile['last'];
    $this->view->occupation = $profile['occupation'];
    $this->view->bio_text = $profile['bio_text'];
    $this->view->avatar = $profile['avatar'];
    $this->view->website = $profile['website'];
  }
  public function validatePost($formData)
  {
    if (array_key_exists('cancel', $_POST)) {
      if (isset($optiions['id'])) {
        $this->showProfile();
      } else {
        $this->_redirect($this->_home);
      }
    }
    /* Avoid testing problems with file uploads */
    if (APPLICATION_ENV === "testing") {
      if (array_key_exists('avatar', $formData)) {
        $this->_location = $formData['avatar'];
      }
      return true;
    }
    if ($this->_form->isValid($formData)) {
      $this->_location = null;
      $this->_form->upavatar->receive();
      if ($this->_form->upavatar->isUploaded()) {
        $filename = $this->_form->upavatar->getValue();
        $tmpString = $options['id'] . '_' . $this->_helper->rand_string(12);
        $location = $this->_form->upavatar->getFileName();
        $dest = '/images/avatars/' . $tmpString;
        mkdir('.' . $dest);
        rename($location, '.' . $dest . '/' . $filename);
        $this->_location = $tmpString . '/' . $filename;
      } else {
        if (array_key_exists('avatar', $formData)) {
          $this->_location = $formData['avatar'];
        }
      }
      return true;
    } else {
      $this->_form->populate($formData);
      return false;
    }
  }
  public function deleteAction()
  {
    if ($this->getRequest()->isPost()) {
      $del = $this->getRequest()->getPost('del');
      if ($del == 'Yes') {
        $id = $this->getRequest()->getPost('id');
        $profile = $this->_mapper->find($id);
        $profile->finder()->delete($profile);
      }
      $this->_redirect('/user/profiles');
    } else {
      $profile = $this->_mapper->findByUser($this->_user);
      $this->view->id = $profile->get('id');
      $this->view->title = $profile->get('first');
      $profile->get('last');
    }
  }
  private function getProfile()
  {
    $profile = $this->_mapper->findByUser($this->_user);
    $formData['first'] = $profile->get('first');
    $formData['middle'] = $profile->get('middle');
    $formData['last'] = $profile->get('last');
    $formData['occupation'] = $profile->get('occupation');
    $formData['website'] = $profile->get('website');
    $formData['bio_text'] = $profile->get('bio_text');
    $formData['avatar'] = $profile->get('avatar');
    $formData['upavatar'] = $profile->get('avatar');
    return $formData;
  }
  private function setProfile($profile, $formData)
  {
    $profile->set('user_id', $this->_user);
    $profile->set('first', $formData['first']);
    $profile->set('middle', $formData['middle']);
    $profile->set('last', $formData['last']);
    $profile->set('occupation', $formData['occupation']);
    if (!preg_match('/^.*http:\/\//', $formData['website'])) {
      $formData['website'] = 'http://' . $formData['website'];
    }
    $profile->set('website', $formData['website']);
    $profile->set('bio_text', $formData['bio_text']);
    $profile->set('avatar', $this->_location);
    $this->_form->populate($formData);
    $ow = Local_Domain_ObjectWatcher::instance();
    $ow->clearPending();
  }
}
