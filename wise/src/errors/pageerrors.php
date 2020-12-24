<?php
namespace wise\src\errors;

set_error_handler('PageErrors');

require_once __DIR__ . '../../../../vendor/autoload.php';
class PageErrors
{
    
    /**
     * @method missingFile
     * @param filename
     * 
	 * echo error message
	 * 
     */
    public function missingFile($filename)
    {
        echo "<b>Page not found: $filename</b>";
    }

    /**
     * @method errorByCode
     * @param error
     * @param class
     * @param function
     * @param line
     * @param file
     * 
	 * echo error message
	 * 
     */
    public function errorByCode(string $error, string $class, string $function, string $line, string $file)
    {
        $date = __DIR__ . "/../logs/error_logs/error_log_" . \DateTime::createFromFormat('U.u', microtime(TRUE))->format("Y_m_d");
        if (!file_exists("$date")) {
            \file_put_contents("$date", "");
        }

        $phpmsg = $error . "Error caught on " .  \DateTime::createFromFormat('U.u', microtime(TRUE))->format("@h:i:sA") . ": ";
        $phpmsg .= "$class::$function on $line in $file\r\n";
        $phpmsg .= file_get_contents("$date") . "\r\n";
        file_put_contents("$date", $phpmsg);
    }
}
