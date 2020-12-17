<?php

namespace wise\src\lib;

require_once '\wise\src\lib\newObject.php';

 class newObjectTest extends newObject
 {
     public function testCheckForFunctionnewObj()
     {
         $obj = new newObject();
         $testReturn = $obj->newObj();
     }
 }
