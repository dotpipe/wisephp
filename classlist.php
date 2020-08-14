<?php
    namespace Adoms\src;
    if (!isset($_GET['class']))
        echo "@#@#@";


    function scanEachDir ($dir = "./") {
        foreach (scandir(strtolower($dir)) as $value) {
            if ($value == '..' || $value ==  '.')
                continue;
                
            if (is_dir(strtolower($dir . '/' . $value)))
                scanEachDir(strtolower($dir .  "/" . $value));
            if (strtolower($_GET['class']) . ".php" == $value)
            {
                $classes = get_declared_classes();
                require_once strtolower($dir . '/' . $_GET['class']) . '.php';
                $diff = array_diff(get_declared_classes(), $classes);
                $class = reset($diff);
                $i = 1;
                echo '<center><div style="text-align:center">';
                foreach (get_class_methods($class) as $key){
                    $cnt_space = 25-strlen($key);
                    echo '<b>' . $key . '</b>' . str_repeat("&nbsp;",$cnt_space);
                    if ($i%4 == 0)
                        echo '</div><br><br><br><div>';
                    $i++;
                }
                echo '</div></center>';
                break;
            }
        }
        return;
    }
    scanEachDir('./adoms');
?>