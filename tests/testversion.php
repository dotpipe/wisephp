<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Version.php';

 class VersionTest extends Version
 {
     public function testCheckForFunctionabout()
     {
         $obj = new Version();
         $testReturn = $obj->about();
     }
 }
