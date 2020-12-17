<?php

namespace wise\src\wireframe;

require_once '\wise\src\wireframe\PageControllers.php';

 class PageControllersTest extends PageControllers
 {
     public function testCheckForFunctionaddModelData()
     {
         $obj = new PageControllers();
         $testReturn = $obj->addModelData();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new PageControllers();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionpaginateModels()
     {
         $obj = new PageControllers();
         $testReturn = $obj->paginateModels();
     }
     public function testCheckForFunctionnewView()
     {
         $obj = new PageControllers();
         $testReturn = $obj->newView();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new PageControllers();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctionaddPartial()
     {
         $obj = new PageControllers();
         $testReturn = $obj->addPartial();
     }
     public function testCheckForFunctionaddShared()
     {
         $obj = new PageControllers();
         $testReturn = $obj->addShared();
     }
 }
