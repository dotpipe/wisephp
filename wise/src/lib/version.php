<?php declare (strict_types = 1);
namespace wise\src\lib;

require_once __DIR__ . '../../../../vendor/autoload.php';


class Version {
    
    /**
     * @method about
     * @param none
     * 
     * Tells a dash of what's in this framework
     */
    public function about($bool)  {
        if ($bool == 0) {
            echo 'Wise v4.1.3<br>';
            echo 'Wise Object Oriented Frameworkg';
        }
        else if ($bool == 1)
            echo 'Wise v4.1.3';
        else
            for ($i = 0 ; $i < $bool ; $i++)
                echo 'Was \$vbool too complex an idea for you? ... ';
    }
}
