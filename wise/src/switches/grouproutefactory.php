<?php

namespace wise\src\switches;

require "../../../vendor/autoload.php";

/** *
 * @category Route based on Groups
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class GroupRouteFactory
{
    public $router;

    /**
     * @method __construct
     * @param uri
     * @param groupid
     * @param route
     * @param user
     * @param final
     * @param filename
     * 
     */
    function __construct(string $uri, int $groupid, string $route = ".", string $user = ".", string $final = ".", string $filename = "index.php")
    {
        $this->router = array("group" => $groupid, "uri" => $uri, "route" => "{$route}/{$groupid}/{$user}/{$final}", "sub" => $route, "user" => $user, "final" => $final, "type" => "GroupRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

?>