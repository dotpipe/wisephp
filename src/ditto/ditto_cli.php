<?php

namespace src\ditto;

require_once "/../../../vendor/autoload.php";

function io_cli($pluck): string
{
    if (!file_exists($pluck)) {
        return "";
    }
    $classes = get_declared_classes();
    require_once $pluck;
    $diff = array_diff(get_declared_classes(), $classes);
    reset($diff);
    $class = current($diff);
    echo $class . " ";
    $_class = get_class_methods($class);
    $args = func_get_args();
    if (!is_array($_class)) {
        return "";
    }
    
    try {
        $c = "";
        $exc = explode('\\', $class);
        $out_class = $exc[count($exc)-1];
        $namesp = array_pop($exc);
        $namesp = implode('\\', $exc);
        $c .= "<?php\n\nnamespace " . $namesp . ";\n\nrequire_once '\\" . $class . ".php';\n\n class " . ($out_class) . "Test extends " . ($out_class) . " {\n\n";
        foreach (($_class) as $no => $key) {
            if ($key == "__construct") {
                continue;
            }
            $ref_func = new \ReflectionFunction($out_class . "::" . $key);
            $args = "";
            
            foreach ($ref_func->getParameters() as $param) {
                
                $args .= ', $' . $param->name;
            }
            $args = substr($args, 2, strlen($args));
            $c .= "\tpublic function testCheckForFunction" . $key . "() \n\t{";
            $c .= "\n\t\t\$testReturn = \$this->" . $key . "($args);\n\t}\n";// + substr($c,1,-6)"
        }
        $c .= "}\n?>";
    } catch (\Exception $e) {
        echo $e;
        return "";
    }
    return $c;
}

function recurse_dirs($dir, $output_dir)
{
    echo $dir;
    foreach (scandir($dir) as $file) {
        if ($file == "ditto" || $file == "assert_cli.php") {
            continue;
        }
        $c = "";
        if (is_dir($dir . '\\' . $file) && $file != "." && $file != "..") {
            recurse_dirs($dir . '\\' . $file, $output_dir);
        } elseif (".php" == strtolower(substr($file, strlen($file)-4))) {
            $c = io_cli($dir . '\\' . $file);
            if (strlen($c) > 0) {
                file_put_contents($output_dir."\\test".$file, $c);
            }
        }
    }
}
recurse_dirs($argv[1], $argv[2]);
