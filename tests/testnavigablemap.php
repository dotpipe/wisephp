<?php

namespace wise\src\lib;

require_once '\wise\src\lib\NavigableMap.php';

 class NavigableMapTest extends NavigableMap {

	public function testCheckForFunctiondestroy() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->destroy();
	}
	public function testCheckForFunctionceilKey() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->ceilKey();
	}
	public function testCheckForFunctionrevMap() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->revMap();
	}
	public function testCheckForFunctionfloorEntry() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->floorEntry();
	}
	public function testCheckForFunctionnavigableKeySet() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->navigableKeySet();
	}
	public function testCheckForFunctionpollFirst() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->pollFirst();
	}
	public function testCheckForFunctionpollLast() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->pollLast();
	}
	public function testCheckForFunctionfirstKey() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->firstKey();
	}
	public function testCheckForFunctionsave() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->save();
	}
	public function testCheckForFunctionloadJSON() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->loadJSON();
	}
	public function testCheckForFunctionlastKey() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->lastKey();
	}
	public function testCheckForFunctionheadMap() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->headMap();
	}
	public function testCheckForFunctionsubMap() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->subMap();
	}
	public function testCheckForFunctiontailMap() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->tailMap();
	}
	public function testCheckForFunctionsize() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->size();
	}
	public function testCheckForFunctionclear() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->clear();
	}
	public function testCheckForFunctionat() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->at();
	}
	public function testCheckForFunctionSorter() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->Sorter();
	}
	public function testCheckForFunctionkeyIsIn() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->keyIsIn();
	}
	public function testCheckForFunctionvalIsIn() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->valIsIn();
	}
	public function testCheckForFunctionequals() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->equals();
	}
	public function testCheckForFunctionget() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->get();
	}
	public function testCheckForFunctionisEmpty() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->isEmpty();
	}
	public function testCheckForFunctionmergeAll() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->mergeAll();
	}
	public function testCheckForFunctionremove() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->remove();
	}
	public function testCheckForFunctionfindKey() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->findKey();
	}
	public function testCheckForFunctionremovedat() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->removedat();
	}
	public function testCheckForFunctionreplace() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->replace();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctioncurrent() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->current();
	}
	public function testCheckForFunctiongetIndex() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->getIndex();
	}
	public function testCheckForFunctionsetIndex() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->setIndex();
	}
	public function testCheckForFunctionIter() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->Iter();
	}
	public function testCheckForFunctionrevIter() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->revIter();
	}
	public function testCheckForFunctionCycle() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->Cycle();
	}
	public function testCheckForFunctionrevCycle() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->revCycle();
	}
	public function testCheckForFunctionsync() 
	{
		$obj = new NavigableMap();
		$testReturn = $obj->sync();
	}
}
?>