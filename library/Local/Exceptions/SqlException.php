<?php
class Local_Exceptions_SqlException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
