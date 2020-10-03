<?php
namespace TestTask\Common\Exceptions;

class DBConnectException extends \Exception
{

    /**
     * DBConnectException constructor.
     */
    public function __construct()
    {
        $message = 'Error connect to database';
        $code = 500;
        parent::__construct($message, $code);
    }
}
