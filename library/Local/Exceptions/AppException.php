<?php
class Local_Exceptions_AppException extends Exception
{
  // Redefine the exception so message isn't optional
  public function __construct($message)
  {
    parent::__construct($message);
  }
}
