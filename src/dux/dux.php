<?php declare (strict_types = 1);
namespace src\dux;

require_once(__DIR__."/../../../vendor/autoload.php");    

class dux {

    private $dux = "";
    public $methods_docd = 0;
    public $classes_undocd = 0;
    public $methods_total = 0;
    public $classes_total = 0;

    /**
     * @method list_classes
     * @param $start_dir
     * 
     * go through all classes loaded
     * 
     */
    public function start(string $start_dir)
    {
        $path = realpath($start_dir);
        if ($path == null || $path == "")
            $path = $start_dir;
        foreach (scandir($path) as $ext => $dir)
        {
            if ($dir == "." || $dir == ".." || $dir[0] == ".")
                continue;
            if (substr($dir,-4) == ".php" && !is_dir("$path/$dir"))
            {
                if ($this->is_class("$path/$dir", $dir)) {
                    $this->list_methods("$path/$dir", $dir);
                    $this->classes_total++;
                }
            }
            else if (strpos($dir,"vendor") == false && is_dir("$path/$dir"))
                $this->start("$path/$dir");
        }
    }

    /**
     * @method is_class
     * @param $start_dir, $class
     * 
     * proxy to get_dox in aft of getting file contents
     * 
     */
    public function is_class(string $start_dir, $file)
    {
        $guts = fopen("$start_dir",'r');
        $str = "";
        $name = strtolower(substr($file,0,-4));
        do
        {
            $str = fgets($guts);
            if (!is_bool($str))
                $str = strtolower($str);
            else if ($str == false) {
                fclose($guts); 
                return false;
            }
            if (strpos($str,"class $name") !== false)
            {
                fclose($guts);
                return true;
            }
        } while ((strpos($str,"class $name") === false));
        return false;
    }

    /**
     * @method list_methods
     * @param $start_dir, $class
     * 
     * proxy to get_dox in aft of getting file contents
     * 
     */
    public function list_methods(string $start_dir, $file)
    {
        $guts = fopen("$start_dir",'r');
        $this->get_dox($guts, $file);
    }

    /**
     * @method get_dox
     * @param $guts, $class
     * 
     * get all strings of comments from each function
     * 
     */
    public function get_dox($guts, string $file)
    {
        $this->dux = "Dux Documentation for " . substr($file,0,-4) . "\n";
        $docd = 0;
        $total = 0;
        $str = "";
        $aray = [];
        do
        {
            $aray[] = "<pre class='" . substr($file,0,-4) ."'>\n";
            while (!is_bool($str) && substr(rtrim($str," \r\n\t\0"),-3) != "/**") {
                $str = (fgets($guts));
                $func = "func";
                $func .= "tion";
                if (!is_bool($str) && strpos($str,"protected $func ") !== false)
                    $total++;
                if (!is_bool($str) && strpos($str,"private $func ") !== false)
                    $total++;
                if (!is_bool($str) && strpos($str,"public $func ") !== false)
                    $total++;
                if (!is_bool($str) && strpos($str,"static $func ") !== false)
                    $total++;
            }
            if (is_bool($str)) {
                array_pop($aray);
                break;
            }
            $docd++;
            do
            {
                $aray[] = (fgets($guts));
            } while (!is_bool(end($aray)) && substr(rtrim(end($aray)," \r\n\t\0"),-2) != "*/");
            array_pop($aray);
            
            {
                $aray[] = (fgets($guts));
                $total++;
            }
            
            $aray[] = "</pre>\n";
            
            $str = fgets($guts);
            
        } while (!is_bool($str));
        $this->output_methods($file, $aray, $docd, $total);
    }

    /**
     * @method output_methods
     * @param $class
     * 
     * turn into directory/class files for dox
     * 
     */
    public function output_methods(string $class, array $aray, int $docd, int $total)
    {
        $this->methods_total += $total;
        if ($class == "")
            return;
        if (count($aray) <= 3)
        {
            $this->classes_undocd++;
            echo "\033[31mError: $class is not documented ($this->classes_undocd) ($total)\033[39m\n";
            return;
        }
        $class = substr($class,0,-4);
        if (!is_dir("documentation/$class"))
        {
            if (!is_dir("documentation"))
            {
                mkdir("documentation");
            }
            mkdir("documentation/$class");
        }
        foreach ($aray as $c => $a)
        {
            $this->dux .= $a;
        }
        if ($docd != $total)
            echo "\033[33mNot all methods in $class are documented ($docd/$total)\033[39m\n";
        else
            echo "\033[32mMethods in $class are documented ($docd/$total)\033[39m\n";
        $this->methods_docd += $docd;
        file_put_contents("documentation/$class/$class.html", $this->dux);
        $this->dux = "";
    }
}

?>