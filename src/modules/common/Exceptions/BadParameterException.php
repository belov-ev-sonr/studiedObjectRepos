<?php
namespace TestTask\Common\Exceptions;

class BadParameterException extends \Exception
{

    /**
     * BadParameterException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $code = 400;
        parent::__construct($message, $code);
    }
}
