<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\Version.php';

 class VersionTest extends Version
 {
     public function testCheckForFunctionabout()
     {
         $obj = new Version();
         $testReturn = $obj->about();
     }
 }
