<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);


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
