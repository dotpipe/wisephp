<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
    include("c:\\xampp\\htdocs\\adoms\\" . strtolower($pClassName) . ".php");
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


class IndexException extends Error_call {
    public function __construct($message) {
        echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();
    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}

class Type_Error extends Error_call {
    public function __construct($message) {
        echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();

    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}

class SyntaxError extends Error {
    public function __construct($message)  {
        echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();

    //    trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
    }
}

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

class Version {
    public function about($vbool)  {
        if ($vbool == 0) {
            echo 'Warim - Version 1.0<br>';
            echo 'Warim Object Oriented Library / PVC Model-View-Controller / Pipes Routing';
        }
        else if ($vbool == 1)
            echo 'Warim v1.0';
        else
            for ($i = 0 ; $i < $vbool ; $i++)
                echo 'Was \$vbool too complex an idea for you? ... ';
    }
}
