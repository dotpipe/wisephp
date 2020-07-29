<?php declare (strict_types = 1);
namespace Adoms\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class Version {
    public function about($vbool)  {
        if ($vbool == 0) {
            echo 'Adoms::Helium v3.0.0<br>';
            echo 'Adoms Object Oriented Framework / Wireframe Model-View-Controller / Pipes Routing';
        }
        else if ($vbool == 1)
            echo 'Adoms v2.0.5';
        else
            for ($i = 0 ; $i < $vbool ; $i++)
                echo 'Was \$vbool too complex an idea for you? ... ';
    }
}
