<?php

namespace wise\src\lib;

require_once '\wise\src\lib\Thread.php';

 class ThreadTest extends Thread {

	public function testCheckForFunctionsize() 
	{
		$obj = new Thread();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionstartThread() 
	{
		$obj = new Thread();
		$testReturn = $obj->startThread();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new Thread();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new Thread();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctionjoin() 
	{
		$obj = new Thread();
		$testReturn = $obj->join();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new Thread();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new Thread();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new Thread();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctionnext() 
	{
		$obj = new Thread();
		$testReturn = $obj->next();
	}
	public function testCheckForFunctionprev() 
	{
		$obj = new Thread();
		$testReturn = $obj->prev();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new Thread();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new Thread();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new Thread();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new Thread();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionclearThread() 
	{
		$obj = new Thread();
		$testReturn = $obj->clearThread();
	}
	public function testCheckForFunctionendThread() 
	{
		$obj = new Thread();
		$testReturn = $obj->endThread();
	}
	public function testCheckForFunctionreadThread() 
	{
		$obj = new Thread();
		$testReturn = $obj->readThread();
	}
	public function testCheckForFunctionwriteThread() 
	{
		$obj = new Thread();
		$testReturn = $obj->writeThread();
	}
	public function testCheckForFunctiondestroy() 
	{
		$obj = new Thread();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctionerase() 
	{
		$obj = new Thread();
		$testReturn = $obj->erase();
	}
	public function testCheckForFunctiondelete() 
	{
		$obj = new Thread();
		$testReturn = $obj->delete();
	}
	public function testCheckForFunctiontouch() 
	{
		$obj = new Thread();
		$testReturn = $obj->touch();
	}
	public function testCheckForFunctionaddStrm() 
	{
		$obj = new Thread();
		$testReturn = $obj->addStrm();
	}
	public function testCheckForFunctionremoveIndex() 
	{
		$obj = new Thread();
		$testReturn = $obj->removeIndex();
	}
	public function testCheckForFunctionfileSize() 
	{
		$obj = new Thread();
		$testReturn = $obj->fileSize();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new Thread();
		$testReturn = $obj->sync();
	}
	public function testCheckForFunctionresize() 
	{
		$obj = new Thread();
		$testReturn = $obj->resize();
	}
	public function testCheckForFunctionsetDelim() 
	{
		$obj = new Thread();
		$testReturn = $obj->setDelim();
	}
	public function testCheckForFunctionresetDelim() 
	{
		$obj = new Thread();
		$testReturn = $obj->resetDelim();
	}
	public function testCheckForFunctionclearBuf() 
	{
		$obj = new Thread();
		$testReturn = $obj->clearBuf();
	}
	public function testCheckForFunctionseek() 
	{
		$obj = new Thread();
		$testReturn = $obj->seek();
	}
	public function testCheckForFunctioneof() 
	{
		$obj = new Thread();
		$testReturn = $obj->eof();
	}
	public function testCheckForFunctionreadBuf() 
	{
		$obj = new Thread();
		$testReturn = $obj->readBuf();
	}
	public function testCheckForFunctionwriteBuf() 
	{
		$obj = new Thread();
		$testReturn = $obj->writeBuf();
	}
	public function testCheckForFunctionclose() 
	{
		$obj = new Thread();
		$testReturn = $obj->close();
	}
	public function testCheckForFunctionchangeDir() 
	{
		$obj = new Thread();
		$testReturn = $obj->changeDir();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new Thread();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionat() 
	{
		$obj = new Thread();
		$testReturn = $obj->at();
	}
	public function testCheckForFunctionSorter() 
	{
		$obj = new Thread();
		$testReturn = $obj->Sorter();
	}
	public function testCheckForFunctionkeyIsIn() 
	{
		$obj = new Thread();
		$testReturn = $obj->keyIsIn();
	}
	public function testCheckForFunctionvalIsIn() 
	{
		$obj = new Thread();
		$testReturn = $obj->valIsIn();
	}
	public function testCheckForFunctionequals() 
	{
		$obj = new Thread();
		$testReturn = $obj->equals();
	}
	public function testCheckForFunctionget() 
	{
		$obj = new Thread();
		$testReturn = $obj->get();
	}
	public function testCheckForFunctionisEmpty() 
	{
		$obj = new Thread();
		$testReturn = $obj->isEmpty();
	}
	public function testCheckForFunctionmergeAll() 
	{
		$obj = new Thread();
		$testReturn = $obj->mergeAll();
	}
	public function testCheckForFunctionremove() 
	{
		$obj = new Thread();
		$testReturn = $obj->remove();
	}
	public function testCheckForFunctionfindKey() 
	{
		$obj = new Thread();
		$testReturn = $obj->findKey();
	}
	public function testCheckForFunctionremovedat() 
	{
		$obj = new Thread();
		$testReturn = $obj->removedat();
	}
	public function testCheckForFunctionreplace() 
	{
		$obj = new Thread();
		$testReturn = $obj->replace();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new Thread();
		$testReturn = $obj->add();
	}
}
?>