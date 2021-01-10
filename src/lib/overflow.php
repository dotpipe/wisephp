<?php declare(strict_types = 1);

namespace src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';

class Overflow
{
    /**
     * @method __construct
     * @param message
     * 
     * echoes the input message
     */
    public function __construct($message)
    {
        echo $message;

        //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}
