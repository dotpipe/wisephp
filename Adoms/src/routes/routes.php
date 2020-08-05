<?php

/*
 *
 * @package FasterRoute - A razz
 * @version v1.0
 * @category Router
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/

/*
 *
 * @category Multi-Insertions
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class RouteFactory {

    function __construct(string $filename, array $objects) {
        foreach ($objects as $assets => $obj) {
            
            $x = null;

            if (is_a($obj, "UserRouteFactory"))
                $x = new UserRouteFactory($obj->user, $obj->uri, $obj->base_dir, $obj->final);
            else if (is_a($obj, "GroupRouteFactory"))
                $x = new GroupRouteFactory($obj->groupid, $obj->uri, $obj->base_dir, $obj->user, $obj->final);
            else if (is_a($obj, "TemporaryRouteFactory"))
                $x = new TemporaryRouteFactory($obj->uri, $obj->base_dir);
            else if (is_a($obj, "PermanentRouteFactory"))
                $x = new PermanentRouteFactory($obj->uri, $obj->base_dir);
            else {
                echo 'Non-Route detected... skipping';
                continue;
            }
            $y = new fileRoute($x, "./config.json");
        }
    }
}

/*
 *
 * @category Route based on Permanent Basis
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class PermanentRouteFactory {

    public $router;
    public $base_dir;
    public $uri;

    function __construct(string $uri, string $base_dir) {
        $this->uri = $uri;
        $this->base_dir = $base_dir;
        $this->router = array("uri" => $uri, "route" => $base_dir, "type" => "PermanentRouteFactory");
    }
}

/*
 *
 * @category Route based on Temporary Status
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class TemporaryRouteFactory {

    public $router;
    public $base_dir;
    public $uri;

    function __construct(string $uri, string $base_dir) {
        $this->uri = $uri;
        $this->base_dir = $base_dir;
        $this->router = array("temporary" => 1, "uri" => $uri, "route" => $base_dir, "type" => "TemporaryRouteFactory");
    }
}

/*
 *
 * @category Route based on Username
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class UserRouteFactory {

    public $router;
    public $user;
    public $base_dir;
    public $uri;
    public $final;

    function __construct(string $user, string $uri, string $base_dir = ".", string $final =".") {
        $this->uri = $uri;
        $this->user = $user;
        $this->final = $final;
        $this->base_dir = $base_dir;
        $this->router = array("user" => $user, "uri" => $uri, "route" => "{$base_dir}/{$user}/{$final}", "base_dir" => $base_dir, "final" => $final, "type" => "UserRouteFactory");
    }
}

/*
 *
 * @category Route based on Groups
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class GroupRouteFactory {

    public $router;
    public $groupid;
    public $base_dir;
    public $uri;
    public $user;
    public $final;

    function __construct(int $groupid, string $uri, string $base_dir = ".", string $user = ".", string $final = ".") {
        $this->uri = $uri;
        $this->user = $user;
        $this->groupid = $groupid;
        $this->final = $final;
        $this->base_dir = $base_dir;
        $this->router = array("groupid" => ".", "uri" => $uri, "route" => "{$base_dir}/{$groupid}/{$user}/{$final}", "base_dir" => $base_dir, "user" => $user, "final" => $final, "type" => "GroupRouteFactory");
    }
}

/*
 *
 * @category File Output
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class fileRoute {

    public $config;

    function __construct(object $lf, string $filename) {
        //if (isset($lf->router->type)) 
        {
            $this->config = $lf;
            $this->submit($filename);
        }
    }

    /*
     * @method submit
     * @param string $filename
     * 
    */
    private function submit(string $filename) {
        $json = [];
        if (!file_exists($filename)) {
            $json = array_merge($json, array(serialize($this->config)));
            $serialized = serialize($this->config);
            file_put_contents($filename, array(serialize($this->config)));
            return;
        }
        $json_conf = file_get_contents($filename);
        $json = unserialize($json_conf);
        $json = array_merge($json, array(serialize($this->config)));
        $serialized = serialize($this->config);
        $json[] = $serialized;
        $json = array_unique($json);
        file_put_contents($filename, array(serialize($this->config)));
        file_put_contents($filename,serialize($json));
    }
}

/*
 *
 * @category Trafficking
 * @author Anthony David Pulse, Jr. <inland14@live.com> 
 * @copyright Copyright (c) 2020, Author
 * 
*/
class DirectRoute {

    public $config;

    function __construct (string $filename) {
        $json = file_get_contents($filename);
        $json = unserialize($json);
        $this->config = ($json);
    }
    
    /*
     * @method findRoute
     * @param string $user, string $UGID
     * 
    */
    public function findRoute(string $user = "", string $UGID = "") {
        foreach ($this->config as $key) {
            $this->hashRoute(unserialize($key), $user, $UGID);
        }
        echo 'No route found';
        return;
    }

    /*
     * @method hashRoute
     * @param objects $keys, string $ID, string $GUID
     * @name $_SERVER['REQUEST_URI']
    */
    public function hashRoute(object $keys, string $ID = "", string $GUID = "") {
        if ($_SERVER['REQUEST_URI'] == $keys->router['uri']) {
            if (isset($keys->router['user']) && strtolower($keys->router['groupid']) == strtolower($ID)
                && isset($keys->router['groupid']) && intval($keys->router['groupid'], 10) == intval($GUID, 10))
                header("Location: " . $keys->router['route']);
            if (isset($keys->router['user']) && strtolower($keys->router['user']) == strtolower($ID))
            header("Location: " . $keys->router['route']);
            header("Location: " . $keys->router['route']);
        }
    }
    
    /*
     * @method flipTemporary
     * @param TemporaryRouteFactory $find
     * 
    */
    public function flipTemporary(TemporaryRouteFactory $find) {
        foreach($config as $keys) {
            if ($keys->uri == $find->router->route) {
                $config->$keys->$keys->router->temporary = 1 ^ $keys->router->temporary;
                return;
            }
        }
    }
    
    /*
     * @method remPermanent
     * @param PermanentRouteFactory $find
     * 
    */
    public function remPermanent(PermanentRouteFactory $find) {
        foreach($config as $keys) {
            if ($keys->uri == $find->router->route) {
                unset($config->$keys);
                return;
            }
        }
    }
}

?>