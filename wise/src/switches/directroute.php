<?php

namespace wise\src\switches;

use wise\src\switches\TemporaryRouteFactory;

use wise\src\switches\PermanentRouteFactory;

require "../../../vendor/autoload.php";

/** *
 * @category Trafficking
 * @author Anthony David Pulse, Jr. <inland14@live.com>
 * @copyright Copyright (c) 2020, Author
 *
*/
class DirectRoute
{
    public $config;

    function __construct(string $filename)
    {
        $json = file_get_contents($filename);
        $this->config = json_decode($json);
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
?>