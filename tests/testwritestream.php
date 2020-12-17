<?php

namespace wise\src\lib;

require_once '\wise\src\lib\writeStream.php';

 class writeStreamTest extends writeStream
 {
     public function testCheckForFunctiondestroy()
     {
         $obj = new writeStream();
         $testReturn = $obj->destroy();
     }
     public function testCheckForFunctiongetIndex()
     {
         $obj = new writeStream();
         $testReturn = $obj->getIndex();
     }
     public function testCheckForFunctionerase()
     {
         $obj = new writeStream();
         $testReturn = $obj->erase();
     }
     public function testCheckForFunctiondelete()
     {
         $obj = new writeStream();
         $testReturn = $obj->delete();
     }
     public function testCheckForFunctiontouch()
     {
         $obj = new writeStream();
         $testReturn = $obj->touch();
     }
     public function testCheckForFunctionaddStrm()
     {
         $obj = new writeStream();
         $testReturn = $obj->addStrm();
     }
     public function testCheckForFunctionsize()
     {
         $obj = new writeStream();
         $testReturn = $obj->size();
     }
     public function testCheckForFunctionIter()
     {
         $obj = new writeStream();
         $testReturn = $obj->Iter();
     }
     public function testCheckForFunctionCycle()
     {
         $obj = new writeStream();
         $testReturn = $obj->Cycle();
     }
     public function testCheckForFunctionrevIter()
     {
         $obj = new writeStream();
         $testReturn = $obj->revIter();
     }
     public function testCheckForFunctionrevCycle()
     {
         $obj = new writeStream();
         $testReturn = $obj->revCycle();
     }
     public function testCheckForFunctionprev()
     {
         $obj = new writeStream();
         $testReturn = $obj->prev();
     }
     public function testCheckForFunctioncurrent()
     {
         $obj = new writeStream();
         $testReturn = $obj->current();
     }
     public function testCheckForFunctionremoveIndex()
     {
         $obj = new writeStream();
         $testReturn = $obj->removeIndex();
     }
     public function testCheckForFunctionfileSize()
     {
         $obj = new writeStream();
         $testReturn = $obj->fileSize();
     }
     public function testCheckForFunctionsync()
     {
         $obj = new writeStream();
         $testReturn = $obj->sync();
     }
     public function testCheckForFunctionresize()
     {
         $obj = new writeStream();
         $testReturn = $obj->resize();
     }
     public function testCheckForFunctionsetDelim()
     {
         $obj = new writeStream();
         $testReturn = $obj->setDelim();
     }
     public function testCheckForFunctionresetDelim()
     {
         $obj = new writeStream();
         $testReturn = $obj->resetDelim();
     }
     public function testCheckForFunctionclearBuf()
     {
         $obj = new writeStream();
         $testReturn = $obj->clearBuf();
     }
     public function testCheckForFunctionseek()
     {
         $obj = new writeStream();
         $testReturn = $obj->seek();
     }
     public function testCheckForFunctioneof()
     {
         $obj = new writeStream();
         $testReturn = $obj->eof();
     }
     public function testCheckForFunctionreadBuf()
     {
         $obj = new writeStream();
         $testReturn = $obj->readBuf();
     }
     public function testCheckForFunctionwriteBuf()
     {
         $obj = new writeStream();
         $testReturn = $obj->writeBuf();
     }
     public function testCheckForFunctionclose()
     {
         $obj = new writeStream();
         $testReturn = $obj->close();
     }
     public function testCheckForFunctionchangeDir()
     {
         $obj = new writeStream();
         $testReturn = $obj->changeDir();
     }
     public function testCheckForFunctionclear()
     {
         $obj = new writeStream();
         $testReturn = $obj->clear();
     }
     public function testCheckForFunctionat()
     {
         $obj = new writeStream();
         $testReturn = $obj->at();
     }
     public function testCheckForFunctionSorter()
     {
         $obj = new writeStream();
         $testReturn = $obj->Sorter();
     }
     public function testCheckForFunctionkeyIsIn()
     {
         $obj = new writeStream();
         $testReturn = $obj->keyIsIn();
     }
     public function testCheckForFunctionvalIsIn()
     {
         $obj = new writeStream();
         $testReturn = $obj->valIsIn();
     }
     public function testCheckForFunctionequals()
     {
         $obj = new writeStream();
         $testReturn = $obj->equals();
     }
     public function testCheckForFunctionget()
     {
         $obj = new writeStream();
         $testReturn = $obj->get();
     }
     public function testCheckForFunctionisEmpty()
     {
         $obj = new writeStream();
         $testReturn = $obj->isEmpty();
     }
     public function testCheckForFunctionmergeAll()
     {
         $obj = new writeStream();
         $testReturn = $obj->mergeAll();
     }
     public function testCheckForFunctionremove()
     {
         $obj = new writeStream();
         $testReturn = $obj->remove();
     }
     public function testCheckForFunctionfindKey()
     {
         $obj = new writeStream();
         $testReturn = $obj->findKey();
     }
     public function testCheckForFunctionremovedat()
     {
         $obj = new writeStream();
         $testReturn = $obj->removedat();
     }
     public function testCheckForFunctionreplace()
     {
         $obj = new writeStream();
         $testReturn = $obj->replace();
     }
     public function testCheckForFunctionadd()
     {
         $obj = new writeStream();
         $testReturn = $obj->add();
     }
     public function testCheckForFunctionsave()
     {
         $obj = new writeStream();
         $testReturn = $obj->save();
     }
     public function testCheckForFunctionloadJSON()
     {
         $obj = new writeStream();
         $testReturn = $obj->loadJSON();
     }
     public function testCheckForFunctionsetIndex()
     {
         $obj = new writeStream();
         $testReturn = $obj->setIndex();
     }
 }
