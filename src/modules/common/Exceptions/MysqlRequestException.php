<?php
namespace TestTask\Common\Exceptions;

class MysqlRequestException extends \Exception
{

    /**
     * MysqlRequestException constructor.
     */
    public function __construct()
    {
        $message = "Error execute mysql request";
        parent::__construct($message);
    }
}
