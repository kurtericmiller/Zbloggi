<?php
class View_Helper_LoggedInAs extends Zend_View_Helper_Abstract
{
    public function loggedInAs()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $username = $auth->getIdentity()->username;
            $logoutUrl = '/auth/index/logout';
            if ($auth->getIdentity()->role == 'admin') {
                $admin = ' &bull; <a href=/admin/article>Admin</a>';
            } else {
                $admin = '';
            }
            return 'Welcome: <span class="userName">' . $username . '</span> &gt; <a href="' . $logoutUrl . '">Log out</a> &bull; <a href="/user/profiles">Profile</a>' . $admin;
        }
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        if ($controller == 'auth' && $action == 'index') {
            return '';
        }
        $loginUrl = "/auth";
        $signup = ' <a href="/user/registration">Sign Up</a>';
        return '<a href="' . $loginUrl . '">Login</a> | ' . $signup;
    }
}
