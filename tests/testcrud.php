<?php

namespace Adoms\src\oauth2;

require_once '\Adoms\src\oauth2\CRUD.php';

 class CRUDTest extends CRUD
 {
     public function testCheckForFunctiontestCRUD()
     {
         $obj = new CRUD();
         $testReturn = $obj->testCRUD();
     }
     public function testCheckForFunctioncreate()
     {
         $obj = new CRUD();
         $testReturn = $obj->create();
     }
     public function testCheckForFunctionread()
     {
         $obj = new CRUD();
         $testReturn = $obj->read();
     }
     public function testCheckForFunctionupdate()
     {
         $obj = new CRUD();
         $testReturn = $obj->update();
     }
     public function testCheckForFunctiondelete()
     {
         $obj = new CRUD();
         $testReturn = $obj->delete();
     }
 }
