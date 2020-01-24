<?php declare (strict_types = 1);

namespace Adoms\src\lib;


class SyntaxError extends Error {
    public function __construct($message)  {
        echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();

    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}
?>