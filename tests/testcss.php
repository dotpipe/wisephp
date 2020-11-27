<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\css.php';

 class cssTest extends css
 {
     public function testCheckForFunctionsize()
     {
         $obj = new css();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionsetIndent()
     {
         $obj = new css();
         $testReturn = $obj->setIndent();
     }
     public function testCheckForFunctionclear()
     {
         $obj = new css();
         $testReturn = $obj->clear();
     }
     public function testCheckForFunctionadd()
     {
         $obj = new css();
         $testReturn = $obj->add();
     }
     public function testCheckForFunctionwrite()
     {
         $obj = new css();
         $testReturn = $obj->write();
     }
     public function testCheckForFunctioncssMap()
     {
         $obj = new css();
         $testReturn = $obj->cssMap();
     }
     public function testCheckForFunctionconvert()
     {
         $obj = new css();
         $testReturn = $obj->convert();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new css();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new css();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctioncurrent()
     {
         $obj = new css();
         $testReturn = $obj->current();
     }
     public function testCheckForFunctiongetIndex()
     {
         $obj = new css();
         $testReturn = $obj->getIndex();
     }
     public function testCheckForFunctionsetIndex()
     {
         $obj = new css();
         $testReturn = $obj->setIndex();
     }
     public function testCheckForFunctionIter()
     {
         $obj = new css();
         $testReturn = $obj->Iter();
     }
     public function testCheckForFunctionrevIter()
     {
         $obj = new css();
         $testReturn = $obj->revIter();
     }
     public function testCheckForFunctionCycle()
     {
         $obj = new css();
         $testReturn = $obj->Cycle();
     }
     public function testCheckForFunctionrevCycle()
     {
         $obj = new css();
         $testReturn = $obj->revCycle();
     }
     public function testCheckForFunctionsync()
     {
         $obj = new css();
         $testReturn = $obj->sync();
     }
 }
