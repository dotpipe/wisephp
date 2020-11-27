<?php

namespace Adoms\src\wireframe;

require_once '\Adoms\src\wireframe\PageErrors.php';

 class PageErrorsTest extends PageErrors
 {
     public function testCheckForFunctionmissingFile()
     {
         $obj = new PageErrors();
         $testReturn = $obj->missingFile();
     }
     public function testCheckForFunctionerrorByCode()
     {
         $obj = new PageErrors();
         $testReturn = $obj->errorByCode();
     }
 }
