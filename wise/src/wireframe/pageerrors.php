<?php

namespace wise\src\wireframe;

require_once __DIR__ . '../../../../vendor/autoload.php';
class PageErrors
{
    public function missingFile($filename)
    {
        echo "<b>Page not found: $filename</b>";
    }

    public function errorByCode(string $error, string $class, string $function, string $line, string $file)
    {
        $date = __DIR__ . "/../logs/error_logs/error_log_" . date_create_from_format("d_M_Y", time());
        if (!file_exists("$date")) {
            \file_put_contents("$date", "");
        }

        $phpmsg = $error . "Error caught on " .  date_create_from_format("@h:i:sA", time()) . ": ";
        $phpmsg .= "$class::$function on $line in $file\r\n";
        $phpmsg .= file_get_contents("$date") . "\r\n";
        file_put_contents("$date", $phpmsg);
    }
}
