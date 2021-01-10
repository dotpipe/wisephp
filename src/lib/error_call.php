<?php declare (strict_types = 1);
namespace src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class Error_call {
    
    /**
     * @method error_msg
     * @param none
     * @return int
     * 
     * Throw error message
     */
    function error_msg($err_type, $err_msg, $err_file, $err_line) {
        echo $err_type . ': ' . $err_msg . ' In file ' . $err_file . ' On line ' . $err_line;
    }

}
?>
