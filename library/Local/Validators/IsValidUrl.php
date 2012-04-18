<?php
class Local_Validators_IsValidUrl extends Zend_Validate_Abstract
{
    const INVALID_URL = 'invalidUrl';
    protected $_messageTemplates = array(self::INVALID_URL => "'%value%' is not a valid http: URL.",);
    public function isValid($value)
    {
        $valueString = (string)$value;
        $this->_setValue($valueString);
        if (preg_match('/^.*:\/\//', $valueString) && !preg_match('/^.*http:\/\//', $valueString)) {
            return false;
        }
        if ($this->url_exists($value)) {
            return true;
        }
        return false;
    }
    function url_exists($url)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_HEADER, 1); //get the header
        curl_setopt($c, CURLOPT_NOBODY, 1); //and *only* get the header
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); //get the response as a string from curl_exec(), rather than echoing it
        curl_setopt($c, CURLOPT_FRESH_CONNECT, 1); //don't use a cached version of the url
        if (!curl_exec($c)) {
            return false;
        } else {
            return true;
        }
    }
}
