<?php
class Local_Plugin_ACL_Acl extends Zend_Acl
{
    private $_userId;
    private $_articleUserId;
    public function __construct()
    {
        // setup roles
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('user'), 'guest');
        $this->addRole(new Zend_Acl_Role('author'), 'user');
        $this->addRole(new Zend_Acl_Role('admin'));
        // setup resources
        $this->add(new Zend_Acl_Resource('blog:comment:index:post'));
        $this->add(new Zend_Acl_Resource('xmlrpc:client:index'));
        $this->add(new Zend_Acl_Resource('admin:article:add'));
        $this->add(new Zend_Acl_Resource('admin:article:index'));
        $this->add(new Zend_Acl_Resource('admin:article:index:post'));
        $this->add(new Zend_Acl_Resource('admin:article:edit:post'));
        $this->add(new Zend_Acl_Resource('admin:article:edit:id'));
        $this->add(new Zend_Acl_Resource('admin:article:delete:id'));
        $this->add(new Zend_Acl_Resource('admin:article:publish'));
        $this->add(new Zend_Acl_Resource('admin:article:publish:id'));
        $this->add(new Zend_Acl_Resource('admin:article:publish:post'));
        // $this->add(new Zend_Acl_Resource('admin:index:index'));
        $this->add(new Zend_Acl_Resource('admin:comment:index'));
        $this->add(new Zend_Acl_Resource('admin:user:index'));
        $this->add(new Zend_Acl_Resource('admin:user:add'));
        $this->add(new Zend_Acl_Resource('admin:user:edit:id'));
        $this->add(new Zend_Acl_Resource('admin:user:delete:id'));
        $this->add(new Zend_Acl_Resource('admin:book:index'));
        $this->add(new Zend_Acl_Resource('admin:book:add'));
        $this->add(new Zend_Acl_Resource('admin:book:edit:id'));
        $this->add(new Zend_Acl_Resource('admin:book:delete:id'));
        $this->add(new Zend_Acl_Resource('admin:section:index'));
        $this->add(new Zend_Acl_Resource('admin:section:index:id'));
        $this->add(new Zend_Acl_Resource('admin:section:index:post'));
        $this->add(new Zend_Acl_Resource('admin:config:index'));
        $this->add(new Zend_Acl_Resource('admin:config:index:id'));
        $this->add(new Zend_Acl_Resource('admin:config:index:post'));
        $this->add(new Zend_Acl_Resource('admin:index:search'));
        $this->add(new Zend_Acl_Resource('admin:index:search:id'));
        $this->add(new Zend_Acl_Resource('admin:index:search:post'));
        //setup privileges
        $this->allow('admin');
        $this->allow('user', 'blog:comment:index:post');
        $this->allow('author', 'admin:article:add');
        $this->allow('author', 'admin:article:index');
        $this->allow('author', 'admin:article:index:post');
        $this->allow('author', 'admin:article:edit:post', null, new Local_Plugin_ACL_Owner());
        $this->allow('author', 'admin:article:edit:id', null, new Local_Plugin_ACL_Owner());
        $this->allow('author', 'admin:article:delete:id', null, new Local_Plugin_ACL_Owner());
    }
    public function setOwner($user, $article_id)
    {
        $this->_userId = $user->id;
        $am = new Local_Domain_Mappers_ArticleMapper();
        $a = $am->find($article_id);
        $this->_articleUserId = $a->get('user_id');
    }
}
