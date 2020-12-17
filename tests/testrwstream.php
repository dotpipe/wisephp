<?php

namespace wise\src\lib;

require_once '\wise\src\lib\rwStream.php';

 class rwStreamTest extends rwStream
 {
     public function testCheckForFunctiondestroy()
     {
         $obj = new rwStream();
         $testReturn = $obj->destroy();
     }
     public function testCheckForFunctiongetIndex()
     {
         $obj = new rwStream();
         $testReturn = $obj->getIndex();
     }
     public function testCheckForFunctionerase()
     {
         $obj = new rwStream();
         $testReturn = $obj->erase();
     }
     public function testCheckForFunctiondelete()
     {
         $obj = new rwStream();
         $testReturn = $obj->delete();
     }
     public function testCheckForFunctiontouch()
     {
         $obj = new rwStream();
         $testReturn = $obj->touch();
     }
     public function testCheckForFunctionaddStrm()
     {
         $obj = new rwStream();
         $testReturn = $obj->addStrm();
     }
     public function testCheckForFunctionsize()
     {
         $obj = new rwStream();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionIter()
     {
         $obj = new rwStream();
         $testReturn = $obj->Iter();
     }
     public function testCheckForFunctionCycle()
     {
         $obj = new rwStream();
         $testReturn = $obj->Cycle();
     }
     public function testCheckForFunctionrevIter()
     {
         $obj = new rwStream();
         $testReturn = $obj->revIter();
     }
     public function testCheckForFunctionrevCycle()
     {
         $obj = new rwStream();
         $testReturn = $obj->revCycle();
     }
     public function testCheckForFunctionprev()
     {
         $obj = new rwStream();
         $testReturn = $obj->prev();
     }
     public function testCheckForFunctioncurrent()
     {
         $obj = new rwStream();
         $testReturn = $obj->current();
     }
     public function testCheckForFunctionremoveIndex()
     {
         $obj = new rwStream();
         $testReturn = $obj->removeIndex();
     }
     public function testCheckForFunctionfileSize()
     {
         $obj = new rwStream();
         $testReturn = $obj->fileSize();
     }
     public function testCheckForFunctionsync()
     {
         $obj = new rwStream();
         $testReturn = $obj->sync();
     }
     public function testCheckForFunctionresize()
     {
         $obj = new rwStream();
         $testReturn = $obj->resize();
     }
     public function testCheckForFunctionsetDelim()
     {
         $obj = new rwStream();
         $testReturn = $obj->setDelim();
     }
     public function testCheckForFunctionresetDelim()
     {
         $obj = new rwStream();
         $testReturn = $obj->resetDelim();
     }
     public function testCheckForFunctionclearBuf()
     {
         $obj = new rwStream();
         $testReturn = $obj->clearBuf();
     }
     public function testCheckForFunctionseek()
     {
         $obj = new rwStream();
         $testReturn = $obj->seek();
     }
     public function testCheckForFunctioneof()
     {
         $obj = new rwStream();
         $testReturn = $obj->eof();
     }
     public function testCheckForFunctionreadBuf()
     {
         $obj = new rwStream();
         $testReturn = $obj->readBuf();
     }
     public function testCheckForFunctionwriteBuf()
     {
         $obj = new rwStream();
         $testReturn = $obj->writeBuf();
     }
     public function testCheckForFunctionclose()
     {
         $obj = new rwStream();
         $testReturn = $obj->close();
     }
     public function testCheckForFunctionchangeDir()
     {
         $obj = new rwStream();
         $testReturn = $obj->changeDir();
     }
     public function testCheckForFunctionclear()
     {
         $obj = new rwStream();
         $testReturn = $obj->clear();
     }
     public function testCheckForFunctionat()
     {
         $obj = new rwStream();
         $testReturn = $obj->at();
     }
     public function testCheckForFunctionSorter()
     {
         $obj = new rwStream();
         $testReturn = $obj->Sorter();
     }
     public function testCheckForFunctionkeyIsIn()
     {
         $obj = new rwStream();
         $testReturn = $obj->keyIsIn();
     }
     public function testCheckForFunctionvalIsIn()
     {
         $obj = new rwStream();
         $testReturn = $obj->valIsIn();
     }
     public function testCheckForFunctionequals()
     {
         $obj = new rwStream();
         $testReturn = $obj->equals();
     }
     public function testCheckForFunctionget()
     {
         $obj = new rwStream();
         $testReturn = $obj->get();
     }
     public function testCheckForFunctionisEmpty()
     {
         $obj = new rwStream();
         $testReturn = $obj->isEmpty();
     }
     public function testCheckForFunctionmergeAll()
     {
         $obj = new rwStream();
         $testReturn = $obj->mergeAll();
     }
     public function testCheckForFunctionremove()
     {
         $obj = new rwStream();
         $testReturn = $obj->remove();
     }
     public function testCheckForFunctionfindKey()
     {
         $obj = new rwStream();
         $testReturn = $obj->findKey();
     }
     public function testCheckForFunctionremovedat()
     {
         $obj = new rwStream();
         $testReturn = $obj->removedat();
     }
     public function testCheckForFunctionreplace()
     {
         $obj = new rwStream();
         $testReturn = $obj->replace();
     }
     public function testCheckForFunctionadd()
     {
         $obj = new rwStream();
         $testReturn = $obj->add();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new rwStream();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new rwStream();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctionsetIndex()
     {
         $obj = new rwStream();
         $testReturn = $obj->setIndex();
     }
 }
