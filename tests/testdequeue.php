<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Dequeue.php';

 class DequeueTest extends Dequeue
 {
     public function testCheckForFunctiondestroy()
     {
         $obj = new Dequeue();
         $testReturn = $obj->destroy();
     }
     public function testCheckForFunctionsize()
     {
         $obj = new Dequeue();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionpollFront()
     {
         $obj = new Dequeue();
         $testReturn = $obj->pollFront();
     }
     public function testCheckForFunctionpollBack()
     {
         $obj = new Dequeue();
         $testReturn = $obj->pollBack();
     }
     public function testCheckForFunctionpush()
     {
         $obj = new Dequeue();
         $testReturn = $obj->push();
     }
     public function testCheckForFunctionpop()
     {
         $obj = new Dequeue();
         $testReturn = $obj->pop();
     }
     public function testCheckForFunctiongetFirst()
     {
         $obj = new Dequeue();
         $testReturn = $obj->getFirst();
     }
     public function testCheckForFunctiongetLast()
     {
         $obj = new Dequeue();
         $testReturn = $obj->getLast();
     }
     public function testCheckForFunctionclear()
     {
         $obj = new Dequeue();
         $testReturn = $obj->clear();
     }
     public function testCheckForFunctionremoveFirst()
     {
         $obj = new Dequeue();
         $testReturn = $obj->removeFirst();
     }
     public function testCheckForFunctionremFirstOcc()
     {
         $obj = new Dequeue();
         $testReturn = $obj->remFirstOcc();
     }
     public function testCheckForFunctionremLastOcc()
     {
         $obj = new Dequeue();
         $testReturn = $obj->remLastOcc();
     }
 }
