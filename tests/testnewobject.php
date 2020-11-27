<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\newObject.php';

 class newObjectTest extends newObject
 {
     public function testCheckForFunctionnewObj()
     {
         $obj = new newObject();
         $testReturn = $obj->newObj();
     }
 }
