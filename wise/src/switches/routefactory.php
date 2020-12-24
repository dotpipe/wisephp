<?php

namespace wise\src\switches;

require "../../../vendor/autoload.php";

/** *
 * @category Multi-Insertions
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class RouteFactory
{
    /**
     * @method __construct
     * @param filename
     * @param objects
     * 
     */
    function __construct(string $filename, array $objects)
    {
        foreach ($objects as $obj) {
            if (isset($obj->router->type)) {
                $x = null;
                if ($obj->type == "UserRouteFactory") {
                    $x = new $obj->router->type($obj->user, $obj->uri, $obj->route, $obj->final);
                } elseif ($obj->type == "GroupRouteFactory") {
                    $x = new $obj->router->type($obj->user, $obj->groupid, $obj->route, $obj->user, $obj->final);
                } else {
                    $x = new $obj->router->type($obj->uri, $obj->route);
                }
                $x = new fileRoute($x, $filename);
            } else {
                echo 'Non-Route detected... skipping';
            }
        }
    }
}

?>