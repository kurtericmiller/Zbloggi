<?php
class Local_Plugin_ACL extends Zend_Controller_Plugin_Abstract
{
  private $_article;
  private $_user;
  public function preDispatch(Zend_Controller_Request_Abstract $request)
  {
    $this->_article = null;
    $this->_user = null;
    $module = $request->getModuleName();
    $controller = $request->getControllerName();
    $action = $request->getActionName();
    if ($request->isPost()) {
      $post = ":post";
      $formData = $this->_request->getPost();
      if (array_key_exists('article_id', $formData)) {
        $this->_article = $formData['article_id'];
      }
    } else {
      $post = "";
    }
    $param = $request->getParam('id');
    if ($param === null || $post == ":post") {
      $id = "";
    } else {
      $id = ":id";
      $this->_article = $param;
    }
    $resource = $module . ":" . $controller . ":" . $action . $post . $id;
    $auth = Zend_Auth::getInstance();
    if ($auth->hasIdentity()) {
      $this->_user = $auth->getIdentity();
      $role = $this->_user->role;
    } else {
      $role = "guest";
    }
    $acl = new Local_Plugin_ACL_Acl();
    if ($acl->has($resource)) {
      if (null !== $this->_article && null !== $this->_user && strpos($resource, "article")) {
        $acl->setOwner($this->_user, $this->_article);
      }
      if (!$acl->isAllowed($role, $resource)) {
        throw new Local_Exceptions_AclException('Unauthorized Access');
      }
    }
    parent::preDispatch($request);
  }
}
