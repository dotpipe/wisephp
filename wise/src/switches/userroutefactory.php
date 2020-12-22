<?php

namespace wise\src\switches;

require "../../../vendor/autoload.php";

/** *
 * @category Route based on Username
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class UserRouteFactory
{
    public $router;

    public function __construct(string $user, string $uri, string $route = ".", string $final =".", string $filename)
    {
        $this->router = array("user" => $user, "uri" => $uri, "route" => "{$route}/{$user}/{$final}", "sub" => $route, "final" => $final, "type" => "UserRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

?>