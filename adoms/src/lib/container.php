<?php

namespace adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

class Container {
    // Type Specifications
    public $typeOf;
    public $rootType;
    // $this->strict >= 1 to Use IndexExceptions
    // in Containers (use_strict($bool))
    public $strict;

    public function __construct() {
        $this->strict = FALSE;
    }

    // Strict IndexException Error Calling
    public function use_strict(bool $bool = FALSE) {
        if ($bool != 0)
            $this->strict = 1;
        else $this->strict = 0;
        return $this->strict;
    }
}

?>