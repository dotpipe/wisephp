<?php
    namespace Adoms\src;

    if (!isset($_GET['class']))
        echo "@#@#@";


    function scanEachDir ($dir = ".\\") {
        foreach (scandir($dir) as $value) {
            if ($value == '..' || $value ==  '.')
                continue;
                
            if (is_dir($dir . '\\' . $value))
                scanEachDir($dir . '\\' . $value);
            if (strtolower($_GET['class']) . ".php" == $value)
            {
                $classes = get_declared_classes();
                require_once $dir . '\\' . $_GET['class'] . '.php';
                $diff = array_diff(get_declared_classes(), $classes);
                $class = reset($diff);
                $i = 1;
                echo '<table style="color:silver"><tr>';
                foreach (get_class_methods($class) as $key){
                    
                    echo '<td width="75px"><h4>' . $key . '</h4></td>';
                    if ($i%5 == 0)
                        echo '</tr><tr>';
                    $i++;
                }
                echo '</tr></table>';
                break;
            }
        }
        return;
    }
    scanEachDir(__NAMESPACE__);
?>