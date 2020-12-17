<?php

namespace wise\src\lib;

require_once '\wise\src\lib\mSet.php';

 class mSetTest extends mSet
 {
     public function testCheckForFunctionclear()
     {
         $obj = new mSet();
         $testReturn = $obj->clear();
     }
     public function testCheckForFunctionget()
     {
         $obj = new mSet();
         $testReturn = $obj->get();
     }
     public function testCheckForFunctionaddSet()
     {
         $obj = new mSet();
         $testReturn = $obj->addSet();
     }
     public function testCheckForFunctionsetExists()
     {
         $obj = new mSet();
         $testReturn = $obj->setExists();
     }
     public function testCheckForFunctionremIndex()
     {
         $obj = new mSet();
         $testReturn = $obj->remIndex();
     }
     public function testCheckForFunctiondestroy()
     {
         $obj = new mSet();
         $testReturn = $obj->destroy();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new mSet();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new mSet();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctionsize()
     {
         $obj = new mSet();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionaddAll()
     {
         $obj = new mSet();
         $testReturn = $obj->addAll();
     }
     public function testCheckForFunctionadd()
     {
         $obj = new mSet();
         $testReturn = $obj->add();
     }
     public function testCheckForFunctionvalIsIn()
     {
         $obj = new mSet();
         $testReturn = $obj->valIsIn();
     }
     public function testCheckForFunctioncompare()
     {
         $obj = new mSet();
         $testReturn = $obj->compare();
     }
     public function testCheckForFunctionexists()
     {
         $obj = new mSet();
         $testReturn = $obj->exists();
     }
     public function testCheckForFunctionremValue()
     {
         $obj = new mSet();
         $testReturn = $obj->remValue();
     }
     public function testCheckForFunctioncurrent()
     {
         $obj = new mSet();
         $testReturn = $obj->current();
     }
     public function testCheckForFunctiongetIndex()
     {
         $obj = new mSet();
         $testReturn = $obj->getIndex();
     }
     public function testCheckForFunctionsetIndex()
     {
         $obj = new mSet();
         $testReturn = $obj->setIndex();
     }
     public function testCheckForFunctionIter()
     {
         $obj = new mSet();
         $testReturn = $obj->Iter();
     }
     public function testCheckForFunctionrevIter()
     {
         $obj = new mSet();
         $testReturn = $obj->revIter();
     }
     public function testCheckForFunctionCycle()
     {
         $obj = new mSet();
         $testReturn = $obj->Cycle();
     }
     public function testCheckForFunctionrevCycle()
     {
         $obj = new mSet();
         $testReturn = $obj->revCycle();
     }
     public function testCheckForFunctionsync()
     {
         $obj = new mSet();
         $testReturn = $obj->sync();
     }
 }
