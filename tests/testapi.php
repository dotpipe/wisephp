<?php

namespace wise\src\lib;

require_once '\wise\src\lib\api.php';

 class apiTest extends api {

	public function testCheckForFunctionsetIndent() 
	{
		$obj = new api();
		$testReturn = $obj->setIndent();
	}
	public function testCheckForFunctionreceive() 
	{
		$obj = new api();
		$testReturn = $obj->receive();
	}
	public function testCheckForFunctionjson2map() 
	{
		$obj = new api();
		$testReturn = $obj->json2map();
	}
	public function testCheckForFunctiondisplay() 
	{
		$obj = new api();
		$testReturn = $obj->display();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new api();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionconvert() 
	{
		$obj = new api();
		$testReturn = $obj->convert();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new api();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new api();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctiondestroy() 
	{
		$obj = new api();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new api();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionmapSearch() 
	{
		$obj = new api();
		$testReturn = $obj->mapSearch();
	}
	public function testCheckForFunctionnewMap() 
	{
		$obj = new api();
		$testReturn = $obj->newMap();
	}
	public function testCheckForFunctionhasNext() 
	{
		$obj = new api();
		$testReturn = $obj->hasNext();
	}
	public function testCheckForFunctionnext() 
	{
		$obj = new api();
		$testReturn = $obj->next();
	}
	public function testCheckForFunctionfindKey() 
	{
		$obj = new api();
		$testReturn = $obj->findKey();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new api();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new api();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new api();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new api();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new api();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new api();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionkeyIsIn() 
	{
		$obj = new api();
		$testReturn = $obj->keyIsIn();
	}
	public function testCheckForFunctionequals() 
	{
		$obj = new api();
		$testReturn = $obj->equals();
	}
	public function testCheckForFunctionget() 
	{
		$obj = new api();
		$testReturn = $obj->get();
	}
	public function testCheckForFunctionisEmpty() 
	{
		$obj = new api();
		$testReturn = $obj->isEmpty();
	}
	public function testCheckForFunctionaddAll() 
	{
		$obj = new api();
		$testReturn = $obj->addAll();
	}
	public function testCheckForFunctionremove() 
	{
		$obj = new api();
		$testReturn = $obj->remove();
	}
	public function testCheckForFunctionreplaceMap() 
	{
		$obj = new api();
		$testReturn = $obj->replaceMap();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new api();
		$testReturn = $obj->sync();
	}
	public function testCheckForFunctionat() 
	{
		$obj = new api();
		$testReturn = $obj->at();
	}
	public function testCheckForFunctionSorter() 
	{
		$obj = new api();
		$testReturn = $obj->Sorter();
	}
	public function testCheckForFunctionvalIsIn() 
	{
		$obj = new api();
		$testReturn = $obj->valIsIn();
	}
	public function testCheckForFunctionmergeAll() 
	{
		$obj = new api();
		$testReturn = $obj->mergeAll();
	}
	public function testCheckForFunctionremovedat() 
	{
		$obj = new api();
		$testReturn = $obj->removedat();
	}
	public function testCheckForFunctionreplace() 
	{
		$obj = new api();
		$testReturn = $obj->replace();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new api();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new api();
		$testReturn = $obj->current();
	}
}
?>