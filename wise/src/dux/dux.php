<?php declare (strict_types = 1);
namespace wise\src\dux;

require_once __DIR__ . '../../../../vendor/autoload.php';    

class dux {

    private $dux = "";
    private $duxdir = "";

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
        foreach (scandir(($path)) as $ext => $dir)
        {
            if ($dir == "." || $dir == ".." || $dir[0] == ".")
                continue;
            if (substr($dir,-4) == ".php" && !is_dir("$path/$dir"))
            {
                $this->list_methods("$path/$dir", $dir);
            }
            else if (strpos($dir,"vendor") == false && is_dir("$path/$dir"))
                $this->start("$path/$dir");
        }
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
        // foreach (dir($start_dir) as $dir => $filedir)
        {
            // if (is_file($start_dir . "\\$filedir"))
            {
                $guts = fopen("$start_dir",'r');
                $this->get_dox($guts, $file);
            }
        }
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
        $x = 0;
        $this->dux = "Dux Documentation for " . substr($file,0,-4) . "\n";
        $w = 1;
        $str = "";
        $aray = [];
        while (!is_bool($str))
        {
            $aray[] = "<pre id='" . substr($file,0,-4) ."'>\n";
            while (!is_bool($str) && substr(rtrim($str," \r\n\t\0"),-3) != "/**")
                $str = (fgets($guts));
            
            do
            {
                $aray[] = (fgets($guts));
            } while (!is_bool(end($aray)) && substr(rtrim(end($aray)," \r\n\t\0"),-2) != "*/");
            array_pop($aray);
            
            // while (!is_bool(end($aray)) && substr(end($aray),-1) != ")")
            {
                $aray[] = (fgets($guts));
            }
            $str = fgets($guts);
            
            $aray[] = "</pre>\n";
        }
        echo ".";
        $this->output_methods($file, $aray);
    }

    /**
     * @method output_methods
     * @param $class
     * 
     * turn into directory/class files for dox
     * 
     */
    public function output_methods(string $class, array $aray)
    {
        if ($class == "")
            return;
        if (count($aray) <= 3)
        {
            echo "Error: $class is not documented\n";
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
        file_put_contents("documentation/$class/$class.html", $this->dux);
        $this->dux = "";
    }
}

?>