<?php

namespace wise\src\lib;

require_once '\wise\src\lib\readStream.php';

 class readStreamTest extends readStream {

	public function testCheckForFunctionaddStream() 
	{
		$obj = new readStream();
		$testReturn = $obj->addStream();
	}
	public function testCheckForFunctiondestroy() 
	{
		$obj = new readStream();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new readStream();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionerase() 
	{
		$obj = new readStream();
		$testReturn = $obj->erase();
	}
	public function testCheckForFunctiondelete() 
	{
		$obj = new readStream();
		$testReturn = $obj->delete();
	}
	public function testCheckForFunctiontouch() 
	{
		$obj = new readStream();
		$testReturn = $obj->touch();
	}
	public function testCheckForFunctionaddStrm() 
	{
		$obj = new readStream();
		$testReturn = $obj->addStrm();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new readStream();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new readStream();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new readStream();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new readStream();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new readStream();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionprev() 
	{
		$obj = new readStream();
		$testReturn = $obj->prev();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new readStream();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctionremoveIndex() 
	{
		$obj = new readStream();
		$testReturn = $obj->removeIndex();
	}
	public function testCheckForFunctionfileSize() 
	{
		$obj = new readStream();
		$testReturn = $obj->fileSize();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new readStream();
		$testReturn = $obj->sync();
	}
	public function testCheckForFunctionresize() 
	{
		$obj = new readStream();
		$testReturn = $obj->resize();
	}
	public function testCheckForFunctionsetDelim() 
	{
		$obj = new readStream();
		$testReturn = $obj->setDelim();
	}
	public function testCheckForFunctionresetDelim() 
	{
		$obj = new readStream();
		$testReturn = $obj->resetDelim();
	}
	public function testCheckForFunctionclearBuf() 
	{
		$obj = new readStream();
		$testReturn = $obj->clearBuf();
	}
	public function testCheckForFunctionseek() 
	{
		$obj = new readStream();
		$testReturn = $obj->seek();
	}
	public function testCheckForFunctioneof() 
	{
		$obj = new readStream();
		$testReturn = $obj->eof();
	}
	public function testCheckForFunctionreadBuf() 
	{
		$obj = new readStream();
		$testReturn = $obj->readBuf();
	}
	public function testCheckForFunctionwriteBuf() 
	{
		$obj = new readStream();
		$testReturn = $obj->writeBuf();
	}
	public function testCheckForFunctionclose() 
	{
		$obj = new readStream();
		$testReturn = $obj->close();
	}
	public function testCheckForFunctionchangeDir() 
	{
		$obj = new readStream();
		$testReturn = $obj->changeDir();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new readStream();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionat() 
	{
		$obj = new readStream();
		$testReturn = $obj->at();
	}
	public function testCheckForFunctionSorter() 
	{
		$obj = new readStream();
		$testReturn = $obj->Sorter();
	}
	public function testCheckForFunctionkeyIsIn() 
	{
		$obj = new readStream();
		$testReturn = $obj->keyIsIn();
	}
	public function testCheckForFunctionvalIsIn() 
	{
		$obj = new readStream();
		$testReturn = $obj->valIsIn();
	}
	public function testCheckForFunctionequals() 
	{
		$obj = new readStream();
		$testReturn = $obj->equals();
	}
	public function testCheckForFunctionget() 
	{
		$obj = new readStream();
		$testReturn = $obj->get();
	}
	public function testCheckForFunctionisEmpty() 
	{
		$obj = new readStream();
		$testReturn = $obj->isEmpty();
	}
	public function testCheckForFunctionmergeAll() 
	{
		$obj = new readStream();
		$testReturn = $obj->mergeAll();
	}
	public function testCheckForFunctionremove() 
	{
		$obj = new readStream();
		$testReturn = $obj->remove();
	}
	public function testCheckForFunctionfindKey() 
	{
		$obj = new readStream();
		$testReturn = $obj->findKey();
	}
	public function testCheckForFunctionremovedat() 
	{
		$obj = new readStream();
		$testReturn = $obj->removedat();
	}
	public function testCheckForFunctionreplace() 
	{
		$obj = new readStream();
		$testReturn = $obj->replace();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new readStream();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new readStream();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new readStream();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new readStream();
		$testReturn = $obj->setIndex();
	}
}
?>