<?php
namespace wise\src\wireframe;

require_once __DIR__ . '../../../../vendor/autoload.php';

class PageControllers
{
    public $token;
    public $view;
    public $mvc = array();
    public $md;
    public $sid = array();
    /**    *
     * @method __construct
     * @param string, string
     *
     */
    public function __construct(string $tok, string $view = 'index')
    {
        $this->mvc = null;
        $this->token = $tok;
        if (!is_dir("$this->token")) {
            mkdir("$this->token");
        }
        if (!is_dir("$this->token")) {
            echo "Unable to create directories needed";
        }
        if (!is_dir("$this->token/view/")) {
            mkdir("$this->token/view");
        }
        if (!is_dir("$this->token/view")) {
            echo "Unable to create directories needed";
        }
        if (!is_dir($this->token."/view/".$_COOKIE['PHPSESSID'])) {
            mkdir($this->token."/view/".$_COOKIE['PHPSESSID']);
        }
        if (!is_dir($this->token."/view/".$_COOKIE['PHPSESSID'])) {
            echo "You do not have Cookies Enabled";
            exit();
        }
        if (!is_dir("$this->token/view/shared")) {
            mkdir("$this->token/view/shared");
        }
        if (!is_dir("$this->token/view/shared")) {
            echo "Unable to create directories needed";
        }
        if (!file_exists("$this->token/config.json")) {
            touch("$this->token/config.json");
        }
        if (!file_exists("$this->token/index.php")) {
            touch("$this->token/index.php");
        }
        if (!file_exists("$this->token/view/shared/index.php")) {
            touch("$this->token/view/shared/index.php");
        }
        if (!file_exists("$this->token/config.json")) {
            echo "Unable to create files needed";
        }
        if (!file_exists("$this->token/index.php")) {
            echo "Unable to create files needed";
        }
        if (!file_exists("$this->token/view/shared/index.php")) {
            echo "Unable to create files needed";
        }
        $this->path = "$this->token/view";
        $this->view = $view;
        $this->mvc[$tok] = new PageModels($view);
        $this->mvc[$tok]->view = new PageViews($tok, $view);
        $this->mvc[$tok]->md = $_COOKIE['PHPSESSID'];
        setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() + (60 * 60 * 24 * 365), "$this->token/$this->md");
        $this->mvc[$tok]->sid['model'] = new PageModels($_COOKIE['PHPSESSID']);
        $this->mvc[$tok]->sid['view'] = new PageViews($tok, $_COOKIE['PHPSESSID']);
    }

    /**    *
     * @method addModelData
     * @param string, array
     *
     */
    public function addModelData(string $view_name, array $data): bool
    {
        $this->mvc[$view_name]->addModelData($view_name, $data);
        return true;
    }

    /**    *
     * @method save
     * @param none
     *
     */
    public function save(): bool
    {
        $fp = fopen("$this->token/$this->md/config.json", "w");
        fwrite($fp, serialize($this));
        fclose($fp);
        return true;
    }
    
    
    /**    *
     * @method paginateModels
     * @param string, string, int, int
     *
     */
    public function paginateModels(string $view_name, string $filename, int $begin = 0, int $end = 0)
    {
        $x = $this->mvc[$this->token]->paginateModels($this->token, $view_name, $filename, $begin, $end);
        return $x;
    }
    
    /**    *
     * @method add_view
     * @param string
     *
     */
    public function add_view(string $view_name): bool
    {
        if (is_dir("$this->path/$view_name/")) {
            if (!file_exists("$this->path/$view_name/index.php")) {
                $fp = fopen("$this->path/$view_name/index.php", "w");
                fclose($fp);
            }
        } else {
            mkdir("$this->path/$view_name");
            if (!is_dir("$this->path/$view_name")) {
                echo "Permissions Error: Unable to create Directory";
                return false;
            }
            touch("$this->path/$view_name/index.php");
            touch("$this->token/config.json");
        }
        $this->mvc[$view_name] = new PageModels($view_name);
        $this->mvc[$view_name]->view = new PageViews($this->token, $view_name);
        return true;
    }
    
    /**    *
     * @method newView
     * @param string
     *
     */
    public function newView(string $view_name): bool
    {
        $this->add_view($view_name);
        return true;
    }
    
    /**    *
     * @method loadJSON
     * @param none
     *
     */
    public function loadJSON()
    {
        if (file_exists("$this->token/config.json") && filesize("$this->token/config.json") > 0) {
            $fp = fopen("$this->token/config.json", "r");
        } else {
            return false;
        }
        $json_context = fread($fp, filesize("$this->token/config.json"));
        $old = unserialize($json_context);
        $b = $old->mvc[$old->token];
        foreach ($b as $key => $val) {
            $old->mvc[$this->token]->$key = $b->$key;
        }
        return $old;
    }
    
    /**    *
     * @method addPartial
     * @param string
     *
     */
    public function addPartial(string $filename)
    {
        return $this->mvc[$this->token]['view']->addPartial($filename);
    }
    
    /**    *
     * @method addShared
     * @param string
     *
     */
    public function addShared(string $filename)
    {
        return $this->mvc[$this->token]['shared']->addPartial($filename);
    }
}
