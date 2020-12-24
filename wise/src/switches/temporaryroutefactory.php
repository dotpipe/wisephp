<?php

namespace wise\src\switches;

require "../../../vendor/autoload.php";

/** *
 * @category Route based on Temporary Status
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class TemporaryRouteFactory
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
        $this->router = array("temporary" => 1, "uri" => $uri, "route" => $route, "type" => "TemporaryRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}