<?php

namespace src\switches;

require "../../../vendor/autoload.php";

/** *
 * @category File Output
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class fileRoute
{
    public $config;

    function __construct(object $lf, string $filename)
    {
        if (isset($lf->router->type)) {
            $this->this->config = $lf;
            $this->submit($filename);
        }
    }

    /** 
     * @method @method submit
     * @param string $filename
     *
     */
    public function submit(string $filename)
    {
        $json = "";
        $json_decoded = [];
        if (file_exists($filename)) {
            $json = file_get_contents($filename);
            $json_decoded = json_decode($json);
        }
        array_push($json_decoded, $this->this->config);
        $json_unique = array_unique($json_decoded);
        file_put_contents($filename, json_encode($json_unique));
    }
}
?>