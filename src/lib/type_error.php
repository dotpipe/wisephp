<?php declare(strict_types = 1);

namespace src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class Type_Error extends Error_call
{
    /**
     * @method __construct
     * @param $message
     * 
     * echo $message param
     */
    public function __construct($message)
    {
        echo $message;

        //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}
