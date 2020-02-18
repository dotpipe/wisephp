<?php

namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

class SyntaxError extends Error {
    public function __construct($message)  {
        echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();

    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}
?>