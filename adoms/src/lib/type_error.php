<?php declare (strict_types = 1);

namespace Adoms\src\lib;



class Type_Error extends Error_call {
    public function __construct($message) {
        echo $message;

    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}
?>