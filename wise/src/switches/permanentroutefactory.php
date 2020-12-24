<?php

namespace wise\src\switches;

require "../../../vendor/autoload.php";
/** *
 * @category Route based on Permanent Basis
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class PermanentRouteFactory
{
    public $router;

    /**
     * @method __construct
     * @param uri
     * @param route
     * @param filename
     * 
     */
    function __construct(string $uri, string $route, string $filename)
    {
        $this->router = array("uri" => $uri, "route" => $route, "type" => "PermanentRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

?>