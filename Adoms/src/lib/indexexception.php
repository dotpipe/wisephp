<?php declare (strict_types = 1);

namespace Adoms\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class IndexException extends Error_call {
    public function __construct($message) {
        echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();
    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}

?>