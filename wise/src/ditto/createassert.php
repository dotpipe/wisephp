<?php

function io_get($pluck)
{
    if (!file_exists($pluck)) {
        return;
    }
    $classes = get_declared_classes();
    require_once $pluck;
    $diff = array_diff(get_declared_classes(), $classes);
    $class = reset($diff);

    $_class = get_class_methods($class);


    $html = $class . ": ";
    $html .= '<select id="functions" style="float:right;width:280px" file_type="class" type_name="' . $class . '" onchange="func_find(this)">\r\n';
    foreach ($_class as $key => $value) {
        if ($value == "__construct") {
            continue;
        }
        $html .= '<option ';
        $html .= 'function=' . ($value) . '>';
        $html .= $value . '</option>';
    }
    file_put_contents("assertions.html", $html . "</select>");
}
?>