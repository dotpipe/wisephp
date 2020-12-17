<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Trees.php';

 class TreesTest extends Trees
 {
     public function testCheckForFunctionlinkTree()
     {
         $obj = new Trees();
         $testReturn = $obj->linkTree();
     }
     public function testCheckForFunctioncreate()
     {
         $obj = new Trees();
         $testReturn = $obj->create();
     }
     public function testCheckForFunctionmockTree()
     {
         $obj = new Trees();
         $testReturn = $obj->mockTree();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new Trees();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionsize()
     {
         $obj = new Trees();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new Trees();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctioncurrent()
     {
         $obj = new Trees();
         $testReturn = $obj->current();
     }
     public function testCheckForFunctiongetIndex()
     {
         $obj = new Trees();
         $testReturn = $obj->getIndex();
     }
     public function testCheckForFunctionsetIndex()
     {
         $obj = new Trees();
         $testReturn = $obj->setIndex();
     }
     public function testCheckForFunctionIter()
     {
         $obj = new Trees();
         $testReturn = $obj->Iter();
     }
     public function testCheckForFunctionrevIter()
     {
         $obj = new Trees();
         $testReturn = $obj->revIter();
     }
     public function testCheckForFunctionCycle()
     {
         $obj = new Trees();
         $testReturn = $obj->Cycle();
     }
     public function testCheckForFunctionrevCycle()
     {
         $obj = new Trees();
         $testReturn = $obj->revCycle();
     }
     public function testCheckForFunctionsync()
     {
         $obj = new Trees();
         $testReturn = $obj->sync();
     }
 }
