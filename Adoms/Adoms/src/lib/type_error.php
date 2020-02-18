<?php

namespace Adoms\src\lib;


$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

class Type_Error extends Error_call {
    public function __construct($message) {
        echo $message;

    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}
?>