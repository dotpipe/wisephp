<?php

/** *
 * @package FasterRoute - A razz
 * @version v1.0
 * @category Router
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/

/** *
 * @category Multi-Insertions
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class RouteFactory
{
    public function __construct(string $filename, array $objects)
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

/** *
 * @category Route based on Permanent Basis
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class PermanentRouteFactory
{
    public $router;

    public function __construct(string $uri, string $route, string $filename)
    {
        $this->router = array("uri" => $uri, "route" => $route, "type" => "PermanentRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

/** *
 * @category Route based on Temporary Status
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class TemporaryRouteFactory
{
    public $router;

    public function __construct(string $uri, string $route, string $filename)
    {
        $this->router = array("temporary" => 1, "uri" => $uri, "route" => $route, "type" => "TemporaryRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

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

/** *
 * @category Route based on Groups
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class GroupRouteFactory
{
    public $router;

    public function __construct(string $uri, int $groupid, string $route = ".", string $user = ".", string $final = ".", string $filename = "index.php")
    {
        $this->router = array("group" => $groupid, "uri" => $uri, "route" => "{$route}/{$groupid}/{$user}/{$final}", "sub" => $route, "user" => $user, "final" => $final, "type" => "GroupRouteFactory");
        $x = new fileRoute($this, $filename);
    }
}

/** *
 * @category File Output
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class fileRoute
{
    public $config;

    public function __construct(object $lf, string $filename)
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

/** *
 * @category Trafficking
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class DirectRoute
{
    public $config;

    public function __construct(string $filename)
    {
        $json = file_get_contents($filename);
        $this->this->config = json_decode($json);
    }
    
    /** 
     * @method @method findRoute
     * @param string $user, string $UGID
     *
     */
    public function findRoute(string $user = "", string $UGID = "")
    {
        foreach ($this->config as $key) {
            $this->hashRoute($key, $user, $UGID);
        }
        echo 'No route found';
        return;
    }

    /** 
     * @method @method hashRoute
     * @param object $keys, string $ID, string $GUID
     * @name $_SERVER['REQUEST_URI']
     */
    public function hashRoute(object $keys, string $ID, string $GUID)
    {
        foreach ($keys as $key => $val) {
            if ($_SERVER['REQUEST_URI'] == $keys->route->uri) {
                if (isset($keys->router->user) && strtolower($keys->router->user) == strtolower($ID)
                    && isset($keys->router->groupid) && intval($keys->router->groupid, 10) == intval($GUID, 10)) {
                    header("Location: {$this->config->router->route}");
                }
                if (isset($keys->router->user) && strtolower($keys->router->user) == strtolower($ID)) {
                    header("Location: {$this->config->router->route}");
                }
                header("Location: {$this->config->router->route}");
            }
        }
    }
    
    /** 
     * @method @method flipTemporary
     * @param TemporaryRouteFactory $find
     *
     */
    public function flipTemporary(TemporaryRouteFactory $find)
    {
        foreach ($this->config as $keys) {
            if ($keys->router->uri == $find->router->route) {
                $this->config->$keys->temporary = 1 ^ $keys->temporary;
                return;
            }
        }
    }
    
    /** 
     * @method @method remPermanent
     * @param PermanentRouteFactory $find
     *
     */
    public function remPermanent(PermanentRouteFactory $find)
    {
        foreach ($this->config as $keys) {
            if ($keys->router->uri == $find->router->route) {
                unset($this->config->$keys);
                return;
            }
        }
    }
}
