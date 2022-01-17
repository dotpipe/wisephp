<?php

namespace src\switches;

require __DIR__."/../../../vendor/autoload.php";

/** *
 * @category Route based on Username
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class UserRouteFactory
{
    public $router;

    /**
     * @method __construct
     * @param user
     * @param uri
     * @param route
     * @param final
     * @param filename
     * 
     */
    function __construct(string $user, string $uri, string $route = ".", string $final =".", string $filename)
    {
        $this->router = array("user" => $user, "uri" => $uri, "route" => "{$route}/{$user}/{$final}", "sub" => $route, "final" => $final, "type" => "UserRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

?>