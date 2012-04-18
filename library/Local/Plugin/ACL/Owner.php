<?php
class Local_Plugin_ACL_Owner implements Zend_Acl_Assert_Interface
{
    public function assert(Zend_Acl $acl, Zend_Acl_Role_Interface $role = null, Zend_Acl_Resource_Interface $resource = null, $privilege = null)
    {
        return $this->_isOwned($acl);
    }
    protected function _isOwned($acl)
    {
        if ($acl->_userId === $acl->_articleUserId) {
            return true;
        } else {
            return false;
        }
    }
}
