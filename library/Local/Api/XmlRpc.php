<?php
abstract class Local_Api_XmlRpc
{
    /**
     * This is the function login
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function login($username, $password)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $adapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $opts = Zend_Registry::getInstance();
        $salt = $opts['config']['salt'];
        $adapter->setTableName('users')->setIdentityColumn('email')->setCredentialColumn('password')->setCredentialTreatment("SHA1(CONCAT(?,'" . $salt . "'))"); $adapter->setIdentity($username);
        $adapter->setCredential($password);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $this->_user = $user;
            return true;
        } else {
            throw new Local_Api_Exception('Authorization failed', 401);
            return false;
        }
    }
    /**
     * This is the function test
     *
     * @return string 
     */
    public function test()
    {
        return "Test was successful";
    }
    /**
     * This is the function testLogin
     *
     * @param string $username
     * @param string $password
     * @return string
     */
    public function testLogin($username, $password)
    {
        if (!$this->login($username, $password)) {
            return 'Failure: name = ' . $username . ', password = ' . $password . ', id = ' . $this->_user->id . ', role = ' . $this->_user->role;
        } else {
            return 'Success: name = ' . $username . ', password = ' . $password . ', id = ' . $this->_user->id . ', role = ' . $this->_user->role;
        }
    }
}
