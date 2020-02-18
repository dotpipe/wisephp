<?php

namespace Adoms\src\lib;

$my = function ($pClassName) {
	if (\file_exists("Adoms\\src\\lib\\".strtolower($pClassName) . ".php"))
	include_once("Adoms\\src\\lib\\".strtolower($pClassName) . ".php");
	else
	include_once(strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

class Container extends Common {
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
            $this->strict = true;
        else $this->strict = 0;
        return $this->strict;
    }
}

?>