<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class Error_call {
    public function __construct($message) {
        echo $err_type . ': ' . $err_msg . ' In file ' . $err_file . ' On line ' . $err_line;
    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }

    function error_msg($err_type, $err_msg, $err_file, $err_line) {
        echo $err_type . ': ' . $err_msg . ' In file ' . $err_file . ' On line ' . $err_line;
    }

}
?>
