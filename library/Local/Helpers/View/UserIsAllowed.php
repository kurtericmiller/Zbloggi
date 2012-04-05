<?php
class View_Helper_UserIsAllowed extends Zend_View_Helper_Abstract
{
    public function UserIsAllowed($entity_id, $user)
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $role = $auth->getIdentity()->role;
            $id = $auth->getIdentity()->id;
            if ($user == $entity_id || $role == 'admin') {
                return true;
            }
        }
        return false;
    }
}
