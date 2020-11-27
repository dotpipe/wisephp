<?php

namespace Adoms\src\lib;

require_once '\Adoms\src\lib\Queue.php';

 class QueueTest extends Queue
 {
     public function testCheckForFunctiondestroy()
     {
         $obj = new Queue();
         $testReturn = $obj->destroy();
     }
     public function testCheckForFunctionsize()
     {
         $obj = new Queue();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new Queue();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new Queue();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctionpoll()
     {
         $obj = new Queue();
         $testReturn = $obj->poll();
     }
     public function testCheckForFunctionpush()
     {
         $obj = new Queue();
         $testReturn = $obj->push();
     }
     public function testCheckForFunctionpop()
     {
         $obj = new Queue();
         $testReturn = $obj->pop();
     }
     public function testCheckForFunctiongetElement()
     {
         $obj = new Queue();
         $testReturn = $obj->getElement();
     }
     public function testCheckForFunctionclear()
     {
         $obj = new Queue();
         $testReturn = $obj->clear();
     }
 }
