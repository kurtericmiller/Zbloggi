<?php
/**
 *   Exception class for Local_Api
 *
 *   @category    Exceptions
 *   @package     Local_Api
 *   @author      Kao Saelee <me AT kaosaelee DOT com>, mods by Bruce Findleton
 *   @license     http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 */
class Local_Api_Exception extends Exception
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
