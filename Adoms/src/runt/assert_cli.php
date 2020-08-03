<?php
require_once '..\..\..\vendor\autoload.php';

function io_cli($pluck): string
{
    if (!file_exists($pluck))
        return "";
    $classes = get_declared_classes();
    require_once $pluck;
    $diff = array_diff(get_declared_classes(), $classes);
    reset($diff);
    $class = current($diff);
    $_class = get_class_methods($class);
    if (!is_array($_class))
        return "";
    
    try {
        $c = "";
        $exc = explode('\\', $class);
        $out_class = $exc[count($exc)-1];
        $namesp = array_pop($exc);
        $namesp = implode('\\',$exc);
        $c .= "<?php\n\nnamespace " . $namesp . ";\n\nrequire_once '\\" . $class . ".php';\n\n class " . ($out_class) . "Test extends " . ($out_class) . " {\n\n";
        foreach (($_class) as $no => $key) {
            if ($key == "__construct")
                continue;
            
            $c .= "\tpublic function testCheckForFunction" . $key . "() \n\t{\n\t\t\$obj = new " . $out_class . "();";
            $c .= "\n\t\t\$testReturn = \$obj->" . $key . "();\n\t}\n";// + substr($c,1,-6)"
        }
        $c .= "}\n?>";
    }
    catch (Exception $e)
    {
        //echo $e;
        return null;
    }
    return $c;
}

function recurse_dirs($dir) {
    echo $dir;
    foreach (scandir($dir) as $file)
    { 
        echo strtolower(substr($file,strlen($file)-4));
        if ($file == "runt" || $file == "assert_cli.php" || $file == "." || $file == "..")
            continue;
        $c = "";
        if (is_dir($dir . '\\' . $file))
        {
            recurse_dirs($dir . '\\' . $file);
        }
        else if (".php" == strtolower(substr($file,strlen($file)-4))) {
            $c = io_cli($dir . '\\' . $file);
            if (strlen($c) > 0)
                file_put_contents("test".$file, $c);
        }
    } 
}
recurse_dirs("c:\\xampp\\htdocs\\adoms\\adoms\\src\\wireframe");
?>